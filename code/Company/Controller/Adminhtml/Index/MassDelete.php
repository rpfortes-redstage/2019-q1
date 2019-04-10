<?php

namespace Redstage\Company\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $collectionFactory;
    protected $departmentRepositoryFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Redstage\Company\Model\ResourceModel\Department\CollectionFactory $collectionFactory,
        \Redstage\Company\Model\DepartmentRepositoryFactory $departmentRepositoryFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->departmentRepositoryFactory = $departmentRepositoryFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_Company::departments');
    }

    /**
     * Mass delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());

            $collectionSize = $collection->getSize();

            foreach ($collection as $department) {
                $this->departmentRepositoryFactory->create()->delete($department);
            }

            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        } catch (\Exception $e) {
            var_dump($e->getMessage()); exit;
            $this->messageManager->addErrorMessage(__('Something wrong deleting items'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
