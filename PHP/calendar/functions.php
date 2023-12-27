<?php
function render($template, $data = []) {
  extract($data);
  if (is_file('templates/' . $template . '.php')) {
    include 'templates/' . $template . '.php';
  } else {
    echo 'Шаблон не найден';
  }
}

function is_error($data) {
  if (empty($_POST[$data])) {
    return '* Это обязательное поле!';
  }
}

function test_input($data) {
  $data = trim($data);
  $data = strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function get_hours_dur() {
  $hours_dur = [];
  for ($i = 1; $i <= 24; $i++) {
    $h = $i % 20 ===  1 ? ' час' : ($i % 21 < 5 ? ' часа' : ' часов');
    $hours_dur[$i] = $h;
  }
  return $hours_dur;
}