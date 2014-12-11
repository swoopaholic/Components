<?php
namespace Swoopaholic\Component\Table\Extension\Crud\Type;

use Swoopaholic\Component\Table\Extension\Core\Type\TableType as Base;
use Swoopaholic\Component\Table\Extension\Crud\Sorting\SortResolverInterface;
use Swoopaholic\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\RouterInterface;

class TableType extends Base
{
    protected $columns = array();

    protected $sortResolver;

    protected $router;

    public function setSortResolver(SortResolverInterface $sortResolver)
    {
        $this->sortResolver = $sortResolver;
    }

    /**
     * @param RouterInterface $router
     * @return $this
     */
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
        return $this;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'use_thead' => false,
            'use_tbody' => false,
            'extra_url_params' => array(),
        ))->setRequired(array(
            'table_route', 'data'
        ))->addAllowedTypes(array(
            'data'  => array('array', 'Iterator'),
            'use_tbody' => 'bool',
            'use_thead' => 'bool',
            'extra_url_params' => array('array'),
        ));
    }

    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $this->buildTableHeader($builder, $options);
        $this->buildTableBody($builder, $options);
    }

    public function getParent()
    {
        return 'table';
    }

    public function getName()
    {
        return 'crud_table';
    }

    protected function buildTableHeader(TableBuilderInterface $builder, $options)
    {
        $headRow = $builder->create('row', 'row', array());
        if ($options['use_thead']) {
            $wrapper = $builder->create('thead', 'head', array());
            $builder->add($wrapper);
            $wrapper->add($headRow);
        } else {
            $builder->add($headRow);
        }

        $wrapper = $headRow;
        foreach ($this->columns as $name => $info) {
            $label = isset($info['options']['label']) ? $info['options']['label'] : $name;
            $params = array('label' => $label);

            if (isset($info['options']['sort'])) {
                $sortParams = $this->sortResolver->getSortParams($info['options']['sort'], $options['extra_url_params']);
                $sortLink = $options['table_route'];
                $params['sortLink'] = $this->router->generate($sortLink, $sortParams);
                $params['sortDir'] = $this->sortResolver->getSortDir($info['options']['sort']);
                $params['active'] = $this->sortResolver->isSort($info['options']['sort']);
            }

            $cell = $builder->create($name, 'head_cell', $params);
            $wrapper->add($cell);
        }

        // for crud actions
        $cell = $builder->create('actions', 'head_cell');
        $wrapper->add($cell);
    }

    protected function buildTableBody(TableBuilderInterface $builder, $options)
    {
        if ($options['use_tbody']) {
            $container = $builder->create('tbody', 'body', array());
            $builder->add($container);
        } else {
            $container = $builder;
        }

        $count = (string) is_array($options['data']) ? count($options['data']) : $options['data']->count();
        $padCount = strlen($count);

        $i = 1;
        foreach ($options['data'] as $item) {
            $rowNumber = str_pad($i++, $padCount, '0', STR_PAD_LEFT);
            $row = $builder->create('row' . $rowNumber, 'row', array());

            foreach ($this->columns as $name => $info) {
                $value = $this->getValue($item, $name);
                $type = $info['type'];
                $cell = $builder->create($name, $type, array('data' => $value));
                $row->add($cell);
            }

            $cell = $builder->create('actions', 'crud_cell', array());
            $row->add($cell);

            $this->buildRowActions($builder, $cell, $item, $options);

            $container->add($row);
        }
    }

    private function getValue($item, $index)
    {
        if (is_array($item)) {
            return $item[$index];
        } elseif (is_object($item)) {
            return $this->getObjectValue($item, $index);
        }

        throw new \Exception('huh?');
    }

    private function getObjectValue($item, $index)
    {
        if (strpos($index, '.')) {
            $indexes = explode('.', $index);
            return $this->getObjectIterateValue($item, $indexes);
        }

        $value = $this->getPropertyAccessor()->getValue($item, $index);
        if (isset($this->converters[$index])) {
            $converter = $this->converters[$index];
            $value = $converter->convert($value);
        }

        return $value;
    }

    private function getObjectIterateValue($item, array $indexes)
    {
        if (empty($item)) {
            return null;
        }

        $property = array_shift($indexes);

        $value = $this->getPropertyAccessor()->getValue($item, $property);

        return empty($indexes)
            ? $this->getObjectValue($item, $property)
            : $this->getObjectIterateValue($value, $indexes);
    }

    protected function addColumn($name, $type, array $options = array())
    {
        $this->columns[$name] = compact('type', 'options');
        return $this;
    }

    protected function getElementClasses($options)
    {
        $classes = parent::getElementClasses($options);
        $classes[] = 'table-crud';

        return $classes;
    }


}
