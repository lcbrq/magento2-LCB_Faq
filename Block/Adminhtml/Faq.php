<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Block\Adminhtml;

class Faq extends \Magento\Backend\Block\Widget\Container {

    /**
     * @var string
     */
    protected $_template = 'faq/faq.phtml';

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return \LCB\Faq\Block\Adminhtml\Faq
     */
    protected function _prepareLayout()
    {

        $this->buttonList->add('add_new',
                [
            'id' => 'add_new',
            'label' => __('Add New Set'),
            'class' => 'action-default primary add',
            'onclick' => 'setLocation(\'' . $this->_getCreateUrl() . '\')',
            'button_class' => '',
            'toolbar'
        ]);

        $this->setChild(
                'grid',
                $this->getLayout()->createBlock('LCB\Faq\Block\Adminhtml\Faq\Grid',
                        'lcb.faq.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     * Get create new set url
     *
     * @param string $type
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl('faq/*/new');
    }

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

}
