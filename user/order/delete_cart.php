<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['username'] == null)
{
	echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}

$b_id = $_POST['b_id'];
$cart=$_SESSION["cart"];


unset($cart[$b_id]);
$_SESSION["cart"] = $cart;

echo "<script> {window.alert('移除成功!');location.href='cart.php'} </script>";

?>