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

interface ProviderInterface
{
    /**
     * Retrieves a navigation by its section and name
     *
     * @param string $name
     * @param array $options
     * @return NavigationInterface
     * @throws \InvalidArgumentException if the NavBar element does not exists
     */
    function get($name, array $options = array());

    /**
     * Checks whether a menu exists in this provider
     *
     * @param string $name
     * @internal param array $options
     * @return bool
     */
    function has($name);
}
