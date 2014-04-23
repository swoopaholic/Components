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

interface TableRowInterface
{
    public function addColumn($data, $columnOptions = null);

    public function setColumnOptions($index, $options);

    public function getColumn($index);

    public function getColumnOptions($index);
}
