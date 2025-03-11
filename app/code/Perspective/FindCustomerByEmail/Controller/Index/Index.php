<?php

namespace Perspective\FindCustomerByEmail\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index implements ActionInterface
{
    /**
     * Constructor
     *
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     */
    public function __construct(
        protected ResultFactory $resultFactory
    ) {
    }

    /**
     * @inheritdoc
     */
    public function execute() {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
