<?php
namespace Sga\CustomerNote\Model\Data;

use Magento\Framework\Api\AbstractSimpleObject;
use Sga\CustomerNote\Api\Data\OrderCustomerNoteInterface;

class OrderCustomerNote extends AbstractSimpleObject implements OrderCustomerNoteInterface
{
    const FIELD_NAME = 'customer_note';

    /**
     * @return string|null
     */
    public function getCustomerNote()
    {
        return $this->_get(static::FIELD_NAME);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCustomerNote($value)
    {
        return $this->setData(static::FIELD_NAME, $value);
    }
}
