<?php
namespace Swoopaholic\Component\Table\Extension\Crud;

use Swoopaholic\Component\Table\AbstractExtension;
use Swoopaholic\Component\Table\Extension\Crud\Sorting\SortResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

class CrudExtension extends AbstractExtension
{
    private $router;

    private $request;

    public function __construct(Request $request, RouterInterface $router)
    {
        $this->request = $request;
        $this->router = $router;
    }

    protected function loadTypes()
    {
        return array(
            new Type\TableType(new SortResolver($this->request), $this->router),
            new Type\CrudCellType(),
            new Type\ActionGroupType(),
            new Type\ActionType(),
            new Type\TextType(),
            new Type\DateTimeType(),
        );
    }
}
