<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../config/config.php';
require_once '../utils/Database.php';
require_once '../controllers/TaskController.php';

$database        = new Database($host, $db, $user, $pass, $charset);
$task_controller = new TaskController($database->get_pdo());

$base_path      = '/do-it-now/backend/public';
$request_method = $_SERVER['REQUEST_METHOD'];
$request_path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($request_path === $base_path . "/tasks") {
  switch ($request_method) {
    case 'GET':
      echo $task_controller->get_all_tasks();
      break;
    case 'POST':
      $json = json_decode(file_get_contents('php://input'));
      $task = $json->task;
      echo $task_controller->add_task($task);
      break;
    case 'OPTIONS':
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
      header("Access-Control-Allow-Headers: Content-Type");
      http_response_code(200);
      break;
    default:
      http_response_code(405);
      echo json_encode(['error' => 'Method not allowed']);
      break;
  }
}

if (preg_match("#^{$base_path}/tasks/(\d+)$#", $request_path, $matches)) {
  $id = $matches[1];
  switch ($request_method) {
    case 'GET':
      echo $task_controller->get_task($id);
      break;
    case 'PUT':
      $json = json_decode(file_get_contents('php://input'));
      $task = $json->task;
      echo $task_controller->update_task($id, $task);
      break;
    case 'DELETE':
      echo $task_controller->delete_task($id);
      break;
    case 'OPTIONS':
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
      header("Access-Control-Allow-Headers: Content-Type");
      http_response_code(200);
      break;
    default:
      http_response_code(405);
      echo json_encode(['error' => 'Method not allowed']);
      break;
  }
}
