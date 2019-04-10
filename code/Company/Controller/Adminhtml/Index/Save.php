<?php

namespace Redstage\Company\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    protected $scopeConfig;
    protected $departmentRepositoryFactory;
    protected $departmentFactory;
    protected $searchCriteriaFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Redstage\Company\Model\DepartmentFactory $departmentFactory,
        \Redstage\Company\Model\DepartmentRepositoryFactory $departmentRepositoryFactory
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->departmentFactory = $departmentFactory;
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
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create()->setPath('*/*/');

        if ($data = $this->getRequest()->getPostValue()) {

            try {
                $department = $this->departmentFactory->create();

                if ($id = $this->getRequest()->getParam('id')) {
                    $department = $this->departmentRepositoryFactory->create()->getById($id);
                }

                $this->departmentRepositoryFactory->create()->save($department, $data);

                $this->messageManager->addSuccessMessage(__('Department Saved successfully'));

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $department->getId()]);
                }

                return $resultRedirect->setPath('*/*/');

            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e,
                    __('Something went wrong while saving the department.' . $e->getMessage()));
            }

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect;
    }
}