<?php
namespace Perspective\FindCouponByCode\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\SalesRule\Model\ResourceModel\Coupon\CollectionFactory as CouponCollectionFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class CouponViewModel implements ArgumentInterface
{
    protected $couponCollectionFactory;
    protected $timezone;

    public function __construct(
        CouponCollectionFactory $couponCollectionFactory,
        TimezoneInterface $timezone
    ) {
        $this->couponCollectionFactory = $couponCollectionFactory;
        $this->timezone = $timezone;
    }

    /**
     * Найти купон по его коду
     *
     * @param string $code
     * @return \Magento\SalesRule\Model\Coupon|null
     */
    public function getCouponByCode($code)
    {
        $collection = $this->couponCollectionFactory->create();
        $coupon = $collection->addFieldToFilter('code', $code)->getFirstItem();

        return $coupon->getId() ? $coupon : null;
    }

    /**
     * Проверяет, активен ли купон
     *
     * @param \Magento\SalesRule\Model\Coupon|null $coupon
     * @return bool
     */
    public function isCouponActive($coupon)
    {
        if (!$coupon) {
            return false;
        }

        $expirationDate = $coupon->getExpirationDate();

        if (!$expirationDate) {
            return true; // Если нет даты окончания — купон активен
        }

        $currentTimestamp = $this->timezone->scopeTimeStamp();
        $expirationTimestamp = strtotime($expirationDate);

        return $expirationTimestamp >= $currentTimestamp;
    }

    /**
     * Получает текущее время магазина с учетом часового пояса
     *
     * @return string
     */
    public function getCurrentDateTime()
    {
        return $this->timezone->date()->format('Y-m-d H:i:s');
    }
}
