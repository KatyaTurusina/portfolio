<?php
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['id'])) {
    $id = test_input($_GET['id']);
    $task = Request::get_task_by_id($id);
    $title = 'Изменение задачи';
    $types = Request::get_types();
    $arr_hours_dur = get_hours_dur();
    $data = compact('title', 'types', 'arr_hours_dur') + $task;
    render('edit_task', $data);
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $task = new Request($_POST);

  if ($_POST['submit'] === 'Изменить') {
    if (empty($task->get_errors())) {
      $task->update();
      header('location: tasks.php');
    } else {
      $title = 'Изменение задачи';
      $types = Request::get_types();
      $arr_hours_dur = get_hours_dur();
      $data = compact('title', 'types', 'arr_hours_dur') + $task->get_errors();
      render('edit_task', $data);
    }
  } else {
    $task->delete();
    header('location: tasks.php');
  }
}
