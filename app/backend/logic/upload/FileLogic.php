<?php
declare (strict_types = 1);

namespace app\backend\logic\upload;

use app\backend\logic\Logic;
use app\backend\model\upload\FileModel as UploadFileModel;
use app\core\driver\storage\Driver;
use app\core\enums\store\settings\KeyEnum;
use think\file\UploadedFile;
use think\Paginator;
use app\core\logic\upload\FileLogic as BaseUploadFileLogic;
use app\backend\logic\store\SettingLogic as StoreSettingLogic;

class FileLogic extends BaseUploadFileLogic
{
    private $uploadFileModel;

    public function __construct()
    {
        parent::__construct();
        $this->uploadFileModel = new UploadFileModel();
    }

    protected function filter($params) {
        $where = [];
        if (filterable_integer($params, 'group_id')) {
            $where[] = ['group_id', '=', $params['group_id']];
        }
        if (filterable_integer($params, 'is_user')) {
            $where[] = ['user_id', $params['is_user'] ? '>' : '=', 0];
        }
        if (filterable_integer($params, 'is_recycle')) {
            $where[] = ['is_recycle', '=', $params['is_recycle']];
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
        $where = $this->filter($params);
        $paginator = $this->uploadFileModel->where($where)
            ->where('is_delete', '=', 0)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function move($id, $params) {
        $ids = explode(',', $id);
        $this->uploadFileModel->whereIn('id', $ids)->save(['group_id' => $params['group_id']]);
        return true;
    }

    public function delete($id) {
        $ids = explode(',', $id);
        $this->uploadFileModel->whereIn('id', $ids)->useSoftDelete('is_delete', 1)->delete();
        return true;
    }

    /**
     * @param $params
     * @param UploadedFile $file
     * @return bool
     */
    public function upload($params, $file)
    {
        $storeSettingLogic = new StoreSettingLogic;
        $config = $storeSettingLogic->getItem(KeyEnum::STORAGE);
        $driver = new Driver($config);
        $driver->upload($file);
        $fileObject = $driver->getFilename();
        $fileInfo = $driver->getFileInfo();
        $this->uploadFileModel->save([
            'storage' => $config['default_engine'],
            'group_id' => $params['group_id'],
            'file_object' => $fileObject,
            'file_name' => $fileInfo->getFilename(),
            'file_size' => $fileInfo->getSize(),
            'file_type' => $fileInfo->getType(),
            'extension' => $fileInfo->getExtension()
        ]);
        return true;
    }

}
