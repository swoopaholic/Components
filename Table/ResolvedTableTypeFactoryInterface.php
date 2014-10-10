<?php
namespace Swoopaholic\Component\Table;

/**
 * Creates ResolvedTableTypeInterface instances.
 *
 * This interface allows you to use your custom ResolvedTableTypeInterface
 * implementation, within which you can customize the concrete TableBuilderInterface
 * implementations or TableView subclasses that are used by the framework.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface ResolvedTableTypeFactoryInterface
{
    /**
     * Resolves a form type.
     *
     * @param TableTypeInterface              $type
     * @param TableTypeExtensionInterface[]   $typeExtensions
     * @param ResolvedTableTypeInterface|null $parent
     *
     * @return ResolvedTableTypeInterface
     *
     * @throws Exception\UnexpectedTypeException  if the types parent {@link TableTypeInterface::getParent()} is not a string
     * @throws Exception\InvalidArgumentException if the types parent can not be retrieved from any extension
     */
    public function createResolvedType(TableTypeInterface $type, array $typeExtensions, ResolvedTableTypeInterface $parent = null);
}
