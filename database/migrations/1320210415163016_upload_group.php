<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class UploadGroup extends Migrator
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
        $table = $this->table('upload_group', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '文件库分组记录表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('type', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '文件类型',])
			->addColumn('name', 'string', ['limit' => 30,'null' => false,'default' => '','signed' => true,'comment' => '分类名称',])
			->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '分类排序(数字越小越靠前)',])
			->addColumn('is_delete', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '是否删除',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
			->addIndex(['type'], ['name' => 'ix_group_type'])
			->addIndex(['updated_at'], ['name' => 'ix_updated_at'])
            ->create();
    }
}
