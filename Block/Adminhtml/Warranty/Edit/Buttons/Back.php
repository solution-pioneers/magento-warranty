<?php

namespace SolutionPioneers\Warranty\Block\Adminhtml\Warranty\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Back
 * 
 * @package SolutionPioneers\Warranty\Block\Adminhtml\Warranty\Edit\Buttons
 */
class Back extends \Magento\Backend\Block\Template implements ButtonProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('*/*/', array('_secure' => true))),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}