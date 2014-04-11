<?php
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
