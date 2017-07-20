<?php
namespace common\www;
use common\validators\Validate;
use common\validators\ValidateException;
use Yii;
use yii\web\Controller;
class BaseController extends Controller{
    public $layout = false;
    private $__preloadScripts = [];
    private $__scripts = [];
    private $__load_scripts_by_sort = false;
    private $__tplValues = [];

    /**设置预加载的JavaScript脚本
     * @param array $preloadScripts
     */
    protected function setPreloadScript($preloadScripts=[]){
        if(empty($preloadScripts)) return;
        $preloadScripts = $this->__formatScriptPath($preloadScripts);
        $this->__preloadScripts = array_merge($this->__preloadScripts,$preloadScripts);
    }
    /**设置关联JavaScript脚本
     * @param array $scripts
     * @param array $preloadScripts
     */
    protected function setScript($scripts=[],$preloadScripts=[]){
        if(empty($scripts)) return;
        $scripts = $this->__formatScriptPath($scripts);
        $this->__scripts = array_merge($this->__scripts,$scripts);
        $this->setPreloadScript($preloadScripts);
    }
    /**格式化脚本路径
     * @param array $scripts
     * @return array
     */
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
        return array_unique($scripts);
    }

    /**给模板赋值 单个赋值
     * @param $key
     * @param $value
     */
    protected function tplValue($key,$value){
        if(!empty($key)){//赋值的索引不能为空
            $this->__tplValues[$key] = $value;
        }
    }

    /**给模板赋值 多个
     * @param array $values
     */
    protected function tplValues(array $values){
        if(!empty($values)){
            $this->__tplValues = array_merge($this->__tplValues,$values);
        }
    }

    /**展示模板
     * @param $view
     * @param array $params
     * @return string
     */
    public function show($view,array $params=[]){
        $params = array_merge($this->__tplValues,$params);
        $params['__scripts'] = $this->__scripts;
        $params['__preloadScripts'] = $this->__preloadScripts;
        return $this->render($view,$params);
    }

    public function failResponse($data,$msg="",$code=-1){
        $this->echoResponse(['code'=>$code,'data'=>$data,'msg'=>$msg]);
    }
    public function successResponse($data=[],$msg="",$code=1){
        $this->echoResponse(['code'=>$code,'data'=>$data,'msg'=>$msg]);
    }

    /**验证参数
     * @param array $validateArr
     * @param bool $isApi
     * @return bool
     */
    public function validateParams(array $validateArr,bool $isApi = true){
        try{
            list($result,$error) = Validate::check($validateArr);
            if($result){
                return true;
            }else{
                $msg = Validate::formatErrorMsg($error);
                $isApi && $this->failResponse('params validate failed',$msg);
            }
        }catch (ValidateException $e){
            $isApi && $this->failResponse($validateArr,$e->getMessage());
        }
        return false;
    }
    /**
     * @param $jsonMixed
     */
    public function echoResponse($jsonMixed){
        if (isset($_GET["callback"])) {
            $callback = preg_replace('/\W/i', '', $_GET["callback"]);
            if($callback) {
                header("Content-Type: application/javascript");
                header('Access-Control-Allow-Origin:*');
                echo "/**/{$callback}(".json_encode($jsonMixed).")";
            }
        } else {
            header("Access-Control-Allow-Origin: *");
            echo json_encode($jsonMixed);
        }
        exit;
    }
}
