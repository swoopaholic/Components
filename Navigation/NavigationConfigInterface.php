<?php
namespace Swoopaholic\Component\Navigation;

/**
 * Interface NavigationConfigInterface
 * @package Swoopaholic\Component\Navigation
 */
interface NavigationConfigInterface
{
    public function getName();

    public function getType();

    public function setType(NavigationTypeInterface $type);

    public function isDisabled();

    public function setAttributes(array $attributes);

    public function getAttributes();

    public function hasAttribute($name);

    public function getAttribute($name, $default = null);

    public function getOptions();

    public function hasOption($name);

    public function getOption($name, $default = null);
}
