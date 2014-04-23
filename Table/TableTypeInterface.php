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

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

interface TableTypeInterface
{
    public function buildView(TableView $view, TableInterface $table, array $options);

    /**
     * Returns the name of the parent type.
     *
     * @return string|null The name of the parent type if any, null otherwise.
     */
    public function getParent();

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName();

    /**
     * @param OptionsResolverInterface $resolver
     * @return mixed
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);
}
