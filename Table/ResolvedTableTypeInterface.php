<?php
namespace Swoopaholic\Component\Table;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * A wrapper for a table type and its extensions.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface ResolvedTableTypeInterface
{
    /**
     * Returns the name of the type.
     *
     * @return string The type name.
     */
    public function getName();

    /**
     * Returns the parent type.
     *
     * @return ResolvedTableTypeInterface|null The parent type or null.
     */
    public function getParent();

    /**
     * Returns the wrapped table type.
     *
     * @return TableTypeInterface The wrapped table type.
     */
    public function getInnerType();

    /**
     * Returns the extensions of the wrapped table type.
     *
     * @return TableTypeExtensionInterface[] An array of {@link TableTypeExtensionInterface} instances.
     */
    public function getTypeExtensions();

    /**
     * Creates a new table builder for this type.
     *
     * @param TableFactoryInterface $factory The table factory.
     * @param string               $name    The name for the builder.
     * @param array                $options The builder options.
     *
     * @return TableBuilderInterface The created table builder.
     */
    public function createBuilder(TableFactoryInterface $factory, $name, array $options = array());

    /**
     * Creates a new table view for a table of this type.
     *
     * @param TableInterface $table   The table to create a view for.
     * @param TableView      $parent The parent view or null.
     *
     * @return TableView The created table view.
     */
    public function createView(TableInterface $table, TableView $parent = null);

    /**
     * Configures a table builder for the type hierarchy.
     *
     * @param TableBuilderInterface $builder The builder to configure.
     * @param array                $options The options used for the configuration.
     */
    public function buildTable(TableBuilderInterface $builder, array $options);

    /**
     * Configures a table view for the type hierarchy.
     *
     * It is called before the children of the view are built.
     *
     * @param TableView      $view    The table view to configure.
     * @param TableInterface $table    The table corresponding to the view.
     * @param array         $options The options used for the configuration.
     */
    public function buildView(TableView $view, TableInterface $table, array $options);

    /**
     * Finishes a table view for the type hierarchy.
     *
     * It is called after the children of the view have been built.
     *
     * @param TableView      $view    The table view to configure.
     * @param TableInterface $table    The table corresponding to the view.
     * @param array         $options The options used for the configuration.
     */
    public function finishView(TableView $view, TableInterface $table, array $options);

    /**
     * Returns the configured options resolver used for this type.
     *
     * @return OptionsResolverInterface The options resolver.
     */
    public function getOptionsResolver();
}
