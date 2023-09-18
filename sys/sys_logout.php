<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$_SESSION['sysname'] = null;
$_SESSION['name'] = null;
echo "<script> {window.alert('登出成功!');location.href='../bookstore.php'} </script>";
?>