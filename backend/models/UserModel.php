<?php
namespace backend\models;

use common\www\BaseModel;

class UserModel extends BaseModel{
    public function init(){
        $this->setTable("eye_admin_user");
    }

    public function getRules(array $user){
        $fields = ['name','password','rpassword','email','mobile','gender'];
        $rules = [];
        foreach($fields as $field){
            //如果不存在字段则不处理
            if(!isset($user[$field])) continue;
            switch ($field){
                case 'name':
                    $rules[$field] = ['v'=>$user[$field],'rs'=>['required',['string',['length'=>[1,64]]]]];
                    break;
                case "password":
                    $rules[$field] = ['v'=>$user[$field],'rs'=>['required',['string',['length'=>[6,18]]]]];
                    break;
                case "rpassword":
                    $password = isset($user[$field]) ? $user[$field] : "";
                    $rules[$field] = ['v'=>$user[$field],'rs'=>['required',['compare',['compareValue'=>$password]]]];
                    break;
                case "email":
                    $rules[$field] = ['v'=>$user[$field],'rs'=>['required','email']];
                    break;
                case "mobile":
                    $rules[$field] = ['v'=>$user[$field],'rs'=>['required','mobile']];
                    break;
                case "gender":
                    $rules[$field] = ['v'=>$user[$field],'rs'=>['required',['integer',['min'=>1,'max'=>2]]]];
                    break;
            }
        }
        return $rules;
    }
    public function getUserByEmail($email){
        $user = $this->selectOne([['email','=',$email]]);
        unset($user['passwd'],$user['salt']);
        return !empty($user) ? $user : [];
    }

    public function register(array $user){
        $fields = ['name','password','rpassword','email','mobile','gender'];
        //检查存在性
        foreach($fields as $field){
            if(!isset($user[$field])) {
                return [false,'The field:'.$field.'is required!'];break;
            }
        }
        list($result,$error) = $this->validateParams($this->getRules($user));
        if(!$result) return [false,$error];
        $res = $this->insert($user);
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