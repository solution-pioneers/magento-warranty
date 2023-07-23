<?php
namespace SolutionPioneers\Warranty\Controller\Adminhtml\Warranty;
 
use SolutionPioneers\Warranty\Controller\Adminhtml\Warranty;
//use SolutionPioneers\Warranty\Model\WarrantyFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends Warranty
{
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \SolutionPioneers\Warranty\Model\WarrantyFactory $warrantyFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
       // ProductAttributeOptionImageFactory $productAttributeOptionImageFactory
    )
    {
        parent::__construct(
            $context, 
            $coreRegistry, 
            $resultPageFactory, 
         //   $productAttributeOptionImageFactory
        );
    }

    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SolutionPioneers_Warranty::warranty');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Warranties'));
 
        return $resultPage;
    }
}