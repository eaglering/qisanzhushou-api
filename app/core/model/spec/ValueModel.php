<?php
declare (strict_types = 1);

namespace app\core\model\spec;

use app\core\model\SpecModel;
use think\Model;

/**
 * @mixin \think\Model
 */
class ValueModel extends Model
{
    protected $name = 'spec_value';

    public function spec() {
        return $this->belongsTo(SpecModel::class, 'spec_id');
    }
}
