define(
    [
        'jquery',
        'uiComponent',
        'knockout'
    ],
    function ($, Component, ko) {
        'use strict';

        ko.extenders.maxOrderCustomerNoteLength = function (target, maxLength) {
            var timer;
            var result = ko.computed({
                read: target,
                write: function (val) {
                    if (maxLength > 0) {
                        clearTimeout(timer);
                        if (val.length > maxLength) {
                            var limitedVal = val.substring(0, maxLength);
                            if (target() === limitedVal) {
                                target.notifySubscribers();
                            } else {
                                target(limitedVal);
                            }
                            result.css("_error");
                            timer = setTimeout(function () { result.css(""); }, 800);
                        } else {
                            target(val);
                            result.css("");
                        }
                    } else {
                        target(val);
                    }
                }
            }).extend({ notify: 'always' });
            result.css = ko.observable();
            result(target());
            return result;
        };

        function getExistingCustomerNote() {
            return window.checkoutConfig.existing_customer_note;
        }

        return Component.extend({
            defaults: {
                template: 'Sga_CustomerNote/checkout/customer-note-block'
            },
            initialize: function() {
                this._super();
                var self = this;
                this.customer_note = ko.observable(getExistingCustomerNote()).extend({maxOrderCustomerNoteLength: this.getMaxLength()});

                this.remainingCharacters = ko.computed(function(){
                    return self.getMaxLength() - self.customer_note().length;
                });
            },
            showInCheckout: function() {
                return window.checkoutConfig.show_in_checkout;
            },
            hasMaxLength: function() {
                return window.checkoutConfig.max_length > 0;
            },
            getMaxLength: function () {
                return window.checkoutConfig.max_length;
            }
        });
    }
);
