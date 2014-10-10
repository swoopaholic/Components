<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table\Extension\Core\Type;

use Swoopaholic\Component\Table\TableBuilderInterface;
use Swoopaholic\Component\Table\TableInterface;
use Swoopaholic\Component\Table\TableView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class TableType extends BaseType
{
    private $classElements = array(
        'striped',
        'bordered',
        'hover',
        'condensed',
    );

    private $propertyAccessor;

    public function __construct(PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    /**
     * @return \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    public function getPropertyAccessor()
    {
        return $this->propertyAccessor;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $defaults = array(
            'responsive' => false,
        );

        foreach ($this->classElements as $element) {
            $defaults[$element] = false;
        }

        $resolver->setDefaults($defaults);

        $resolver->setAllowedValues(array());

        $allowedTypes = array('responsive' => 'bool');
        foreach ($this->classElements as $element) {
            $allowedTypes[$element] = 'bool';
        }

        $resolver->setAllowedTypes($allowedTypes);
    }

    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $isDataOptionSet = array_key_exists('data', $options);

        $builder
            ->setData($isDataOptionSet ? $options['data'] : null);
    }

    public function buildView(TableView $view, TableInterface $table, array $options)
    {
        parent::buildView($view, $table, $options);

        $view->vars['responsive'] = $options['responsive'];
        $view->vars['attr'] = array('class' => $this->getElementClass($options));

        $view->vars = array_replace($view->vars, array(
            'value'      => $table->getViewData(),
            'data'       => $table->getNormData(),
//            'label_attr' => $options['label_attr'],
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function finishView(TableView $view, TableInterface $table, array $options)
    {
    }

    public function getParent()
    {
    }

    public function getName()
    {
        return 'table';
    }

    protected function getElementClasses($options)
    {
        $classElements = array('table');
        foreach ($this->classElements as $element) {
            if ($options[$element]) {
                $classElements[] = 'table-' . $element;
            }
        }
        
        if (isset($options['attr']['class'])) {
            $classElements[] = $options['attr']['class'];
        }

        return $classElements;
    }

    private function getElementClass($options)
    {
        $classElements = $this->getElementClasses($options);

        return implode(' ', $classElements);
    }
}
