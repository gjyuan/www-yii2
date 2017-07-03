<?php
namespace common\www;
use Yii;
use yii\base\Model;
use yii\db\Exception;
abstract class BaseModel extends Model{
    private static $__model;
    protected  $__table;
    private $__transaction;
    private $__cache;
    public function init(){
    }
    public static function getInstance(){
        $class = get_called_class();
        if(!isset(self::$__model[$class]) || empty(self::$__model[$class])){
            $obj = new static();
            self::$__model[$class] = $obj;
        }
        return self::$__model[$class];
    }
    protected function getDb(){
        return Yii::$app->db;
    }
    protected function getTable(){
        return $this->__table;
    }
    protected function setTable($table){
        $this->__table = $table;
    }
    /**获取缓存配置存在责处理 主要用来缓存count（*）结果，缓存时间自己控制
     * @return CCache|mixed|null
     */
    protected function getCache(){
        try{
            if(empty($this->__cache)){
                $cache = Yii::$app->redis;//代码中的缓存配置，如果可以的
                if($cache instanceof \yii\redis\Connection){
                    $this->__cache = $cache;
                }else{
                    $this->__cache = NULL;
                }
            }
        }catch (Exception $e){
            $this->__cache = NULL;
        }
        return $this->__cache;
    }
    //启动事务
    protected function beginTransaction(){
        if(empty($this->__transaction)){
            $this->__transaction = self::getDb()->beginTransaction();
            return $this->__transaction;
        }else{
            throw new Exception("存在未commit的事物");
        }
    }
    //回滚事务
    protected function rollback(){
        if(!empty($this->__transaction)){
            $this->__transaction->rollback();
            $this->__transaction = NULL;
        }
    }
    //提交事务
    protected function commit(){
        if(!empty($this->__transaction)){
            $this->__transaction->commit();
            $this->__transaction = NULL;
        }
    }
    private function hasTransaction(){
        return empty($this->__transaction) ? false : true;
    }
    /**插入一条数据
     * @param array $insertValue
     * @param array $extends
     * @return bool|int
     * @throws CDbException
     */
    public function insert(array $insertValue,array $extends=[]){
        try{
            $extends = $this->__checkExtends($extends);
            $tbSql = isset($extends['tbSql']) && !empty($extends['tbSql']) ? $extends['tbSql'] : $this->__table;
            if(empty($tbSql)){
                throw new CDbException("Model table lost");
            }
            $sql = "insert into ". $tbSql;
            list($setArr,$setParams) = $this->__combineSetValue($insertValue);
            $setStr = implode(',',$setArr);
            $sql .= !empty($setStr) ? " set " . $setStr : "";
            if($this->getDb()->createCommand($sql,$setParams)->execute()){
                $lastId = (int)$this->getDb()->getLastInsertID();
                return $lastId>0 ? $lastId : true;
            }else{
                return false;
            }
        }catch (Exception $e){
            Yii::error("Model insert error:".$e->getMessage());
            return false;
        }
    }

    /**插入多条数据
     * @param array $fields
     * @param array $values
     * @param array $extends
     * @return bool
     */
    public function insertValues(array $fields,array $values,array $extends=[]){
        try{
            $extends = $this->__checkExtends($extends);
            $tbSql = isset($extends['tbSql']) && !empty($extends['tbSql']) ? $extends['tbSql'] : $this->__table;
            if(empty($tbSql)){
                throw new Exception("Model table lost");
            }
            if(empty($fields)){
                throw new Exception("insert fields is empty");
            }
            if(empty($values)){
                throw new Exception("insert values is empty");
            }
            $fieldStr = '`'. implode('`,`',$fields) .'`';
            $sql = 'insert into '.$tbSql.'('. $fieldStr .')';
            list($valueArr,$params) = $this->__combineInsertValues($values);
            $sql .= ' values '.implode(',',$valueArr);
            return $this->getDb()->createCommand($sql,$params)->execute();
        }catch (Exception $e){
            Yii::error("Model insertValues error:".$e->getMessage());
            return false;
        }
    }

    /**更新数据 必须要有条件限制
     * @param array $conditions
     * @param array $setArr
     * @param array $extends
     * @return bool
     */
    public function update(array $conditions,array $setArr,array $extends=[]){
        try{
            $extends = $this->__checkExtends($extends);
            $conditions = $this->__checkConditions($conditions);
            $tbSql = isset($extends['tbSql']) && !empty($extends['tbSql']) ? $extends['tbSql'] : $this->__table;
            if(empty($tbSql)){
                throw new Exception("Model table lost");
            }
            list($setArr,$updateParams) = $this->__combineSetValue($setArr);
            list($conArr,$conParams) = $this->__combineConditions($conditions);
            if(empty($conArr)){
                throw new Exception("Model update conditions is empty");
            }
            if(empty($setArr)){
                throw new Exception("Model update setter data is empty");
            }
            $setStr = implode(" , ",$setArr);
            $conStr = implode(" and ",$conArr);
            $sql = "update ". $tbSql;
            $sql .= " set " . $setStr;
            $sql .= " where " . $conStr;
            return $this->getDb()->createCommand($sql,array_merge($updateParams,$conParams))->execute();
        }catch (Exception $e){
            Yii::error("Model update error:".$e->getMessage());
            return false;
        }
    }

