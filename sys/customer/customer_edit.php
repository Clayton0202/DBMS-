<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}
$temp =[];

$temp['uname'] = $_POST['uname'];
$temp['uaddress'] = $_POST['uaddress'];
$temp['uphone'] = $_POST['uphone'];
$temp['uaccount'] = $_POST['uaccount'];
$temp['upassword'] = $_POST['upassword'];
$temp['uemail'] = $_POST['uemail'];
$temp['ucoupon'] = $_POST['ucoupon'];
$temp['uvip'] = $_POST['uvip'];
$temp['uid'] = $_POST['uid'];

$_SESSION['temp'] = $temp;

if($temp['uname'] == null || $temp['uaddress'] == null || $temp['uphone'] == null || $temp['uaccount'] == null || $temp['upassword'] == null || $temp['uemail'] == null ){
    echo "<script> {window.alert('資料請物留空！');location.href='customer_manage.php'} </script>";
}

?>

<script> var sure=confirm( '確認要更改顧客資訊嗎？');
    if (1==sure){
        location.href = 'customer_edit_finish.php';
    }
    else {
        location.href = 'customer_manage.php';
    }
</script>