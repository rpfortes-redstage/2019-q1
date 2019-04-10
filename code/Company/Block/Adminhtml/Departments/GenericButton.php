<?php

namespace Redstage\Company\Block\Adminhtml\Departments;

class GenericButton
{
    protected $context;
    protected $registry;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->context = $context;
        $this->registry = $registry;
    }

    /**
     * Return department id
     *
     * @return int|null
     */
    public function getDepartmentId()
    {
        $department = $this->registry->registry('current_department');

        if (method_exists($department, 'getId')) {
            return $department->getId();
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
