<?php
namespace Swoopaholic\Component\Table;

interface TableBuilderInterface extends \Traversable, \Countable, TableConfigInterface
{
    /**
     * Adds a new field to this group. A field must have a unique name within
     * the group. Otherwise the existing field is overwritten.
     *
     * If you add a nested group, this group should also be represented in the
     * object hierarchy.
     *
     * @param string|int|TableBuilderInterface $child
     * @param string|TableTypeInterface        $type
     * @param array                           $options
     *
     * @return TableBuilderInterface The builder object.
     */
    public function add($child, $type = null, array $options = array());

    /**
     * Creates a form builder.
     *
     * @param string                   $name    The name of the form or the name of the property
     * @param string|TableTypeInterface $type    The type of the form or null if name is a property
     * @param array                    $options The options
     *
     * @return TableBuilderInterface The created builder.
     */
    public function create($name, $type = null, array $options = array());

    /**
     * Returns a child by name.
     *
     * @param string $name The name of the child
     *
     * @return TableBuilderInterface The builder for the child
     *
     * @throws Exception\InvalidArgumentException if the given child does not exist
     */
    public function get($name);

    /**
     * Removes the field with the given name.
     *
     * @param string $name
     *
     * @return TableBuilderInterface The builder object.
     */
    public function remove($name);

    /**
     * Returns whether a field with the given name exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name);

    /**
     * Returns the children.
     *
     * @return array
     */
    public function all();

    /**
     * Creates the table.
     *
     * @return Table The table
     */
    public function getTable();
}
