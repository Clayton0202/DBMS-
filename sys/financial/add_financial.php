<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}

$type = $_POST['type'];
$descrit = $_POST['descrit'];
$total = $_POST['total'];



$sql_add_financial = "INSERT INTO financial ( F_startDate, F_Type, F_Descript, F_Total) VALUES (now(), '$type', '$descrit', $total)";


//判斷是否為空值
if( $type!= null && $total != null && $descrit != null)
{
 //新增資料進資料庫語法
	if(mysqli_query($conn,$sql_add_financial))
	{
		echo "<script> {window.alert('新增成功!');location.href='financial.php'} </script>";
	}
	else
	{
		echo "<script> {window.alert('新增失敗!');location.href='financial.php'} </script>";
	}

	
}		
else
{
    echo "<script> {window.alert('資料未填!');location.href='financial.php'} </script>";
}
?> 