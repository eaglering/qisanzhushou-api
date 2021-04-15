<?php
declare(strict_types=1);

namespace app\backend\logic\store;

use app\backend\logic\Logic;
use app\core\enums\store\user\permission\TypeEnum;
use thans\jwt\facade\JWTAuth;
use app\backend\model\store\UserModel as StoreUserModel;
use app\backend\logic\store\user\PermissionLogic as StoreUserPermissionLogic;
use app\core\logic\store\UserLogic as BaseStoreUserLogic;
use think\facade\Request;
use think\Paginator;

class UserLogic extends BaseStoreUserLogic implements Logic
{
    private $storeUserModel;

    public function __construct()
    {
        parent::__construct();
        $this->storeUserModel = new StoreUserModel();
    }

    /**
     * @param array $data
     * @return array|false
     */
    public function login($data)
    {
        // 验证用户名密码是否正确
        /** @var StoreUserModel $user */
        $user = $this->storeUserModel->where('username', '=', $data['username'])
            ->where('is_delete', '=', 0)->find();
        if (!$user || $user['password'] !== qszs_hash($data['password'])) {
            $this->error = "用户名或密码错误";
            return false;
        }
        if ($user['status']) {
            $this->error = '您的账号已被禁用';
            return false;
        }
        // 保存登录状态
        return $this->loginState($user);
    }

    /**
     * @param $userId
     * @return StoreUserModel|false
     */
    public function getLoginUserById($userId)
    {
        /** @var StoreUserModel $user */
        $user = $this->storeUserModel->where('id', '=', $userId)
            ->where('is_delete', '=', 0)->find();
        if (!$user) {
            $this->error = '用户不存在';
            return false;
        }
        if ($user['status']) {
            $this->error = '您的账号已被禁用';
            return false;
        }
        return $user;
    }

    /**
     * @param StoreUserModel $user
     * @return array
     */
    protected function loginState($user)
    {
        $token = JWTAuth::builder(['uid' => $user['id']]);
        if ($user['is_super']) {
            $interfaces = ['ROLE_ADMIN'];
        } else {
            // 获取当前用户的权限url列表
            $storeUserPermissionLogic = new StoreUserPermissionLogic;
            $permission = $storeUserPermissionLogic->getPermissions($user['id']);
            $interfaces = [];
            foreach ($permission['permissions'] as $item) {
                $interfaces[] = $item['url'];
            }
            foreach ($permission['roles'] as $item) {
                $interfaces[] = 'ROLE_' . strtoupper($item['name']);
            }
        }
        return [
            'token' => $token,
            'uuid' => md5("{$user['id']}"),
            'name' => $user['username'],
            'interfaces' => $interfaces
        ];
    }

    protected function filter($params) {
        $where = [];
        if (filterable_string($params, 'keyword')) {
            $where[] = ['username|phone|realname', 'like', '%' . $params['keyword'] . '%'];
        }
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
        $identifier = Request::middleware('identifier');
        $where = $this->filter($params);
        $paginator = $this->storeUserModel->where($where)
            ->where('id', '<>', $identifier['id'])
            ->where('is_delete', '=', 0)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        $params['password'] = qszs_hash(trim($params['password']));
        return $this->storeUserModel->allowField(['username', 'password', 'phone', 'realname', 'is_lock'])->save($params);
    }

    public function edit($id, $params) {
        $model = $this->storeUserModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        if (filterable_string($params, 'password')) {
            $params['password'] = qszs_hash(trim($params['password']));
        } else if (isset($params['password'])) {
            unset($params['password']);
        }
        $params['is_lock'] = 1;
        $model->allowField(['username', 'password', 'phone', 'realname', 'is_lock'])->save($params);
        return true;
    }

    /**
     * 授权
     * @param $id
     * @param $params
     * @return bool
     */
    public function grant($id, $params) {
        /** @var StoreUserModel $model */
        $model = $this->storeUserModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        // 保存权限
        $ruleData = [];
        foreach ($params['permissions'] as $permissionId) {
            $ruleData[] = [
                'user_id' => $model['id'],
                'type' => TypeEnum::PERMISSION,
                'rule_id' => $permissionId
            ];
        }
        foreach ($params['roles'] as $roleId) {
            $ruleData[] = [
                'user_id' => $model['id'],
                'type' => TypeEnum::ROLE,
                'rule_id' => $roleId
            ];
        }
        $model->startTrans();
        try {
            $model->rules()->where('user_id', '=', $model['id'])->delete();
            $ruleData && $model->rules()->saveAll($ruleData);
            $model->commit();
        } catch (\Exception $e) {
            $model->rollback();
            throw $e;
        }
        return true;
    }

    public function view($id) {
        $model = $this->storeUserModel
            ->where('id', '=', $id)
            ->with(['rules'])
            ->find();
        if (!$model) {
            $this->error = '无效的id';
            return false;
        }
        $model = $model->toArray();
        $model['permissions'] = [];
        $model['roles'] = [];
        foreach ($model['rules'] as $rule) {
            if ($rule['type'] == TypeEnum::ROLE) {
                $model['roles'][] = $rule['rule_id'];
            } else if ($rule['type'] == TypeEnum::PERMISSION) {
                $model['permissions'][] = $rule['rule_id'];
            }
        }
        return $model;
    }

    public function delete($id) {
        $id = explode(',', $id);
        $this->storeUserModel->whereIn('id', $id)->useSoftDelete('is_delete', 1)->delete();
        return true;
    }

    public function state($id, $params) {
        $model = $this->storeUserModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save(['is_lock' => $params['is_lock']]);
        return true;
    }
}
