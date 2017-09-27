<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.2') < 0) {

            $setup->getConnection()
                ->changeColumn(
                    $setup->getTable('lcb_faq'), 'question', 'question', [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => '64k',
                    'comment' => 'FAQ question'
                ]);

            $setup->getConnection()
                ->changeColumn(
                    $setup->getTable('lcb_faq'), 'answer', 'answer', [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => '64k',
                    'comment' => 'FAQ answer'
                ]);
        }


        $setup->endSetup();
    }

}
