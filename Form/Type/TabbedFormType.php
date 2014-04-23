<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TabbedFormType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'mapped' => false
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        $tabs = array();
        $active = false;
        foreach ($form->all() as $child) {
            if ('tab' == $child->getConfig()->getType()->getName()) {
                $config = $child->getConfig();
                $id = $config->getName();
                $title = $config->getOption('title') ? $config->getOption('title') : $id;
                if ($config->getOption('active')) {
                    $active = $id;
                }
                $tabs[$id] = $title;
            }
        }

        $view->vars['active'] = $active;
        $view->vars['tabs'] = $tabs;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'tabbed';
    }
} 