<?php
class Database
{
  private $pdo;

  public function __construct($host, $db, $user, $pass, $charset)
  {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $this->pdo = new PDO($dsn, $user, $pass, $opt);
    $this->create_tasks_table();
  }

  public function get_pdo()
  {
    try 
    {
      return $this->pdo;
    }
    catch (PDOException $e) 
    {
      return ['error' => $e->getMessage()];
    }
  }

  public function create_tasks_table()
  {
    $sql = "
    CREATE TABLE IF NOT EXISTS tasks (
      id INT AUTO_INCREMENT PRIMARY KEY,
      task VARCHAR(50) NOT NULL
    )
  ";

    try 
    {
      $this->pdo->exec($sql);
    } 
    catch (PDOException $e) 
    {
      echo $e->getMessage();
    }
  }
}
