<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}
$temp = $_SESSION['temp'];
unset($_SESSION['temp']);

$id = $temp['id'];
$method = $temp['method'];

$sql_change = "UPDATE shipping_method SET S_method = '$method' WHERE S_ID = $id";
mysqli_query($conn,$sql_change);

echo "<script> {window.alert('更改成功！');location.href='../ship_and_location.php'} </script>";
?>
