<?php
namespace Swoopaholic\Component\Table;

use Swoopaholic\Component\Table\Exception\InvalidArgumentException;

class PreloadedExtension implements TableExtensionInterface
{
    /**
     * @var TableTypeInterface[]
     */
    private $types = array();

    /**
     * @var array[TableTypeExtensionInterface[]]
     */
    private $typeExtensions = array();

    /**
     * Creates a new preloaded extension.
     *
     * @param TableTypeInterface[]                 $types         The types that the extension should support.
     * @param array[TableTypeExtensionInterface[]] typeExtensions The type extensions that the extension should support.
     */
    public function __construct(array $types, array $typeExtensions)
    {
        $this->types = $types;
        $this->typeExtensions = $typeExtensions;
    }

    /**
     * {@inheritdoc}
     */
    public function getType($name)
    {
        if (!isset($this->types[$name])) {
            throw new InvalidArgumentException(sprintf('The type "%s" can not be loaded by this extension', $name));
        }

        return $this->types[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasType($name)
    {
        return isset($this->types[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getTypeExtensions($name)
    {
        return isset($this->typeExtensions[$name])
            ? $this->typeExtensions[$name]
            : array();
    }

    /**
     * {@inheritdoc}
     */
    public function hasTypeExtensions($name)
    {
        return !empty($this->typeExtensions[$name]);
    }
}
