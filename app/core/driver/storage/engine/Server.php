<?php
declare(strict_types=1);

namespace app\core\driver\storage\engine;

use app\core\logic\Logic;
use think\Exception;
use think\File;
use think\file\UploadedFile;
use think\Request;

abstract class Server extends Logic
{
    /** @var $file File|UploadedFile */
    protected $file;
    // 文件名
    protected $filename;
    /** @var \SplFileInfo $fileInfo */
    protected $fileInfo;

    /**
     * 设置上传的文件信息
     * @param File|UploadedFile $file
     * @return bool
     */
    public function upload($file)
    {
        // 接收上传的文件
        $this->file = $file;
        // 文件信息
        $this->fileInfo = $this->file->getFileInfo();
        $this->uploadFile();
        return true;
    }

    /**
     * 文件上传
     */
    abstract protected function uploadFile();

    /**
     * 文件删除
     * @param $filename
     * @return bool|mixed
     */
    abstract public function delete($filename);

    /**
     * 返回上传后文件路径
     * @return string
     */
    abstract public function getFilename();

    /**
     * 返回文件请求路径
     * @param $filename
     * @return string
     */
    abstract public function getFileUrl($filename);

    /**
     * 返回文件信息
     * @return mixed
     */
    public function getFileInfo()
    {
        return $this->fileInfo;
    }

    /**
     * 生成保存文件名
     */
    protected function buildName()
    {
        // 要上传图片的本地路径
        $realPath = $this->file->getPath();
        // 扩展名
        $ext = pathinfo($this->file->getFilename(), PATHINFO_EXTENSION);
        // 自动生成文件名
        return date('YmdHis') . substr(md5($realPath), 0, 5)
            . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT) . ".{$ext}";
    }
}
