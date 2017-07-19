<?php
namespace backend\models;

use common\www\BaseModel;

class UserModel extends BaseModel{
    public function init(){
        $this->setTable("eye_admin_user");
    }
    public function getUserByEmail($email){
        $user = $this->selectOne([['email','=',$email]]);
        unset($user['passwd'],$user['salt']);
        return !empty($user) ? $user : [];
    }
    public function register(array $user){
        $fields = ['email','password','name','mobile','gender'];
        $res = $this->insert(['email'=>$user['email'],'password'=>$user['password'],'name'=>$user['name'],'mobile'=>$user['mobile'],'gender'=>$user['gender']]);
        return $res;
    }

    /**
     * @param $email
     * @param $passwd
     * @param string $token
     * @return array
     */
    public function checkUserPasswd($email,$passwd,$token=""){
        $user = $this->selectOne([['email','=',$email]]);
        if(!empty($user)){
            $dbPasswd = isset($user['passwd']) ? $user['passwd'] : "";
            if($dbPasswd == md5($passwd)){
                unset($user['passwd'],$user['salt']);
                return [true,$user];
            }else{
                return [false,"密码错误"];
            }
        }else{
            return [false,"账户不存在"];
        }
    }
}