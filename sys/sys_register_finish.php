<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../mysql_connect.inc.php");

$name = $_POST['name'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$sys = $_POST['sys'];

$sys_correct = 'oooo';

$sql = "SELECT * FROM sys_manager where SM_Account = '$id'";
$result = mysqli_query($conn,$sql);
$row = @mysqli_fetch_row($result);

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($id != null && $pw != null && $pw2 != null && $pw == $pw2 && $phone != null && $address != null && strcmp($sys,$sys_correct) == 0)
{
 //新增資料進資料庫語法
	if($row == null){
		$sql = "INSERT INTO sys_manager (SM_Name, SM_Address, SM_Phone, SM_Account, SM_Password) VALUES ('$name', '$address', '$phone', '$id', '$pw')";
		if(mysqli_query($conn,$sql))
		{
			echo "<script> {window.alert('新增成功!');location.href='sys_login.php'} </script>";
		}
		else
		{
			echo "<script> {window.alert('新增失敗!');location.href='sys_register.php'} </script>";
		}
	}
	else{
		echo "<script> {window.alert('ID已存在!');location.href='sys_register.php'} </script>";
	}
}
		
else
{
	echo "<script> {window.alert('您無權限註冊 或 資料未填及密碼有誤!');location.href='sys_register.php'} </script>";
}
?>
