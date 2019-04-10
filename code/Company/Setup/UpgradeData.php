<?php
namespace Redstage\Company\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/*
UpgradeData conforms to UpgradeDataInterface, which requires the implementation of the upgrade
method taht accepts two parameters of type ModuleDataSetupInterface and ModuelContextInterface.
We are further adding our own __construct method to which we are passing DepartmentFactory and
EmployeeeFactory, as we will be using them within the upgrade method as shown next.
*/
class UpgradeData implements UpgradeDataInterface {
    protected $departmentFactory;
    protected $employeeFactory;

    public function __construct(
        \Redstage\Company\Model\DepartmentFactory $departmentFactory,
        \Redstage\Company\Model\EmployeeFactory $employeeFactory
    ) {
        $this->departmentFactory = $departmentFactory;
        $this->employeeFactory = $employeeFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();

        $salesDepartment = $this->departmentFactory->create();
        $salesDepartment->setName('Sales');
        $salesDepartment->save();



        $employee = $this->employeeFactory->create();
        $employee->setDepartmentId($salesDepartment->getId());
        $employee->setEmail('rafael.pfortes@gmail.com');
        $employee->setFirstName('Rafael');
        $employee->setLastName('Fortes');
        $employee->setServiceYears(2);
        $employee->setDob('1986-08-28');
        $employee->setSalary('2000.00');
        $employee->setVatNumber('3165408');
        $employee->setNote('Just some notes to Rafael');
        $employee->save();

        $setup->endSetup();
    }
}