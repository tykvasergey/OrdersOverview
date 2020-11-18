<?php

namespace BroSolutions\OrdersOverview\Block\Adminhtml\Comments;

class History extends \Magento\Backend\Block\Template
{
    protected $_template = 'BroSolutions_OrdersOverview::comments/history.phtml';

    protected $deliveryCommentCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \BroSolutions\OrdersOverview\Model\ResourceModel\DeliveryComment\Collection $deliveryCommentCollection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->deliveryCommentCollection = $deliveryCommentCollection;
    }

    public function getComments()
    {
        $id = $this->getRequest()->getParam('entity_id');

        if (!$id) {
            return false;
        }

        $comments = $this->deliveryCommentCollection->addFieldToSelect('*')
            ->addFieldToFilter('parent_id', $id)
            ->setOrder('entity_id', 'desc');

        if (!$comments->getSize()) {
            return false;
        }

        return $comments;
    }
}
