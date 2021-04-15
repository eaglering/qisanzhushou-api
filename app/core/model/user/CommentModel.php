<?php
declare (strict_types = 1);

namespace app\core\model\user;

use think\Model;
use app\core\model\user\comment\ImageModel as UserCommentImageModel;

/**
 * @mixin \think\Model
 */
class CommentModel extends Model
{
    protected $name = 'user_comment';

    public function images() {
        return $this->hasMany(UserCommentImageModel::class, 'comment_id');
    }
}
