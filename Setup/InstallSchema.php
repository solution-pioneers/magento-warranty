<?php 

namespace SolutionPioneers\Warranty\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('solutionpioneers_warranty');

        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'solutionpioneers_warranty_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullbale'=>false,'default'=>''],
                )->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    '',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'image',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullbale'=>false,'default'=>''],
                )->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    []
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    []
                )->setOption('charset','utf8');
            $conn->createTable($table);
        }

        $setup->endSetup();
    }
}
?>