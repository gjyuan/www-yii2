<?php
function smarty_function_widget($params, $template) {
    $className = isset($params['name']) ? $params['name'] : "";
    if (empty($className) || !class_exists($className)) {
        throw new Exception('smarty widget has no class name');
    }
    $widget = new $className();
    $varObj = $template->tpl_vars;
    foreach ($varObj as $name => $obj) {
        if(property_exists($widget,$name)){
            $widget->$name = $obj->value;
        }
    }
    //调用Widget实例的run方法 子类可以复写改方法来实现特定于自己的功能
    $widget->run();
}
