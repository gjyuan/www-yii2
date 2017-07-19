<?php
namespace common\validate;
use Yii;
use yii\base\DynamicModel;
use yii\validators\Validator;

class Validate extends Validator {
    private static $__check_result;
    public static function check(array $data)
    {
        foreach ($data as $key => $info) {
            $attribute = [$key => $info['v']];
            $rule = $info['r'];
            $rules = $info['rs'];
        }
        DynamicModel::validateData();
    }

    private static function checkRuleParam(array $data){
        $flag = true;$rules = [];
        foreach($data as $key=>$d){
            if(isset($d['v']) && (isset($d['r'])||isset($d['rs']))){
                $attribute = [$key=>$d['v']];
                $r = isset($d['r']) ? $d['r'] : [];
                $rs = isset($d['rs']) ? $d['rs'] : [];
                if(!empty($r)){
                    list($flag,$rRule)= self::getRule($key,$r);
                    $rules[] = $rRule;
                }
                if(!empty($rs)){
                    foreach($rs as $o){
                        list($flag,$rsRule) = self::getRule($key,$o);
                        $rules[] = $rsRule;
                    }
                }
            }else{
                $flag = false;
                break;
            }
        }
        return $rules;
    }
    private static function getRule(string $attribute,mixed $rule){
        if(is_string($rule)){
            return [$attribute,$rule];
        }
        if(is_array($rule) && is_string($rule[0]) && is_array($rule[1])){
            $r = $rule[0];$propertys = $rule[1];
            return array_merge([$attribute,$r],$propertys);
        }else{
            return [false,[]];
        }
    }
}
