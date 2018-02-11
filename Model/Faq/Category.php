<?php

/**
 * Easy FAQ management
 * 
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Model\Faq;

class Category implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var null|array
     */
    protected $options;

    /**
     * @param \LCB\Faq\Model\ResourceModel\Category\Collection
     */
    public function __construct(
        \LCB\Faq\Model\ResourceModel\Category\Collection $collection
    ) {
        $this->categoryCollection = $collection;
    }

    /**
     * @return array|null
     */
    public function toOptionArray()
    {
        if (null == $this->options) {
            $this->options = $this->categoryCollection
                ->toOptionArray();
        }
        return $this->options;
    }
}

