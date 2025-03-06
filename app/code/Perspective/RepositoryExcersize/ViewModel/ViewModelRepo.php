<?php

namespace Perspective\RepositoryExcersize\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ViewModelRepo implements ArgumentInterface
{ 
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var \Magento\Catalog\Api\Data\ProductInterface
     */
    private $productInterface;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Catalog\Api\Data\ProductInterface $productInterface
    ) {
        $this->productRepository = $productRepository;   
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->productInterface = $productInterface;
    }

    public function getProductById($productId)
     {
        
        if (is_null($productId)){
            return null;
        }

        $productModel = $this->productRepository->getById($productId);

        return $productModel;
     }
         
}
