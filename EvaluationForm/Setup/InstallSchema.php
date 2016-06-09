<?php
namespace backend\EvaluationForm\Setup;
use Magento\Framework\Setup\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
       public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
       {

       $installer = $setup;
       $setup->startSetup();
       $table = $installer->getConnection()->newTable
          ($installer->getTable('EvaluationForm'))
               ->addColumn(
                       'id',
                       Table::TYPE_INTEGER,
                       null,
                       [
                               'identity' => true,
                               'unsigned' => true,
                               'nullable' => false,
                               'primary' => true
                       ],
                       'ID'
               )
               ->addColumn(
                       'firstname',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Firstname'
               )
               ->addColumn(
                       'lastname',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Lastname'
               )

		->addColumn(
                       'sector',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Sector'
               )
               ->addColumn(
                       'direction',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Direction'
               )
               ->addColumn(
                       'pace',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Pace'
               )
               ->addColumn(
                       'materials',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Materials'
               )
               ->addColumn(
                       'unclear',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Unclear'
               )

		->addColumn(
                       'help_asked',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Help_asked'
               )
               ->addColumn(
                       'helper',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Helper'
               )
               ->addColumn(
                       'questions',
                       Table::TYPE_TEXT,
                       null,
                       ['nullable' => false, 'default' => ''],
                       'Questions'
               )
               ->setComment('Form Table');

               $installer->getConnection()->createTable($table);

               $installer->endSetup();

}

}?>
