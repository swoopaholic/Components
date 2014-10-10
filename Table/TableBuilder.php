<?php
namespace Swoopaholic\Component\Table;

use Swoopaholic\Component\Table\Exception\InvalidArgumentException;
use Swoopaholic\Component\Table\Exception\UnexpectedTypeException;

class TableBuilder extends TableConfig implements \IteratorAggregate, TableBuilderInterface
{
    protected $factory;

    /**
     * The children of the builder.
     *
     * @var TableBuilderInterface[]
     */
    private $children = array();

    /**
     * The data of children who haven't been converted to builders yet.
     *
     * @var array
     */
    private $unresolvedChildren = array();

    /**
     * Creates a new builder.
     *
     * @param string                   $name
     * @param TableFactoryInterface     $factory
     * @param array                    $options
     */
    public function __construct($name, TableFactoryInterface $factory, array $options = array())
    {
        parent::__construct($name, $options);

        $this->factory = $factory;
    }

    public function add($child, $type = null, array $options = array())
    {
        if ($child instanceof self) {
            $this->children[$child->getName()] = $child;

            // In case an unresolved child with the same name exists
            unset($this->unresolvedChildren[$child->getName()]);

            return $this;
        }

        if (!is_string($child)) {
            throw new UnexpectedTypeException($child, 'string or Swoopaholic\Component\Table\TableBuilder');
        }

        if (null !== $type && !is_string($type) && !$type instanceof TableTypeInterface) {
            throw new UnexpectedTypeException($type, 'string or Swoopaholic\Component\Table\TableTypeInterface');
        }

        if (null === $type) {
            $type = 'text';
        }

        // Add to "children" to maintain order
        $this->children[$child] = null;
        $this->unresolvedChildren[$child] = array(
            'type'    => $type,
            'options' => $options,
        );

        return $this;
    }

    public function create($name, $type = null, array $options = array())
    {
        if (null === $type) {
            $type = 'text';
        }

        return $this->factory->createNamedBuilder($name, $type, null, $options);
    }

    public function get($name)
    {
        if (isset($this->unresolvedChildren[$name])) {
            return $this->resolveChild($name);
        }

        if (isset($this->children[$name])) {
            return $this->children[$name];
        }

        throw new InvalidArgumentException(sprintf('The child with the name "%s" does not exist.', $name));
    }

    public function remove($name)
    {
        unset($this->unresolvedChildren[$name]);

        if (array_key_exists($name, $this->children)) {
            unset($this->children[$name]);
        }

        return $this;
    }

    public function has($name)
    {
        if (isset($this->unresolvedChildren[$name])) {
            return true;
        }

        if (isset($this->children[$name])) {
            return true;
        }

        return false;
    }

    public function all()
    {
        $this->resolveChildren();
        return $this->children;
    }

    public function count()
    {
        return count($this->children);
    }

    public function getTable()
    {
        $this->resolveChildren();

        $table = new Table($this);

        foreach ($this->children as $child) {
            // Automatic initialization is only supported on root forms
            $table->add($child->getTable());
        }

        $table->initialize();

        return $table;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * Converts an unresolved child into a builder instance.
     */
    private function resolveChild($name)
    {
        $info = $this->unresolvedChildren[$name];
        $child = $this->create($name, $info['type'], $info['options']);
        $this->children[$name] = $child;
        unset($this->unresolvedChildren[$name]);

        return $child;
    }

    /**
     * Converts all unresolved children into builder instances.
     */
    private function resolveChildren()
    {
        foreach ($this->unresolvedChildren as $name => $info) {
            $this->children[$name] = $this->create($name, $info['type'], $info['options']);
        }

        $this->unresolvedChildren = array();
    }
}
