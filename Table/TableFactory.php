<?php
namespace Swoopaholic\Component\Table;

use Swoopaholic\Component\Table\Exception\UnexpectedTypeException;

class TableFactory implements TableFactoryInterface
{
    /**
     * @var TableRegistryInterface
     */
    private $registry;

    /**
     * @var ResolvedTableTypeFactoryInterface
     */
    private $resolvedTypeFactory;

    public function __construct(TableRegistryInterface $registry, ResolvedTableTypeFactoryInterface $resolvedTypeFactory)
    {
        $this->registry = $registry;
        $this->resolvedTypeFactory = $resolvedTypeFactory;
    }

    public function create($type = 'table', $data = null, array $options = array())
    {
        return $this->createBuilder($type, $data, $options)->getTable();
    }

    public function createNamed($name, $type = 'table', $data = null, array $options = array())
    {
        return $this->createNamedBuilder($name, $type, $data, $options)->getTable();
    }

    public function createBuilder($type = 'table', $data = null, array $options = array())
    {
//        $name = $type instanceof TableTypeInterface || $type instanceof ResolvedFormTypeInterface
//            ? $type->getName()
//            : $type;

        $name = is_object($type) ? $type->getName() : $type;

        return $this->createNamedBuilder($name, $type, $data, $options);
    }

    public function createNamedBuilder($name, $type = 'table', $data = null, array $options = array())
    {
        if (null !== $data && !array_key_exists('data', $options)) {
            $options['data'] = $data;
        }

        if ($type instanceof TableTypeInterface) {
            $type = $this->resolveType($type);
        } elseif (is_string($type)) {
            $type = $this->registry->getType($type);
        } else {
            throw new UnexpectedTypeException($type, 'string, or Swoopaholic\Component\Table\TableTypeInterface');
        }

        return $type->createBuilder($this, $name, $options);
    }

    private function resolveType(TableTypeInterface $type)
    {
        $parentType = $type->getParent();

        if ($parentType instanceof TableTypeInterface) {
            $parentType = $this->resolveType($parentType);
        } elseif (null !== $parentType) {
            $parentType = $this->registry->getType($parentType);
        }

        return $this->resolvedTypeFactory->createResolvedType(
            $type,
            array(),
            $parentType
        );
    }
}
