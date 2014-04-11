<?php
namespace Swoopaholic\Component\Navigation;

interface NavigationRegistryInterface
{
    public function getType($name);

    public function hasType($name);
}
