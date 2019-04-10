<?php

namespace Redstage\Company\Model\Department;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $storeManager;
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Redstage\Company\Model\ResourceModel\Department\CollectionFactory $departmentCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $departmentCollectionFactory->create();
        $this->storeManager = $storeManager;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        foreach ($this->collection->getItems() as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        return $this->loadedData;
    }
}
