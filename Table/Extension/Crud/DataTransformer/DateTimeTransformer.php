<?php
/*
 * This file is part of the Swoopaholic Framework Bundle.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table\Extension\Crud\DataTransformer;

use Swoopaholic\Component\Table\DataTransformerInterface;

class DateTimeTransformer implements DataTransformerInterface
{
    private $format;

    public function __construct($format = 'Y-m-d H:i:s')
    {
        $this->format = $format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function transform($value)
    {
        if (is_null($value)) {
            return null;
        }

        if (! $value instanceof \DateTime) {
            throw new \InvalidArgumentException('DateTimeConverter only accepts DateTime objects');
        }

        return $value->format($this->format);
    }
}
