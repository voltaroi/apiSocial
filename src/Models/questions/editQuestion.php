<?php

require_once __DIR__ . '/../../db.php';

function editQuestion($title, $description, $content, $idOfQuestion){
    global $db;

    if(!empty($title) && !empty($description) && !empty($content)){

        $new_question_title = htmlspecialchars($title);
        $new_question_description = nl2br(htmlspecialchars($description));
        $new_question_content = nl2br(htmlspecialchars($content));

        $editQuestionOnWebsite = $db->prepare('UPDATE questions SET title = ?, description = ?, content = ? WHERE id = ?');
        $editQuestionOnWebsite->execute(array($new_question_title, $new_question_description, $new_question_content, $idOfQuestion));        

        return "Success";

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}