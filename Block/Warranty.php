<?php
namespace SolutionPioneers\Warranty\Block;

use SolutionPioneers\Warranty\Model\Warranty as WarrantyModel;
use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use SolutionPioneers\Warranty\Helper\Data as Helper;

class Warranty extends AbstractProduct
{
    /**
     * @var \SolutionPioneers\Warranty\Helper\Data
     */
    protected $helper;

    /**
     * @param \SolutionPioneers\Warranty\Helper\Data $helper
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param array $data
     */
    public function __construct(        
        Helper $helper,
        Context $context,
        array $data = []
    ) {
        $this->helper = $helper;

        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getWarrantyImage(): string
    {
        $product = $this->getProduct();
        
        if (!$product) {
            return '';
        }

        if (!$product->getWarranty()) {
            return '';
        }
        
        return $this->helper->getProductWarrantyImage($product);
    }

    /**
     * @return string
     */
    public function getWarrantyDescription(): string
    {
        $product = $this->getProduct();
        
        if (!$product) {
            return '';
        }

        if (!$product->getWarranty()) {
            return '';
        }
        
        return $this->helper->getProductWarrantyDescription($product);
    }
    
}

