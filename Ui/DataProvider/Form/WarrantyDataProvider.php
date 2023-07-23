<?php

namespace SolutionPioneers\Warranty\Ui\DataProvider\Form;

use SolutionPioneers\Warranty\Model\ResourceModel\Warranty\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Filesystem\DirectoryList;

/**
 * Class WarrantyDataProvider
 * 
 * @package SolutionPioners\ProductLabel\Ui\DataProvider\Form
 */
class WarrantyDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Magento\Framework\Filesystem\DirectoryList
     */
    protected $directoryList;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    /**
     * @var SolutionPioneers\Warranty\Model\ResourceModel\Warranty\CollectionFactory
     */
    protected $warrantyCollectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $warrantyCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        StoreManagerInterface $storeManager,
        DirectoryList $directoryList,
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $data);

        $this->directoryList = $directoryList;
        $this->warrantyCollectionFactory = $warrantyCollectionFactory;
        $this->collection = $warrantyCollectionFactory->create();
        $this->_request = $request;
        $this->storeManager = $storeManager;
    }

    /**
    * Get data
    *
    * @return array
    */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $itemId = $this->_request->getParam('id');

        $this->collection = $this->warrantyCollectionFactory->create();

        if (!empty($itemId)) {
            $items = $this->collection->getItems();
            foreach ($items as $item) {
                $data = $item->getData();

                 /* Prepare Image */
                $map = [
                    'image' => 'getImagePath',
                ];

                foreach ($map as $key => $method) {
                    if (isset($data[$key]) && !empty($data[$key])) {
                        $name = $data[$key];
                        unset($data[$key]);
                        $data[$key][0] = [
                            'name' => $name,
                            'url' => $this->getImageUrl($item->$method()),
                            'size' => $this->getImageSize($item->$method())
                        ];
                    }
                }

                $this->loadedData[$item->getIdProductLabel()] = $data;
            }
        }
        
        return $this->loadedData;
    }

    /**
     * @param \Magento\Framework\Api\Filter $filter
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }

    /**
     * @param string $imagePath
     * 
     * @return string
     */
    protected function getImageUrl(string $imagePath) 
    {
        return $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $imagePath;
    }

    /**
     * @param string $imagePath
     * 
     * @return int
     */
    protected function getImageSize(string $imagePath) 
    {
        $path = $this->directoryList->getPath('media') . '/'.$imagePath;
        
        return filesize($path);
    }
}