<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class StorePermission extends Migrator
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
        $table = $this->table('store_permission', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '商户权限列表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '权限名称',])
			->addColumn('url', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '权限url',])
			->addColumn('parent_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '父级权限id',])
			->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '排序(数字越小越靠前)',])
			->addColumn('path', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '路径',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['url'], ['unique' => true,'name' => 'uk_url'])
            ->create();
    }
}
