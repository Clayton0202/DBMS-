<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['username'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}
$temp = [];

$temp['id']  = $_SESSION['username'];
$temp['name'] = $_POST['name'];
$temp['address'] = $_POST['address'];
$temp['phone'] = $_POST['phone'];
$temp['account'] = $_POST['account'];
$temp['pw'] = $_POST['pw'];
$temp['pw2'] = $_POST['pw2'];
$temp['email'] = $_POST['email'];

$_SESSION['temp'] = $temp;

if($temp['name'] == null || $temp['address'] ==  null || $temp['phone'] ==  null || $temp['account'] ==  null || $temp['pw'] ==  null || $temp['pw2'] ==  null || $temp['email']==  null){
    echo "<script> {window.alert('請物留空！');location.href='info.php'} </script>";
}
else if($temp['pw']!= $temp['pw']){
    echo "<script> {window.alert('請確認密碼輸入是否正確！');location.href='info.php'} </script>";
}

?>

<script> var sure=confirm( '確認要更改嗎？');
    if (1==sure){
        location.href = 'info_edit_finish.php';
    }
    else {
        location.href = 'info.php';
    }
</script>