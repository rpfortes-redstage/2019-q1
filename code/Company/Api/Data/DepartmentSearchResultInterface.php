<?php

namespace Redstage\Company\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DepartmentSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Redstage\Company\Api\Data\DepartmentInterface[]
     */
    public function getItems();

    /**
     * @param \Redstage\Company\Api\Data\DepartmentInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}