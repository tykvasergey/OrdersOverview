<?php
namespace BroSolutions\OrdersOverview\Block\Adminhtml;

/**
 * Class Menu
 *
 * @package BroSolutions\OrdersOverview\Block\Adminhtml
 */
class Menu extends \Magento\Backend\Block\Template
{

    const ORDER_TYPES = [
        'present' => ['title' => 'Orders vandaag', 'url' => 'ordersoverview/present/index'],
        'future' => ['title' => 'Orderoverzicht (nog te leveren)', 'url' => 'ordersoverview/future/index'],
        'past' => ['title' => 'Orderoverzicht (historie)', 'url' => 'ordersoverview/past/index']
    ];

    const HOME_URL = 'ordersoverview/index/index';

    protected $_template = 'BroSolutions_OrdersOverview::menu.phtml';

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->backendUrl = $backendUrl;
    }

    /**
     * @return \string[][]
     */
    public function getOrderTypes()
    {
        return self::ORDER_TYPES;
    }

    /**
     * @return string
     */
    public function getPageUrl($url)
    {
        $url = $this->backendUrl->getUrl($url);

        return $url;
    }

    /**
     * Get home url
     */
    public function getHomeUrl()
    {
        return $this->backendUrl->getUrl(self::HOME_URL);
    }
}
