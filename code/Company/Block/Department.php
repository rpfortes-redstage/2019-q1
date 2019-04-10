<?php

namespace Redstage\Company\Block;

class Department extends \Magento\Framework\View\Element\Template
{
    protected $helper;
    protected $departmentCollectionFactory;
    protected $storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Redstage\Company\Model\ResourceModel\Department\CollectionFactory $departmentCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->helper = $context->getScopeConfig();
        $this->departmentCollectionFactory = $departmentCollectionFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * Retrieve enabled departments by current store
     *
     * @return bool|\Magento\Framework\DataObject[]
     */
    public function getDepartments()
    {
        $collection = $this->departmentCollectionFactory->create();

        return count($collection->getItems()) ? $collection->getItems() : false;
    }
}
