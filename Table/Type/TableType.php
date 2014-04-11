<?php
/**
 * Created 04-02-14 21:13
 */
namespace Swoopaholic\Component\Table\Type;

use Swoopaholic\Component\Table\TableInterface;
use Swoopaholic\Component\Table\TableView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TableType extends BaseType
{
    private $classElements = array(
        'striped',
        'bordered',
        'hover',
        'condensed',
    );

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

    public function buildView(TableView $view, TableInterface $table, array $options)
    {
        parent::buildView($view, $table, $options);

        $view->vars['responsive'] = $options['responsive'];
        $view->vars['attr'] = array('class' => $this->getElementClass($options));
    }

    public function getName()
    {
        return 'table';
    }

    private function getElementClass($options)
    {
        $classElements = array('table');
        foreach ($this->classElements as $element) {
            if ($options[$element]) {
                $classElements[] = 'table-' . $element;
            }
        }

        return implode(' ', $classElements);
    }
}
