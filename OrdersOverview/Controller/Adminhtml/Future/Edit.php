<?php

namespace BroSolutions\OrdersOverview\Controller\Adminhtml\Future;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    protected $order;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Sales\Model\Order $order
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->order = $order;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $incrementId = $this->order->load($this->getRequest()->getParam('entity_id'))->getIncrementId();
        $resultPage->getConfig()->getTitle()->prepend(__('#%1', $incrementId));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('BroSolutions_OrdersOverview::orders_overview_future');
    }

}
