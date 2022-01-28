<?php
namespace Sga\CustomerNote\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Sga\CustomerNote\Model\Data\OrderCustomerNote;
use Sga\CustomerNote\Helper\Config as ConfigHelper;

class CartCustomerNote implements ArgumentInterface
{
    protected $_checkoutSession;
    protected $_configHelper;

    public function __construct(
        CheckoutSession $checkoutSession,
        ConfigHelper $configHelper
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_configHelper = $configHelper;
    }

    public function getComment(): ?string
    {
        if ($this->_checkoutSession->getQuoteId()) {
            return $this->_checkoutSession->getQuote()->getData(OrderCustomerNote::FIELD_NAME);
        }
        return null;
    }

    public function getExtraClass(): string
    {
        $class = '';
        $maxLength = $this->getMaxLength();
        if ($maxLength > 0) {
            $class .= 'validate-length maximum-length-' . $maxLength;
        }
        return $class;
    }

    public function getMaxLength()
    {
        return $this->_configHelper->getMaxLength();
    }

    public function hasMaxLength()
    {
        return $this->getMaxLength() > 0;
    }
}
