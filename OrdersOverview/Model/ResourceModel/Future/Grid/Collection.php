<?php

namespace BroSolutions\OrdersOverview\Model\ResourceModel\Future\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable,
        $resourceModel
    ) {
        $this->addFilterToMap(
            'custom_name',
            new \Zend_Db_Expr(
                'CONCAT(main_table.increment_id, main_table.customer_firstname, main_table.customer_lastname)'
            )
        );
        $this->addFilterToMap(
            'shipping_address',
            new \Zend_Db_Expr(
                'CONCAT(soa.postcode, soa.city, soa.street)'
            )
        );
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        $date = date('Y-m-d');
        $this->addFieldToSelect('*')
            ->addFieldToFilter('delivery_date', ['gt' => $date])
            ->join(
                ["soa" => "sales_order_address"],
                'main_table.entity_id = soa.parent_id AND soa.address_type="shipping"',
                ['street', 'postcode', 'city']
            );

        return $this;
    }
}