    /**查询语句
     * @param array $conditions
     * @param array $extends
     * @return array
     */
    public function select(array $conditions,array $extends=[]){
        try{
            $extends = $this->__checkExtends($extends);
            $conditions = $this->__checkConditions($conditions);
            $tbSql = isset($extends['tbSql']) && !empty($extends['tbSql']) ? $extends['tbSql'] : $this->__table;
            if(empty($tbSql)){
                throw new Exception("Model table lost");
            }
            list($fieldStr,$limitStr,$orderStr,$w_l,$w_c,$cached,$groupBy) = $this->__getSelectExtends($extends);
            list($conArr,$paramArr) = $this->__combineConditions($conditions);
            $conStr = implode(" and ",$conArr);
            $list = array();$count = 0;
            if($w_l){//获取数据列表
                $sql = "select ". $fieldStr ." from ". $tbSql;
                $sql .= !empty($conStr) ? " where " . $conStr : "";
                $sql .= $groupBy.$orderStr.$limitStr;
                $sql .= $this->hasTransaction() ? " for update " : "";
                $list = $this->getDb()->createCommand($sql,$paramArr)->queryAll();
            }
            if($w_c){//获取统计条数
                $countSql = "select count(".$fieldStr.") from ". $tbSql;
                $countSql .= !empty($conStr) ? " where " . $conStr : "";
                $countSql .= $groupBy;
                $cacheObj = $this->getCache();
                if($cached && $cacheObj){//有缓存
                    $cacheKey = 'fn_count_'.md5($countSql.json_encode($paramArr));
                    $count = $cacheObj->get($cacheKey);
                    if($count === false || $count==null){
                        $count = $this->getDb()->createCommand($countSql,$paramArr)->queryScalar();
                        $cacheObj->set($cacheKey,$count,600);//分页数据存10分钟的缓存
                    }
                }else{//无缓存
                    $count = $this->getDb()->createCommand($countSql,$paramArr)->queryScalar();
                }
            }
            return array($list,$count);
        }catch (Exception $e){
            Yii::error("Model select error:".$e->getMessage());
            return array([],0);
        }
    }

    /**获取查询的其他条件 支持的key ： field-查询的字段 page-页码 pagesize-每页的数量 all 则是全部 orderBy-排序方式 cached-是否缓存count数据 w_l-获取数据列表默认获取 w_c获取总数默认不获取
     * @param array $extends
     * @return array
     */
    private function __getSelectExtends(array $extends){
        $fieldStr = isset($extends['field']) ? ' '.$extends['field'].' ' : " * ";
        $w_l = isset($extends['w_l']) ? $extends['w_l'] : true;//请求数据列with_list
        $w_c = isset($extends['w_c']) ? $extends['w_c'] : false;//请求总行数默认不请求 with_count
        $page = isset($extends['page']) ? $extends['page'] : 1;//当前页
        $pagesize = isset($extends['pagesize']) ? $extends['pagesize'] : 20;//每页数目
        $limitStr = $pagesize!="all" ? " limit ". ($page-1)*$pagesize .",". $pagesize :"";
        $orderStr  = isset($extends['orderBy']) ? " order by " . $extends['orderBy'] : "";
        $cached = isset($extends['cached']) ? $extends['cached'] : true;
        $groupBy = isset($extends['groupBy']) ? " group by " . $extends['groupBy'] : "";
        return [$fieldStr,$limitStr,$orderStr,$w_l,$w_c,$cached,$groupBy];
    }

