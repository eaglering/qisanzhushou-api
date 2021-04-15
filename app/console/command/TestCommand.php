<?php
declare(strict_types=1);

namespace app\console\command;

use app\backend\logic\store\RoleLogic as StoreRoleLogic;
use app\core\model\express\ConfigModel;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\App;

class TestCommand extends Command
{
    protected function configure()
    {
        $this->setName('test');
    }

    public function execute(Input $input, Output $output)
    {
        $logic = new StoreRoleLogic();
        $data = $logic->tree();
        var_dump($data);
    }
}
