<?php
namespace common\widgets;
use yii\base\Widget;
use Yii;

class LoadJs extends Widget{
    public $__scripts;
    public $__preloadScripts;
    public function run(){
        $scriptHtml = "";
        $scriptHtml .= '<script type="text/javascript">var __preloadArr=[],__loadArr=[];';
        if(!empty($this->__preloadScripts)){
            foreach($this->__preloadScripts as $preloadScript){
                $scriptHtml .= '__preloadArr.push("'. Yii::$app->fe->feroot($preloadScript) .'");';
            }
        }
        if(!empty($this->__scripts)) {
            foreach ($this->__scripts as $script) {
                $scriptHtml .= "__loadArr.push('". Yii::$app->fe->feroot($script) ."');";
            }
        }
        $scriptHtml .= 'Common.addPreloadJs(__preloadArr);Common.addSysncJs(__loadArr);Common.loadJs();';
        $scriptHtml .= '</script>';
        echo $scriptHtml;
    }
}
