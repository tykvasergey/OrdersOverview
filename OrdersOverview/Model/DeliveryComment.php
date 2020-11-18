<?php

namespace BroSolutions\OrdersOverview\Model;

class DeliveryComment extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('BroSolutions\OrdersOverview\Model\ResourceModel\DeliveryComment');
    }
}
