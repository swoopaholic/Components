<?php
namespace Swoopaholic\Component\Table\Extension\Core;

use Swoopaholic\Component\Table\AbstractExtension;
use Symfony\Component\PropertyAccess\PropertyAccess;

class CoreExtension extends AbstractExtension
{
    protected function loadTypes()
    {
        return array(
            new Type\TableType(PropertyAccess::createPropertyAccessor()),
            new Type\BodyType(),
            new Type\CellType(),
            new Type\HeadCellType(),
            new Type\HeadType(),
            new Type\RowType(),
        );
    }
}
