<?php

require_once __DIR__ . '/../../db.php';

function publishQuestion($title, $description, $content){
    global $db;

    if (!isset($_SESSION['id']) || !isset($_SESSION['pseudo'])) {
        return "You are not connected";
    }

    if(!empty($title) && !empty($description) && !empty($content)){

        $question_title = htmlspecialchars($title);
        $question_description = nl2br(htmlspecialchars($description));
        $question_content = nl2br(htmlspecialchars($content));
        $question_date = date('d/m/Y');

        $question_id_author = $_SESSION['id'];
        $question_pseudo_author = $_SESSION['pseudo'];

        $insterQuestionOnWebsite = $db->prepare('INSERT INTO questions(title, description, content, id_author, pseudo_author, date_publish)VALUES(?, ?, ?, ?, ?, ?)');
        $insterQuestionOnWebsite->execute(
            array(
                $question_title, 
                $question_description, 
                $question_content, 
                $question_id_author, 
                $question_pseudo_author, 
                $question_date
            )
        );

        return "200";

    }else{
        return "400";
    }
}