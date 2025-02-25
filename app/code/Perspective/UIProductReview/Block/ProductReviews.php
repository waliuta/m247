<?php
namespace Perspective\UIProductReview\Block;

class ProductReviews extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @var Magento\Review\Model\ResourceModel\Review\CollectionFactory
     */
    private $_ratingCollection;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $_ratingCollection,
            array $data = []
    ) {
        $this->registry = $registry;
        $this->_ratingCollection = $_ratingCollection;
        parent::__construct($context, $data);
    }

    public function getProductId()
    {
        return $this->getRequest()->getParam('id');
    }

    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getReviewCollection($product)
    {
        $rating = $this->_ratingCollection;
        $collection = $rating->create()
            ->addStatusFilter(
                \Magento\Review\Model\Review::STATUS_APPROVED
            )->addEntityFilter(
                'product',
                $product->getId()
            )->setDateOrder();

     return  $collection;      
   // echo "<pre>";
    //print_r($collection->getData());
}

}





/*

<?php

namespace Perspective\UIProductReview\Block;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Review\Model\RatingFactory;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory;
use Magento\Review\Model\Review;
use \Magento\Catalog\Helper\Data;

class Reviews extends \Magento\Framework\View\Element\Template
{

    protected $ratingobj;
    protected $productobj;
    protected $reviewobj;
    protected $cataloghelper;

    public function __construct(
        StoreManagerInterface $storeManager,
        ProductFactory $productobj,
        RatingFactory $ratingFactory,
        CollectionFactory $reviewFactory,
        Data $catalogHelper
        )
    {
            $this->_storeManager = $storeManager;
            $this->productobj = $productobj;
            $this->ratingobj = $ratingFactory;
            $this->reviewobj = $reviewFactory;
            $this->cataloghelper = $catalogHelper;
     }

     public function getProductId()
     {
        return $this->catalogHelper->getProduct()->getData();
     }

     public function getProductReview($productId)
     {
            $collection = $this->reviewobj->create()
            ->addStatusFilter(Review::STATUS_APPROVED)
            ->addEntityFilter('product',$productId)
            ->setDateOrder();
     }

     
}
     */