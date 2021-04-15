<?php
declare (strict_types = 1);

namespace app\core\controller;

use think\App;
use think\exception\ValidateException;
use think\Paginator;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class Controller
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate($validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v;
    }

    protected function success($data = [], $message = '操作成功') {
        $code = 200;
        return json(compact('code', 'message', 'data'));
    }

    /**
     * @param Paginator $paginator
     * @param array $options
     * @return \think\response\Json
     */
    protected function paginator($paginator, $options = []) {
        $code = 200;
        $message = '获取成功';
        $total = $paginator->total();
        $size = $paginator->listRows();
        $pages = $paginator->lastPage();
        $page = $paginator->currentPage();
        $data = $paginator->items();
        $data = compact('total', 'size', 'pages', 'page', 'data');
        $data = array_merge($data, $options);
        return json(compact('code', 'message', 'data'));
    }

    protected function error($message = '操作失败', $data = [], $code = 0) {
        return json(compact('code', 'message', 'data'));
    }
}
