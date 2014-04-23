<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Navigation\Type;

use Swoopaholic\Component\Navigation\NavigationInterface;
use Swoopaholic\Component\Navigation\NavigationView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DropdownType extends MenuType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'label' => null,
                'icon' => '',
                'menu' => ''
            )
        );
    }

    public function buildView(NavigationView $view, NavigationInterface $navigation, array $options)
    {
        parent::buildView($view, $navigation, $options);

        $view->vars['menu'] = $options['menu'];
        $view->vars['label'] = $options['label'];
        $view->vars['icon'] = $options['icon'];
    }

    public function getName()
    {
        return 'dropdown';
    }
}