<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractType
 * @package Swoopaholic\Component\Table
 */
abstract class AbstractType implements TableTypeInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildView(TableView $view, TableInterface $table, array $options)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'table';
    }
}
