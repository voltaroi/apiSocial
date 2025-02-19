<?php

require_once __DIR__ . '/../../db.php';

function getAllQuestions($search = null) {
    global $db;

    if (!$db) {
        die(json_encode(['error' => 'Database connection not initialized']));
    }

    if ($search && !empty($search)) {
        $query = $db->prepare('SELECT id, title, description, pseudo_author, id_author, date_publish FROM questions WHERE title LIKE ? ORDER BY id DESC');
        $query->execute(["%$search%"]);
    } else {
        $query = $db->query('SELECT id, title, description, pseudo_author, id_author, date_publish FROM questions ORDER BY id DESC LIMIT 5');
    }

    return $query->fetchAll(PDO::FETCH_ASSOC);
}
