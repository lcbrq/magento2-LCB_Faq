<?php

/**
 * Easy FAQ management
 * 
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Model;

class Faq extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('LCB\Faq\Model\ResourceModel\Faq');
    }

}
