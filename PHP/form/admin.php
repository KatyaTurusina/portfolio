<?php
session_start();
include 'pattern.php';

$users = [
  'admin' => '12345'
];

if(empty($_SESSION['authorized'])) {
  echo '<div class="form">';
  echo '<p>Вы не вошли в систему!</p>';
  echo '<form method="POST">';
  echo 'Логин: <input type="text" name="login">';
  echo 'Пароль: <input type="text" name="password">';
  echo "<button type='submit'>Войти</button>";
  echo '</form>';
  echo '</div>';
  if($_POST) {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$login])) {
      if($users[$login] === $password) {
        $_SESSION['authorized'] = true;
        $_SESSION['username'] = $login;
        $_SESSION['timestamp'] = time();
        header("Location: cabinet.php");
        exit;
      }
    }
  }
  
}
else
{
  header("Location: cabinet.php");
  exit;
}
