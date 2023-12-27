<?
session_start();
unset($_SESSION['authorized']);

header("location:admin.php");
exit();
?>