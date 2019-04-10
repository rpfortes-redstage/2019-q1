<?php

namespace Redstage\Company\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $departmentRepositoryFactory;
    protected $registry;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Redstage\Company\Model\DepartmentRepositoryFactory $departmentRepositoryFactory,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->departmentRepositoryFactory = $departmentRepositoryFactory;
        $this->registry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_Company::departments');
    }

    /**
     * Initialize page
     *
     * @param $department
     * @return \Magento\Framework\View\Result\Page
     */
    protected function init($department)
    {
        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend(__('Departments'));

        if (method_exists($department, 'getId')) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit "%1"', $department->getTitle()));

            $resultPage->addBreadcrumb($department->getId() ? __('Edit Department') : __('New Department'),
                $department->getId() ? __('Edit Department') : __('New Department'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Department'));
        }

        $resultPage->setActiveMenu('Redstage_Company::departments')
            ->addBreadcrumb(__('Departments'), __('Departments'))
            ->addBreadcrumb(__('Manage Departments'), __('Manage Departments'));

        return $resultPage;
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        try {
            $department = $this->departmentRepositoryFactory->create();

            if ($id = $this->getRequest()->getParam('id')) {
                $department = $department->getById($id);
            }

            $this->registry->register('current_department', $department);

            $resultPage = $this->init($department);

        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong: ' . $e->getMessage()));
        }

        return $resultPage;
    }
}
