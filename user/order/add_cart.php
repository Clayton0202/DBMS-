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
$num = $_POST['num'];

if(isset($_SESSION["cart"])){ //判斷是否有 cart
    $cart=$_SESSION["cart"];
}
else{
    $cart=[];
}

if (array_key_exists($b_id, $cart)) {
    $cart[$b_id]=$cart[$b_id]+$num;
}
else{
    $cart[$b_id]=$num;
}

$_SESSION["cart"]=$cart;
echo "<script> {window.alert('加入成功!');location.href='../user_page.php'} </script>";

?>