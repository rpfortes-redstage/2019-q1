<?php

namespace Redstage\Company\Controller\Adminhtml\Index;

class NewAction extends \Magento\Backend\App\Action
{
    protected $resultForwardFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
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
     * Forward to edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
