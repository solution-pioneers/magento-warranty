<?php
namespace SolutionPioneers\Warranty\Controller\Adminhtml;

//use SolutionPioneers\Warranty\Model\ProductAttributeOptionImageFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
 
class Warranty extends Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
    
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \SolutionPioneers\Warranty\Model\WarrantyFactory
     */
  //  protected $productAttributeOptionImageFactory;
 
    
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
    //    ProductAttributeOptionImageFactory $productAttributeOptionImageFactory
    ) {
        parent::__construct($context);

        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
      //  $this->productAttributeOptionImageFactory = $productAttributeOptionImageFactory;
 
    }

    public function execute()
    {
 
    }
 
    protected function _isAllowed()
    {
        return true;
    }
}