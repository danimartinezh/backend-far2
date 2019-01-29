<?php

class serverModel extends Model {
    
    function __construct() {}

    function getAnswersType($id){
        $q = ' call spGetAnswersWithTypes('.$id.') ';
        return $this->execute_query($q);
    }

    function addAnswersType($id, $idA, $cookie, $result){
        $q = ' call spSubmitFormAnswers('.$id.','.$idA.','.$result.','.$cookie.') ';
        return $this->execute_query($q);
    }

    function getQuestions(){
        $q = ' SELECT q.iIdQuestion, q.sText as "sQuestion", a.* FROM tblQuestion AS q LEFT JOIN tblAnswer AS a ON q.iIdQuestion = a.iIdQuestion ORDER BY q.iOrder ';
        return $this->execute_query($q);
    }

    function addQuestion($id, $text){
        $q = ' INSERT INTO tblQuestion SET iIdQuestion="'.$id.'", stext="'.$text.'" ';
        return $this->execute_query($q);
    }

}
?>