<?php
namespace Perspective\UIComponentRest\Block\Product;

class Review extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Perspective\UIComponentRest\Model\ReviewRepository
     */
    private $reviewRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Perspective\UIComponentRest\Model\ReviewRepository $reviewRepository,
        array $data = []
    ) {
        $this->reviewRepository = $reviewRepository;
        parent::__construct($context, $data);
    }

    public function getProductId()
    {
        return $this->getRequest()->getParam('id');
    }

    public function getRevById($productId)
    {
        return $this->getReviewsByProductId($productId);
    }
}
