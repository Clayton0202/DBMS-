<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$_SESSION['username'] = null;
$_SESSION['name'] = null;
$_SESSION['cart'] = null;
echo "<script> {window.alert('登出成功!');location.href='../bookstore.php'} </script>";
?>