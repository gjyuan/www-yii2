<?php
namespace common\validators;
use yii\base\DynamicModel;
use yii\base\Exception;

class Validate {
    public static function check(array $data)
    {
        try{
            list($attributes,$rules) = self::generateRules($data);
            $model = DynamicModel::validateData($attributes,$rules);
            if($model->hasErrors()){
                $errors = $model->getErrors();
                return [false,$errors];
            }
            return [true,[]];
        }catch (ValidateException $e){
            return [false,$e->getMessage()];
        }
    }
    public static function formatErrorMsg(array $error){
        $msg = "";
        foreach($error as $k=>$err){
            $msg .= "Param:".$k." error:";
            foreach($err as $num=>$e){
                $msg .= ($num+1) . '.' . $e;
            }
            $msg .= "；";
        }
        return $msg;
    }
    private static function generateRules(array $data){
        $rules = [];$attributes=[];
        try{
            foreach($data as $key=>$d){
                if(isset($d['v']) && (isset($d['r'])||isset($d['rs']))){
                    $attributes[$key] = $d['v'];
                    $r = isset($d['r']) ? $d['r'] : [];
                    $rs = isset($d['rs']) ? $d['rs'] : [];
                    if(!empty($r)){
                        $rules[] = self::getRule($key,$r);
                    }
                    if(!empty($rs)){
                        foreach($rs as $o){
                            $rules[] = self::getRule($key,$o);
                        }
                    }
                }else{
                    throw new ValidateException("Rule data is error please format your rules, 'v' is required and 'r' or 'rs' need at least one");
                    break;
                }
            }
            return [$attributes,$rules];
        }catch (ValidateException $e){
            var_dump($e->getMessage());exit;
        }
    }
    private static function getRule(string $attribute,$rule){
        if(is_string($rule)){
            $ruleType = $rule;
            $result = [$attribute,$rule];
        }else{
            if(is_array($rule) ){
                $r = isset($rule[0]) ? $rule[0] : "";
                $propertys = isset($rule[1]) ? $rule[1] : [];
                if(!is_array($propertys)){
                    throw new ValidateException("Properties must be an array type , error attribute:".$attribute." rule:".json_encode($rule));
                }
                if(!empty($r) && is_string($r)){
                    $ruleType = $r;
                    $result = array_merge([$attribute,$r],$propertys);
                }else{
                    throw new ValidateException("Rule must be an string type , error attribute:".$attribute." rule:".json_encode($rule));
                }
            }else{
                throw new ValidateException($attribute." rules is error!");
            }
        }
        $defaultProperty = self::getDefaultProperty($ruleType);
        foreach($defaultProperty as $k=>$v){
            if(!isset($result[$k])){
                $result[$k] = $v;
            }
        }
        return $result;
    }
    private static function getDefaultProperty(string $ruleType,string $attribute=''){
        $defaultProperty = [];
        switch ($ruleType){
            case "email":
                $defaultProperty['message'] = "邮箱格式有误！";
                break;
            case "required":
                $defaultProperty['message'] = "必需参数缺失！";
                break;
        }
        return $defaultProperty;
    }
}
class ValidateException extends Exception{
}
