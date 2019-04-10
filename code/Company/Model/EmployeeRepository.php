<?php

namespace Redstage\Company\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Redstage\Company\Api\Data\EmployeeInterface;
use Redstage\Company\Api\Data\EmployeeSearchResultInterface;
use Redstage\Company\Api\Data\EmployeeSearchResultInterfaceFactory;
use Redstage\Company\Api\EmployeeRepositoryInterface;
use Redstage\Company\Model\ResourceModel\Employee\CollectionFactory as EmployeeCollectionFactory;
use Redstage\Company\Model\ResourceModel\Employee\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * @var EmployeeFactory
     */
    private $employeeFactory;

    /**
     * @var EmployeeCollectionFactory
     */
    private $employeeCollectionFactory;

    /**
     * @var EmployeeSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    public function __construct(
        EmployeeFactory $employeeFactory,
        EmployeeCollectionFactory $employeeCollectionFactory,
        EmployeeSearchResultInterfaceFactory $employeeSearchResultInterfaceFactory
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeCollectionFactory = $employeeCollectionFactory;
        $this->searchResultFactory = $employeeSearchResultInterfaceFactory;
    }

    public function getById($id)
    {
        $employee = $this->employeeFactory->create();
        $employee->getResource()->load($employee, $id);

        if (! $employee->getId()) {
            throw new NoSuchEntityException(__('Unable to find employee with ID "%1"', $id));
        }
        return $employee;
    }

    public function save(EmployeeInterface $employee)
    {
        $employee->getResource()->save($employee);
        return $employee;
    }

    public function delete(EmployeeInterface $employee)
    {
        $employee->getResource()->delete($employee);
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