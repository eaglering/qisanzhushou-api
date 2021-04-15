<?php
declare (strict_types = 1);

namespace app\backend\controller\upload;

use app\backend\controller\Controller;
use app\backend\logic\upload\FileLogic as UploadFileLogic;

class FileController extends Controller
{
    /**
     * 列表
     * @return \think\response\Json
     */
    public function list()
    {
        $params = $this->request->param();
        $validator = $this->validate([
            'group_id' => 'integer',
            'is_user' => 'in:-1,0,1',
            'is_recycle' => 'in:-1,0,1'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new UploadFileLogic();
        $paginator = $logic->paginator($params);
        return $this->paginator($paginator);
    }

    /**
     * 编辑
     * @param int $file_ids
     * @return \think\Response
     */
    public function move($file_ids)
    {
        $params = $this->request->param();
        $validator = $this->validate([
            'group_id' => 'require|number'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new UploadFileLogic();
        if (!$logic->move($file_ids, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    /**
     * 删除
     * @param string $file_ids
     * @return \think\response\Json
     */
    public function delete($file_ids)
    {
        $logic = new UploadFileLogic();
        $logic->delete($file_ids);
        return $this->success();
    }

    public function upload()
    {
        $params = $this->request->param();
        $validator = $this->validate([
            'group_id' => 'require|number'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $files = $this->request->file();
        $validator = $this->validate([
            'file' => 'require|filesize:10485760|fileExt:jpg,jpeg,png,gif',
        ]);
        if (!$validator->check($files)) {
            return $this->error($validator->getError());
        }
        $logic = new UploadFileLogic();
        $logic->upload($params, $files['file']);
        return $this->success();
    }
}
