<?php
namespace Perspective\TodaysOrders\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class TodaysOrders implements ArgumentInterface
{
    private OrderRepositoryInterface $orderRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private SortOrderBuilder $sortOrderBuilder;
    private CustomerRepositoryInterface $customerRepository;
    private TimezoneInterface $timezone;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        CustomerRepositoryInterface $customerRepository,
        TimezoneInterface $timezone
    ) {
        $this->orderRepository = $orderRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->customerRepository = $customerRepository;
        $this->timezone = $timezone;
    }

    public function getTodaysOrders()
    {
        $today = $this->timezone->date()->format('Y-m-d');

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('created_at', $today . ' 00:00:00', 'gteq')
            ->addFilter('created_at', $today . ' 23:59:59', 'lteq')
            ->setSortOrders([$this->sortOrderBuilder->setField('created_at')->setDescendingDirection()->create()])
            ->create();

        $orders = $this->orderRepository->getList($searchCriteria)->getItems();

        return $orders;
    }

    public function getCustomerInfo($customerId)
    {
        if (!$customerId) {
            return 'Гость';
        }
        try {
            $customer = $this->customerRepository->getById($customerId);
            return $customer->getFirstname() . ' ' . $customer->getLastname() . ' (' . $customer->getEmail() . ')';
        } catch (\Exception $e) {
            return 'Неизвестный покупатель';
        }
    }
}
