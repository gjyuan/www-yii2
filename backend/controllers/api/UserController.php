<?php
namespace backend\controllers\api;
use backend\models\UserModel;
use common\validate\Validate;
use common\www\BaseController;
use Yii;
class UserController extends BaseController{

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
        list($userName,$password,$rpassword,$name,$mobile) = $request->getStrings(['userName','password','rpassword','name','mobile']);
        $gender = $request->getInt('gender',1);
        $validateArr = array(
            'userName'=>['v'=>$userName,'rs'=>['email','required']],
            'password'=>['v'=>$password,'r'=>['string',['length'=>[6,20]]]],
        );
        var_dump(Validate::check($validateArr));exit;
        $user = ['email'=>$userName,'password'=>$password,'name'=>$name,'mobile'=>$mobile,'gender'=>$gender];
        $userId = UserModel::getInstance()->register($user);
        $this->successResponse($userId);
    }
}
