<?php
declare (strict_types=1);

namespace app\backend\logic;

use app\backend\logic\Logic;
use app\backend\model\goods\spec\RelModel;
use app\backend\model\GoodsModel;
use app\core\enums\goods\DealerMoneyTypeEnum;
use app\core\model\SpecModel;
use think\db\concern\WhereQuery;
use think\facade\Log;
use think\facade\Request;
use think\Paginator;
use app\core\logic\GoodsLogic as BaseGoodsLogic;
use app\backend\model\spec\ValueModel as SpecValueModel;
use app\backend\model\goods\spec\RelModel as GoodsSpecRelModel;
use app\backend\model\goods\SkuModel as GoodsSkuModel;

class GoodsLogic extends BaseGoodsLogic implements Logic
{
    private $goodsModel;
    private $goodsSkuModel;

    public function __construct()
    {
        parent::__construct();
        $this->goodsModel = new GoodsModel();
        $this->goodsSkuModel = new GoodsSkuModel();
    }

    /**
     * @param WhereQuery $q
     * @param $params
     */
    protected function filter($q, $params)
    {
        if (filterable_string($params, 'keyword')) {
            $goodsIds = $this->goodsSkuModel->whereLike('key', '%' . $params['keyword'] . '%')->column('goods_id');
            if ($goodsIds) {
                $q->whereOr([
                    [['goods_name', 'like', '%' . $params['keyword'] . '%']],
                    [['id', 'in', $goodsIds]]
                ]);
            } else {
                $q->whereLike('goods_name', '%' . $params['keyword'] . '%');
            }
        }
        if (filterable_integer($params, 'goods_status')) {
            $q->where('goods_status', '=', $params['goods_status']);
        }
        if (filterable_integer($params, 'category_id')) {
            $q->where('category_id', '=', $params['category_id']);
        }
    }

    /**
     * @param Paginator $paginator
     * @return mixed
     */
    protected function format($paginator)
    {
        if ($paginator->isEmpty()) {
            return $paginator;
        }
        $paginator->map(function ($item) {
            $item['goods_price_range'] = $this->goodsModel->getGoodsPriceRange($item['skus']);
            return $item;
        });
        return $paginator;
    }

