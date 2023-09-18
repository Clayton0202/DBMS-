<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}
$temp = $_SESSION['temp'];
unset($_SESSION['temp']);

$uname = $temp['uname'] ;
$uaddress = $temp['uaddress'];
$uphone = $temp['uphone'];
$uaccount = $temp['uaccount'];
$upassword = $temp['upassword'] ;
$uemail = $temp['uemail'] ;
$ucoupon = $temp['ucoupon'];
$uvip = $temp['uvip'];
$uid = $temp['uid'];


$sql_change = "UPDATE user SET U_Name = '$uname', U_Address = '$uaddress', U_Phone = '$uphone', U_Account = '$uaccount', U_Password = '$upassword', U_Email = '$uemail' WHERE U_ID = $uid";
$sql_change_coupon = "UPDATE user SET U_Coupon = $ucoupon where U_ID = $uid";
$sql_change_vip = "UPDATE user SET U_Isvip = '$uvip' where U_ID = $uid";
$sql_delete_coupon = "UPDATE user SET U_Coupon = null where U_ID = $uid";
$sql_delete_vip = "UPDATE user SET U_Isvip = null where U_ID = $uid"; 

mysqli_query($conn,$sql_change); 
if ($ucoupon != null){
    mysqli_query($conn,$sql_change_coupon); 
}else{
    mysqli_query($conn,$sql_delete_coupon);
}
if ($uvip != null){
    mysqli_query($conn,$sql_change_vip); 
}else{
    mysqli_query($conn,$sql_delete_vip);
}

echo "<script> {window.alert('更改成功！');location.href='customer_manage.php'} </script>";
?>
