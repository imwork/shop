<?php
//检测PHP的版本,版本低于5.3就退出
version_compare(PHP_VERSION,'5.3','>') or exit('版本太低!');
//定义项目的根目录常量
define('ROOT_PATH',dirname($_SERVER['SCRIPT_FILENAME']).'/');
//定义框架的目录
define('THINK_PATH',dirname(ROOT_PATH).'/ThinkPHP/');
//定义应用目录
define('APP_PATH',ROOT_PATH.'Application/');
//定义运行时目录(Runtime)
define('RUNTIME_PATH',ROOT_PATH.'Runtime/');
//设置调试模式
define('APP_DEBUG',true);
//绑定指定的一个模块
//define('BIND_MODULE','Admin');
//加载框架的入口文件
require THINK_PATH.'ThinkPHP.php';





