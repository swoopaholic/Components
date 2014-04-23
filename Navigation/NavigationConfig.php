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

/**
 * Class NavigationConfig
 * @package Swoopaholic\Component\Navigation
 */
class NavigationConfig implements NavigationConfigInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $disabled;

    /**
     * @var
     */
    private $type;

    /**
     * @var array
     */
    private $attributes = array();

    /**
     * @var array
     */
    private $options;

    /**
     * @param $name
     * @param $options
     */
    public function __construct($name, $options)
    {
        $this->name = (string) $name;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param NavigationTypeInterface $type
     * @return $this
     */
    public function setType(NavigationTypeInterface $type)
    {
        $this->type = $type;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled == true;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasAttribute($name)
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * @param $name
     * @param null $default
     * @return null
     */
    public function getAttribute($name, $default = null)
    {
        return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : $default;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasOption($name)
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * @param $name
     * @param null $default
     * @return null
     */
    public function getOption($name, $default = null)
    {
        return array_key_exists($name, $this->options) ? $this->options[$name] : $default;
    }
}
