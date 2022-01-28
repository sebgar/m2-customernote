<?php
namespace Sga\CustomerNote\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Quote\Api\CartRepositoryInterface;
use Sga\CustomerNote\Api\Data\OrderCustomerNoteInterface;
use Sga\CustomerNote\Api\OrderCustomerNoteManagementInterface;
use Sga\CustomerNote\Model\Data\OrderCustomerNote;
use Sga\CustomerNote\Helper\Config as ConfigHelper;

class OrderCustomerNoteManagement implements OrderCustomerNoteManagementInterface
{
    protected $_quoteRepository;
    protected $_configHelper;

    public function __construct(
        CartRepositoryInterface $quoteRepository,
        ConfigHelper $configHelper
    ) {
        $this->_quoteRepository = $quoteRepository;
        $this->_configHelper = $configHelper;
    }

    public function saveOrderCustomerNote(
        $cartId,
        OrderCustomerNoteInterface $orderCustomerNote
    ) {
        $quote = $this->_quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $note = $orderCustomerNote->getCustomerNote();

        $this->_validateNote($note);

        try {
            $quote->setData(OrderCustomerNote::FIELD_NAME, strip_tags($note));
            $this->_quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The order comment could not be saved'));
        }

        return $note;
    }

    protected function _validateNote($note)
    {
        $maxLength = $this->_configHelper->getMaxLength();
        if ($maxLength > 0 && (mb_strlen($note) > $maxLength)) {
            throw new ValidatorException(__('Comment is too long'));
        }
    }
}
