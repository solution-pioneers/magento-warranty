<?php 

namespace SolutionPioneers\Warranty\Model\Source;

use SolutionPioneers\Warranty\Model\ResourceModel\Warranty\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;


class Warranty extends AbstractSource
{
    /**
     * @var \SolutionPioneers\Warranty\Model\ResourceModel\Warranty\CollectionFactory $warrantyCollectionFactory
     */
    protected $warrantyCollectionFactory;

    /**
     * @param \SolutionPioneers\Warranty\Model\ResourceModel\Warranty\CollectionFactory $warrantyCollectionFactory
     */
    public function __construct(
        CollectionFactory $warrantyCollectionFactory
      ){
        $this->warrantyCollectionFactory = $warrantyCollectionFactory;
     }

    /**
     * @return array
     */
    public function getAllOptions(): array
    {
        $options = [['label' => __('--Select--'), 'value' => '']];
        $this->collection = $this->warrantyCollectionFactory->create();
        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $options[] = ['label' => $item->getTitle(), 'value' => $item->getId()];
        }

        return $options;
    }
}