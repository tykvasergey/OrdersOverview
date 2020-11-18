<?php

namespace BroSolutions\OrdersOverview\Block\Adminhtml\Comments;

class QuickChangeStatus extends \Magento\Backend\Block\Template
{
    protected $_template = 'BroSolutions_OrdersOverview::comments/quick_change_status.phtml';

    protected $driverStatuses;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \BroSolutions\OrdersOverview\Model\Source\DriverStatuses $driverStatuses,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->driverStatuses = $driverStatuses;
    }

    public function getStatuses()
    {
        $statuses = $this->driverStatuses->toOptionArray();

        if (count($statuses) == 0) {
            return false;
        }

        return $statuses;
    }
}
