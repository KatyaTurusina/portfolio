<?php
include 'init.php';
$table = Request::read();
$title = 'Список задач';
$data = compact('title', 'table');
render('tasks', $data);
