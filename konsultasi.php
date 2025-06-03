<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
// Jika sudah login, arahkan ke email:
header("Location: https://mail.google.com/mail/?view=cm&fs=1&to=admin@gmail.com");
exit;
?>
