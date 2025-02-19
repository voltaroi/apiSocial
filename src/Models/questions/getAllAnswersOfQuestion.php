<?php

require_once __DIR__ . '/../../db.php';

function getAllAnswersOfQuestion($id){
    global $db;

    $getAllAnswersOfThisQuestion = $db->prepare('SELECT id, id_author, pseudo_author, id_question, content FROM answers WHERE id_question = ? ORDER BY id DESC');
    $getAllAnswersOfThisQuestion->execute(array($id));
    
    $answers = [];
    
    while($answer = $getAllAnswersOfThisQuestion->fetch()){
        $id_answer = $answer['id'];
    
        $getAllLikeOfAnswersOfThisQuestion = $db->prepare('SELECT COUNT(*) AS like_count FROM tolike WHERE id_answert = ?');
        $getAllLikeOfAnswersOfThisQuestion->execute(array($id_answer));
        $likeData = $getAllLikeOfAnswersOfThisQuestion->fetch();
    
        $answers[] = [
            'id' => $id_answer,
            'id_author' => $answer['id_author'],
            'pseudo_author' => $answer['pseudo_author'],
            'id_question' => $answer['id_question'],
            'content' => $answer['content'],
            'like_count' => $likeData['like_count']
        ];
    }
    return $answers;
}