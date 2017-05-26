<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Block\Index;

use LCB\Faq\Model\ResourceModel\Faq\Collection;

class Index extends \Magento\Framework\View\Element\Template {

    protected $_faqCollection;
    
    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,       
    \LCB\Faq\Model\ResourceModel\Faq\Collection $faqCollection,
    array $data = []
    )
    {
        $this->_faqCollection = $faqCollection;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    /**
     * Get questions and answers
     * 
     * @return LCB\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getQA()
    {
        $collection = $this->_faqCollection;
        $collection->addStoreFilter($this->_storeManager->getStore()->getId());
        $collection->addFieldToFilter('is_active', ['eq' => \LCB\Faq\Model\Status::STATUS_ENABLED]);
        return $collection->load();
    }

}
