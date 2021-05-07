<?php
declare(strict_types=1);

namespace app\frontend\logic\navigator;

use app\core\enums\navigator\category\TypeEnum;
use app\core\model\navigator\SiteModel;

class SiteLogic
{
    private $siteModel;

    public function __construct()
    {
        $this->siteModel = new SiteModel;
    }

    /**
     * 获取首页推荐
     * @param $limit
     * @return \think\Collection
     */
    public function getHomeHot($limit) {
        $q = $this->siteModel->where('type', '=', TypeEnum::HOME_HOT)
            ->order('sort', 'desc')
            ->order('created_at', 'asc');
        !is_null($limit) && $q->limit($limit);
        return $q->select();
    }

    /**
     * 获取文档教程
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getDocument() {
        return $this->siteModel->where('type', '=', TypeEnum::DOCUMENT)
            ->order('sort', 'desc')
            ->order('created_at', 'asc')
            ->with(['category'])
            ->select();
    }

    /**
     * 获取助手工具
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getTool() {
        return $this->siteModel->where('type', '=', TypeEnum::TOOL)
            ->order('sort', 'desc')
            ->order('created_at', 'asc')
            ->with(['category'])
            ->select();
    }

    /**
     * 获取开源项目
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getProject() {
        return $this->siteModel->where('type', '=', TypeEnum::PROJECT)
            ->order('sort', 'desc')
            ->order('created_at', 'asc')
            ->with(['category'])
            ->select();
    }
}
