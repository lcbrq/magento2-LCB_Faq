<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Block\Adminhtml\Faq\Edit;

/**
 * Adminhtml FAQ edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_status;
    protected $_categories;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \LCB\Faq\Model\Category $category
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Framework\Registry $registry, 
        \Magento\Framework\Data\FormFactory $formFactory, 
        \LCB\Faq\Model\Category $category,
        \Magento\Store\Model\System\Store $systemStore, array $data = []
    )
    {
        $this->_systemStore = $systemStore;
        $this->_categories = $category->getOptionArray();
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('grid_form');
        $this->setTitle(__('Questions And Answers'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \LCB\Faq\Model\Faq $model */
        $model = $this->_coreRegistry->registry('faq');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
                [
                    'data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('faq_');

        $fieldset = $form->addFieldset(
                'base_fieldset', ['class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
                'question', 'textarea',
                [
                    'name' => 'question',
                    'label' => __('Question'),
                    'title' => __('Question'),
                    'required' => true
                ]
        );

        $fieldset->addField(
                'answer', 'textarea',
                [
                    'name' => 'answer',
                    'label' => __('Answer'),
                    'title' => __('Answer'),
                    'required' => true
                ]
        );
        
        if($this->_categories){
            $fieldset->addField(
                    'category_id', 'select',
                    [
                        'name' => 'category_id',
                        'label' => __('Category'),
                        'title' => __('Category'),
                        'required' => true,
                        'values' => $this->_categories,
                    ]
            );
        }

        $fieldset->addField(
                'store_ids', 'multiselect',
                [
                    'name' => 'store_ids[]',
                    'label' => __('Store Views'),
                    'title' => __('Store Views'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                ]
        );

        $fieldset->addField(
                'is_active', 'select',
                [
                    'label' => __('Status'),
                    'title' => __('Status'),
                    'name' => 'is_active',
                    'required' => true,
                    'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
                ]
        );

        if (!$model->getId()) {
            $model->setData('store_ids', '0');
            $model->setData('is_active', '1');
        }

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
