<?php

/**
 * Easy FAQ management
 *
 * @category   LCB
 * @package    LCB_Faq
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */

namespace LCB\Faq\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {

            $table = $setup->getConnection()->newTable(
                $setup->getTable('lcb_faq')
            )->addColumn(
                'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Set Id'
            )->addColumn(
                'question', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [], 'FAQ question'
            )->addColumn(
                'answer', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [], 'FAQ answer'
            )->addColumn(
                'category_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11, [], 'FAQ category Id'
            )->addColumn(
                'is_active', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                1, [], 'Set active'
            )->addColumn(
                'store_ids', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [], 'Store Ids'
            )
                ->setComment(
                    'Questions and Answers'
                );
            $setup->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }

}
