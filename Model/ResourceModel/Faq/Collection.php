<?php

/**
 * Easy FAQ management
 * 
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Model\ResourceModel\Faq;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define FAQ resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'LCB\Faq\Model\Faq',
            'LCB\Faq\Model\ResourceModel\Faq'
        );
    }
    
    /**
     * Add store filter to collection
     * 
     * @param int $storeId
     */
    public function addStoreFilter($storeId)
    {
        $this->addFieldToFilter(
            ['store_ids', 'store_ids'], 
            [
                ['finset' => array($storeId)],
                ['eq' => '0']
            ]
        );
    }
    
}
