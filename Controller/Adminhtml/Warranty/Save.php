<?php

namespace SolutionPioneers\Warranty\Controller\Adminhtml\Warranty;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use SolutionPioneers\Warranty\Model\ImageUploader;

/**
 * Class Save
 * 
 * @package SolutionPioneers\Warranty\Controller\Adminhtml\Faq
 */
class Save extends Action
{
    protected const IMAGE_PATH = 'solutionpioneers_warranty/';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * @var \G2\ProductLabel\Model\ImageUploader
     */
    protected $imageUploader;

    /**
     * AbstractAction constructor.
     *
     * @param Context $context
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \G2\ProductLabel\Model\ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ImageUploader $imageUploader
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->imageUploader = $imageUploader;
    }

    /**
     * @return void
     */
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            /** @var \SolutionPioneers\Warranty\Model\Warranty $model */
            $model = $this->_objectManager->create('SolutionPioneers\Warranty\Model\Warranty');

            try {
                $data = $this->getRequest()->getPostValue();

                if (isset($data['solutionpioneers_warranty_id']) && $warrantyId = $data['solutionpioneers_warranty_id']) {
                    $model = $model->load($warrantyId);
                } else {
                    unset($data['solutionpioneers_warranty_id']);
                }
                
                $data = $this->addImageData($data);
                $model->setData($data);

                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $model->save();

                $this->messageManager->addSuccess(__('Warranty successfully saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData(false);
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the warranty data. Please review the error log.')
                );
                $this->_redirect('*/*/edit', ['solutionpioneers_warranty_id' => $this->getRequest()->getParam('warranty_id')]);
                
                return;
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * @param array $rawData
     */
    protected function addImageData(array $rawData)
    {
        $data = $rawData;
        if (isset($data['image'][0]['name'])) {
            $imageName = $this->imageUploader->uploadFileAndGetName('image', $data);
            $data['image_path'] = static::IMAGE_PATH . $imageName;
            $data['image'] = $imageName;
        } else {
            $data['image'] = null;
        }

        return $data;
    }
}