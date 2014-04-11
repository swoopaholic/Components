<?php
/**
 * Created 04-02-14 21:13
 */
namespace Swoopaholic\Component\Table\Type;

use Swoopaholic\Component\Table\TableInterface;
use Swoopaholic\Component\Table\TableView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RowType extends BaseType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array('state' => null));
        $resolver->setAllowedValues(array('state' => array('active', 'success', 'warning', 'danger')));
    }

    public function buildView(TableView $view, TableInterface $table, array $options)
    {
        parent::buildView($view, $table, $options);

        $view->vars['attr'] = array();

        if ($options['state']) {
            $view->vars['attr']['class'] = $options['state'];
        }
    }


    public function getName()
    {
        return 'row';
    }
}
