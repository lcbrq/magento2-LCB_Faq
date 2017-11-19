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

    /** @var \LCB\Faq\Model\FaqFactory  */
    protected $_faqFactory;

    /** @var \LCB\Faq\Model\Category  */
    protected $_categories;

    /**
     * Index constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \LCB\Faq\Model\FaqFactory $faqFactory
     * @param \LCB\Faq\Model\Category $category
     * @param array $data
     */
    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,       
    \LCB\Faq\Model\FaqFactory $faqFactory,
    \LCB\Faq\Model\Category $category,
    array $data = []
    )
    {
        $this->_categories = $category;
        $this->_faqFactory = $faqFactory;
        parent::__construct($context);
    }


    /**
     * @return mixed
     * TODO: change strpos to something better
     */
    protected function _prepareLayout()
    {
        $currentUrl = $this->_urlBuilder->getCurrentUrl();
        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');

        if(strpos($currentUrl,'faq')!=false){
            $this->pageConfig->getTitle()->set('FAQ van Emile Bakker Auto\'s: wij houden van duidelijkheid!');
            $this->pageConfig->setDescription('✓ Specialist in het importeren van nieuwe & jonge, gebruikte auto\'s uit de EU ✓ Page description: Meer dan 20 jaar ervaring ✓ Familiebedrijf ✓ Full service garage');

            if ($pageMainTitle && $pageMainTitle instanceof \Magento\Theme\Block\Html\Title) {
                $pageMainTitle->setPageTitle('Veel gestelde vragen');
            }

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


    /**
     * @return array
     */
    public function getCategories(){
        return $this->_categories->getOptionArray();
    }

}
