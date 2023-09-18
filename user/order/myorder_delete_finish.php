<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['username'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}
$temp = $_SESSION['temp'];
unset($_SESSION['temp']);
 
$delete_oid = $temp;

$sql_orderlist = "SELECT * FROM order_list where O_ID = $delete_oid";
$r_book = mysqli_query($conn, $sql_orderlist);
foreach($r_book as $row){
    $Inum = $row['O_Booknum'];
    $B_ID = $row['Book_ID'];
    $sql_inADD = "UPDATE inventory SET I_num = I_num + $Inum where Book_ID = $B_ID ";
    mysqli_query($conn, $sql_inADD);
}

$sql_check = "SET foreign_key_checks = 0";
$sql_delete = "DELETE FROM order_list WHERE O_ID = $delete_oid";
$sql_delete1 = "DELETE FROM order_ WHERE O_ID = $delete_oid";
$sql_check_back = "SET foreign_key_checks = 1";

$sql_money = "SELECT * FROM order_ where O_ID = $delete_oid";
$result = mysqli_query($conn,$sql_money);
$row1 = mysqli_fetch_assoc($result);
$money = $row1['O_Total'];
$sql_f = "INSERT INTO financial(F_startDate, F_Type, F_Descript, F_Total) values (now(), '支', '訂單退款', $money)";
mysqli_query($conn,$sql_f);



mysqli_query($conn,$sql_check); 
mysqli_query($conn,$sql_delete);
mysqli_query($conn,$sql_delete1);
mysqli_query($conn,$sql_check_back);

echo "<script> {window.alert('取消成功！');location.href='myorder.php'} </script>";
?>                                      