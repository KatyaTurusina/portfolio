<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <?php include 'templates/header.php' ?>
  <h3 class="heading"><?= $title ?></h3>
  <div class="main_block">
    <form method="POST" action="edit_task.php">
      <div class="div_table">
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="theme">Тема:</label>
          </div>
          <div class="div_cell">
            <input type="text" name="theme" value="<?= $_POST['theme'] ?? $theme ?>">
            <span class="error"><?= $theme_error ?? '' ?></span>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="type">Тип:</label>
          </div>
          <div class="div_cell">
            <select name="type">
              <?php foreach ($types as $i => $type) { ?>
                <option value=<?= "$i" ?> <?= ($_POST['type'] ?? $type_id) === "$i" ? 'selected' : '' ?>><?= $type[0] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="location">Место:</label>
          </div>
          <div class="div_cell">
            <input type="text" name="location" value="<?= $_POST['location'] ?? $location ?>">
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="datetime">Дата и время:</label>
          </div>
          <div class="div_cell">
            <input name='datetime' type='datetime-local' value="<?= $_POST['datetime'] ?? $datetime ?>">
            <span class="error"><?= $datetime_error ?? '' ?></span>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="hours_dur">Длительность:</label>
          </div>
          <div class="div_cell">
            <select name="hours_dur">
              <?php foreach ($arr_hours_dur as $i => $h){ ?>
                <option value=<?= "$i" ?> <?= ($_POST['hours_dur'] ?? $hours_dur) === "$i" ? 'selected' : '' ?>><?= $i . $h ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="comment">Комментарий:</label>
          </div>
          <div class="div_cell">
            <textarea name="comment"><?= $_POST['comment'] ?? $comment ?></textarea>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="datetime">Выполнено:</label>
          </div>
          <div class="div_cell">
            <input name='status' type='checkbox' value="1" <?= $_POST['status'] ?? $status === '1' ? 'checked' : ''?>>
            <input name='id' type='hidden' value="<?= $_POST['id'] ?? $id ?>">
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell"></div>
          <div class="div_cell">
            <input type="submit" name="submit" value="Изменить">
            <input type="submit" name="submit" value="Удалить">
          </div>
        </div>
      </div>
    </form>
  </div>
  </div>
</body>
</html>