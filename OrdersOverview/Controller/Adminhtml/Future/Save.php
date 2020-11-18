<?php

namespace BroSolutions\OrdersOverview\Controller\Adminhtml\Future;

class Save extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    protected $deliveryComment;

    protected $order;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \BroSolutions\OrdersOverview\Model\DeliveryComment $deliveryComment,
        \Magento\Sales\Model\Order $order
    ) {
        $this->deliveryComment = $deliveryComment;
        $this->order = $order;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost();
        try {
            if ($data['delivery_status'] == 1) {
                $this->deliveryComment->setParentId($data['entity_id'])
                    ->setComment(__('De order is bezorgd op afleveradres'))
                    ->save();
            } else {
                if (isset($data['delivery_comment']) && !empty($data['delivery_comment'])) {
                    $this->deliveryComment->setParentId($data['entity_id'])
                        ->setComment($data['delivery_comment'])
                        ->save();
                }
            }
            $this->order->load($data['entity_id'])->setDeliveryStatus($data['delivery_status'])->save();
        } catch (\Exception $e) {

        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        return $resultRedirect;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('BroSolutions_OrdersOverview::orders_overview_present');
    }
}
