<?php
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
