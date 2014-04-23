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

class TableRow implements TableRowInterface
{
    protected $data;

    protected $columnOptions;

    public function __construct(array $data = array(), array $columnOptions = array())
    {
        $this->data = new \ArrayIterator($data);
        $this->columnOptions = new \ArrayIterator($columnOptions);
    }

    public function addColumn($data, $columnOptions = null)
    {
        // TODO: Implement $columnOptions
    }

    public function getData()
    {
        return $this->data;
    }

    public function setColumnOptions($index, $options)
    {
        if (! $this->data->offsetExists($index)) {
            throw new \Exception('Index does noet exist');
        }

        $this->columnOptions[$index] = $options;
    }

    public function getColumn($index)
    {
        if (! $this->data->offsetExists($index)) {
            throw new \Exception('Index does noet exist');
        }

        return $this->data->offsetGet($index);
    }

    public function getColumnOptions($index)
    {
        if (! $this->data->offsetExists($index)) {
            throw new \Exception('Index does noet exist');
        }

        return $this->columnOptions[$index];
    }
}
