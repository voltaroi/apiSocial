<?php

require_once __DIR__ . '/../../db.php';

function getInfoOfEditedQuestion($id){
    global $db;

    if (!isset($_SESSION['id'])) {
        return "You are not connected";
    }

    $idOfQuestion = $id;

    $checkIfQuestionExist = $db->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExist->execute(array($idOfQuestion));

    if($checkIfQuestionExist->rowCount() > 0){

        $questionInfos = $checkIfQuestionExist->fetch();
        if($questionInfos['id_author'] == $_SESSION['id']){

            $question_title = $questionInfos['title'];
            $question_description = $questionInfos['description'];
            $question_content = $questionInfos['content'];
            $question_date = $questionInfos['date_publish'];

            $question_description = str_replace('<br />', '', $question_description);
            $question_content = str_replace('<br />', '', $question_content);

            return $question_content;

        }else{
            return "404";
        }

    }else{
        return "404";
    }
}