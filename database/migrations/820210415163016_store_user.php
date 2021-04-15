<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class StoreUser extends Migrator
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
        $table = $this->table('store_user', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '管理员用户表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('username', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '用户名',])
			->addColumn('password', 'string', ['limit' => 60,'null' => false,'default' => '','signed' => true,'comment' => '密码',])
			->addColumn('phone', 'string', ['limit' => 20,'null' => true,'signed' => true,'comment' => '手机号',])
			->addColumn('realname', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '真实名称',])
			->addColumn('is_super', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '是否超级管理员',])
			->addColumn('is_lock', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '是否锁定',])
			->addColumn('is_delete', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '是否已删除',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['phone'], ['unique' => true,'name' => 'ux_phone'])
			->addIndex(['updated_at'], ['name' => 'ix_updated_at'])
			->addIndex(['username'], ['unique' => true,'name' => 'ux_username'])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
            ->create();
    }
}
