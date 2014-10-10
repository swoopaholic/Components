<?php
namespace Swoopaholic\Component\Table;

class TableFactoryBuilder implements TableFactoryBuilderInterface
{
    /**
     * @var ResolvedTableTypeFactoryInterface
     */
    private $resolvedTypeFactory;

    /**
     * @var TableExtensionInterface[]
     */
    private $extensions = array();

    /**
     * @var TableTypeInterface[]
     */
    private $types = array();

    /**
     * @var TableTypeExtensionInterface[]
     */
    private $typeExtensions = array();

    /**
     * {@inheritdoc}
     */
    public function setResolvedTypeFactory(ResolvedTableTypeFactoryInterface $resolvedTypeFactory)
    {
        $this->resolvedTypeFactory = $resolvedTypeFactory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addExtension(TableExtensionInterface $extension)
    {
        $this->extensions[] = $extension;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addExtensions(array $extensions)
    {
        $this->extensions = array_merge($this->extensions, $extensions);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addType(TableTypeInterface $type)
    {
        $this->types[$type->getName()] = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addTypes(array $types)
    {
        foreach ($types as $type) {
            $this->types[$type->getName()] = $type;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addTypeExtension(TableTypeExtensionInterface $typeExtension)
    {
        $this->typeExtensions[$typeExtension->getExtendedType()][] = $typeExtension;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addTypeExtensions(array $typeExtensions)
    {
        foreach ($typeExtensions as $typeExtension) {
            $this->typeExtensions[$typeExtension->getExtendedType()][] = $typeExtension;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTableFactory()
    {
        $extensions = $this->extensions;

        if (count($this->types) > 0 || count($this->typeExtensions) > 0) {
            $extensions[] = new PreloadedExtension($this->types, $this->typeExtensions);
        }

        $resolvedTypeFactory = $this->resolvedTypeFactory ?: new ResolvedTableTypeFactory();
        $registry = new TableRegistry($extensions, $resolvedTypeFactory);

        return new TableFactory($registry, $resolvedTypeFactory);
    }
}
