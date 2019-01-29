<?php

function date_to_mysql($date=false) { //dd-mm-YYYY => YYYY-mm-dd
    if (!$date) return '';
        else {
            $date = str_replace('/', '-', $date);
            return date("Y-m-d",strtotime($date));
        }
}

function mysql_to_date($date=false, $separador="-") { //YYYY-mm-dd => dd-mm-YYYY
    if (!$date) return false;
    else if ($date == '0000-00-00') return '';
        else return date("d".$separador."m".$separador."Y",strtotime($date));
}

function load_model($model){
    include_once(DOCUMENT_ROOT.'/model/'.$model.'.model.php');
    $class_name = $model.'Model';
    return new $class_name;
}

function generate_password($random_string_length) {
    
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $string = '';
    
    for ($i = 0; $i < $random_string_length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $string;
}

?>