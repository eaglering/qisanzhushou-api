<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SqRegion extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('sq_region', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('pid', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '父id',])
			->addColumn('shortname', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '简称',])
			->addColumn('name', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '名称',])
			->addColumn('merger_name', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '全称',])
			->addColumn('level', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '层级 1 2 3 省市区县',])
			->addColumn('pinyin', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '拼音',])
			->addColumn('code', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '长途区号',])
			->addColumn('zip_code', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '邮编',])
			->addColumn('first', 'string', ['limit' => 50,'null' => false,'default' => '','signed' => true,'comment' => '首字母',])
			->addColumn('lng', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '经度',])
			->addColumn('lat', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '纬度',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
			->addIndex(['name'], ['name' => 'ix_name'])
			->addIndex(['updated_at'], ['name' => 'ix_updated_at'])
            ->create();
    }
}
