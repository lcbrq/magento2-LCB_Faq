<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Controller\Adminhtml\faq;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;

class ExportExcel extends \Magento\Backend\App\Action {

    protected $_fileFactory;

    /**
     * Generate xml file for Excel
     * 
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout(false);

        $fileName = 'faq.xml';

        $exportBlock = $this->_view->getLayout()->createBlock('LCB\Faq\Block\Adminhtml\Faq\Grid');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $this->_fileFactory = $objectManager->create('Magento\Framework\App\Response\Http\FileFactory');

        return $this->_fileFactory->create(
                        $fileName, $exportBlock->getExcelFile(),
                        DirectoryList::VAR_DIR
        );
    }

}
