<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

//获取配置文件环境变量
define("APP_MODE", get_cfg_var('lianjia.environment'));
//设置根路径path
define("ROOT_PATH",__DIR__);
// 注册 Composer 自动加载器
require(ROOT_PATH .'/vendor/autoload.php');
// 包含 Yii 类文件
require(ROOT_PATH . '/vendor/yiisoft/yii2/Yii.php');
$config = array(
    'MODULE_MAP' => array(
        'frontend' => array(
            'host' => "self.gjyuan.com",
            'root' => 'frontend'
        ),
        'backend' => array(
            'regex' => '',
            'root' => ''
        ),
    )
);
// 创建、配置、运行一个应用
(new yii\web\WebApplication($config))->run();
