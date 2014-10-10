<?php
namespace Swoopaholic\Component\Table;

interface TableFactoryBuilderInterface
{
    /**
     * Sets the factory for creating ResolvedTableTypeInterface instances.
     *
     * @param ResolvedTableTypeFactoryInterface $resolvedTypeFactory
     *
     * @return TableFactoryBuilderInterface The builder.
     */
    public function setResolvedTypeFactory(ResolvedTableTypeFactoryInterface $resolvedTypeFactory);

    /**
     * Adds an extension to be loaded by the factory.
     *
     * @param TableExtensionInterface $extension The extension.
     *
     * @return TableFactoryBuilderInterface The builder.
     */
    public function addExtension(TableExtensionInterface $extension);

    /**
     * Adds a list of extensions to be loaded by the factory.
     *
     * @param TableExtensionInterface[] $extensions The extensions.
     *
     * @return TableFactoryBuilderInterface The builder.
     */
    public function addExtensions(array $extensions);

    /**
     * Adds a table type to the factory.
     *
     * @param TableTypeInterface $type The table type.
     *
     * @return TableFactoryBuilderInterface The builder.
     */
    public function addType(TableTypeInterface $type);

    /**
     * Adds a list of table types to the factory.
     *
     * @param TableTypeInterface[] $types The table types.
     *
     * @return TableFactoryBuilderInterface The builder.
     */
    public function addTypes(array $types);

    /**
     * Adds a table type extension to the factory.
     *
     * @param TableTypeExtensionInterface $typeExtension The table type extension.
     *
     * @return TableFactoryBuilderInterface The builder.
     */
    public function addTypeExtension(TableTypeExtensionInterface $typeExtension);

    /**
     * Adds a list of table type extensions to the factory.
     *
     * @param TableTypeExtensionInterface[] $typeExtensions The table type extensions.
     *
     * @return TableFactoryBuilderInterface The builder.
     */
    public function addTypeExtensions(array $typeExtensions);

    /**
     * Builds and returns the factory.
     *
     * @return TableFactoryInterface The table factory.
     */
    public function getTableFactory();
}
