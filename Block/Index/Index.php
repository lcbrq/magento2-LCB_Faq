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

    protected $_faqFactory;
    
    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,       
    \LCB\Faq\Model\FaqFactory $faqFactory,
    array $data = []
    )
    {
        $this->_faqFactory = $faqFactory;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    /**
     * Get FAQ collection
     * 
     * @return LCB\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getCollection(){
        return $this->_faqFactory->create()->getCollection();
    }
    
    /**
     * Get questions and answers
     * 
     * @return LCB\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getQA()
    {
        $collection = $this->getCollection();
        $collection->addStoreFilter($this->_storeManager->getStore()->getId());
        $collection->addFieldToFilter('is_active', ['eq' => \LCB\Faq\Model\Status::STATUS_ENABLED]);
        return $collection;
    }
    
    /**
     * Get questions ans answers by category id
     * 
     * @return LCB\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getQAByCategoryId($categoryId)
    {
        $collection = $this->getCollection();
        $collection->addStoreFilter($this->_storeManager->getStore()->getId());
        $collection->addFieldToFilter('is_active', ['eq' => \LCB\Faq\Model\Status::STATUS_ENABLED]);
        $collection->addFieldToFilter('category_id', ['eq' => $categoryId]);
        return $collection;
    }

}
