<?php
class Request
{
  public $theme;
  public $type_id;
  public $location;
  public $datetime;
  public $hours_dur;
  public $comment;
  public $status;
  public $id;

  protected $errors = [];

  protected static $name_user_db = 'root';
  protected static $pass_db = '123';
  protected static $name_db = 'calendar';

  public function __construct(array $post = [])
  {
    $this->validate();
    if (empty($this->errors)) {
      $this->theme = test_input($post['theme']);
      $this->type_id = $post['type'] + 1;
      $this->location = test_input($post['location']);
      $this->datetime = $post['datetime'];
      $this->hours_dur = $post['hours_dur'];
      $this->comment = test_input($post['comment']);
      $this->status = $post['status'] == '1' ? 1 : 0;
      $this->id = $post['id'] ?? '';
    }
  }

  public function validate()
  {
    foreach (['theme', 'datetime'] as $item) {
      if (is_error($item)) {
        $item_error = $item . '_error';
        $this->errors[$item_error] = is_error($item);
      }
    }
  }

  public function save()
  {
    try {
      $conn = new PDO('mysql:host=localhost;dbname=' . Request::$name_db, Request::$name_user_db, Request::$pass_db);
      $conn->exec('SET NAMES "utf8";');
      $query = 'INSERT INTO `tasks` (`theme`, `type_id`, `location`, `datetime`, `hours_dur`, `comment`, `status`) 
                VALUES (:theme, :type_id, :location, :datetime, :hours_dur, :comment, :status);';
      $sql = $conn->prepare($query);
      $sql->bindValue(':theme', $this->theme);
      $sql->bindValue(':type_id', $this->type_id);
      $sql->bindValue(':location', $this->location);
      $sql->bindValue(':datetime', $this->datetime);
      $sql->bindValue(':hours_dur', $this->hours_dur);
      $sql->bindValue(':comment', $this->comment);
      $sql->bindValue(':status', $this->status);
      $sql->execute();
      $conn = null;
    } catch (PDOException $e) {
      echo 'Database error: ' . $e->getMessage();
    }
  }

  public function update()
  {
    try {
      $conn = new PDO('mysql:host=localhost;dbname=' . Request::$name_db, Request::$name_user_db, Request::$pass_db);
      $conn->exec('SET NAMES "utf8";');
      $query = 'UPDATE `tasks` SET 
                `theme` = :theme, `type_id` = :type_id, 
                `location` = :location, `datetime` = :datetime, 
                `hours_dur` = :hours_dur, `comment` = :comment, `status` = :status
                WHERE `id` = :id';
      $sql = $conn->prepare($query);
      $sql->bindValue(':theme', $this->theme);
      $sql->bindValue(':type_id', $this->type_id);
      $sql->bindValue(':location', $this->location);
      $sql->bindValue(':datetime', $this->datetime);
      $sql->bindValue(':hours_dur', $this->hours_dur);
      $sql->bindValue(':comment', $this->comment);
      $sql->bindValue(':status', $this->status);
      $sql->bindValue(':id', $this->id);
      $sql->execute();
      $conn = null;
    } catch (PDOException $e) {
      echo 'Database error: ' . $e->getMessage();
    }
  }

  public function delete()
  {
    try {
      $conn = new PDO('mysql:host=localhost;dbname=' . Request::$name_db, Request::$name_user_db, Request::$pass_db);
      $conn->exec('SET NAMES "utf8";');
      $query = 'DELETE FROM `tasks`WHERE `id` = :id';
      $sql = $conn->prepare($query);
      $sql->execute([':id' => $this->id]);
      $conn = null;
    } catch (PDOException $e) {
      echo 'Database error: ' . $e->getMessage();
    }
  }

