<?php
namespace Perspective\UIComponentRest\Api\Data;

interface ReviewRepositoryInterface
{
    /**
     * Get reviews for a specific product
     *
     * @param int $productId
     * @return array
     */
    public function getReviewsByProductId($productId);
}
