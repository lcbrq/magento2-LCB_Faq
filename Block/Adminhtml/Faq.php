<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Block\Adminhtml;

class Faq extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_faq';
        $this->_blockGroup = 'LCB_Faq';
        $this->_headerText = __('FAQ');
        $this->_addButtonLabel = __('Add new set');
        parent::_construct();
    }

}
