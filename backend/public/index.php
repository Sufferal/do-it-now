<?php
require_once '../utils/Database.php';
require_once '../config/config.php';

$database = new Database($host, $db, $user, $pass, $charset);
$database->create_tasks_table();
