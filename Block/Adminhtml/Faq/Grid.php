<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Block\Adminhtml\Faq;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended {

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \LCB\Faq\Model\faqFactory
     */
    protected $_faqFactory;

    /**
     * @var \LCB\Faq\Model\Status
     */
    protected $_status;
    
    /**
     * @var array $_categories
     */
    protected $_categories;
      
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \LCB\Faq\Model\faqFactory $faqFactory
     * @param \LCB\Faq\Model\Status $status
     * @param \LCB\Faq\Model\Category $category,
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, 
    \Magento\Backend\Helper\Data $backendHelper, 
    \LCB\Faq\Model\FaqFactory $FaqFactory,        
    \LCB\Faq\Model\Status $status, 
    \LCB\Faq\Model\Category $category,          
    \Magento\Framework\Module\Manager $moduleManager, 
    array $data = []
    )
    {
        $this->_faqFactory = $FaqFactory;
        $this->_status = $status;
        $this->_categories = $category->getOptionArray();
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('faqGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
   protected function _prepareCollection()
    {
        $collection = $this->_faqFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
                'id',
                [
                    'header' => __('ID'),
                    'type' => 'number',
                    'index' => 'id',
                    'header_css_class' => 'col-id',
                    'column_css_class' => 'col-id'
                ]
        );

        $this->addColumn(
                'question',
                [
                    'header' => __('Question'),
                    'index' => 'question',
                ]
        );

        $this->addColumn(
                'answer',
                [
                    'header' => __('Answer'),
                    'index' => 'answer',
                ]
        );

       $this->addColumn(
                'is_active',
                [
                    'header' => __('Status'),
                    'index' => 'is_active',
                    'type' => 'options',
                    'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
                ]
        );

        if($this->_categories){
            $this->addColumn(
                     'category_id',
                     [
                         'header' => __('Category'),
                         'index' => 'category_id',
                         'type' => 'options',
                         'options' => $this->_categories
                     ]
             );
        }
        
       
        /**
         * Check is single store mode
         */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $this->addColumn(
                    'store_ids',
                    [
                        'header' => __('Store View'),
                        'index' => 'store_ids',
                        'type' => 'store',
                        'store_all' => true,
                        'store_view' => true,
                        'sortable' => false,
                        'filter_condition_callback' => [$this, '_filterStoreCondition']
                    ]
            );
        }

        $this->addExportType($this->getUrl('faq/*/exportCsv',
                        ['_current' => true]), __('CSV'));
        $this->addExportType($this->getUrl('faq/*/exportExcel',
                        ['_current' => true]), __('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('faq');

        $this->getMassactionBlock()->addItem(
                'delete',
                [
                    'label' => __('Delete'),
                    'url' => $this->getUrl('faq/*/massDelete'),
                    'confirm' => __('Are you sure?')
                ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
             'status',
             [
                'label' => __('Change status'),
                'url' => $this->getUrl('faq/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                        ]
                   ]
            ]
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('faq/*/index', ['_current' => true]);
    }

    /**
     * @param \LCB\Faq\Model\faq|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {

        return $this->getUrl('faq/*/edit', ['id' => $row->getId()]);
    }

    /**
     * Filter store condition
     *
     * @param \LCB\Faq\Model\ResourceModel\Faq\Collection $collection
     * @param \Magento\Framework\DataObject $column
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _filterStoreCondition($collection, \Magento\Framework\DataObject $column)
    {
        if (!($value = $column->getFilter()->getValue())) {
            return;
        }

        $this->getCollection()->addFieldToFilter('store_ids', ['like' => "%$value%"]);
    }
    
}
