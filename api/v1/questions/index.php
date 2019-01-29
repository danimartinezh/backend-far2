<?php
include_once('../../../config/config.inc.php'); //cargando archivo de configuracion
$sM = load_model('server');

header('Content-Type: application/json;charset=utf-8');
$data = array();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    $rgq = $sM->getQuestions();
    if($rgq){
        while($frgq = $rgq->fetch_assoc()){
            echo json_encode($frgq);
        }
    }else{
        echo 'Error';
    }
}else if($_SERVER['REQUEST_METHOD'] === "POST"){//add
    if(isset($_REQUEST['id']) && isset($_REQUEST['sText'])){
        $sM->addQuestion($_REQUEST['id'], $_REQUEST['sText']);
    }
}else if($_SERVER['REQUEST_METHOD'] === "PUT"){
    if(isset($_REQUEST['id']) && isset($_REQUEST['sText'])){

    }
}else if($_SERVER['REQUEST_METHOD'] === "DELETE"){

}

?>