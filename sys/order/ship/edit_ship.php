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

$_SESSION['temp'] = $temp;

if($temp['method']  == null){
    echo "<script> {window.alert('請物留空！');location.href='../ship_and_location.php'} </script>";
}

//$sql_change = "UPDATE shipping_method SET S_method = '$method' WHERE S_ID = $id";
?>

<script> var sure=confirm( '確認要更改嗎？');
    if (1==sure){
        <?php 
        //mysqli_query($conn,$sql_change); 
        ?>
        //alert( '更改成功'); 
        location.href = 'edit_ship_finish.php';
    }
    else {
        location.href = '../ship_and_location.php';
    }
</script>