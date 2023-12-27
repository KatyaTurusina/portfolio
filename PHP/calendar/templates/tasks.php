<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <?php include 'templates/header.php' ?>
  <h3 class="heading">Список задач</h3>
  <div class="container_tasks">
    <div class="filter">
      <form method="get">
        <select name="display_tasks">
          <option></option>
          <option value="current" <?= $_GET['display_tasks'] === 'current' ? 'selected' : '' ?>>Текущие задачи</option>
          <option value="overdue" <?= $_GET['display_tasks'] === 'overdue' ? 'selected' : '' ?>>Просроченные задачи</option>
          <option value="completed" <?= $_GET['display_tasks'] === 'completed' ? 'selected' : '' ?>>Выполненые задачи</option>
        </select>
        <input type="date" name="date" value="<?= $_GET['date'] ?? '' ?>">
        <input type="submit" value="Показать">
      <form>
      <div class="div_filter">
        <a class="a_filter" href="?display_tasks=now">Сегодня</a>
        <a class="a_filter" href="?display_tasks=tomorrow">Завтра</a>
        <a class="a_filter" href="?display_tasks=this_week">Текущая неделя</a>
        <a class="a_filter" href="?display_tasks=next_week">Следущая неделя</a>
      </div>
    </div>
    <div class="table_tasks">
      <div class="row_tasks row_head">
        <div class="cell_tasks">Тип</div>
        <div class="cell_tasks">Задача</div>
        <div class="cell_tasks">Место</div>
        <div class="cell_tasks">Дата и время</div>
      </div>
      <?= $table ?>
    </div>
  </div>
</body>

</html>