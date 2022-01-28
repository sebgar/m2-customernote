<?php

namespace Sga\CustomerNote\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Checkout\Model\Session;
use Sga\CustomerNote\Model\Data\OrderCustomerNote;
use Sga\CustomerNote\Helper\Config as ConfigHelper;

class CheckoutProvider implements ConfigProviderInterface
{
    protected $_checkoutSession;
    protected $_configHelper;

    public function __construct(
        Session $checkoutSession,
        ConfigHelper $configHelper
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_configHelper = $configHelper;
    }

    public function getConfig()
    {
        $customerNote = '';
        if ($this->_checkoutSession->getQuoteId()) {
            $customerNote = $this->_checkoutSession->getQuote()->getData(OrderCustomerNote::FIELD_NAME) ?: '';
        }

        return [
            'show_in_checkout' => $this->_configHelper->isShowInCheckout(),
            'max_length' => $this->_configHelper->getMaxLength(),
            'existing_customer_note' => $customerNote
        ];
    }
}
