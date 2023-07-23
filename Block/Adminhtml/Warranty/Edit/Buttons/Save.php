<?php

namespace SolutionPioneers\Warranty\Block\Adminhtml\Warranty\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Save
 * 
 * @package SolutionPioneers\Warranty\Block\Adminhtml\Warranty\Edit\Buttons
 */
class Save extends \Magento\Backend\Block\Template implements ButtonProviderInterface
{
    /**
     * get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}