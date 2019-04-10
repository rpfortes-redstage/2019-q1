<?php

namespace Redstage\Company\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    protected $departmentRepositoryFactory;

    public function __construct(
        Action\Context $context,
        \Redstage\Company\Model\DepartmentRepositoryFactory $departmentRepositoryFactory
    ) {
        parent::__construct($context);
        $this->departmentRepositoryFactory = $departmentRepositoryFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_Company::departments');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $resultRedirect = $this->resultRedirectFactory->create();

        if (!empty($id)) {

            try {
                $department = $this->departmentRepositoryFactory->create()->getById($id);

                $this->departmentRepositoryFactory->create()->delete($department);

                $this->messageManager->addSuccessMessage(__('The department has been deleted.'));

                return $resultRedirect->setPath('*/*/');

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a department to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
