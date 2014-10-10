<?php
namespace Swoopaholic\Component\Table;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

interface TableTypeExtensionInterface
{
    /**
     * Builds the table.
     *
     * This method is called after the extended type has built the table to
     * further modify it.
     *
     * @see TableTypeInterface::buildTable()
     *
     * @param TableBuilderInterface $builder The table builder
     * @param array                $options The options
     */
    public function buildTable(TableBuilderInterface $builder, array $options);

    /**
     * Builds the view.
     *
     * This method is called after the extended type has built the view to
     * further modify it.
     *
     * @see TableTypeInterface::buildView()
     *
     * @param TableView      $view    The view
     * @param TableInterface $form    The table
     * @param array         $options The options
     */
    public function buildView(TableView $view, TableInterface $form, array $options);

    /**
     * Finishes the view.
     *
     * This method is called after the extended type has finished the view to
     * further modify it.
     *
     * @see TableTypeInterface::finishView()
     *
     * @param TableView      $view    The view
     * @param TableInterface $form    The table
     * @param array         $options The options
     */
    public function finishView(TableView $view, TableInterface $form, array $options);

    /**
     * Overrides the default options from the extended type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType();
}
