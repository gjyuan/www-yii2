<?php
namespace common\widgets;
use yii\base\Widget;
use Yii;

class LoadJs extends Widget{
    public $__scripts;
    public $__load_scripts_by_sort;
    public function run(){
        $scriptHtml = "";
        if(!empty($this->__scripts)) {
            $scriptHtml .= '<script type="text/javascript">$LAB';
            $scriptHtml .= $this->__load_scripts_by_sort ? '.setOptions({AlwaysPreserveOrder:true})' : "";
            foreach ($this->__scripts as $script) {
                $scriptHtml .= ".script('". Yii::$app->fe->feroot($script) ."')";
            }
            $scriptHtml .= '</script>';
        }
        echo $scriptHtml;
    }
}