    /**查询一条数据
     * @param array $conditions
     * @param array $extends
     * @return array
     */
    public function selectOne(array $conditions,array $extends=[]){
        try{
            $extends = $this->__checkExtends($extends);
            $conditions = $this->__checkConditions($conditions);
            list($fieldStr,$limitStr,$orderStr,$w_l,$w_c,$cached,$groupBy) = $this->__getSelectExtends($extends);
            $tbSql = isset($extends['tbSql']) && !empty($extends['tbSql']) ? $extends['tbSql'] : $this->__table;
            if(empty($tbSql)){
                throw new Exception("Model table lost");
            }
            $sql = "select ". $fieldStr ." from ". $tbSql;
            list($conArr,$paramArr) = $this->__combineConditions($conditions);
            $conStr = implode(" and ",$conArr);
            $sql .= !empty($conStr) ? " where " . $conStr : "";
            $sql .= $orderStr;
            $sql .= " limit 1";//只取第一条
            $sql .= $this->hasTransaction() ? " for update " : "";
            $row = $this->getDb()->createCommand($sql,$paramArr)->queryOne();
            return empty($row) ? array() : $row;
        }catch (Exception $e){
            Yii::error("Model selectOne error:".$e->getMessage());
            return [];
        }
    }

    /**检查扩展条件是否在规定范围里
     * @param array $extends
     * @return array
     */
    private function __checkExtends(array $extends=[]){
        $keys = ['tbSql','page','pagesize','orderBy','cached','w_l','w_c','field','groupBy'];
        foreach($extends as $k=>$v){
            if(!in_array($k,$keys)){
                unset($extends[$k]);
            }
        }
        return $extends;
    }

    /**检查where的条件的合理性，防止太过自由的处理
     * @param array $conditions
     * @return array
     * @throws CDbException
     */
    private function __checkConditions(array $conditions){
        $operates = ['=','>','<','>=','<=','!=','<>','in'];
        $newCon = [];
        foreach($conditions as $c){
            $field = isset($c[0]) ? $c[0] : "";
            $op = isset($c[1]) ? $c[1] : '';
            if(in_array($op,$operates) && !empty($field)){//检测condition的条件必须是在可允许的范围内，并且至少有一个参数
                $newCon[] = $c;
            }else{
                throw new Exception("Model conditions error:one of condition is wrong!");
            }
        }
        return $newCon;
    }

    /** 组合条件语句
     * @param array $conditions
     * @return array
     * @throws CDbException
     */
    private function __combineConditions(array $conditions){
        $conArr = array() ;$params = array();
        foreach($conditions as $k=>$c) {
            $field = trim($c[0]);
            $operator = trim($c[1]);
            $placeholder = ":LJC" . $k;//占位符
            switch ($operator) {
                case "in":
                    $inValues = isset($c[2]) ? $c[2] : [];
                    $inShort = isset($c[3]) ? $c[3] . '.' : "";
                    if (empty($inValues) || !is_array($inValues)) {
                        throw new Exception("Model 'IN' condition params is wrong" . json_encode($c));
                    }
                    $in_placeholder = [];
                    if (count($inValues) == 1) {//如果in只有一个转换成 “=”
                        $holder = $placeholder . "INONE0";
                        $conArr[] = $inShort . '`' . $field . '`=' . $holder;
                        $params[$holder] = end($inValues);
                    } else {
                        foreach ($inValues as $index => $inVal) {
                            $holder = $placeholder . "IN" . $index;
                            $in_placeholder[] = $holder;
                            $params[$holder] = $inVal;
                        }
                        if (!empty($in_placeholder)) {
                            $conArr[] = $inShort . '`' . $field . '` in(' . implode(',', $in_placeholder) . ')';
                        }
                    }
                    break;
                default://默认的处理模式 = > >= <> < 等条件的处理
                    $value = isset($c[2]) ? $c[2] : '!@#$%^&*~()_+';
                    $inShort = isset($c[3]) ? $c[3] . '.' : "";
                    if ($value === '!@#$%^&*~()_+') {
                        throw new Exception("Model '" . $operator . "' condition params is wrong" . json_encode($c));
                    }
                    $conArr[] = $inShort . '`' . $field . '`' . $operator . $placeholder;
                    $params[$placeholder] = $value;
            }
        }
        return array($conArr,$params);
    }

    /** 插入单条数据的value组合 sql
     * @param array $setValues
     * @return array
     */
    private function __combineSetValue(array $setValues){
        $setArr = array();$params = array();
        foreach($setValues as $k=>$v){
            $key = trim($k);
            $placeholder  = ":LJI" . $key;
            $holder = $placeholder;
            $setArr[] = '`'.$key.'`='.$holder;
            $params[$holder] = $v;
        }
        return array($setArr,$params);
    }

    /**插入多条数据的value组合 sql
     * @param array $valueList
     * @return array
     */
    private function __combineInsertValues(array $valueList){
        $params = array();$valueStrArr = "";
        foreach($valueList as $k=>$values){
            $holderArr = array();
            foreach($values as $i=>$value){
                $placeHolder = ':LJI'.$k.$i;
                $holderArr[] = $placeHolder;
                $params[$placeHolder] = $value;
            }
            $valueStrArr[] = '('.implode(',',$holderArr).')';
        }
        return array($valueStrArr,$params);
    }
}
