<?php
namespace backend\controllers;
use common\www\BaseController;
use Yii;
class SiteController extends BaseController{
    public function actionIndex(){
        $this->setScript('test');
        return $this->show('test');
    }
}
