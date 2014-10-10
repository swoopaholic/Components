<?php
/*
 * This file is part of the Swoopaholic Framework Bundle.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table\Extension\Crud\Type;

use Swoopaholic\Component\Table\Extension\Core\Type\BaseType;

class ActionGroupType extends BaseType
{
    public function getName()
    {
        return 'crud_action_group';
    }
}
