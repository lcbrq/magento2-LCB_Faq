<?php

/**
 * Created by Marcin Gierus.
 * Date: 17.04.18
 * Time: 14:58
 */

namespace LCB\Faq\Helper;

use Magento\Framework\App\Helper\Context;

/**
 * Class Faq
 *
 * @package LCB\Faq\Helper
 */
class Faq extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * Faq constructor.
     *
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @param $path
     * @return mixed
     */
    public function getConfigData($path)
    {
        return $this->scopeConfig->getValue('faq/page_options/'.$path);
    }


}