    public function paginator($params)
    {
        $paginator = $this->goodsModel->where(function ($q) use ($params) { $this->filter($q, $params); })
            ->where('is_delete', '=', 0)
            ->with(['image.file', 'skus', 'category'])
            ->append(['spec_type_text', 'goods_sales'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    /**
     * 添加商品
     * @param $params
     * @return bool
     */
    public function add($params)
    {
        return $this->saveData($this->goodsModel, $params);
    }

    /**
     * 编辑商品
     * @param $id
     * @param $params
     * @return bool
     */
    public function edit($id, $params)
    {
        /** @var GoodsModel $model */
        $model = $this->goodsModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        return $this->saveData($model, $params);
    }

    /**
     * 保存商品数据
     * @param GoodsModel $goodsModel
     * @param array $params
     */
    protected function saveData($goodsModel, $params) {
        $isUpdated = $goodsModel->isExists();
        if ($params['is_ind_dealer'] && $params['dealer_money_type'] == DealerMoneyTypeEnum::MONEY) {
            $params['first_money_fen'] = floor($params['first_money'] * 100);
            $params['second_money_fen'] = floor($params['second_money'] * 100);
            $params['third_money_fen'] = floor($params['third_money'] * 100);
        } else {
            $params['first_money_fen'] = $params['first_money'];
            $params['second_money_fen'] = $params['second_money'];
            $params['third_money_fen'] = $params['third_money'];
        }
        if (!$params['is_enable_grade'] || !$params['is_alone_grade']) {
            $params['alone_grade_equity'] = [];
        }
        $specModel = new SpecModel;
        $specValueModel = new SpecValueModel;
        $goodsSpecRelModel = new GoodsSpecRelModel;
        $goodsModel->startTrans();
        try {
            $goods = Request::only([
                'alone_grade_equity', 'category_id', 'content', 'dealer_money_type', 'deduct_stock_type',
                'delivery_id', 'first_money_fen', 'goods_name', 'goods_sort', 'goods_status',
                'is_alone_grade', 'is_enable_grade', 'is_ind_dealer', 'is_points_discount', 'is_points_gift',
                'sales_actual', 'sales_initial', 'second_money_fen', 'selling_point', 'spec_type', 'third_money_fen'
            ], $params);
            $goodsModel->save($goods);
            $goodsSpecRel = [];
            $specValues = [];
            foreach ($params['spec_rels'] as $item) {
                $spec = $specModel->where('spec_name', '=', $item['label'])->find();
                !$spec && $spec = SpecModel::create(['spec_name' => $item['label']]);
                foreach ($item['tags'] as $tag) {
                    $specValue = $specValueModel->where('spec_id', '=', $spec['id'])
                        ->where('spec_value', '=', $tag)->find();
                    !$specValue && $specValue = SpecValueModel::create([
                        'spec_id' => $spec['id'], 'spec_value' => $tag]);
                    $specValues[$tag] = $specValue['id'];
                    $goodsSpecRel[] = [
                        'goods_id' => $goodsModel['id'],
                        'spec_id' => $spec['id'],
                        'spec_value_id' => $specValue['id']
                    ];
                }
            }
            $skus = [];
            foreach ($params['skus'] as $key => $item) {
                $specValueIds = explode('-', $item['key']);
                $specValueIds = array_map(function ($item) use ($specValues) {
                    return $specValues[$item] ?? '';
                }, $specValueIds);
                if (!$isUpdated && isset($item['id'])) {
                    unset($item['id']);
                }
                $item['goods_id'] = $goodsModel['id'];
                $item['goods_no'] = $item['goods_no'] ?: $this->genGoodsNo($key);
                $item['spec_sku_id'] = implode('-', $specValueIds);
                $item['goods_price_fen'] = floor($item['goods_price'] * 100);
                $item['line_price_fen'] = floor($item['line_price'] * 100);
                $skus[] = $item;
            }
            $images = [];
            foreach ($params['images'] as $item) {
                if (!$isUpdated && isset($item['id'])) {
                    unset($item['id']);
                }
                $item['goods_id'] = $goodsModel['id'];
                $images[] = $item;
            }
            if ($isUpdated) {
                $goodsModel->images()->where('goods_id', '=', $goodsModel['id'])->delete();
                $goodsModel->skus()->where('goods_id', '=', $goodsModel['id'])->delete();
                $goodsSpecRelModel->where('goods_id', '=', $goodsModel['id'])->delete();
            }
            $goodsModel->images()->saveAll($images, false);
            $goodsSpecRelModel->saveAll($goodsSpecRel, false);
            $goodsModel->skus()->saveAll($skus, false);
            $goodsModel->commit();
        } catch (\Exception $e) {
            $goodsModel->rollback();
            throw $e;
        }
        return true;
    }

    public function view($id)
    {
        $model = $this->goodsModel
            ->where('id', '=', $id)
            ->where('is_delete', '=', 0)
            ->with(['images.file', 'skus.file', 'category', 'delivery', 'spec_rel.spec'])
            ->append(['goods_sales', 'spec_type_text', 'goods_status_text', 'deduct_stock_type_text',
                'dealer_money_type_text', 'first_money', 'second_money', 'third_money'])
            ->find();
        if (!$model) {
            $this->error = '无效的id';
            return false;
        }
        $specValues = [];
        $specRels = [];
        // 构建规格
        if ($model['spec_rel']) {
            foreach ($model['spec_rel'] as $rel) {
                $specValues[$rel['id']] = $rel['spec_value'];
                if (!isset($specRels[$rel['spec']['spec_name']])) {
                    $specRels[$rel['spec']['spec_name']] = [
                        'label' => $rel['spec']['spec_name'],
                        'tags' => [$rel['spec_value']]
                    ];
                } else {
                    $specRels[$rel['spec']['spec_name']]['tags'][] = $rel['spec_value'];
                }
            }
        }
        $model['spec_rels'] = array_values($specRels);
        // 构建sku
        collect($model['skus'])->map(function ($item) use ($specValues) {
            $specSkus = explode('-', $item['spec_sku_id']);
            $specSkus = array_map(function ($id) use ($specValues) {
                return $specValues[$id] ?? '';
            }, $specSkus);
            $item['key'] = implode('-', $specSkus);
            return $item;
        });
        return $model;
    }

    public function delete($id)
    {
        $id = explode(',', $id);
        $this->goodsModel->whereIn('id', $id)->useSoftDelete('is_delete', 1)->delete();
        return true;
    }

    public function status($id, $params)
    {
        $model = $this->goodsModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save(['goods_status' => $params['goods_status']]);
        return true;
    }
}
