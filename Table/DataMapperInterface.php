<?php
namespace Swoopaholic\Component\Table;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface DataMapperInterface
{
    /**
     * Maps properties of some data to a list of forms.
     *
     * @param mixed           $data  Structured data.
     * @param TableInterface[] $forms A list of {@link TableInterface} instances.
     *
     * @throws Exception\UnexpectedTypeException if the type of the data parameter is not supported.
     */
    public function mapDataToTables($data, $tables);

}
