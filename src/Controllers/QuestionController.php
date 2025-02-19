<?php

require_once __DIR__ . '/../Models/questions/getAllQuestion.php';
require_once __DIR__ . '/../Models/questions/getQuestionContent.php';
require_once __DIR__ . '/../Models/questions/getMyQuestion.php';
require_once __DIR__ . '/../Models/questions/getAllAnswersOfQuestion.php';
require_once __DIR__ . '/../Models/questions/publishQuestion.php';
require_once __DIR__ . '/../Models/questions/publishAnswer.php';
require_once __DIR__ . '/../Models/questions/likeAnswer.php';
require_once __DIR__ . '/../Models/questions/editQuestion.php';
require_once __DIR__ . '/../Models/questions/deleteQuestion.php';
require_once __DIR__ . '/../Models/questions/getInfoOfEditedQuestion.php';

class QuestionController {
    public function getAllQuestions($search = null) {
        return getAllQuestions($search);
    }

    public function getQuestionContent($id){
        return getQuestionContentById($id);
    }

    public function getMyQuestion($id){
        return getMyQuestion($id);
    }

    public function getAllAnswersOfQuestion($id){
        return getAllAnswersOfQuestion($id);
    }

    public function publishQuestion($title, $description, $content){
        return publishQuestion($title, $description, $content);
    }

    public function publishAnswer($question, $reponse){
        return publishAnswer($question, $reponse);
    }

    public function likeAnswer($answer_id){
        return likeAnswer($answer_id);
    }

    public function editQuestion($title, $description, $content, $idOfQuestion){
        return editQuestion($title, $description, $content, $idOfQuestion);
    }

    public function deleteQuestion($id){
        return deleteQuestion($id);
    }

    public function getInfoOfEditedQuestion($id){
        return getInfoOfEditedQuestion($id);
    }
}
