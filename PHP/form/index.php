<?php
session_start();
$ips = 'ip.txt';
$sessions = 'sessions.txt';
$hits = 'hits.txt';

#сохранение пользователей с уникальными ip
if(!isset($_SESSION['ip']))
{
  $ip = getenv('REMOTE_ADDR');
  $_SESSION['ip'] = $ip;
  file_put_contents($ips, $ip . "\n", FILE_APPEND);
}

#сохранение всех сессий
if(!isset($_SESSION['visit']))
{
  $visit = session_id();
  $_SESSION['visit'] = $visit;
  file_put_contents($sessions, $visit . "\n", FILE_APPEND);
}

if ($_POST)
{

  $data = [
    'username' => '',
    'lastname' => '',
    'email' => '',
    'phone' => '',
    'direction' => '',
    'payment' => '',
    'mailing' => ''
  ];
  
  $errors = [];

  foreach (array_slice($data, 0, 6) as $key => $value)
  {
    if (!empty($_POST[$key]))
    {
      $data[$key] = strip_tags($_POST[$key]);
    }
    else
    {
      $errors[$key] = '* заполните поле';
    }
  }
  
  if ($errors)
  {
    include 'form.php';
  }
  else
  {
		$fileName='allData.txt';

    if(is_file($fileName))
    {
      if(isset($_POST['mailing']))
      {
        $agree='Да'; 
      }
      else
      {
        $agree='Нет'; 
      }

      $sep = '||';
      foreach ($data as $key => $value)
      {
        $data[$key] = str_replace('||', '', $value);
      }
      
      file_put_contents($fileName, uniqid()
          . $sep . $data['username']
          . $sep . $data['lastname']
          . $sep . $data['email']
          . $sep . $data['phone']
          . $sep . $data['direction']
          . $sep . $data['payment']
          . $sep . $agree
          . $sep . date('d.m.Y')
          . $sep . date('H:i:s')
          . $sep . getenv('REMOTE_ADDR')
          . $sep . 'Доступна' . "\n", FILE_APPEND);

      echo 'Заявка принята!<br>';
      include 'pattern.php';

    }
    else
    {
      echo 'Error';
    }
    #cохранение сессий, во время которых произошла отправка формы
    if(!isset($_SESSION['hit']))
    {
      $hit = session_id();
      $_SESSION['hit'] = $hit;
      file_put_contents($hits, $hit . "\n", FILE_APPEND);
    }
  } 
}
else
{
  include 'form.php';
}
$count = [
  'Uniq Ip' => count(array_unique(file($ips))),
  'All sessions' => count(file($sessions)),
  'Hits' => count(file($hits))
];
echo '<br>';
echo '<br>';
print_r($count);

?>