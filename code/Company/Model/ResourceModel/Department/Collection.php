<?php
namespace Redstage\Company\Model\ResourceModel\Department;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Redstage\Company\Model\Department', 'Redstage\Company\Model\ResourceModel\Department');
    }
}