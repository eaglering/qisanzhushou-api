<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SqStoreSetting extends Migrator
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
        $table = $this->table('sq_store_setting', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '商城设置记录表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('key', 'string', ['limit' => 30,'null' => false,'default' => '','signed' => true,'comment' => '设置项标示',])
			->addColumn('describe', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '设置项描述',])
			->addColumn('values', 'text', ['limit' => MysqlAdapter::TEXT_MEDIUM,'null' => true,'signed' => true,'comment' => '设置内容（json格式）',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
			->addIndex(['key'], ['unique' => true,'name' => 'ux_key'])
			->addIndex(['updated_at'], ['name' => 'ix_updated_at'])
            ->create();
    }
}
