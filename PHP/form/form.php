<?php include 'pattern.php' ?>

<div class="form">
<h1>Форма регистрации</h1>
<form method="POST" action="index.php">
  
  <label>Имя: <span><?= $errors['username'] ?? '' ?></span></label>
  <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
  

  <label>Фамилия: <span><?= $errors['lastname'] ?? '' ?></span></label>
  <input type="text" name="lastname" value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>">
  
  
  <label>Email: <span><?= $errors['email'] ?? '' ?></span></label>
  <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
 

  <label>Телефон: <span><?= $errors['phone'] ?? '' ?></span></label>
  <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
  

  <label>Направление:</label>
  <select name="direction" value="<?= htmlspecialchars($_POST['direction']) ?>">
    <option value="business">Бизнес</option>
    <option value="tecnologies">Технологии</option>
    <option value="advertising_and_marketing">Реклама и Маркетинг</option>
  </select>

  <label>Способ оплаты:</label>
  <select name="payment" value="<?= htmlspecialchars($_POST['payment']) ?>">
    <option value="webmoney">WebMoney</option>
    <option value="yandexmoney">Яндекс.Деньги</option>
    <option value="paypal">PayPal</option>
    <option value="credit_card">Кредитная карта</option>
  </select>

  <label>
  <input type="checkbox" name="mailing" <?php echo (isset($_POST['mailing'])?'checked="checked"':'') ?> />
  Получать рассылку о конференции
  </label>    
  <button type="submit" name="but">Отправить</button>
</form>
</div>