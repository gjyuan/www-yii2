<?php
namespace common\www;
use Yii;
use yii\web\Controller;
class BaseController extends Controller{
    public $layout = false;
    private $__scripts = [];
    private $__load_scripts_by_sort = false;
    private $__tplValues = [];
    protected function setScript($scripts=[],$withSort=false){
        if(empty($scripts)) return;
        $scripts = $this->__formatScriptPath($scripts);
        $this->__scripts = $scripts;
        $this->__load_scripts_by_sort = $withSort;
    }
    private function __formatScriptPath($scripts=[]){
        $scripts = is_array($scripts) ? $scripts : [$scripts];
        $controller = $this->id;//获取当前控制器的id
        if(!empty($controller)){
            $path = "/js/main/". $controller ."/";
            foreach($scripts as $k=>$v){
                if(strpos($v, "/") !== 0){//如果以'/’开头 则是绝对路径不做处理
                    $v = $path.$v;
                }
                if(substr($v, -3) !== ".js"){//如果不是以'.js'结尾 则添加上
                    $v .= ".js";
                }
                $scripts[$k] = $v;
            }
        }
        return $scripts;
    }
    protected function tplValue($key,$value){
        if(!empty($key)){//赋值的索引不能为空
            $this->__tplValues[$key] = $value;
        }
    }
    protected function tplValues(array $values){
        if(!empty($values)){
            $this->__tplValues = array_merge($this->__tplValues,$values);
        }
    }

    public function show($view,array $params=[]){
        $params = array_merge($this->__tplValues,$params);
        $params['__scripts'] = $this->__scripts;
        $params['__load_scripts_by_sort'] = $this->__load_scripts_by_sort;
        return $this->render($view,$params);
    }

}
