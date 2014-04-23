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
