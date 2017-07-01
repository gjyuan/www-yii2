<?php
namespace backend\controllers;
use common\www\BaseController;
use Yii;
class LoginController extends BaseController{

    public function actionIndex(){

        return $this->show("login");
    }
}
