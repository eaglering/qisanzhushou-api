<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class StoreUserLoginLog extends Migrator
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
        $table = $this->table('store_user_login_log', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '登录日志' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('title', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '标题',])
			->addColumn('user_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '用户id',])
			->addColumn('username', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '用户名',])
			->addColumn('ip', 'string', ['limit' => 30,'null' => false,'default' => '','signed' => true,'comment' => 'ip地址',])
			->addColumn('location', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '地址',])
			->addColumn('browser', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '浏览器',])
			->addColumn('os', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '操作系统',])
			->addColumn('status', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '状态 1 成功 2失败',])
			->addColumn('type', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '类型 1 登录 2 退出',])
			->addColumn('remark', 'string', ['limit' => 1000,'null' => false,'default' => '','signed' => true,'comment' => '提示消息',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['updated_at'], ['name' => 'ix_updated_at'])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
            ->create();
    }
}
