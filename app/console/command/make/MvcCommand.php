<?php
declare(strict_types=1);

namespace app\console\command\make;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\facade\Config;
use think\facade\Db;

class MvcCommand extends Command
{
    protected $list = ['core.model', 'core.logic', 'backend.model', 'backend.logic', 'backend.controller'];

    protected function configure()
    {
        $this->setName("make:mvc")->setDescription('Create mvc class')->addOption('table', 't', Option::VALUE_REQUIRED)
            ->addOption('all', 'a', Option::VALUE_REQUIRED);
    }

    protected function execute(Input $input, Output $output)
    {
        $table = $input->getOption('table');
        $all = $input->getOption('all');
        if (!$table && !$all) {
            $output->writeln('<error>-t [table] or -a option is required</error>');
            return;
        }
        $driver = Config::get('database.default');
        $prefix = Config::get("database.connections.{$driver}.prefix");
        $tables = [];
        if ($all) {
            $tables = Db::query('show tables');
        }
        if ($table) {
            $tables = [['Qisan' => $table]];
        }
        foreach ($tables as $item) {
            $tableName = array_values($item)[0];
            if (strpos($tableName, $prefix) === 0) {
                $tableName = substr($tableName, strlen($prefix));
            }
            $variables = $this->getVariables($tableName);
            $this->build($variables, $output);
        }
    }

    protected function getVariables(String $tableName)
    {
        $arr = explode('_', $tableName);
        $variables = [];
        $variables['{%tableName%}'] = $tableName;
        $variables['{%className%}'] = ucfirst(array_pop($arr));
        $variables['{%className.camel%}'] = str_replace('_', '', ucwords($tableName, '_'));
        $variables['{%className.camel.lcfirst%}'] = lcfirst($variables['{%className.camel%}']);
        if ($arr) {
            $variables['{%namespace%}'] = '\\' . implode('\\', $arr);
        } else {
            $variables['{%namespace%}'] = '';
        }
        $variables['{%actionSuffix%}'] = Config::get('route.action_suffix', '');
        return $variables;
    }

    protected function getPathname($variables, $name)
    {
        $namespace = str_replace('\\', '/', $variables['{%namespace%}']);
        list($module, $type) = explode('.', $name);
        $suffix = ucfirst($type);
        return $this->app->getBasePath() . $module . '/' . $type . $namespace . '/' . $variables['{%className%}'] . $suffix . '.php';
    }

    protected function getStub($name)
    {
        list($module, $type) = explode('.', $name);
        return dirname(__DIR__, 2) . '/stub/' . $module . '/' . $type . '.stub';
    }

    protected function build(array $variables, Output $output)
    {
        foreach ($this->list as $name) {
            $pathname = $this->getPathname($variables, $name);
            if (is_file($pathname)) {
                $output->writeln('<error>' . $name . ':' . $pathname . ' already exists!</error>');
                continue;
            }
            if (!is_dir(dirname($pathname))) {
                mkdir(dirname($pathname), 0755, true);
            }
            $stub = $this->buildClass($name, $variables);
            file_put_contents($pathname, $stub);
            $output->writeln('<info>' . $name . ':' . $pathname . ' created successfully.</info>');
        }
    }

    protected function buildClass(string $name, array $variables)
    {
        $stub = file_get_contents($this->getStub($name));
        return str_replace(array_keys($variables), array_values($variables), $stub);
    }

}