  public static function read()
  {
    try {
      $conn = new PDO('mysql:host=localhost;dbname=' . Request::$name_db, Request::$name_user_db, Request::$pass_db);
      $conn->exec('SET NAMES "utf8";');
      $query = 'SELECT `id`, 
                        (SELECT `name` FROM `types` t WHERE t.id = tasks.type_id) AS type,
                        `theme`, `location`, `datetime` 
                        FROM `tasks`';
      $dispaly_tasks = test_input($_GET['display_tasks'] ?? '');
      switch ($dispaly_tasks) {
        case 'current':
          $query .= ' WHERE `status` = 0 AND DATE_ADD(`datetime`, INTERVAL `hours_dur` HOUR) >= NOW()';
          break;
        case 'overdue':
          $query .= ' WHERE `status` = 0 AND DATE_ADD(`datetime`, INTERVAL `hours_dur` HOUR) < NOW()';
          break;
        case 'completed':
          $query .= ' WHERE `status` = 1';
          break;
        case 'now':
          $query .= ' WHERE `status` = 0 AND DATE_FORMAT(`datetime`, "%Y-%m-%d") = CURDATE() 
                      AND DATE_ADD(`datetime`, INTERVAL `hours_dur` HOUR) >= NOW()';
          break;
        case 'tomorrow':
          $query .= ' WHERE `status` = 0 AND DATE_FORMAT(`datetime`, "%Y-%m-%d") = DATE_ADD(CURDATE(), INTERVAL 1 DAY)';
          break;
        case 'this_week':
          $query .= ' WHERE `status` = 0 AND YEAR(`datetime`) = YEAR(CURDATE())
                      AND WEEK(`datetime`, 1) = WEEK(CURDATE(), 1) AND DAYOFWEEK(`datetime`) >= DAYOFWEEK(CURDATE())
                      AND DATE_ADD(`datetime`, INTERVAL `hours_dur` HOUR) >= NOW()';
          break;
        case 'next_week':
          $query .= ' WHERE `status` = 0 AND YEAR(`datetime`) = YEAR(CURDATE())
                      AND WEEK(`datetime`, 1) = WEEK(CURDATE(), 1) + 1';
          break;
        default:
          $date = test_input($_GET['date'] ?? '');
          if ($date) {
            $query .= 'WHERE DATE_FORMAT(`datetime`, "%Y-%m-%d") = :date';
          } else{
            return;
          }
      }

      $date = test_input($_GET['date'] ?? '');
      if ($date) {
        $query .= ' AND DATE_FORMAT(`datetime`, "%Y-%m-%d") = :date';
      } 

      $query .= ' ORDER BY `datetime`';
      $sql = $conn->prepare($query);
      $sql->execute([':date' => $date]);
      $table = '';
      while ($row = $sql->fetch()) {
        $table .= '<div class="row_tasks">';
        for ($i = 1; $i < count($row) / 2; $i++) {
          $table .= $i === 2 ? '<div class="cell_tasks"><a href="edit_task.php?id=' . $row['id'] . '">' . $row['theme'] . '</a></div>' : '<div class="cell_tasks">' . $row[$i] . '</div>';
        }
        $table .= '</div>';
      }
      $conn = null;
      return $table;
    } catch (PDOException $e) {
      echo 'Database error: ' . $e->getMessage();
    }
  }

  public static function get_task_by_id($id) {
    try {
      $conn = new PDO('mysql:host=localhost;dbname=' . Request::$name_db, Request::$name_user_db, Request::$pass_db);
      $conn->exec('SET NAMES "utf8";');
      $query = 'SELECT `id`, `theme`, `type_id` - 1 as type_id, `location`, DATE_FORMAT(`datetime`, "%Y-%m-%dT%H:%i") AS datetime, `hours_dur`, `comment`, `status`
                FROM `tasks` WHERE id = :id';
      $sql = $conn->prepare($query);
      $sql->execute([':id' => $id]);
      $res = $sql->fetch();
      $conn = null;
      return $res;
    } catch (PDOException $e) {
      echo 'Database error: ' . $e->getMessage();
    }
  }

  public static function get_types() {
    try {
      $conn = new PDO('mysql:host=localhost;dbname=' . Request::$name_db, Request::$name_user_db, Request::$pass_db);
      $conn->exec('SET NAMES "utf8";');
      $query = 'SELECT `name` FROM `types`';
      $res = $conn->query($query);
      $conn = null;
      return $res;
    } catch (PDOException $e) {
      echo 'Database error: ' . $e->getMessage();
    }
  }

  public function get_errors()
  {
    return $this->errors;
  }
}