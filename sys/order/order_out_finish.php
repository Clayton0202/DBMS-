<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}
$temp = $_SESSION['tempo'];
unset($_SESSION['tempo']);
 
$delete_oid = $temp;

$query_O = "select O_isShip from order_ where O_ID = $delete_oid" ; 
$query_run_O = mysqli_query($conn,$query_O); 
$row = mysqli_fetch_assoc($query_run_O);


$sql_check = "SET foreign_key_checks = 0";
$sql_delete = "update order_ set O_isShip = 'Y' WHERE O_ID = $delete_oid";
$sql_delete1 = "update order_ set O_isShip = null WHERE O_ID = $delete_oid";
$sql_check_back = "SET foreign_key_checks = 1";

if ($row['O_isShip'] == "Y"){
    mysqli_query($conn,$sql_check); 
    mysqli_query($conn,$sql_delete1);
    mysqli_query($conn,$sql_check_back);
}else{
    mysqli_query($conn,$sql_check); 
    mysqli_query($conn,$sql_delete);
    mysqli_query($conn,$sql_check_back);
}

echo "<script> {window.alert('更改成功！');location.href='order.php'} </script>";
?>   