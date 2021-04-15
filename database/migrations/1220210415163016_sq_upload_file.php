<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SqUploadFile extends Migrator
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
        $table = $this->table('sq_upload_file', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '文件库记录表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('storage', 'string', ['limit' => 20,'null' => false,'default' => '','signed' => true,'comment' => '存储方式',])
			->addColumn('group_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '文件分组id',])
			->addColumn('file_object', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '存储域名',])
			->addColumn('file_name', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '文件路径',])
			->addColumn('file_size', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '文件大小(字节)',])
			->addColumn('file_type', 'string', ['limit' => 20,'null' => false,'default' => '','signed' => true,'comment' => '文件类型',])
			->addColumn('extension', 'string', ['limit' => 20,'null' => false,'default' => '','signed' => true,'comment' => '文件扩展名',])
			->addColumn('user_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '是否为c端用户上传',])
			->addColumn('is_recycle', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '是否已回收',])
			->addColumn('is_delete', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '软删除',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['updated_at'], ['name' => 'ix_updated_at'])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
            ->create();
    }
}
