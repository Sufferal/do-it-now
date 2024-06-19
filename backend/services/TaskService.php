<?php
require_once '../models/Task.php';

class TaskService 
{
  private $taskModel;
  
  public function __construct($pdo) 
  {
    $this->taskModel = new Task($pdo);
  }

  public function get_all_tasks() 
  {
    return $this->taskModel->get_all_tasks();
  }

  public function get_task($id) 
  {
    return $this->taskModel->get_task($id);
  }

  public function add_task($task) 
  {
    $this->taskModel->add_task($task);
  }

  public function update_task($id, $task) 
  {
    $this->taskModel->update_task($id, $task);
  }

  public function delete_task($id) 
  {
    $this->taskModel->delete_task($id);
  }
}