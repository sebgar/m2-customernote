<?php
namespace Sga\CustomerNote\Api\Data;

interface OrderCustomerNoteInterface
{
    /**
     * @return string|null
     */
    public function getCustomerNote();

    /**
     * @param string $value
     * @return null
     */
    public function setCustomerNote($value);
}
