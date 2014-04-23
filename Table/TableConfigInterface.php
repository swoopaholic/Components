<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table;

/**
 * Interface TableConfigInterface
 * @package Swoopaholic\Component\Table
 */
interface TableConfigInterface
{
    public function getName();

    public function getType();

    public function setType(TableTypeInterface $type);

    public function isDisabled();

    public function setAttributes(array $attributes);

    public function getAttributes();

    public function hasAttribute($name);

    public function getAttribute($name, $default = null);

    public function getOptions();

    public function hasOption($name);

    public function getOption($name, $default = null);
}
