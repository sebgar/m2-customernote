define([
    'jquery',
], function ($) {
    'use strict';

    $.widget('mage.customerNoteLength', {
        options: {},

        _create: function () {
            $(this.options.elements.input_text).on('keyup', function (e) {
                this.calculate();
            }.bind(this));

            this.calculate();
        },

        calculate: function () {
            var max = $(this.options.elements.result).data('length');
            var nb = $(this.options.elements.input_text).val().length;
            $(this.options.elements.result).html(max - nb);
        }
    });

    return $.mage.customerNoteLength;
});
