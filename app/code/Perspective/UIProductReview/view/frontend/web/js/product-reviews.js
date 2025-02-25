define([
    'uiComponent',
    'ko',
    'jquery',
    'mage/url',
  //  'text!Perspective_UIProductReview/template/product-reviews.html'
], function (Component, ko, $, urlBuilder, template) {
    return Component.extend({
        defaults: {
         //   template: 'Perspective_UIProductReview/product-reviews',
            reviews: ko.observableArray([]),
            productId: null,
        },

        initialize: function () {
            this._super();
            console.log('Product Reviews Component Initialized...');
            console.log('Product ID:', this.productId);
            this.loadReviews();
          //  this.initializeReviews();
        },

        /*
        initializeReviews: function () {
            // Используем переданные через блок данные
            if (!this.reviews || this.reviews.length === 0) {
                console.warn('No reviews available.');
            } else {
                console.log('Reviews initialized:', this.reviews);
            
            }
        }
*/
        
        loadReviews: function () {
            var self = this;
            console.log('loadReview thisproductID...'+ this.productId);
            if (!this.productId) {
                console.error('Product ID is not provided...');
                return;
            }
            if (this.reviews.length > 0) {
                console.log('Reviews loaded:', this.reviews);

                // Вывод никнейма из каждого отзыва
                this.reviews.forEach(function (review) {
                    console.log('Nickname:', review.nickname);
                });
            } else {
                console.warn('No reviews available to display.');
            }
        }
        
    });
});
