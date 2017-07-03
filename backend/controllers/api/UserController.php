<?php
namespace backend\controllers\api;
use backend\models\UserModel;
use common\www\BaseController;
use Yii;
class UserController extends BaseController{

    public function actionUserCheck(){
        list($userName,$passwd) = Yii::$app->request->getStrings(['userName','passwd']);
        list($checkResult,$user) = UserModel::getInstance()->checkUserPasswd($userName,$passwd);
        if($checkResult){
            $this->successResponse($user);
        }else{
            $this->failResponse([],$user);
        }
    }
}
