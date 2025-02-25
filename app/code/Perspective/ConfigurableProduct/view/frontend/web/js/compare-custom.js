define([
    'jquery'
], function ($) {
    'use strict';

    let clickCount = 0;

    return function (originalWidget) {
        $.widget('mage.compare', originalWidget, {
            _create: function () {
                this._super();
                this._bindCounter();
            },

            _bindCounter: function () {
                this.element.on('click', () => {
                    clickCount++;
                    console.log('Add to Compare clicked: ' + clickCount + ' times');
                });
            }
        });

        return $.mage.compare;
    };
});
