<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SqStoreUserOperateLog extends Migrator
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
        $table = $this->table('store_user_operate_log', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '操作日志' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('title', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '标题',])
			->addColumn('business_type', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '业务类型 0 其他 1 新增 2 修改 3 删除',])
			->addColumn('method', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '方法名称',])
			->addColumn('request_url', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '请求url',])
			->addColumn('request_method', 'string', ['limit' => 10,'null' => false,'default' => '','signed' => true,'comment' => '请求方法',])
			->addColumn('request_param', 'string', ['limit' => 2000,'null' => false,'default' => '','signed' => true,'comment' => '操作参数',])
			->addColumn('operator_type', 'boolean', ['null' => false,'default' => 0,'signed' => true,'comment' => '操作类别 0 其他 1后台用户 2手机端用户',])
			->addColumn('operator_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '操作员id',])
			->addColumn('operator_name', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '操作员',])
			->addColumn('operator_ip', 'string', ['limit' => 30,'null' => false,'default' => '','signed' => true,'comment' => '操作员ip',])
			->addColumn('operator_location', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '操作员地址',])
			->addColumn('json_result', 'text', ['limit' => MysqlAdapter::TEXT_REGULAR,'null' => false,'signed' => true,'comment' => '返回数据',])
			->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_MEDIUM,'null' => false,'default' => 0,'signed' => false,'comment' => '返回状态',])
			->addColumn('error_msg', 'string', ['limit' => 2000,'null' => false,'default' => '','signed' => true,'comment' => '错误描述',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['updated_at'], ['name' => 'ix_updated_at'])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
            ->create();
    }
}
