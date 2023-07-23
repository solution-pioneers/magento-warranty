<?php 

namespace SolutionPioneers\Warranty\Model\ResourceModel\Warranty;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'solutionpioneers_warranty_id';
	protected $_eventPrefix = 'solutionpioneers_warranty_warranty_collection';
	protected $_eventObject = 'warranty_collection';

    /**
     * Constructor
     */
	public function _construct()
    {
		$this->_init(
            "SolutionPioneers\Warranty\Model\Warranty",
            "SolutionPioneers\Warranty\Model\ResourceModel\Warranty"
        );
	}
}
