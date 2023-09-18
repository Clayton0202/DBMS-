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

$delete_id = $temp;

$sql_check = "SET foreign_key_checks = 0";
$sql_delete = "DELETE FROM shipping_method WHERE S_ID = $delete_id ";
$sql_check_back = "SET foreign_key_checks = 1";

mysqli_query($conn,$sql_check); 
mysqli_query($conn,$sql_delete);
mysqli_query($conn,$sql_check_back);

echo "<script> {window.alert('刪除成功！');location.href='../ship_and_location.php'} </script>";
?>
