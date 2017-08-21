<?php
function smarty_function_fe($params, &$smarty){
    foreach ($params as $key => $value) {
        switch ($key) {
            case "static": return Yii::$app->fe->feroot($value);
            case "image":
                $ret = Yii::$app->fe->imgroot($value);
                if (isset($params["size"])) {
                    $ret .= "." . $params["size"];
                    if (isset($params["format"])) {
                        $ret .= "." . $params["format"];
                    } else {
                        $ret .= substr($value, strrpos($value, '.'));
                    }
                }
                return $ret;
        }
    }
    Yii::warning("smarty template error", $smarty);
}
