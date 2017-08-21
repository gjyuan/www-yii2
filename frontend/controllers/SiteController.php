<?php
namespace frontend\controllers;

use common\vender\www\controller\BaseController;
use Yii;
class SiteController extends BaseController {
    /**
     * Displays homepage.
     * @return mixed
     */
    public function actionIndex(){
        echo "hello world!";
    }
}
