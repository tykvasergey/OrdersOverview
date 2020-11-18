<?php

namespace BroSolutions\OrdersOverview\Ui\DataProvider;

class OrdersDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;

    protected $loadedData;

    protected $deliveryCommentCollection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \BroSolutions\OrdersOverview\Model\ResourceModel\DeliveryComment\Collection $deliveryCommentCollection,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $orderCollectionFactory->create();
        $this->deliveryCommentCollection = $deliveryCommentCollection;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $this->collection->join(
            ["soa" => "sales_order_address"],
            'main_table.entity_id = soa.parent_id AND soa.address_type="shipping"',
            ['street', 'postcode', 'city']
        );

        $items = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($items as $item) {
            $this->loadedData[$item->getEntityId()] = [
                'entity_id' => $item->getEntityId(),
                'increment_id' => $item->getIncrementId(),
                'delivery_shipping_note' => $this->getDeliveryShippingNote($item->getDeliveryShippingNote()),
                'shipping_address' => $item->getStreet() . ' ' . $item->getPostcode() . ' ' . $item->getCity(),
                'customer_name' => $item->getCustomerFirstname() . ' ' . $item->getCustomerLastname(),
                'instructions' => $item->getDeliveryComment(),
                'delivery_status' => $item->getDeliveryStatus(),
                'delivery_date' => date("d M Y", strtotime($item->getDeliveryDate())),
                'delivery_comment' => $this->getLastComment($item->getEntityId())
            ];
        }

        return $this->loadedData;
    }

    private function getLastComment($id)
    {
        $comments = $this->deliveryCommentCollection->addFieldToSelect('*')
            ->addFieldToFilter('parent_id', $id)
            ->setOrder('entity_id', 'desc');

        if (!$comments->getSize()) {
            return '';
        }

        return $comments->getFirstItem()->getComment();
    }

    private function getDeliveryShippingNote($deliveryShippingNote)
    {
        if (strpos($deliveryShippingNote, 'Na ') !== false) {
            return 'NM';
        }

        if (strpos($deliveryShippingNote, 'Voor ') !== false) {
            return 'VM';
        }

        return '';
    }
}
