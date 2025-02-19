<?php

require_once __DIR__ . '/../../db.php';

function editProfile(){
    global $db;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profilePic'])) {
        global $db;
    
        if (!isset($_SESSION['id'])) {
            die(json_encode(["error" => "Vous devez être connecté."]));
        }
    
        $userId = $_SESSION['id'];
        $file = $_FILES['profilePic'];
    
        if ($file['error'] !== UPLOAD_ERR_OK) {
            die(json_encode(["error" => "Erreur lors de l'upload."]));
        }
    
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
        if (!in_array($fileExt, $allowedExtensions)) {
            die(json_encode(["error" => "Format non valide. (JPG, JPEG, PNG, GIF uniquement)"]));
        }
    
        $newFileName = "profile_" . $userId . "." . $fileExt;
        $uploadPath = __DIR__ . "/uploads/profile_pics/" . $newFileName;
    
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
    
            $updatePic = $db->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $updatePic->execute([$newFileName, $userId]);
    
            echo json_encode(["success" => "Image uploadée avec succès", "filename" => $newFileName]);
        } else {
            echo json_encode(["error" => "Erreur lors du déplacement du fichier."]);
        }
    } else {
        echo json_encode(["error" => "Aucun fichier reçu."]);
    }    
}