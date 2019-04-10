<?php

namespace Redstage\Company\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface EmployeeInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $name
     * @return void
     */
    public function setFirstName($firstName);

    /**
     * @return \Redstage\Company\Api\Data\EmployeeExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Redstage\Company\Api\Data\EmployeeExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(EmployeeExtensionInterface $extensionAttributes);
}