<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\web;

use Yii;
use yii\base\Exception;

class WebApplication extends \yii\web\Application{
    private $__root_path; //根路径
    private $__application_host;//应用域名host
    private $__application_root;//应用对应模块的根路径
    private $__module_map;//入口文件域名和模块路径对应表
    public function __construct(array $config=[]){
        $this->__module_map = isset($config['MODULE_MAP']) ? $config['MODULE_MAP'] : [];
        unset($config["MODULE_MAP"]);
        if(!$this->checkApplicationRoot()){
            throw new Exception("Unknown host for your request!");
        }
        $config['id'] = $this->__application_host;
        $config['basePath'] = $this->getApplicationRootPath();
        parent::__construct($this->getApplicationConfig($config));
    }
    /**
     *加载boootstrap文件 -- common和application下的别名设置
     */
    protected function bootstrap(){
        $commonBootstrap = $this->getCommonRootPath() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "bootstrap.php";
        $applicationBootstrap = $this->getApplicationRootPath() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "bootstrap.php";
        $this->loadBootstrap($commonBootstrap,$applicationBootstrap);
        parent::bootstrap();
    }

    /**获取项目根路径
     * @return string
     * @throws Exception
     */
    protected function getRootPath(){
        if(!empty($this->__root_path)) return $this->__root_path;
        if(!defined("ROOT_PATH")){
            throw new Exception("The application root path ROOT_PATH is require!");
        }
        $this->__root_path = ROOT_PATH;
        return $this->__root_path;
    }

    /**获取通用module根路径
     * @return string
     * @throws Exception
     */
    protected function getCommonRootPath(){
        return $this->getRootPath() . DIRECTORY_SEPARATOR . "common";
    }

    /**获取相应应用的module根路径
     * @return string
     * @throws Exception
     */
    protected function getApplicationRootPath(){
        return $this->getRootPath() . DIRECTORY_SEPARATOR . $this->__application_root;
    }

    /**检查入口应用的域名和根路径
     * @return bool
     */
    protected function checkApplicationRoot(){
        if(empty($this->__module_map)){
            return false;
        }else{
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "";
            foreach($this->__module_map as $applicationId=>$map){
                $mapHost = isset($map['host']) ? $map['host'] : "";
                $mapRoot = isset($map['root']) ? $map['root'] : "";
                if(!empty($mapHost) && !empty($mapRoot) && strpos($mapHost,$host) === 0){
                    $this->__application_host = $mapHost;
                    $this->__application_root = $mapRoot;
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    /**获取应用的配置信息
     * @param array $config
     * @return array
     */
    private function getApplicationConfig($config=[]){
        !defined("APP_MODE") && define("APP_MODE", get_cfg_var('lianjia.environment'));
        $commonConfigFile = $this->getCommonRootPath() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . APP_MODE . ".php";
        $appConfigFile = $this->getApplicationRootPath() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . APP_MODE . ".php";
        $commonConfig = require($commonConfigFile);
        $appConfig = require($appConfigFile);
        $config = $this->mergeConfig($config,$commonConfig,$appConfig);
        return $config;
    }

    /**合并配置文件的信息
     * @return array
     */
    private function mergeConfig() {
        $config = [];
        $args = func_get_args();
        foreach($args as $newConfig){
            if (is_string($newConfig)) {
                if(is_file($newConfig)){
                    $newConfig = require($newConfig);
                }else{
                    continue;
                }
            }
            if(empty($newConfig)) continue;
            foreach ($newConfig as $key => $value) {
                if(isset($config[$key])){
                    $config[$key] = is_array($value) ? array_merge($config[$key],$value) : $value;
                }else{
                    $config[$key] = $value;
                }
            }
        }
        return $config;
    }

    /**
     * 加载入口文件的方法
     */
    private function loadBootstrap(){
        $args = func_get_args();
        foreach($args as $bootstrap) {
            if (is_string($bootstrap)) {
                if (is_file($bootstrap)) {
                    include($bootstrap);
                } else {
                    continue;
                }
            }
        }
    }

}
