<?php
require_once '../config/config.php';
require_once '../utils/Database.php';
require_once '../services/TaskService.php';

$database = new Database($host, $db, $user, $pass, $charset);