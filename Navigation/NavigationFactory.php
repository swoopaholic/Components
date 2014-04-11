<?php
namespace Swoopaholic\Component\Navigation;

use Symfony\Component\OptionsResolver\OptionsResolver;

class NavigationFactory implements NavigationFactoryInterface
{
    /**
     * @var NavigationRegistryInterface
     */
    private $registry;

    public function __construct(NavigationRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function create($name, NavigationTypeInterface $type, array $options = array())
    {
        $resolver = new OptionsResolver();
        $type->setDefaultOptions($resolver);
        $options = $resolver->resolve($options);

        $config = new NavigationConfig($name, $options);
        $config->setType($type);

        return new Navigation($config);
    }

    public function createNamed($name, array $options = array())
    {
        // TODO implement from registry...
    }
}
