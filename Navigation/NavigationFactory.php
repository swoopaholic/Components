<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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
