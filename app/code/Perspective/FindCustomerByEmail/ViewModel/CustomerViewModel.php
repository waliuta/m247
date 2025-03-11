<?php
namespace Perspective\FindCustomerByEmail\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerViewModel implements ArgumentInterface
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomerByEmail($email)
    {
        try {
            return $this->customerRepository->get($email);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }
}

