<?php

require_once __DIR__ . '/../../db.php';

function deleteQuestion($id){
    global $db;

    if (!isset($_SESSION['id'])) {
        return "You are not connected";
    }

    $idOfTheQuestion = $id;

    $checkIfQuestionExits = $db->prepare('SELECT id_author FROM questions WHERE id = ?');
    $checkIfQuestionExits->execute([$idOfTheQuestion]);

    if($checkIfQuestionExits->rowCount() > 0){
        $questionsInfo = $checkIfQuestionExits->fetch();
        if($questionsInfo['id_author'] == $_SESSION['id']){

            $deleteThisQuestion = $db->prepare('DELETE FROM questions WHERE id = ?');
            $deleteThisQuestion->execute([$idOfTheQuestion]);

            return "Success";

        }else{
            echo"Vous n'avez pas les autorisation";
        }
    }else{
        echo"Aucune question trouver";
    }
}