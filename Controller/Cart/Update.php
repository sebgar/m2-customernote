<?php
namespace Sga\CustomerNote\Controller\Cart;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Checkout\Model\Cart as CustomerCart;
use Magento\Checkout\Model\Session as CheckoutSession;
use Sga\CustomerNote\Model\Data\OrderCustomerNoteFactory;
use Sga\CustomerNote\Model\OrderCustomerNoteManagement;

class Update extends \Magento\Checkout\Controller\Cart implements HttpPostActionInterface
{
    protected $logger;
    protected $orderCustomerNoteManagement;
    protected $orderCustomerNoteFactory;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        CheckoutSession $checkoutSession,
        StoreManagerInterface $storeManager,
        Validator $formKeyValidator,
        CustomerCart $cart,
        LoggerInterface $logger,
        OrderCustomerNoteManagement $orderCustomerNoteManagement,
        OrderCustomerNoteFactory $orderCustomerNoteFactory
    ) {
        parent::__construct($context, $scopeConfig, $checkoutSession, $storeManager, $formKeyValidator, $cart);
        $this->logger = $logger;
        $this->orderCustomerNoteManagement = $orderCustomerNoteManagement;
        $this->orderCustomerNoteFactory = $orderCustomerNoteFactory;
    }

    public function execute()
    {
        try {
            $note = trim($this->getRequest()->getParam('customer_note', ''));
            $cartQuote = $this->cart->getQuote();

            $customerNote = $this->orderCustomerNoteFactory->create();
            $customerNote->setCustomerNote($note);

            $this->orderCustomerNoteManagement->saveOrderCustomerNote($cartQuote->getId(), $customerNote);
            $this->messageManager->addSuccessMessage(__('Your comment has been saved.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was an error when updating the quote.'));
            $this->logger->critical($e->getMessage(), ['exception' => $e->getTraceAsString()]);
        }

        return $this->_goBack();
    }
}
