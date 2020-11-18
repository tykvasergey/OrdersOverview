<?php

namespace BroSolutions\OrdersOverview\Block\Adminhtml\Order\View;

class DeliveryComments extends \Magento\Backend\Block\Template
{

    protected $order;

    protected $driverStatuses;

    protected $commentsCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Model\Order $order,
        \BroSolutions\OrdersOverview\Model\Source\DriverStatuses $driverStatuses,
        \BroSolutions\OrdersOverview\Model\ResourceModel\DeliveryComment\Collection $commentsCollection,
        array $data = []
    ) {
        $this->order = $order;
        $this->driverStatuses = $driverStatuses;
        $this->commentsCollection = $commentsCollection;
        parent::__construct($context, $data);
    }

    public function getComments()
    {
        $comments = $this->commentsCollection->addFieldToSelect('*')
            ->addFieldToFilter('parent_id', $this->getRequest()->getParam('order_id'));

        if (!$comments->getSize()) {
            return false;
        }

        return $comments;
    }

    public function getDeliveryStatus()
    {
        $order = $this->order->load($this->getRequest()->getParam('order_id'));
        $status = $order->getDeliveryStatus();
        $driverStatuses = $this->driverStatuses->toOptionArray();

        if (!$status || count($driverStatuses) == 0) {
            return false;
        }

        foreach ($driverStatuses as $driverStatus) {
            if ($driverStatus['value'] == $status) {
                return $driverStatus['label'];
            }
        }

        return false;
    }
}
