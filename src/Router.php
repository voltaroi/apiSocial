<?php

require_once __DIR__ . '/db.php';

class Router {
    public function handleRequest() {
        require_once 'Controllers/QuestionController.php';
        require_once 'Controllers/UserController.php';

        $action = $_GET['action'] ?? '';

        switch ($action) {
            //Question
            case 'getAllQuestions':
                $controller = new QuestionController();
                $search = $_GET['search'] ?? null;
                $response = $controller->getAllQuestions($search);   
                header('Content-Type: application/json');
                echo json_encode($response);  
                break;

            case 'getQuestionContent':
                $controller = new QuestionController();
                $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
                if ($id === null || $id <= 0) {
                    http_response_code(400);
                    echo json_encode(['error' => 'ID is required and must be a positive integer']);
                    exit;
                }
                $response = $controller->getQuestionContent($id);   
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'getMyQuestion':
                $controller = new QuestionController();
                $response = $controller->getMyQuestion($_GET['id']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;
            
            case 'getAllAnswersOfQuestion':
                $controller = new QuestionController();
                $response = $controller->getAllAnswersOfQuestion($_GET['id']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'publishQuestion':
                $controller = new QuestionController();
                $response = $controller->publishQuestion($_GET['title'], $_GET['description'], $_GET['content']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'publishAnswer':
                $controller = new QuestionController();
                $response = $controller->publishAnswer($_GET['question'], $_GET['reponse']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'likeAnswer':
                $controller = new QuestionController();
                $response = $controller->likeAnswer($_GET['answer_id']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'editQuestion':
                $controller = new QuestionController();
                $response = $controller->editQuestion($_GET['title'], $_GET['description'], $_GET['content'], $_GET['idOfQuestion']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'deleteQuestion':
                $controller = new QuestionController();
                $response = $controller->deleteQuestion($_GET['id']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'getInfoOfEditedQuestion':
                $controller = new QuestionController();
                $response = $controller->getInfoOfEditedQuestion($_GET['id']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            //User
            case 'login':
                $controller = new UserController();
                $response = $controller->login($_GET['pseudo'], $_GET['password']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'register':
                $controller = new UserController();
                $response = $controller->register($_GET['pseudo'], $_GET['password']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'logout':
                $controller = new UserController();
                $response = $controller->logout();
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'getUserProfile':
                $controller = new UserController();
                $response = $controller->getUserProfile($_GET['id']);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;

            case 'editProfile':
                $controller = new UserController();
                $response = $controller->editProfile();
                header('Content-Type: application/json');
                echo json_encode($response);
                break;
            
            default:
                http_response_code(404);
                echo json_encode(['error' => 'Route not found']);
                break;
        }
    }
}

$router = new Router();
$router->handleRequest();
