define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Sga_CustomerNote/js/model/checkout/customer-note-validator'
    ],
    function (Component, additionalValidators, commentValidator) {
        'use strict';

        additionalValidators.registerValidator(commentValidator);

        return Component.extend({});
    }
);
