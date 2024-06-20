<?php
class Task 
{
  private $pdo;
  
  public function __construct($pdo) 
  {
    $this->pdo = $pdo;
  }

  public function get_last_inserted_id()
  {
    return $this->pdo->lastInsertId();
  }

  public function get_all_tasks() 
  {
    try 
    {
      $stmt = $this->pdo->query('SELECT * FROM tasks');
      return $stmt->fetchAll();
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
      $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = ?');
      $stmt->execute([$id]);
      return $stmt->fetch();
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
      $stmt = $this->pdo->prepare('INSERT INTO tasks (task) VALUES (?)');
      $stmt->execute([$task]);
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
      $stmt = $this->pdo->prepare('UPDATE tasks SET task = ? WHERE id = ?');
      $stmt->execute([$task, $id]);
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
      $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = ?');
      $stmt->execute([$id]);
    }
    catch (PDOException $e) 
    {
      return ['error' => $e->getMessage()];
    }
  }
}