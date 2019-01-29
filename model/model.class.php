<?php
/* DRIVER DE BASE DE DATOS */
//se carga desde 'config/config.inc.php'

class Model {
    private $host_bd = 'ec2-35-167-86-222.us-west-2.compute.amazonaws.com';
    private $name_bd = 'projecte_FAR';
    private $user_bd = 'far';
    private $pass_bd = 'FuckHacker2019';
    public $pre = '';

    private $link_bd = false;
    
    function conectar_bd() {
        $this->link_bd = new mysqli($this->host_bd, $this->user_bd, $this->pass_bd, $this->name_bd);
        return $this->link_bd;
    }
    
    function execute_query($query) {
        $this->conectar_bd();
        $this->link_bd->query("SET NAMES 'utf8'"); //correccion para que busque caracters especiales (acentos, ç, ...)
        return $this->link_bd->query($query);
    }
    // evita sql inject
    // controla la consula sql
    function escstr($str) {
        if (!$this->link_bd) $this->conectar_bd();
        //return mysql_real_escape_string($str, $this->link_bd);
        //hace unfiltro del campo recibido para comprobar que no es una inyeccion sql
        
        return $this->link_bd->real_escape_string($str);
    }
    
    function safe_show($v) {
        return htmlspecialchars(stripslashes($v));
    }
    
    function get_insert_id() {
        return $this->link_bd->insert_id;
    }
    
    function get_affected_rows() {
        return $this->link_bd->affected_rows;
    }
    
    function date_to_mysql_datetime($date='now', $is_fechafin=false) {
        
        if (strlen($date) < 1) return '';
        
        $pattern = '';
        $time_append = '';
        
        switch ($date) {
            case 'now':
                $pattern = 'Y-m-d';
                $date = date($pattern);
                
                if ($is_fechafin) $time_append .= ' 23:59:59';
                    else $time_append .= ' 00:00:00';
            break;
            case 'complete':
                $pattern = 'Y-m-d H:i:s';
                $date = date($pattern);
            break;
            default:
                $pattern = 'Y-m-d';
                if ($is_fechafin) $time_append .= ' 23:59:59';
                    else $time_append .= ' 00:00:00';
            break;
        }
        
        $date = str_replace('/', '-', $date);
        $date = date($pattern,strtotime($date));
        $date .= $time_append;
            
        return $date;
    }

    function arrayToString($arr, $delimitador=';'){
        $str = '';
        for ($i=0;$i<count($arr); $i++) {
            $str .= $arr[$i];
            $str .= ($i+1==count($arr)) ? '' : $delimitador;
        }
        return $str;
    }

    function stringToArray($str, $delimitador=';'){
        
    }
    
    function mysql_datetime_to_date($datetime) {
        $date = strtotime($datetime);
        return date('d/m/Y', $date);
    }
    
    function mysql_datetime_to_datetime($datetime) {
        $date = strtotime($datetime);
        return date('d/m/Y H:i:s', $date);
    }
    
    function get_formatted_price($precio) {
        return number_format((float)$precio, 2, ',', '');
    }
}
?>