<?php
namespace Swoopaholic\Component\Table;

use Swoopaholic\Component\Table\Exception\InvalidArgumentException;
use Swoopaholic\Component\Table\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResolvedTableType implements ResolvedTableTypeInterface
{
    /**
     * @var TableTypeInterface
     */
    private $innerType;

    /**
     * @var ResolvedTableTypeInterface|null
     */
    private $parent;

    private $typeExtensions;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    public function __construct(TableTypeInterface $innerType, array $typeExtensions = array(), ResolvedTableTypeInterface $parent = null)
    {
        if (!preg_match('/^[a-z0-9_]*$/i', $innerType->getName())) {
            throw new InvalidArgumentException(sprintf(
                'The "%s" table type name ("%s") is not valid. Names must only contain letters, numbers, and "_".',
                get_class($innerType),
                $innerType->getName()
            ));
        }

        foreach ($typeExtensions as $extension) {
            if (!$extension instanceof TableTypeExtensionInterface) {
                throw new UnexpectedTypeException($extension, 'Swoopaholic\Component\Table\TableTypeExtensionInterface');
            }
        }

        $this->innerType = $innerType;
        $this->typeExtensions = $typeExtensions;
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->innerType->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getInnerType()
    {
        return $this->innerType;
    }

    /**
     * @return array
     */
    public function getTypeExtensions()
    {
        return $this->typeExtensions;
    }

    /**
     * {@inheritdoc}
     */
    public function createBuilder(TableFactoryInterface $factory, $name, array $options = array())
    {
        $options = $this->getOptionsResolver()->resolve($options);

        $builder = $this->newBuilder($name, $factory, $options);
        $builder->setType($this);

        $this->buildTable($builder, $options);

        return $builder;
    }

    /**
     * {@inheritdoc}
     */
    public function createView(TableInterface $table, TableView $parent = null)
    {
        $options = $table->getConfig()->getOptions();

        $view = $this->newView($parent);

        $this->buildView($view, $table, $options);

        foreach ($table as $name => $child) {
            /* @var TableInterface $child */
            $view->children[$name] = $child->createView($view);
        }

        $this->finishView($view, $table, $options);

        return $view;
    }

    /**
     * Finishes a table view for the type hierarchy.
     *
     * This method is protected in order to allow implementing classes
     * to change or call it in re-implementations of {@link createView()}.
     *
     * It is called after the children of the view have been built.
     *
     * @param TableView      $view    The table view to configure.
     * @param TableInterface $table    The table corresponding to the view.
     * @param array         $options The options used for the configuration.
     */
    public function finishView(TableView $view, TableInterface $table, array $options)
    {
        if (null !== $this->parent) {
            $this->parent->finishView($view, $table, $options);
        }

        $this->innerType->finishView($view, $table, $options);

        foreach ($this->typeExtensions as $extension) {
            /* @var TableTypeExtensionInterface $extension */
            $extension->finishView($view, $table, $options);
        }
    }
    
    /**
     * Configures a table builder for the type hierarchy.
     *
     * This method is protected in order to allow implementing classes
     * to change or call it in re-implementations of {@link createBuilder()}.
     *
     * @param TableBuilderInterface $builder The builder to configure.
     * @param array                $options The options used for the configuration.
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        if (null !== $this->parent) {
            $this->parent->buildTable($builder, $options);
        }

        $this->innerType->buildTable($builder, $options);

        foreach ($this->typeExtensions as $extension) {
            $extension->buildTable($builder, $options);
        }
    }

    /**
     * Configures a table view for the type hierarchy.
     *
     * This method is protected in order to allow implementing classes
     * to change or call it in re-implementations of {@link createView()}.
     *
     * It is called before the children of the view are built.
     *
     * @param TableView      $view    The table view to configure.
     * @param TableInterface $table    The table corresponding to the view.
     * @param array         $options The options used for the configuration.
     */
    public function buildView(TableView $view, TableInterface $table, array $options)
    {
        if (null !== $this->parent) {
            $this->parent->buildView($view, $table, $options);
        }

        $this->innerType->buildView($view, $table, $options);

        foreach ($this->typeExtensions as $extension) {
            $extension->buildView($view, $table, $options);
        }
    }

    /**
     * Returns the configured options resolver used for this type.
     *
     * This method is protected in order to allow implementing classes
     * to change or call it in re-implementations of {@link createBuilder()}.
     *
     * @return \Symfony\Component\OptionsResolver\OptionsResolverInterface The options resolver.
     */
    public function getOptionsResolver()
    {
        if (null === $this->optionsResolver) {
            if (null !== $this->parent) {
                $this->optionsResolver = clone $this->parent->getOptionsResolver();
            } else {
                $this->optionsResolver = new OptionsResolver();
            }

            $this->innerType->setDefaultOptions($this->optionsResolver);
        }

        return $this->optionsResolver;
    }

    /**
     * Creates a new builder instance.
     *
     * Override this method if you want to customize the builder class.
     *
     * @param string               $name      The name of the builder.
     * @param TableFactoryInterface $factory   The current table factory.
     * @param array                $options   The builder options.
     *
     * @return TableBuilderInterface The new builder instance.
     */
    protected function newBuilder($name, TableFactoryInterface $factory, array $options)
    {
        return new TableBuilder($name, $factory, $options);
    }

    /**
     * Creates a new view instance.
     *
     * Override this method if you want to customize the view class.
     *
     * @param TableView|null $parent The parent view, if available.
     *
     * @return TableView A new view instance.
     */
    protected function newView(TableView $parent = null)
    {
        return new TableView($parent);
    }
}
