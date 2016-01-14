<?php
header('Content-Type: text/html;charset=utf-8');
/**
 * 把商品错误信息分装成一个自定义函数
 * @param $model
 * @return string
 */
function show_model_error($model)
{
    //得到model中的错误信息
    $errors = $model->getError();
    $errorMsg = '<ul>';
    if (is_array($errors)) {
        //如果是数组将错误信息拼成一个ul
        foreach ($errors as $error) {
            $errorMsg .= "<li>{$error}</li>";
        }
    } else {
        $errorMsg .= "<li>{$errors}</li>";
    }
    $errorMsg .= '</ul>';
    return $errorMsg;
}


//做系统兼容性出来.
if(!function_exists('array_column')){
    function array_column($rows,$field){
        $value =array();
        foreach($rows as $row){
            $value[] = $row[$field];
        }
        return $value;
    }
}