<?php

namespace Redstage\Company\Model\ResourceModel\Department\Grid;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        $mainTable = 'redstage_department',
        $resourceModel = \Redstage\Company\Model\ResourceModel\Department::class
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }
}
