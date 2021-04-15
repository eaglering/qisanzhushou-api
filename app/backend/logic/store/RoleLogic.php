<?php
declare (strict_types = 1);

namespace app\backend\logic\store;

use app\backend\logic\Logic;
use app\backend\model\store\RoleModel as StoreRoleModel;
use app\core\enums\store\user\permission\TypeEnum;
use think\facade\Db;
use think\facade\Request;
use think\Paginator;
use app\core\logic\store\RoleLogic as BaseStoreRoleLogic;
use app\backend\model\store\user\PermissionModel as StoreUserPermissionModel;

class RoleLogic extends BaseStoreRoleLogic implements Logic
{
    private $storeRoleModel;

    public function __construct()
    {
        parent::__construct();
        $this->storeRoleModel = new StoreRoleModel();
    }

    protected function filter($params) {
        $where = [];
        return $where;
    }

    /**
     * @param Paginator $paginator
     * @return mixed
     */
    protected function format($paginator) {
        if ($paginator->isEmpty()) {
            return $paginator;
        }
        return $paginator;
    }

    public function paginator($params) {
        $where = $this->filter($params);
        $paginator = $this->storeRoleModel->where($where)
            ->order(Db::raw('concat(path, if(path,",",""), id)'), 'asc')
            ->append(['path_name', 'complete_path', 'complete_path_name'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        $this->storeRoleModel->save($params);
        return true;
    }

    public function edit($id, $params) {
        /** @var StoreRoleModel $model */
        $model = $this->storeRoleModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    /**
     * 授权
     * @param $id
     * @param $params
     * @return bool
     */
    public function grant($id, $params) {
        /** @var StoreRoleModel $model */
        $model = $this->storeRoleModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        // 保存角色权限
        $permissionData = [];
        foreach ($params['permissions'] as $permissionId) {
            $permissionData[] = [
                'role_id' => $model['id'],
                'permission_id' => $permissionId
            ];
        }
        $model->startTrans();
        try {
            $model->permissions()->where('role_id', $model['id'])->delete();
            $permissionData && $model->permissions()->saveAll($permissionData);
            $model->commit();
        } catch (\Exception $e) {
            $model->rollback();
            throw $e;
        }
        return true;
    }

    public function view($id) {
        $model = $this->storeRoleModel
            ->with(['permissions'])
            ->where('id', '=', $id)
            ->append(['path_name', 'complete_path_name'])
            ->find();
        if (!$model) {
            $this->error = '无效的id';
            return false;
        }
        $model = $model->toArray();
        $model['permissions'] = array_map(function ($item) {
            return $item['permission_id'];
        }, $model['permissions']);
        return $model;
    }

    public function delete($id) {
        $id = explode(',', $id);
        $children = $this->storeRoleModel->whereIn('parent_id', $id)->exists();
        if ($children) {
            $this->error = '角色存在子集不可删除';
            return false;
        }
        $storeUserPermissionModel = new StoreUserPermissionModel;
        $rules = $storeUserPermissionModel->where('type', '=', TypeEnum::ROLE)
            ->whereIn('rule_id', $id)->column('rule_id');
        if ($rules) {
            $this->error = '角色已被分配给用户不可删除';
            return false;
        }
        $this->storeRoleModel->whereIn('id', $id)->delete();
        return true;
    }

    public function tree() {
        $all = $this->storeRoleModel->order('sort', 'asc')->column(['id', 'name', 'parent_id']);
        return list2tree($all, 'id', 'parent_id');
    }
}
