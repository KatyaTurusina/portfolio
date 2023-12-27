<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href='style.css'>

</head>

<body>
  <?php include 'templates/header.php' ?>
  <h3 class="heading"><?= $title ?></h3>
  <div class="main_block">
    <form method="POST" action="form.php">
      <div class="div_table">
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="theme">Тема:</label>
          </div>
          <div class="div_cell">
            <input type="text" name="theme" value="<?= $_POST['theme'] ?? '' ?>">
            <span class="error"><?= $theme_error ?? '' ?></span>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="type">Тип:</label>
          </div>
          <div class="div_cell">
            <select name="type">
              <?php foreach ($types as $id => $type) { ?>
                <option value=<?= "$id" ?> <?= $_POST['type'] === "$id" ? 'selected' : '' ?>><?= $type[0] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="location">Место:</label>
          </div>
          <div class="div_cell">
            <input type="text" name="location" value="<?= $_POST['location'] ?? '' ?>">
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="datetime">Дата и время:</label>
          </div>
          <div class="div_cell">
            <input name='datetime' type='datetime-local' value="<?= $_POST['datetime'] ?? '' ?>">
            <span class="error"><?= $datetime_error ?? '' ?></span>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="hours_dur">Длительность:</label>
          </div>
          <div class="div_cell">
            <select name="hours_dur">
              <?php foreach ($arr_hours_dur as $i => $h) { ?>
                <option value=<?= "$i" ?> <?= $_POST['hours_dur'] === "$i" ? 'selected' : '' ?>><?= $i . $h ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell" align="right">
            <label for="comment">Комментарий:</label>
          </div>
          <div class="div_cell">
            <textarea name="comment"><?= $_POST['comment'] ?? '' ?></textarea>
          </div>
        </div>
        <div class="div_row">
          <div class="div_cell"></div>
          <div class="div_cell">
            <input type="submit" value="Добавить">
          </div>
        </div>
      </div>
    </form>
  </div>
</body>
</html>