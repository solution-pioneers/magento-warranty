<?php

namespace SolutionPioneers\Warranty\Block\Adminhtml;

use \Magento\Backend\Block\Widget\Grid\Container;

class Warranty extends Container
{
    /**
     * Constructor 
     */
	protected function _construct()
	{
		$this->_controller = 'adminhtml_warranty';
		$this->_blockGroup = 'SolutionPioneers_Warranty';
		$this->_headerText = __('Warranty');
		$this->_addButtonLabel = __('Create New Warranty');

		parent::_construct();
	}
}