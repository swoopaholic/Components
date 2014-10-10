<?php
namespace Swoopaholic\Component\Table;

//use Swoopaholic\Component\Table\Exception\ExceptionInterface;
use Swoopaholic\Component\Table\Exception\UnexpectedTypeException;
use Swoopaholic\Component\Table\Exception\InvalidArgumentException;

class TableRegistry implements TableRegistryInterface
{
    /**
     * Extensions
     *
     * @var TableExtensionInterface[] An array of TableExtensionInterface
     */
    private $extensions = array();

    /**
     * @var TableTypeInterface[]
     */
    private $types = array();

    /**
     * @var TableTypeGuesserInterface|false|null
     */
    private $guesser = false;

    /**
     * @var ResolvedTableTypeFactoryInterface
     */
    private $resolvedTypeFactory;

    /**
     * Constructor.
     *
     * @param TableExtensionInterface[]         $extensions          An array of TableExtensionInterface
     * @param ResolvedTableTypeFactoryInterface $resolvedTypeFactory The factory for resolved form types.
     *
     * @throws UnexpectedTypeException if any extension does not implement TableExtensionInterface
     */
    public function __construct(array $extensions, ResolvedTableTypeFactoryInterface $resolvedTypeFactory)
    {
        foreach ($extensions as $extension) {
            if (!$extension instanceof TableExtensionInterface) {
                throw new UnexpectedTypeException($extension, 'Symfony\Component\Table\TableExtensionInterface');
            }
        }

        $this->extensions = $extensions;
        $this->resolvedTypeFactory = $resolvedTypeFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getType($name)
    {
        if (!is_string($name)) {
            throw new UnexpectedTypeException($name, 'string');
        }

        if (!isset($this->types[$name])) {
            $type = null;

            foreach ($this->extensions as $extension) {
                if ($extension->hasType($name)) {
                    $type = $extension->getType($name);
                    break;
                }
            }

            if (!$type) {
                throw new InvalidArgumentException(sprintf('Could not load type "%s"', $name));
            }

            $this->resolveAndAddType($type);
        }

        return $this->types[$name];
    }

    /**
     * Wraps a type into a ResolvedTableTypeInterface implementation and connects
     * it with its parent type.
     *
     * @param TableTypeInterface $type The type to resolve.
     *
     * @return ResolvedTableTypeInterface The resolved type.
     */
    private function resolveAndAddType(TableTypeInterface $type)
    {
        $parentType = $type->getParent();

        if ($parentType instanceof TableTypeInterface) {
            $this->resolveAndAddType($parentType);
            $parentType = $parentType->getName();
        }

        $typeExtensions = array();

        foreach ($this->extensions as $extension) {
            $typeExtensions = array_merge(
                $typeExtensions,
                $extension->getTypeExtensions($type->getName())
            );
        }

        $this->types[$type->getName()] = $this->resolvedTypeFactory->createResolvedType(
            $type,
            $typeExtensions,
            $parentType ? $this->getType($parentType) : null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function hasType($name)
    {
        if (isset($this->types[$name])) {
            return true;
        }

        try {
            $this->getType($name);
        } catch (ExceptionInterface $e) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensions()
    {
        return $this->extensions;
    }
}
