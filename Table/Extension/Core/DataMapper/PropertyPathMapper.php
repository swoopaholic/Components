<?php
namespace Swoopaholic\Component\Table\Extension\Core\DataMapper;

use Swoopaholic\Component\Table\DataMapperInterface;
use Swoopaholic\Component\Table\Exception\UnexpectedTypeException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * A data mapper using property paths to read/write data.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class PropertyPathMapper implements DataMapperInterface
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * Creates a new property path mapper.
     *
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function __construct(PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    /**
     * {@inheritdoc}
     */
    public function mapDataToTables($data, $tables)
    {
        $empty = null === $data || array() === $data;

        if (!$empty && !is_array($data) && !is_object($data)) {
            throw new UnexpectedTypeException($data, 'object, array or empty');
        }

        foreach ($tables as $table) {
            $propertyPath = $table->getPropertyPath();
            $config = $table->getConfig();

            if (!$empty && null !== $propertyPath && $config->getMapped()) {
                $table->setData($this->propertyAccessor->getValue($data, $propertyPath));
            } else {
                $table->setData($form->getConfig()->getData());
            }
        }
    }
}
