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

use Swoopaholic\Component\Table\AbstractType;

class TextType extends AbstractType
{
    public function getParent()
    {
        return 'cell';
    }

    public function getName()
    {
        return 'text';
    }
}
