<?php

namespace SolutionPioneers\Warranty\Block\Adminhtml\Grid\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Backend\Block\Context;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;

class Image extends AbstractRenderer
{
    /**
     * @var Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param \Magento\Backend\Block\Context Context
     * @param \Magento\Store\Model\StoreManagerInterface $storemanager
     * @param  array $data
     */
    public function __construct(
        Context $context, 
        StoreManagerInterface $storemanager, 
        array $data = []
    ){
        parent::__construct($context, $data);
        $this->storeManager = $storemanager;
        $this->_authorization = $context->getAuthorization();
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * 
     * @return string
     */
    public function render(DataObject $row): string
    {
        if(!$row['image'] || empty($row['image'])) {
            return '';
        }
        
        $mediaDirectory = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $imageUrl = $mediaDirectory .  '/solutionpioneers/warranty/' . $row['image'];

        return '<img src="' . $imageUrl . '" width="100"/>';
    }
}