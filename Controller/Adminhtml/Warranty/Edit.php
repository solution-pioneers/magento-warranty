<?php

namespace SolutionPioneers\Warranty\Controller\Adminhtml\Warranty;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Edit
 * 
 * @package SolutionPioneers\Warranty\Controller\Adminhtml\Warranty
 */
class Edit extends Action
{
    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * AbstractAction constructor.
     *
     * @param Context $context
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->eventManager = $context->getEventManager();
        $this->resultPageFactory = $resultPageFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $warrantyId = $this->getWarrantyId();
        
        if ($warrantyId) {
            try {
                $model = $this->_objectManager->create('SolutionPioneers\Warranty\Model\Warranty')->load($warrantyId);
            } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
                $this->messageManager->addError(__('This Warranty no longer exists.'));
                $this->_redirect('*/*/*');

                return;
            }
        } else {
            /** @var \SolutionPioneers\Warranty\Model\Warranty $model */
            $model = $this->_objectManager->create('SolutionPioneers\Warranty\Model\Warranty');
        }
        
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        
        $resultPage->getConfig()->getTitle()->prepend(__('New Warranty'));
        if ($warrantyId) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Warranty'));
        }
        
        $resultPage->addBreadcrumb(__('Warranty'), __('Warranty'));

        return $resultPage;
    }

    /**
     * @return string
     */
    protected function getWarrantyId()
    {
        return $this->getRequest()->getParam('id');
    }
}