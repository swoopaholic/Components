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

class TableView implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * The variables assigned to this view.
     * @var array
     */
    public $vars = array(
        'value' => null,
        'attr'  => array(),
    );

    public $parent;

    /**
     * The child views.
     * @var array
     */
    public $children = array();

    public function __construct(TableView $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * Returns a child by name (implements \ArrayAccess).
     *
     * @param string $name The child name
     *
     * @return navigation elementView The child view
     */
    public function offsetGet($name)
    {
        return $this->children[$name];
    }

    /**
     * Returns whether the given child exists (implements \ArrayAccess).
     *
     * @param string $name The child name
     *
     * @return Boolean Whether the child view exists
     */
    public function offsetExists($name)
    {
        return isset($this->children[$name]);
    }

    /**
     * Implements \ArrayAccess.
     *
     * @throws BadMethodCallException always as setting a child by name is not allowed
     */
    public function offsetSet($name, $value)
    {
        throw new BadMethodCallException('Not supported');
    }

    /**
     * Removes a child (implements \ArrayAccess).
     *
     * @param string $name The child name
     */
    public function offsetUnset($name)
    {
        unset($this->children[$name]);
    }

    /**
     * Returns an iterator to iterate over children (implements \IteratorAggregate)
     *
     * @return \ArrayIterator The iterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    /**
     * Implements \Countable.
     *
     * @return integer The number of children views
     */
    public function count()
    {
        return count($this->children);
    }
}
