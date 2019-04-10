<?php
namespace Redstage\Company\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Redstage\Company\Api\Data\EmployeeExtensionInterface;
use Redstage\Company\Api\Data\EmployeeInterface;

class Employee extends AbstractExtensibleModel implements EmployeeInterface
{
    const ENTITY = 'redstage_employee';
    const FIRST_NAME = 'first_name';

    protected function _construct()
    {
        $this->_init('Redstage\Company\Model\ResourceModel\Employee');
    }

    public function getFirstName()
    {
        return $this->_getData(self::FIRST_NAME);
    }

    public function setFirstName($firstName)
    {
        $this->setData(self::FIRST_NAME, $firstName);
    }

    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    public function setExtensionAttributes(EmployeeExtensionInterface $extensionAttributes)
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}