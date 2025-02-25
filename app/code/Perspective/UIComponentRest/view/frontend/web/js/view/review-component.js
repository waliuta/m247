define(['uiComponent', 'jquery', 'ko'], function (Component, $, ko) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Perspective_UIComponentRest/review-component',
            productId: null, // Передается из x-magento-init
            reviews: ko.observableArray([]),
        },

        initialize: function () {
            this._super();
            console.log("UI Component initialize...");
            this.loadReviews();
        },

        /**
         * Загружает отзывы через REST API.
         */
        
        loadReviews: function () {
            var self = this;
            console.log('loadReview thisproductID...'+ this.productId);
            if (!this.productId) {
                console.error('Product ID is not provided');
                return;
            }

            var url = '/rest/V1/products/' + this.productId + '/reviews';
            console.log('URL...'+ url);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    self.reviews(data);
                },
                error: function () {
                    console.error('Failed to fetch reviews');
                },
            });
        },
        
        /*
        loadReviews: function () {
            const self = this;
            //var serviceUrl = 'rest/V1/product/${this.productId}/reviews';
            var url = '/rest/V1/products/' + this.productId + '/reviews';
            console.log('URL...'+ url);
            
            $.get(url, function (data) {
                self.reviews(data);
                console.log(data);
            });
            
        }
            */

    });
});


