<?php
declare (strict_types = 1);

namespace app\core\model\goods;

use think\Model;
use app\core\model\upload\FileModel as UploadFileModel;

/**
 * @mixin \think\Model
 */
class SkuModel extends Model
{
    protected $name = 'goods_sku';

    public function getGoodsPriceAttr($value, $data) {
        return fen2yuan($data['goods_price_fen']);
    }

    public function getLinePriceAttr($value, $data) {
        return fen2yuan($data['line_price_fen']);
    }

    public function file() {
        return $this->belongsTo(UploadFileModel::class, 'image_id');
    }
}
