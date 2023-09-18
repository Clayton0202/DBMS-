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

$_SESSION['type']= $_POST['type'];
$_SESSION['descript']= $_POST['descript'];
$_SESSION['TOTAL']= $_POST['F_TOTAL'];
$_SESSION['id']= $_POST['fid'];

$type = $_SESSION['type'];
$descript = $_SESSION['descript'];
$TOTAL=$_SESSION['TOTAL'];


if($descript== null ||$type == null ||$TOTAL== null){
    echo "<script> {window.alert('請物留空！');location.href='financial.php'} </script>";
}



?>

<script> var sure=confirm( '確認要更改這筆帳務嗎 ');
    if (1==sure){

        location.href = 'edit_financial_finish.php';
    }
    else {
        location.href = 'financial.php';
    }
</script>