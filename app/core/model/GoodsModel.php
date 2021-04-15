<?php
declare (strict_types=1);

namespace app\core\model;

use app\core\enums\goods\DealerMoneyTypeEnum;
use app\core\enums\goods\DeductStockTypeEnum;
use app\core\enums\goods\SpecTypeEnum;
use app\core\enums\goods\StatusEnum;
use think\Model;
use app\core\model\goods\ImageModel as GoodsImageModel;
use app\core\model\goods\SkuModel as GoodsSkuModel;
use app\core\model\goods\spec\RelModel as GoodsSpecRelModel;
use app\core\model\spec\ValueModel as SpecValueModel;
use app\core\model\user\CommentModel as UserCommentModel;

/**
 * @mixin \think\Model
 */
class GoodsModel extends Model
{
    protected $name = 'goods';

    /**
     * 减库存方式
     * @param $value
     * @param $data
     * @return mixed|string
     */
    public function getDeductStockTypeTextAttr($value, $data) {
        $map = DeductStockTypeEnum::data();
        return $map[$data['deduct_stock_type']]['label'] ?? '';
    }

    /**
     * 分销佣金类型
     * @param $value
     * @param $data
     * @return mixed|string
     */
    public function getDealerMoneyTypeTextAttr($value, $data) {
        $map = DealerMoneyTypeEnum::data();
        return $map[$data['dealer_money_type']]['label'] ?? '';
    }

    /**
     * 一级佣金
     * @param $value
     * @param $data
     * @return mixed|string
     */
    public function getFirstMoneyAttr($value, $data) {
        if ($data['dealer_money_type'] == DealerMoneyTypeEnum::MONEY) {
            return fen2yuan($data['first_money_fen']);
        } else {
            return $data['first_money_fen'];
        }
    }

    /**
     * 二级佣金
     * @param $value
     * @param $data
     * @return mixed|string
     */
    public function getSecondMoneyAttr($value, $data) {
        if ($data['dealer_money_type'] == DealerMoneyTypeEnum::MONEY) {
            return fen2yuan($data['second_money_fen']);
        } else {
            return $data['second_money_fen'];
        }
    }

    /**
     * 三级佣金
     * @param $value
     * @param $data
     * @return mixed|string
     */
    public function getThirdMoneyAttr($value, $data) {
        if ($data['dealer_money_type'] == DealerMoneyTypeEnum::MONEY) {
            return fen2yuan($data['third_money_fen']);
        } else {
            return $data['third_money_fen'];
        }
    }

    /**
     * 计算显示销量 (初始销量 + 实际销量)
     * @param $value
     * @param $data
     * @return mixed
     */
    public function getGoodsSalesAttr($value, $data)
    {
        return $data['sales_initial'] + $data['sales_actual'];
    }

    /**
     * 商品状态
     * @param $value
     * @param $data
     * @return mixed
     */
    public function getGoodsStatusTextAttr($value, $data)
    {
        $map = StatusEnum::data();
        return $map[$data['goods_status']]['label'] ?? '';
    }

    /**
     * 商品规格
     * @param $value
     * @param $data
     * @return mixed
     */
    public function getSpecTypeTextAttr($value, $data)
    {
        $map = SpecTypeEnum::data();
        return $map[$data['spec_type']]['label'] ?? '';
    }

    /**
     * 获取器：单独设置折扣的配置
     * @param $json
     * @return mixed
     */
    public function getAloneGradeEquityAttr($json)
    {
        return $json ? json_decode($json, true) : [];
    }

    /**
     * 修改器：单独设置折扣的配置
     * @param $data
     * @return mixed
     */
    public function setAloneGradeEquityAttr($data)
    {
        return json_encode($data);
    }

    /**
     * 商品分类
     * @return \think\model\relation\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id')
            ->append(['complete_path_name']);
    }

    public function skus()
    {
        return $this->hasMany(GoodsSkuModel::class, 'goods_id')->append(['goods_price', 'line_price']);
    }

    /**
     * 商品图片
     * @return \think\model\relation\HasOne
     */
    public function image()
    {
        return $this->hasOne(GoodsImageModel::class, 'goods_id');
    }

    /**
     * 商品图片
     * @return \think\model\relation\HasMany
     */
    public function images()
    {
        return $this->hasMany(GoodsImageModel::class, 'goods_id');
    }

    public function specRel()
    {
        return $this->belongsToMany(SpecValueModel::class, GoodsSpecRelModel::class, 'spec_value_id', 'goods_id');
    }

    /**
     * 运费模板表
     * @return \think\model\relation\BelongsTo
     */
    public function delivery()
    {
        return $this->BelongsTo(DeliveryModel::class, 'delivery_id');
    }

    /**
     * 订单评价
     * @return \think\model\relation\HasMany
     */
    public function comment()
    {
        return $this->hasMany(UserCommentModel::class, 'goods_id');
    }

    /**
     * 获取商品价格范围
     * @param $skus
     * @return string
     */
    public function getGoodsPriceRange($skus) {
        $minFen = $maxFen = 0;
        foreach ($skus as $sku) {
            if (!$minFen || $minFen > $sku['goods_price_fen']) {
                $minFen = $sku['goods_price_fen'];
            }
            if (!$maxFen || $maxFen < $sku['goods_price_fen']) {
                $maxFen = $sku['goods_price_fen'];
            }
        }
        if ($minFen === $maxFen) {
            return sprintf('￥%.2f', $minFen / 100);
        } else {
            return sprintf('￥%.2f ~ ￥%.2f', $minFen / 100, $maxFen / 100);
        }
    }
}
