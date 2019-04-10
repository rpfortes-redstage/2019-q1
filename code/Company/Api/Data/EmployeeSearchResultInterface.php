<?php

namespace Redstage\Company\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface EmployeeSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Redstage\Company\Api\Data\EmployeeInterface[]
     */
    public function getItems();

    /**
     * @param \Redstage\Company\Api\Data\EmployeeInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}