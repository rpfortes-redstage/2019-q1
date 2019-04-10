<?php
namespace Redstage\Company\Model\ResourceModel\Employee;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Redstage\Company\Model\Employee',
            'Redstage\Company\Model\ResourceModel\Employee'
        );
    }
}