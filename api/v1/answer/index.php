<?php
include_once('../../../config/config.inc.php'); //cargando archivo de configuracion
$sM = load_model('server');

header('Content-Type: application/json;charset=utf-8');
$data = array();

/* GET */
if(isset($_GET['id'])){
    $rgat = $sM->getAnswersType($_GET['id']);
    if($rgat){
        while($frgat = $rgat->fetch_assoc()){
            echo json_encode($frgat);
        }
    }else{
        echo 'Error';
    }
}
/* GET */

/* POST */
if(isset($_POST['id']) && isset($_POST['idA']) && isset($_POST['cookie']) && isset($_POST['result'])){
    $raat = $sM->addAnswersType($_GET['id']);
    if($raat){
        echo 'Bien';
    }else{
        echo 'Error';
    }
}
/* POST */

?>