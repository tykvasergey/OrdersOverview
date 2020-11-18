<?php

namespace BroSolutions\OrdersOverview\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class CustomFields extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['shipping_address'] = $item['street'] . ' ' . $item['postcode'] . ' ' . $item['city'];
                $item['custom_name'] = $item['increment_id']
                    . $this->getDeliveryShippingNote($item['delivery_shipping_note'])
                    . '- ' . $item['customer_firstname']
                    . '-' . $item['customer_lastname']
                    . '<p>' . $item['street'] . ' ' . $item['postcode'] . ' ' . $item['city'] . '</p>';
            }
        }
        return $dataSource;
    }

    private function getDeliveryShippingNote($deliveryShippingNote)
    {
        if (strpos($deliveryShippingNote, 'Na ') !== false) {
            return '-NM';
        }

        if (strpos($deliveryShippingNote, 'Voor ') !== false) {
            return '-VM';
        }

        return '';
    }
}
