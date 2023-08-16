<?php

namespace SolutionPioneers\Warranty\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	/**
	 * @var \Magento\Framework\Setup\ModuleDataSetupInterface
	 */
	private $eavSetupFactory;

	/**
	 * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
	 */
	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}

	/**
	 * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
	 * @param \Magento\Framework\Setup\ModuleContextInterface $context
	 */
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

		$eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'warranty', [
            'group' => 'Warranty',
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 10,
            'label' => 'Warranty',
            'input' => 'select',
            'class' => '',
            'source' => 'SolutionPioneers\Warranty\Model\Source\Warranty',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'apply_to' => ''
        ]);

	}
}
