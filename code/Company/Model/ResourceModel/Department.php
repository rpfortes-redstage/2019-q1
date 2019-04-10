<?php
namespace Redstage\Company\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Department extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('redstage_department', 'id');
    }
}