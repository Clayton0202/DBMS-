<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../mysql_connect.inc.php");

$name = $_POST['name'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "SELECT * FROM user where U_Account = '$id'";
$result = mysqli_query($conn,$sql);
$row = @mysqli_fetch_row($result);

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($id != null && $pw != null && $pw2 != null && $pw == $pw2 && $email != null && $phone != null && $address != null)
{
 //新增資料進資料庫語法
	if($row == null){
		$sql = "INSERT INTO user (U_Name, U_Address, U_Phone, U_Account, U_Password, U_Email) VALUES ('$name', '$address', '$phone', '$id', '$pw', '$email')";
		if(mysqli_query($conn,$sql))
		{
			echo "<script> {window.alert('新增成功!');location.href='user_login.php'} </script>";
		}
		else
		{
			echo "<script> {window.alert('新增失敗!');location.href='user_register.php'} </script>";
		}
	}
	else{
		echo "<script> {window.alert('ID已存在!');location.href='user_register.php'} </script>";
	}
	
}
else
{
	echo "<script> {window.alert('您有資料未填 或 密碼輸入錯誤!');location.href='user_register.php'} </script>";
}
?>
