<?php
namespace Sga\CustomerNote\Api;

/**
 * Interface for saving the checkout comment to the quote for orders of logged in users
 * @api
 */
interface OrderCustomerNoteManagementInterface
{
    /**
     * @param int $cartId
     * @param \Sga\CustomerNote\Api\Data\OrderCustomerNoteInterface $orderCustomerNote
     * @return string
     */
    public function saveOrderCustomerNote(
        $cartId,
        \Sga\CustomerNote\Api\Data\OrderCustomerNoteInterface $orderCustomerNote
    );
}
