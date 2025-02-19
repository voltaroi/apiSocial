<?php

require_once __DIR__ . '/../../db.php';

function getUserProfile($id){
    global $db;

    $idOfUser = $id;

    $checkIfUserExists = $db->prepare('SELECT pseudo, profile_pic FROM users WHERE id = ?');
    $checkIfUserExists->execute(array($idOfUser));

    if($checkIfUserExists->rowCount() > 0){

        $usersInfo = $checkIfUserExists->fetch();

        $user_pseudo = $usersInfo['pseudo'];

        $getHisQuestions = $db->prepare('SELECT * FROM questions WHERE id_author = ? ORDER BY id DESC');
        $getHisQuestions->execute(array($idOfUser));

        $getFollows = $db->prepare('SELECT * FROM follow WHERE id_followed = ?');
        $getFollows->execute(array($idOfUser));

        $numFollows = $getFollows->rowCount();

        $questions = [];
        while ($question = $getHisQuestions->fetch()) {
            $questions[] = [
                'id' => $question['id'],
                'title' => $question['title'],
                'content' => $question['content'],
                'date_publish' => $question['date_publish']
            ];
        }

        $userData['questions'] = $questions;
        $userData['num_followers'] = $numFollows;

        if(isset($_POST['toggleFollow'])){
            if(isset($_SESSION['id'])){
                $idFollower = $_SESSION['id']; 
                $idFollowed = $_POST['id_followed'];

                if($idFollower != $idFollowed){
                    $checkFollow = $db->prepare('SELECT * FROM follow WHERE id_follower = ? AND id_followed = ?');
                    $checkFollow->execute(array($idFollower, $idFollowed));
            
                    if($checkFollow->rowCount() > 0){
                        $unfollow = $db->prepare('DELETE FROM follow WHERE id_follower = ? AND id_followed = ?');
                        $unfollow->execute(array($idFollower, $idFollowed));
                    } else {
                        $follow = $db->prepare('INSERT INTO follow (id_follower, id_followed) VALUES (?, ?)');
                        $follow->execute(array($idFollower, $idFollowed));
                    }
            
                    exit();
                }
            } else {
                return "400";
            }
        }
        return $userData;

    } else {
        return "404";
    }

}