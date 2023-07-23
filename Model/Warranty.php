<?php 

namespace SolutionPioneers\Warranty\Model;

use Magento\Framework\Model\AbstractModel;

class Warranty extends AbstractModel
{
    /**
     * Constructor
     */
	public function _construct()
  {
		$this->_init("SolutionPioneers\Warranty\Model\ResourceModel\Warranty");
	}

}
