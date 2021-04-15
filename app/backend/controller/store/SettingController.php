<?php
declare (strict_types=1);

namespace app\backend\controller\store;

use app\backend\controller\Controller;
use app\backend\logic\store\SettingLogic as StoreSettingLogic;
use app\core\enums\DeliveryTypeEnum;
use app\core\enums\store\settings\KeyEnum;

class SettingController extends Controller
{
    public function store()
    {
        $logic = new StoreSettingLogic();
        return $this->success($logic->getItem(KeyEnum::STORE));
    }

    public function saveStore()
    {
        $params = $this->request->param();
        return $this->updateEvent(KeyEnum::STORE, $params);
    }

    public function mail()
    {
        $logic = new StoreSettingLogic();
        return $this->success($logic->getItem(KeyEnum::MAIL));
    }

    public function saveMail()
    {
        $params = $this->request->param();
        return $this->updateEvent(KeyEnum::STORE, $params);
    }

    public function sms()
    {
        $logic = new StoreSettingLogic();
        return $this->success($logic->getItem(KeyEnum::SMS));
    }

    public function saveSms()
    {
        $params = $this->request->param();
        return $this->updateEvent(KeyEnum::SMS, $params);
    }

    public function storage()
    {
        $logic = new StoreSettingLogic();
        return $this->success($logic->getItem(KeyEnum::STORAGE));
    }

    public function saveStorage()
    {
        $params = $this->request->param();
        return $this->updateEvent(KeyEnum::STORAGE, $params);
    }

    /**
     * @param $key
     * @param $params
     * @return \think\response\Json
     */
    protected function updateEvent($key, $params)
    {
        $logic = new StoreSettingLogic();
        if (!$logic->edit($key, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }
}
