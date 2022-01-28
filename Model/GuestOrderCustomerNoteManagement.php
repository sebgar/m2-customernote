<?php
namespace Sga\CustomerNote\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;
use Sga\CustomerNote\Api\Data\OrderCustomerNoteInterface;
use Sga\CustomerNote\Api\GuestOrderCustomerNoteManagementInterface;
use Sga\CustomerNote\Api\OrderCustomerNoteManagementInterface;

class GuestOrderCustomerNoteManagement implements GuestOrderCustomerNoteManagementInterface
{
    protected $_quoteIdMaskFactory;
    protected $_orderCustomerNoteManagement;

    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        OrderCustomerNoteManagementInterface $orderCustomerNoteManagement
    ) {
        $this->_quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->_orderCustomerNoteManagement = $orderCustomerNoteManagement;
    }

    public function saveOrderCustomerNote(
        $cartId,
        OrderCustomerNoteInterface $orderCustomerNote
    ) {
        $quoteIdMask = $this->_quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->_orderCustomerNoteManagement->saveOrderCustomerNote($quoteIdMask->getQuoteId(), $orderCustomerNote);
    }
}
