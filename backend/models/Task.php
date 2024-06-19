<?php
class Task 
{
  private $pdo;
  
  public function __construct($pdo) 
  {
    $this->pdo = $pdo;
  }

  public function get_all_tasks() 
  {
    $stmt = $this->pdo->query('SELECT * FROM tasks');
    return $stmt->fetchAll();
  }

  public function get_task($id) 
  {
    $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  public function add_task($task) 
  {
    $stmt = $this->pdo->prepare('INSERT INTO tasks (task) VALUES (?)');
    $stmt->execute([$task]);
  }

  public function update_task($id, $task) 
  {
    $stmt = $this->pdo->prepare('UPDATE tasks SET task = ? WHERE id = ?');
    $stmt->execute([$task, $id]);
  }

  public function delete_task($id) 
  {
    $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->execute([$id]);
  }
}