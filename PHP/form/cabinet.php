<?php
session_start();
if(time() - $_SESSION['timestamp'] > 300) {
    header('Location: logout.php'); 
    exit;
}

include 'pattern.php';
echo '<a class="exit" href="logout.php">Выйти</a>';
$fileName = 'allData.txt';
$allData = file($fileName);

$tableHeaders=
    [
    "УДАЛИТЬ",
    "ID",
    "Имя",
    "Фамилия",
    "Email",
    "Номер телефона",
    "Направление",
    "Способ оплаты",
    "Рассылка",
    "Дата",
    "Время",
    "IP-adress",
    "Статус заявки"
    ];

echo "<form method='POST'>";
echo '<table>';
echo '<caption>Заявки</caption>';
echo '<tr>';
foreach($tableHeaders as $header)
{
echo "<th> $header </th>";
}
echo '</tr>';

foreach ($allData as $key => $value)
{
echo "<tr><td><input type='checkbox' name='$key'";
if (isset($_POST[$key]))
{
    echo "hidden='false' checked='checked'> </td>";
    $allData[$key] = str_replace('Доступна', 'Удалена', $allData[$key]); 
}
else
{
    echo "></td>";
}

$availableApplications = $allData;

foreach ($availableApplications as $index => $dataStr)
{
    if (strpos($dataStr, 'Удалена') == true)
    {
    unset($availableApplications[$index]);
    file_put_contents('availableApplications.txt', $availableApplications);
    }
}


foreach (explode('||', $allData[$key]) as $dataCell)
{
    echo '<td>';
    echo $dataCell;
    echo '</td>';
}

echo '</tr>';
}

echo '</table>';

echo '<button type="submit" class="del">Удалить</button></form>';





