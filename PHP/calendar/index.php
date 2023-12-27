<?php
include 'init.php';
$title = 'Новая задача';
$types = Request::get_types();
$arr_hours_dur = get_hours_dur();
$data = compact('title', 'types', 'arr_hours_dur');
render('new_task', $data);