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

interface TableFactoryInterface
{
    /**
     * @param $name
     * @param TableTypeInterface $type
     * @param array $options
     * @return TableInterface
     */
    public function create($name, TableTypeInterface $type, array $options = array());

    /**
     * @param $name
     * @param array $options
     * @return TableInterface
     */
    public function createNamed($name, array $options = array());
}
