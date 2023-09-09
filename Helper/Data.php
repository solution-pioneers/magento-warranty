<?php

namespace SolutionPioneers\Warranty\Helper;

use SolutionPioneers\Warranty\Model\Warranty;
use SolutionPioneers\Warranty\Model\WarrantyFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    /**
     * @var \SolutionPioneers\Warranty\Model\WarrantyFactory
     */
    protected $warrantyFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \SolutionPioneers\Warranty\Model\WarrantyFactory $warrantyFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        ProductFactory $productFactory,
        WarrantyFactory $warrantyFactory,
        StoreManagerInterface $storeManager
    ){
        $this->productFactory = $productFactory;
        $this->warrantyFactory = $warrantyFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @return string
     */
    public function getProductWarrantyImage($product): string
    {
        $warranty = $this->getProductWarranty($product);

        if (!$warranty) {
            return '';
        }

        return $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) 
            . 'solutionpioneers/warranty/' 
            . $warranty->getImage(); 
    }


    /**
     * @param int $id
     * 
     * @return \SolutionPioneers\Warranty\Model\Warranty
     */
    protected function getWarrantyById(int $id): Warranty
    {
        return $this->warrantyFactory->create()->load($id);
    }

    /**
     * @return string
     */
    public function getProductWarrantyDescription($product): string
    {
        $warranty = $this->getProductWarranty($product);

        if (!$warranty) {
            return '';
        }

        return $warranty->getDescription();
    }

    /**
     * @param $product
     * 
     * @return \SolutionPioneers\Warranty\Model\Warranty|null
     */
    public function getProductWarranty($product): ?Warranty
    {
        if (!$product) {
            return null;
        }

        if (!$product->getWarranty()) {
            $product = $this->productFactory->create()->load($product->getId());

            if (!$product->getWarranty()) {
                return null;
            }
        }

        return $this->getWarrantyById($product->getWarranty());
    }
}