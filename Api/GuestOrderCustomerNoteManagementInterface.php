<?php
namespace Sga\CustomerNote\Api;

/**
 * Interface for saving the checkout comment to the quote for guest orders
 */
interface GuestOrderCustomerNoteManagementInterface
{
    /**
     * @param string $cartId
     * @param \Sga\CustomerNote\Api\Data\OrderCustomerNoteInterface $orderCustomerNote
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function saveOrderCustomerNote(
        $cartId,
        \Sga\CustomerNote\Api\Data\OrderCustomerNoteInterface $orderCustomerNote
    );
}
