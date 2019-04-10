<?php
namespace Redstage\Company\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Redstage\Company\Api\Data\DepartmentInterface;

interface DepartmentRepositoryInterface {
    /**
     * @param int $id
     * @return \Redstage\Company\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityExceptio
     */
    public function getById($id);

    /**
     * @param DepartmentInterface $department
     * @return DepartmentInterface
     */
    public function save(DepartmentInterface $department);

    /**
     * @param DepartmentInterface $department
     * @return void
     */
    public function delete(DepartmentInterface $department);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Redstage\Company\Api\Data\DepartmentSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
