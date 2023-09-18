<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}
$temp = [];

$temp['method'] = $_POST['method'];
$temp['id'] = $_POST['id'];
$temp['address'] = $_POST['address'];

$_SESSION['temp'] = $temp;

if($temp['address'] == null){
    echo "<script> {window.alert('請物留空！');location.href='../ship_and_location.php'} </script>";
}

?>

<script> var sure=confirm( '確認要更改嗎？');
    if (1==sure){

        location.href = 'edit_location_finish.php';
    }
    else {
        location.href = '../ship_and_location.php';
    }
</script>