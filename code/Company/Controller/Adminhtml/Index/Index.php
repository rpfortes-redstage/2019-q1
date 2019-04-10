<?php

namespace Redstage\Company\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_Company::departments');
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu('Redstage_Company::departments');

        $resultPage->addBreadcrumb(__('Departments'), __('Departments'));

        $resultPage->addBreadcrumb(__('Manage Departments'), __('Manage Departments'));

        $resultPage->getConfig()->getTitle()->prepend(__('Manage Departments'));

        return $resultPage;
    }
}
