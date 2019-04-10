<?php
namespace Redstage\Company\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;

class Employee extends AbstractEntity
{
    protected function _construct()
    {
        $this->_read = 'redstage_employee_read';
        $this->_write = 'redstage+employee_write';
    }

    public function getEntityType()
    {
        if(empty($this->_type)) {
            $this->setType(\Redstage\Company\Model\Employee::ENTITY);
        }

        return parent::getEntityType();
    }
}