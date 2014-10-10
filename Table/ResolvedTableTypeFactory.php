<?php
namespace Swoopaholic\Component\Table;

class ResolvedTableTypeFactory implements ResolvedTableTypeFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createResolvedType(TableTypeInterface $type, array $typeExtensions, ResolvedTableTypeInterface $parent = null)
    {
        return new ResolvedTableType($type, $typeExtensions, $parent);
    }
}
