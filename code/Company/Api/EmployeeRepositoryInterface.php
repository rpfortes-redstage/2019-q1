<?php
namespace Redstage\Company\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Redstage\Company\Api\Data\EmployeeInterface;

interface EmployeeRepositoryInterface {
    /**
     * @param int $id
     * @return \Redstage\Company\Api\Data\EmployeeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityExceptio
     */
    public function getById($id);

    /**
     * @param EmployeeInterface $employee
     * @return EmployeeInterface
     */
    public function save(EmployeeInterface $employee);

    /**
     * @param EmployeeInterface $employee
     * @return void
     */
    public function delete(EmployeeInterface $employee);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Redstage\Company\Api\Data\EmployeeSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
