<?php

namespace BroSolutions\OrdersOverview\Model\ResourceModel\DeliveryComment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'BroSolutions\OrdersOverview\Model\DeliveryComment',
            'BroSolutions\OrdersOverview\Model\ResourceModel\DeliveryComment'
        );
    }
}

