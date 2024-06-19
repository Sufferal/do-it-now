<?php
require_once '../models/Task.php';

class TaskService 
{
  private $taskModel;
  
  public function __construct($pdo) 
  {
    $this->taskModel = new Task($pdo);
  }

  private function does_task_exist($id) 
  {
    return $this->taskModel->get_task($id) !== false;
  }

  public function get_all_tasks() 
  {
    try 
    {
      return $this->taskModel->get_all_tasks();
    }
    catch (PDOException $e) 
    {
      return ['error' => $e->getMessage()];
    } 
  }

  public function get_task($id) 
  {
    try 
    {
      if (!$this->does_task_exist($id))
      {
        return ['message' => 'No task with such id'];
      }
      return $this->taskModel->get_task($id);
    }
    catch (PDOException $e) 
    {
      return ['error' => $e->getMessage()];
    }
  }

  public function add_task($task) 
  {
    try 
    {
      $this->taskModel->add_task($task);
      return ['message' => 'Task added successfully'];
    } 
    catch (PDOException $e) 
    {
      return ['error' => $e->getMessage()];
    }
  }

  public function update_task($id, $task) 
  {
    try 
    {
      if (!$this->does_task_exist($id))
      {
        return ['message' => 'No task with such id'];
      }

      $this->taskModel->update_task($id, $task);
      return ['message' => 'Task updated successfully'];
    } 
    catch (PDOException $e) 
    {
      return ['error' => $e->getMessage()];
    }
  }

  public function delete_task($id) 
  {
    try 
    {
      if (!$this->does_task_exist($id))
      {
        return ['message' => 'No task with such id'];
      }

      $this->taskModel->delete_task($id);
      return ['message' => 'Task deleted successfully'];
    }
    catch (PDOException $e) 
    {
      return ['error' => $e->getMessage()];
    }
  }
}