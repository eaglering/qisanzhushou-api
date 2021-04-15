<?php
declare (strict_types = 1);

namespace app\core\model\goods;

use app\core\model\upload\FileModel as UploadFileModel;
use think\Model;

/**
 * @mixin \think\Model
 */
class ImageModel extends Model
{
    protected $name = 'goods_image';

    /**
     * 关联文件库
     * @return \think\model\relation\BelongsTo
     */
    public function file()
    {
        return $this->belongsTo(UploadFileModel::class, 'image_id', 'id');
    }
}
