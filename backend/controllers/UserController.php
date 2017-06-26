<?php
namespace backend\controllers;
use common\www\BaseController;
use Yii;
class UserController extends BaseController{
    public function actionIndex(){
    }
    public function actionTest(){
        phpinfo();
    }
}
