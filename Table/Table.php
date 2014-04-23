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

class Table implements TableInterface
{
    protected $parent;

    protected $children = array();

    protected $config;

    public function __construct(TableConfigInterface $config)
    {
        $this->config = $config;
    }

    public function offsetExists($name)
    {
        return $this->has($name);
    }

    public function offsetGet($name)
    {
        return $this->get($name);
    }

    public function offsetSet($name, $value)
    {
        $this->set($name, $value);
    }

    public function offsetUnset($name)
    {
        $this->remove($name);
    }

    /**
     * @param TableInterface $parent
     * @return $this
     */
    public function setParent(TableInterface $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return NavigationInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($name)
    {
        if (isset($this->children[$name])) {
            $this->children[$name]->setParent(null);

            unset($this->children[$name]);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->children[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        if (isset($this->children[$name])) {
            return $this->children[$name];
        }

        throw new OutOfBoundsException(sprintf('Child "%s" does not exist.', $name));
    }

    /**
     * @param $child
     * @return mixed
     */
    public function add($child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function all()
    {
        return $this->children;
    }

    /**
     * Returns the number of table children (implements the \Countable interface).
     *
     * @return integer The number of embedded table children
     */
    public function count()
    {
        return count($this->children);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        // TODO: Implement current() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        // TODO: Implement next() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }


    /**
     * Returns the name by which the table is identified in tables.
     *
     * @return string The name of the table.
     */
    public function getName()
    {
        return $this->config->getName();
    }

    /**
     * Returns whether this navigation element is disabled.
     *
     * The content of a disabled element is displayed, but not allowed to be
     * used in the interface.
     *
     * Navigation elements whose parents are disabled are considered disabled regardless of
     * their own state.
     *
     * @return Boolean
     */
    public function isDisabled()
    {
        // TODO: Implement isDisabled() method.
    }

    public function createView(TableView $parent = null)
    {
        $options = $this->getConfig()->getOptions();

        $view = $this->newView($parent);
        $this->config->getType()->buildView($view, $this, $options);

        foreach ($this->children as $name => $child) {
            /* @var NavigationInterface $child */
            $view->children[$name] = $child->createView($view);
        }

        return $view;
    }

    protected function newView(TableView $parent = null)
    {
        return new TableView($parent);
    }

    /**
     * @return TableConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }
}
