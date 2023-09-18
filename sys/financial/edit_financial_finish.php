<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}

$type = $_SESSION['type'];
$descript = $_SESSION['descript'];
$TOTAL=$_SESSION['TOTAL'];
$id = $_SESSION['id'];

unset($_SESSION['descript']); 
unset($_SESSION['type']);
unset($_SESSION['TOTAL']);
unset($_SESSION['id']);


$sql_change = "UPDATE financial SET F_changeDATE = now(), F_Type = '$type', F_Descript = '$descript', F_Total = $TOTAL WHERE F_ID =$id";

if(mysqli_query($conn,$sql_change)){
    echo "<script> {window.alert('更改成功！');location.href='financial.php'} </script>";
}
else{
    echo "<script> {window.alert('更改失敗！');location.href='financial.php'} </script>";
}



?>
