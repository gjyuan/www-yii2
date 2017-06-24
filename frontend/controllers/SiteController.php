<?php
namespace frontend\controllers;

use common\www\BaseController;
use Yii;
class SiteController extends BaseController{
    /**
     * Displays homepage.
     * @return mixed
     */
    public function actionIndex(){
        echo "hello world!";
    }
}
