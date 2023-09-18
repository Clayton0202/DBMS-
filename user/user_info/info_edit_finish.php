<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['username'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}
$temp = $_SESSION['temp'];
unset($_SESSION['temp']);

$id = $temp['id'];
$name = $temp['name'];
$address = $temp['address'];
$phone = $temp['phone'];
$account = $temp['account'];
$pw = $temp['pw'];
$email = $temp['email'];


$sql_change = "UPDATE user SET U_Name = '$name', U_Address = '$address', U_Phone = '$phone', U_Account = '$account', U_Password = '$pw', U_Email = '$email' WHERE U_ID = $id";
mysqli_query($conn,$sql_change);

echo "<script> {window.alert('更改成功！');location.href='info.php'} </script>";
?>
