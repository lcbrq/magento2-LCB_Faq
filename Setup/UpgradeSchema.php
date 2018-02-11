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

        if (version_compare($context->getVersion(), '1.1.0') < 0) {
            
            $table = $setup->getConnection()->newTable(
                $setup->getTable('lcb_faq_category')
            )->addColumn(
                'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Category Id'
            )->addColumn(
                'url', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [], 'Category url'
            )->addColumn(
                'name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [], 'Category name'
            )->addColumn(
                'is_active', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                1, [], 'Is enabled'
            )->setComment(
                    'FAQ Category'
            );
            $setup->getConnection()->createTable($table);
            
        }

        $setup->endSetup();
    }

}
