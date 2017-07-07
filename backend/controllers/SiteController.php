<?php
namespace backend\controllers;
use common\www\BaseController;
use Yii;
class SiteController extends BaseController{
    public function actionIndex(){
        return $this->show('index');
    }
    public function actionTest(){
        phpinfo();
    }
    public function actionError(){
        return $this->show("error");
    }
}
