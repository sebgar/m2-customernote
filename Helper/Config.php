<?php
namespace Sga\CustomerNote\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    const XML_PATH_SHOW_IN_CART = 'sales/customer_note/show_in_cart';
    const XML_PATH_SHOW_IN_CHECKOUT = 'sales/customer_note/show_in_checkout';
    const XML_PATH_MAX_LENGTH = 'sales/customer_note/max_length';

    public function isShowInCart($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_IN_CART,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function isShowInCheckout($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_IN_CHECKOUT,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getMaxLength($store = null)
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_MAX_LENGTH,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }
}
