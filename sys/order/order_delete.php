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

$_SESSION['temp0'] = $_POST['deleteoid'];

?>

<script> var sure=confirm( '確認要刪除此訂單嗎 ');
    if (1==sure){
        location.href = 'order_delete_finish.php';
    }
    else {
        location.href = 'order.php';
    }
</script>