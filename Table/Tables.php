<?php
namespace Swoopaholic\Component\Table;

use Swoopaholic\Component\Table\Extension\Core\CoreExtension;

final class Tables
{
    /**
     * Creates a form factory with the default configuration.
     *
     * @return TableFactoryInterface The form factory.
     */
    public static function createTableFactory()
    {
        return self::createTableFactoryBuilder()->getTableFactory();
    }

    /**
     * Creates a form factory builder with the default configuration.
     *
     * @return TableFactoryBuilderInterface The form factory builder.
     */
    public static function createTableFactoryBuilder()
    {
        $builder = new TableFactoryBuilder();
        $builder->addExtension(new CoreExtension());

        return $builder;
    }

    /**
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }
}
