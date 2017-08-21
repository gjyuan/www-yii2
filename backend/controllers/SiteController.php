<?php
namespace backend\controllers;
use common\vender\www\controller\BaseController;
use Yii;
class SiteController extends BaseController {
    public function actionIndex(){
        $this->setScript(['index']);
        return $this->show('index');
    }
    public function actionTest(){
        var_dump(Yii::$app->getSecurity());
//        phpinfo();
    }
    public function actionError(){
        return $this->show("error");
    }
}
