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

use Swoopaholic\Component\Table\Exception\RuntimeException;
use Swoopaholic\Component\Table\Exception\OutOfBoundsException;
use Swoopaholic\Component\Table\Exception\UnexpectedTypeException;
use Swoopaholic\Component\Table\Util\OrderedHashMap;
use Symfony\Component\PropertyAccess\PropertyPath;
use Traversable;

class Table implements \IteratorAggregate, TableInterface
{
    protected $parent;

    protected $children = array();

    protected $config;

    private $viewData;

    private $normData;

    public function __construct(TableConfigInterface $config)
    {
        $this->config = $config;
        $this->children = new OrderedHashMap();
    }

    /**
     * @return mixed
     */
    public function getViewData()
    {
        return $this->viewData;
    }

    /**
     * @return mixed
     */
    public function getNormData()
    {
        return $this->normData;
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
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return $this->children;
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
    public function add($child, $type = null, array $options = array())
    {
        // Obtain the view data
        $viewData = null;

        // If setData() is currently being called, there is no need to call
        // mapDataToForms() here, as mapDataToForms() is called at the end
        // of setData() anyway. Not doing this check leads to an endless
        // recursion when initializing the form lazily and an event listener
        // (such as ResizeFormListener) adds fields depending on the data:
        //
        //  * setData() is called, the form is not initialized yet
        //  * add() is called by the listener (setData() is not complete, so
        //    the form is still not initialized)
        //  * getViewData() is called
        //  * setData() is called since the form is not initialized yet
        //  * ... endless recursion ...
        //
        // Also skip data mapping if setData() has not been called yet.
        // setData() will be called upon form initialization and data mapping
        // will take place by then.
//        if (!$this->lockSetData && $this->defaultDataSet && !$this->config->getInheritData()) {
//            $viewData = $this->getViewData();
//        }

        if (!$child instanceof TableInterface) {
            if (!is_string($child) && !is_int($child)) {
                throw new UnexpectedTypeException($child, 'string, integer or Swoopaholic\Component\Table\TableInterface');
            }

            if (null !== $type && !is_string($type) && !$type instanceof TableTypeInterface) {
                throw new UnexpectedTypeException($type, 'string or Swoopaholic\Component\Table\TableTypeInterface');
            }

            // Never initialize child forms automatically
//            $options['auto_initialize'] = false;

            if (null === $type) {
                $child = $this->config->getTableFactory()->createForProperty($this->config->getDataClass(), $child, null, $options);
            } else {
                $child = $this->config->getTableFactory()->createNamed($child, $type, null, $options);
            }
        }

        $this->children[$child->getName()] = $child;

        $child->setParent($this);

//        if (!$this->lockSetData && $this->defaultDataSet && !$this->config->getInheritData()) {
//            $iterator = new InheritDataAwareIterator(new \ArrayIterator(array($child)));
//            $iterator = new \RecursiveIteratorIterator($iterator);
//            $this->config->getDataMapper()->mapDataToForms($viewData, $iterator);
//        }

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

    /**
     * {@inheritdoc}
     */
    public function setData($modelData)
    {
        // Treat data as strings unless a value transformer exists
        if (!$this->config->getViewTransformers() && is_scalar($modelData)) {
            $modelData = (string) $modelData;
        }

        $viewData = $this->normToView($modelData);

        $this->normData = $modelData;
        $this->viewData = $viewData;
        return $this;
    }

    public function initialize()
    {
        if (null !== $this->parent) {
            throw new RuntimeException('Only root tables should be initialized.');
        }

        $this->setData($this->config->getData());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->setData($this->config->getData());

        return $this->modelData;
    }

    /**
     * {@inheritdoc}
     */
    public function getPropertyPath()
    {
        if (null !== $this->config->getPropertyPath()) {
            return $this->config->getPropertyPath();
        }

        if (null === $this->getName() || '' === $this->getName()) {
            return;
        }

        $parent = $this->parent;

        while ($parent && $parent->getConfig()->getInheritData()) {
            $parent = $parent->getParent();
        }

        if ($parent && null === $parent->getConfig()->getDataClass()) {
            return new PropertyPath('['.$this->getName().']');
        }

        return new PropertyPath($this->getName());
    }

    public function createView(TableView $parent = null)
    {
        if (null === $parent && $this->parent) {
            $parent = $this->parent->createView();
        }

        return $this->config->getType()->createView($this, $parent);
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

    /**
     * Transforms the value if a value transformer is set.
     *
     * @param mixed $value The value to transform
     *
     * @return mixed
     */
    private function normToView($value)
    {
        // Scalar values should  be converted to strings to
        // facilitate differentiation between empty ("") and zero (0).
        // Only do this for simple forms, as the resulting value in
        // compound forms is passed to the data mapper and thus should
        // not be converted to a string before.
        if (!$this->config->getViewTransformers()) {
            return null === $value || is_scalar($value) ? (string) $value : $value;
        }

        foreach ($this->config->getViewTransformers() as $transformer) {
            $value = $transformer->transform($value);
        }

        return $value;
    }
}
