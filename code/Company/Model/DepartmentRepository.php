<?php

namespace Redstage\Company\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Redstage\Company\Api\Data\DepartmentInterface;
use Redstage\Company\Api\Data\DepartmentSearchResultInterface;
use Redstage\Company\Api\Data\DepartmentSearchResultInterfaceFactory;
use Redstage\Company\Api\DepartmentRepositoryInterface;
use Redstage\Company\Model\ResourceModel\Department\CollectionFactory as DepartmentCollectionFactory;
use Redstage\Company\Model\ResourceModel\Department\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * @var DepartmentFactory
     */
    private $departmentFactory;

    /**
     * @var DepartmentCollectionFactory
     */
    private $departmentCollectionFactory;

    /**
     * @var DepartmentSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    public function __construct(
        DepartmentFactory $departmentFactory,
        DepartmentCollectionFactory $departmentCollectionFactory,
        DepartmentSearchResultInterfaceFactory $departmentSearchResultInterfaceFactory
    ) {
        $this->departmentFactory = $departmentFactory;
        $this->departmentCollectionFactory = $departmentCollectionFactory;
        $this->searchResultFactory = $departmentSearchResultInterfaceFactory;
    }

    public function getById($id)
    {
        $department = $this->departmentFactory->create();
        $department->getResource()->load($department, $id);

        if (! $department->getId()) {
            throw new NoSuchEntityException(__('Unable to find department with ID "%1"', $id));
        }
        return $department;
    }

    public function save(DepartmentInterface $department, $data = [])
    {
        if (count($data)) {
            $department->setName($data['name']);
        }

        $department->getResource()->save($department);

        return $department;
    }

    public function delete(DepartmentInterface $department)
    {
        $department->getResource()->delete($department);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}