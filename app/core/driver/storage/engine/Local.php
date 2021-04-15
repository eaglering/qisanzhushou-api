<?php
declare(strict_types=1);

namespace app\core\driver\storage\engine;

use think\facade\Filesystem;

/**
 * 本地文件驱动
 * Class Local
 * @package app\core\driver\storage\engine;
 */
class Local extends Server
{
    /**
     * 上传图片文件
     */
    protected function uploadFile()
    {
        $disk = Filesystem::disk('public');
        $this->filename = $disk->putFile('uploads', $this->file);
    }

    /**
     * 删除文件
     * @param $filename
     * @return bool|mixed
     */
    public function delete($filename)
    {
        $filePath = Filesystem::disk('public')->path($filename);
        // 文件所在目录
        return !file_exists($filePath) ?: unlink($filePath);
    }

    /**
     * 返回文件路径
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * 返回文件请求路径
     * @param $filename
     * @return string
     */
    public function getFileUrl($filename)
    {
        return Filesystem::disk('public')->getConfig()->get('url') . $filename;
    }
}
