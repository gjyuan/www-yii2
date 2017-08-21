<?php
namespace backend\controllers\api;
use backend\models\UserModel;
use common\vender\www\controller\BaseController;
use Yii;
class UserController extends BaseController {

    public function actionUserCheck(string $userName,string $password):bool
    {
        list($checkResult,$user) = UserModel::getInstance()->checkUserPasswd($userName,$password);
        if($checkResult){
            $this->successResponse($user);
        }else{
            $this->failResponse([],$user);
        }
    }
    public function actionRegister()
    {
        $request = Yii::$app->request;
        list($email,$password,$rpassword,$name,$mobile) = $request->getStrings(['email','password','rpassword','name','mobile']);
        $gender = $request->getInt('gender',1);
        $user = ['email'=>$email,'password'=>$password,'rpassword'=>$rpassword,'name'=>$name,'mobile'=>$mobile,'gender'=>$gender];
        $validateArr = UserModel::getInstance()->getRules($user);
        $this->validateParams($validateArr);
        $userId = true;//UserModel::getInstance()->register($user);
        $this->successResponse($userId);
    }
}
