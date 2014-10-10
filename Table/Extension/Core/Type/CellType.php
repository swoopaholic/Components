<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table\Extension\Core\Type;

use Swoopaholic\Component\Table\AbstractType;

class CellType extends AbstractType
{
    public function getName()
    {
        return 'cell';
    }
}
