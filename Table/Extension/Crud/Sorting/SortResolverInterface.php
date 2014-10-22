<?php
/*
 * This file is part of the Swoopaholic Framework Bundle.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Table\Extension\Crud\Sorting;

interface SortResolverInterface
{
    /**
     * Returns the uri query params for the sort key
     *
     * @param $key
     * @param array $extraUrlParams
     * @return array
     */
    public function getSortParams($key, $extraUrlParams = array());

    /**
     * Returns the current sort direction for the key
     *
     * @param $key
     * @return string 'ASC|'DESC'
     */
    public function getSortDir($key);

    /**
     * Checks if the key is the current sort
     *
     * @param $key
     * @return boolean
     */
    public function isSort($key);
}
