<?php

use think\migration\Migrator;
use think\migration\db\Column;

class DataSqStoreUser extends Migrator
{
    public function up()
    {
        $singleRow = [
            'id' => 1,
            'username' => 'admin',
            'password' => 'ade43e3ae3c2013b7b76026c8f0ea9c334b0d6a7',
            'phone' => '12345678901',
            'realname' => '石头',
            'is_super' => 1,
            'is_lock' => 0,
            'is_delete' => 0
        ];
        $this->table('sq_store_user')->insert($singleRow)->saveData();
    }
}
