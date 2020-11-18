<?php

namespace BroSolutions\OrdersOverview\Block\Adminhtml\Order;

class Items extends \Magento\Backend\Block\Template
{
    protected $_template = 'BroSolutions_OrdersOverview::order/items.phtml';

    protected $order;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Model\Order $order,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->order = $order;
    }

    public function getOrderItems()
    {
        $order = $this->order->load($this->getRequest()->getParam('entity_id'));
        $items = $order->getAllVisibleItems();

        if (count($items) == 0) {
            return false;
        }

        return $items;
    }
}
