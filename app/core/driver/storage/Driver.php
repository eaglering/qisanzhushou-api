<?php


namespace app\core\driver\storage;

use app\core\driver\sms\engine\Server;
use Exception;

/**
 * Class Driver
 * @method void upload($file);
 * @method bool delete($filename);
 * @method string getFilename();
 * @method \SplFileInfo getFileInfo();
 * @method string getFileUrl($filename);
 * @package app\core\driver\storage
 */
class Driver
{
    private $config;    // 配置信息
    /** @var Server $engine */
    private $engine;    // 当前短信引擎类
    private $engineName;    // 当前短信引擎名称

    /**
     * 构造方法
     * Driver constructor.
     * @param $config
     */
    public function __construct($config)
    {
        // 配置信息
        $this->config = $config;
        // 当前引擎名称
        $this->engineName = $this->config['default_engine'];
        // 实例化当前存储引擎
        $this->engine = $this->getEngineClass();
    }

    /**
     * 获取当前的存储引擎
     * @return mixed
     */
    private function getEngineClass()
    {
        $classSpace = __NAMESPACE__ . '\\engine\\' . ucfirst($this->engineName);
        if (!class_exists($classSpace)) {
            throw new Exception('未找到存储引擎类: ' . $this->engineName);
        }
        return new $classSpace($this->config['engine'][$this->engineName]);
    }

    public function __call($name, $args) {
        return $this->engine->$name(...$args);
    }
}
