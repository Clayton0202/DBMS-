<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}

$delete_id= $_SESSION['temp'];
unset($_SESSION['temp']);


$sql_delete = "DELETE FROM financial WHERE F_ID = $delete_id ";

mysqli_query($conn,$sql_delete);

echo "<script> {window.alert('刪除成功！');location.href='financial.php'} </script>";
?>
