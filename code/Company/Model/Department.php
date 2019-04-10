<?php
namespace Redstage\Company\Model;

use Magento\Framework\Model\AbstractModel;
use Redstage\Company\Api\Data\DepartmentInterface;

class Department extends AbstractModel implements DepartmentInterface
{
    const NAME = 'name';

    protected function _construct()
    {
        $this->_init('Redstage\Company\Model\ResourceModel\Department');
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }
}