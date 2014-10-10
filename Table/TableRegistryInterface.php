<?php
namespace Swoopaholic\Component\Table;

interface TableRegistryInterface
{
    /**
     * Returns a form type by name.
     *
     * This methods registers the type extensions from the form extensions.
     *
     * @param string $name The name of the type
     *
     * @return ResolvedTableTypeInterface The type
     *
     * @throws Exception\UnexpectedTypeException  if the passed name is not a string
     * @throws Exception\InvalidArgumentException if the type can not be retrieved from any extension
     */
    public function getType($name);

    /**
     * Returns whether the given form type is supported.
     *
     * @param string $name The name of the type
     *
     * @return bool Whether the type is supported
     */
    public function hasType($name);

    /**
     * Returns the extensions loaded by the framework.
     *
     * @return TableExtensionInterface[]
     */
    public function getExtensions();
}
