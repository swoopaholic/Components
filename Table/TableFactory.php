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

use Symfony\Component\OptionsResolver\OptionsResolver;

class TableFactory implements TableFactoryInterface
{
//    /**
//     * @var TableRegistryInterface
//     */
//    private $registry;

    public function __construct(/*TableRegistryInterface $registry*/)
    {
        /*$this->registry = $registry;*/
    }

    public function create($name, TableTypeInterface $type, array $options = array())
    {
        $resolver = new OptionsResolver();
        $type->setDefaultOptions($resolver);
        $options = $resolver->resolve($options);

        $config = new TableConfig($name, $options);
        $config->setType($type);

        return new Table($config);
    }

    public function createNamed($name, array $options = array())
    {
        // TODO implement from registry...
    }
}
