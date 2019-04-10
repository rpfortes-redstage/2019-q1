<?php

namespace Redstage\Company\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    const URL_PATH_EDIT = 'departments/index/edit';

    const URL_PATH_DELETE = 'departments/index/delete';

    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {

                $name = $this->getData('name');

                if (isset($item['id'])) {

                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_EDIT, ['id' => $item['id']]),
                        'label' => __('Edit')
                    ];

                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_DELETE,
                            ['id' => $item['id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete ${ $.$data.name }'),
                            'message' => __('Are you sure you wan\'t to delete a ${ $.$data.name } record?')
                        ]
                    ];
                }

            }

        }

        return $dataSource;
    }
}
