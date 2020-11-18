<?php

namespace BroSolutions\OrdersOverview\Model\Source;

class DriverStatuses implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Geleverd')],
            ['value' => 2, 'label' => __('Geleverd (buren)')],
            ['value' => 3, 'label' => __('Niet geleverd met opmerking')],
            ['value' => 4, 'label' => __('Niet geleverd met kaart')]
        ];
    }
}
