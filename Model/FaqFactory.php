<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Model;

class FaqFactory {

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    /**
     * Create new FAQ set
     *
     * @param array $arguments
     * @return \LCB\Faq\Model\Faq
     * 
     */
    public function create(array $arguments = [])
    {
        return $this->_objectManager->create('LCB\Faq\Model\Faq', $arguments,
                        false);
    }
    
}
