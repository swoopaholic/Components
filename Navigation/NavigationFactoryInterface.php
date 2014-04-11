<?php
namespace Swoopaholic\Component\Navigation;

interface NavigationFactoryInterface
{
    /**
     * @param $name
     * @param NavigationTypeInterface $type
     * @param array $options
     * @return NavigationInterface
     */
    public function create($name, NavigationTypeInterface $type, array $options = array());

    /**
     * @param $name
     * @param array $options
     * @return NavigationInterface
     */
    public function createNamed($name, array $options = array());
}
