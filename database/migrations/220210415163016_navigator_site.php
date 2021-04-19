<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class NavigatorSite extends Migrator
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
        $table = $this->table('navigator_site', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '网址' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('hash_code', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '哈希值',])
			->addColumn('type', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '参考category.type',])
			->addColumn('category_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '分类编号',])
			->addColumn('title', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '网站标题',])
			->addColumn('favicon', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '图标',])
			->addColumn('thumbnail', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '缩略图',])
			->addColumn('description', 'string', ['limit' => 1000,'null' => false,'default' => '','signed' => true,'comment' => '描述',])
			->addColumn('url', 'string', ['limit' => 1000,'null' => false,'default' => '','signed' => true,'comment' => '地址',])
			->addColumn('status', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '状态 10上架 20下架',])
			->addColumn('is_captured', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '是否已采集',])
			->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '排序',])
			->addColumn('is_hot', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '推荐',])
			->addColumn('created_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '采集时间',])
			->addColumn('updated_at', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '更新时间',])
			->addIndex(['category_id'], ['name' => 'ix_category_id'])
			->addIndex(['hash_code'], ['name' => 'ix_hash_code'])
			->addIndex(['created_at'], ['name' => 'ix_created_at'])
            ->create();
    }
}
