<?php
namespace Swoopaholic\Component\Table;

interface TableFactoryInterface
{
    public function create($type = 'table', $data, array $options = array());

    public function createNamed($name, $type = 'table', $data = null, array $options = array());

    public function createBuilder($type = 'table', $data, array $options = array());

    public function createNamedBuilder($name, $type = 'table', $data, array $options = array());
}
