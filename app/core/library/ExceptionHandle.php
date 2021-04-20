<?php
namespace app\core\library;

use Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\RouteNotFoundException;
use think\exception\ValidateException;
use think\Response;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /** @var App */
    protected $app;

    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
//        HttpException::class,
//        HttpResponseException::class,
//        ModelNotFoundException::class,
//        DataNotFoundException::class,
//        ValidateException::class,
        RouteNotFoundException::class
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        if (!$this->isIgnoreReport($exception)) {
            // 收集异常数据
            $data = [
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
                'message' => $this->getMessage($exception),
                'code'    => $this->getCode($exception),
            ];
            $log = "[{$data['code']}]{$data['message']}[{$data['file']}:{$data['line']}]";

            if ($this->app->config->get('log.record_trace')) {
                $log .= PHP_EOL . $exception->getTraceAsString();
            }

            try {
                $this->app->log->record($log, 'error');
            } catch (Exception $e) {}

            try {
                $robot = $this->app->config->get('log.channels.feishu');
                if ($robot) {
                    $env = strtoupper($this->app->env());
                    curlPost($robot, json_encode([
                        'msg_type' => 'text',
                        'content' => [
                            'text' => "<at user_id=\"all\"> </at> {$env} Exception\r\n{$log}"
                        ]
                    ], JSON_UNESCAPED_SLASHES), [
                        'timeout' => 5,
                        'header' => [
                            'Content-type: application/json;charset=utf-8',
                            'Accept: application/json'
                        ]
                    ]);
                }
            } catch (Exception $e) {}
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制

        // 其他错误交给系统处理
        return parent::render($request, $e);
    }

    /**
     * @access protected
     * @param Throwable $exception
     * @return Response
     */
    protected function convertExceptionToResponse(Throwable $exception): Response
    {
        if (!$this->isJson) {
            $response = Response::create($this->renderExceptionContent($exception));
        } else {
            $response = Response::create($this->convertExceptionToArray($exception), 'json');
        }

        if ($exception instanceof HttpException) {
            $response->header($exception->getHeaders());
        }

        return $response;
    }
}
