<?php

/**
 * Easy FAQ management
 * 
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Model\ResourceModel\Category;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
                'LCB\Faq\Model\Category', 
                'LCB\Faq\Model\ResourceModel\Category'
        );
    }

    public function toOptionArray()
    {

        $options = [[
            'value' => '',
            'label' => __('All')
        ],
        [
            'value' => 0,
            'label' => __('Default')
        ]];

        foreach ($this as $category) {
            $options[] = [
                'value' => $category->getId(),
                'label' => __($category->getName())
            ];
        }

        return $options;
    }

}
