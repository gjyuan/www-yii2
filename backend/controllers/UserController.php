<?php
namespace backend\controllers;
use common\www\BaseController;
use Yii;
class UserController extends BaseController{
    public function actionIndex(){
        echo "user index";
    }
    public function actionLogin(){
        $this->setScript('login');
        return $this->show("login");
    }
}
