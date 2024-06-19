<?php
require_once '../services/TaskService.php';

class TaskController
{
  private $taskService;

  public function __construct($pdo)
  {
    $this->taskService = new TaskService($pdo);
  }

  public function get_all_tasks()
  {
    try 
    {
      $tasks = $this->taskService->get_all_tasks();
      return json_encode($tasks);
    }
    catch (PDOException $e) 
    {
      return json_encode(['error' => $e->getMessage()]);
    }
  }

  public function get_task($id)
  {
    try 
    {
      $task = $this->taskService->get_task($id);
      return json_encode($task);
    }
    catch (PDOException $e) 
    {
      return json_encode(['error' => $e->getMessage()]);
    }
  }

  public function add_task($task)
  {
    try 
    {
      $result = $this->taskService->add_task($task);
      return json_encode($result);
    } 
    catch (PDOException $e) 
    {
      return json_encode(['error' => $e->getMessage()]);
    }
  }

  public function update_task($id, $task)
  {
    try 
    {
      $result = $this->taskService->update_task($id, $task);
      return json_encode($result);
    } 
    catch (PDOException $e) 
    {
      return json_encode(['error' => $e->getMessage()]);
    }
  }

  public function delete_task($id)
  {
    try 
    {
      $result = $this->taskService->delete_task($id);
      return json_encode($result);
    } 
    catch (PDOException $e) 
    {
      return json_encode(['error' => $e->getMessage()]);
    }
  }
}
