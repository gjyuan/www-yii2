<?php
namespace backend\controllers;
use common\www\BaseController;
use Yii;
class UserTestController extends BaseController{
    public function actionIndex(){
        echo "user test index";
    }
    public function actionTestAction(){
        phpinfo();
    }
}
