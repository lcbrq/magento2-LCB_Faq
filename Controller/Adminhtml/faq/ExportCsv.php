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

class ExportCsv extends \Magento\Backend\App\Action {

    protected $_fileFactory;

    /**
     * Generate csv file
     * 
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout(false);

        $fileName = 'faq.csv';

        $exportBlock = $this->_view->getLayout()->createBlock('LCB\Faq\Block\Adminhtml\Faq\Grid');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $this->_fileFactory = $objectManager->create('Magento\Framework\App\Response\Http\FileFactory');

        return $this->_fileFactory->create(
                        $fileName, $exportBlock->getCsvFile(),
                        DirectoryList::VAR_DIR
        );
    }

}
