<?php
namespace Swoopaholic\Component\Navigation\Type;

use Swoopaholic\Component\Navigation\NavigationInterface;
use Swoopaholic\Component\Navigation\NavigationView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BarType extends BaseType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'orientation' => 'top',
            'data-class' => ''
        ));

        $resolver->setAllowedValues(array(
            'orientation' => array('top', 'left', 'right'),
        ));

        $resolver->setAllowedTypes(array(
            'data-class' => 'string'
        ));
    }

    public function buildView(NavigationView $view, NavigationInterface $navigation, array $options)
    {
        parent::buildView($view, $navigation, $options);

        $view->vars['orientation'] = $options['orientation'];
        $view->vars['data-class'] = $options['data-class'];

    }

    public function getName()
    {
        return 'bar';
    }
}
