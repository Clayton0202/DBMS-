<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
	echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}

$method = $_POST['method'];
$address = $_POST['address'];


$sql1 = "SELECT * FROM pickup_location left join shipping_method using(S_ID) where S_ID = '$method' and P_address = '$address'";
$find_exist = mysqli_query($conn,$sql1);
$row_exist = @mysqli_fetch_row($find_exist);


$sql_add = "INSERT INTO pickup_location (P_address,S_ID) VALUES ('$address',$method)";


//判斷是否為空值
if($method != null)
{
 //新增資料進資料庫語法
	if($row_exist == null){


		if(mysqli_query($conn,$sql_add))
		{
			echo "<script> {window.alert('新增成功!');location.href='../ship_and_location.php'} </script>";
		}
		else
		{
			echo "<script> {window.alert('新增失敗!');location.href='../ship_and_location.php'} </script>";
		}
	}
	else{
        echo "<script> {window.alert('已存在!');location.href='../ship_and_location.php'} </script>";
	}
	
}		
else
{
    echo "<script> {window.alert('資料未填!');location.href='../ship_and_location.php'} </script>";
}
?>
