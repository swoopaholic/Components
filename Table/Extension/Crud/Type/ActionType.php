<?php
/*
 * This file is part of the Swoopaholic Framework Bundle.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table\Extension\Crud\Type;

use Swoopaholic\Component\Table\Extension\Core\Type\BaseType;
use Swoopaholic\Component\Table\TableInterface;
use Swoopaholic\Component\Table\TableView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActionType extends BaseType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'icon' => null,
                'url' => null,
                'label' => null
            )
        );
        $resolver->setAllowedValues(array());
        $resolver->setAllowedTypes(array());
    }

    public function buildView(TableView $view, TableInterface $table, array $options)
    {
        parent::buildView($view, $table, $options);

        $view->vars['icon'] = $options['icon'];
        $view->vars['url'] = $options['url'];
        $view->vars['label'] = $options['label'];
    }

    public function getName()
    {
        return 'crud_action';
    }
}
