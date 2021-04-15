<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class StoreUserPermission extends Migrator
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
        $table = $this->table('store_user_permission', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '用户的权限表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('user_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '用户id',])
			->addColumn('type', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '类型 1角色 2权限',])
			->addColumn('rule_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '规则id',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
            ->create();
    }
}
