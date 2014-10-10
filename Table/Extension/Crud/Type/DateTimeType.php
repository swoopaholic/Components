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
use Swoopaholic\Component\Table\Extension\Crud\DataTransformer\DateTimeTransformer;
use Swoopaholic\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateTimeType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setAllowedTypes(array('data' => array('DateTime', 'null')));
    }

    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new DateTimeTransformer());
        parent::buildTable($builder, $options);
    }

    public function getParent()
    {
        return 'cell';
    }

    public function getName()
    {
        return 'datetime';
    }
}
