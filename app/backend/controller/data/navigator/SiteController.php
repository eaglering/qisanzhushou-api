<?php
declare(strict_types=1);

namespace app\backend\controller\data\navigator;

use app\backend\controller\Controller;
use app\core\enums\navigator\category\TypeEnum as CategoryTypeEnum;

class SiteController extends Controller
{
    public function types() {
        return $this->success(array_values(CategoryTypeEnum::data()), '获取成功');
    }
}
