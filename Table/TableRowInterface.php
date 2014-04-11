<?php
/**
 * Created 02-02-14 11:07
 */
namespace Swoopaholic\Component\Table;

interface TableRowInterface
{
    public function addColumn($data, $columnOptions = null);

    public function setColumnOptions($index, $options);

    public function getColumn($index);

    public function getColumnOptions($index);
}
