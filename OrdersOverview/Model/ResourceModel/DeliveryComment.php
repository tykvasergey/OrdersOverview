<?php

namespace BroSolutions\OrdersOverview\Model\ResourceModel;

class DeliveryComment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('delivery_comment', 'entity_id');
    }
}
