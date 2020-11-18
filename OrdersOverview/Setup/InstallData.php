<?php

namespace BroSolutions\OrdersOverview\Setup;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    protected $salesSetupFactory;

    public function __construct(\Magento\Sales\Setup\SalesSetupFactory $salesSetupFactory)
    {
        $this->salesSetupFactory = $salesSetupFactory;
    }

    public function install(
        \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context0
    ) {
        $installer = $setup;

        $installer->startSetup();

        $salesSetup = $this->salesSetupFactory->create(['resourceName' => 'sales_setup', 'setup' => $installer]);

        $salesSetup->addAttribute(\Magento\Sales\Model\Order::ENTITY, 'delivery_status', [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            'length' => 10,
            'visible' => true,
            'nullable' => false
        ]);

        $installer->endSetup();
    }
}
