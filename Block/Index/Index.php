<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Block\Index;

/**
 * Class Index
 *
 * @package LCB\Faq\Block\Index
 */
class Index extends \Magento\Framework\View\Element\Template {

    /** @var \LCB\Faq\Model\FaqFactory  */
    protected $_faqFactory;

    /** @var \LCB\Faq\Model\Category  */
    protected $_categories;

    /** @var \LCB\Faq\Helper\Faq  */
    protected $_faqHelper;

    /**
     * Index constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \LCB\Faq\Model\FaqFactory                        $faqFactory
     * @param \LCB\Faq\Model\Category                          $category
     * @param \LCB\Faq\Helper\Faq                              $faqHelper
     * @param array                                            $data
     */
    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,       
    \LCB\Faq\Model\FaqFactory $faqFactory,
    \LCB\Faq\Model\Category $category,
    \LCB\Faq\Helper\Faq $faqHelper,
    array $data = []
    )
    {
        $this->_faqHelper=$faqHelper;
        $this->_categories = $category;
        $this->_faqFactory = $faqFactory;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');


        $this->pageConfig->getTitle()->set($this->_faqHelper->getConfigData('meta_title'));
        $this->pageConfig->setDescription($this->_faqHelper->getConfigData('meta_description'));

        if ($pageMainTitle && $pageMainTitle instanceof \Magento\Theme\Block\Html\Title) {
            $pageMainTitle->setPageTitle($this->_faqHelper->getConfigData('title'));
        }

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
     * Get questions and answers by category id
     * 
     * @return \LCB\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getQAByCategoryId($categoryId)
    {
        $collection = $this->getCollection();
        $collection->addStoreFilter($this->_storeManager->getStore()->getId());
        $collection->addFieldToFilter('is_active', ['eq' => \LCB\Faq\Model\Status::STATUS_ENABLED]);
        $collection->addFieldToFilter('category_id', ['eq' => $categoryId]);
        return $collection;
    }


    /**
     * @return array
     */
    public function getCategories(){
        return $this->_categories->getCollection();
    }

}
