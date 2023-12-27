<?php
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $task = new Request($_POST);
  if (empty($task->get_errors())) {
    $task->save();
    header('location: templates/successful_add.php');
  } else {
    $title = 'Новая задача';
    $types = Request::get_types();
    $durations = get_hours_dur();
    $data = compact('title', 'types', 'durations') + $task->get_errors();
    render('new_task', $data);
  }
}