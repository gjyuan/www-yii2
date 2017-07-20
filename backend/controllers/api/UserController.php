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
        list($email,$password,$rpassword,$name,$mobile) = $request->getStrings(['email','password','rpassword','name','mobile']);
        $gender = $request->getInt('gender',1);
        $validateArr = array(
            'email'=>['v'=>$email,'rs'=>['required','email']],
            'password'=>['v'=>$password,'rs'=>['required',['string',['length'=>[6,20]]]]],
            'rpassword'=>['v'=>$rpassword,'rs'=>['required',['compare',['compareValue'=>$password]]]],
        );
        $this->validateParams($validateArr);
        $user = ['email'=>$email,'password'=>$password,'name'=>$name,'mobile'=>$mobile,'gender'=>$gender];
        $userId = true;//UserModel::getInstance()->register($user);
        $this->successResponse($userId);
    }
}
