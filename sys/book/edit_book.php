<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}
$temp =[];

$temp['b_name'] = $_POST['b_name'];
$temp['b_author']= $_POST['b_author'];
$temp['b_edit'] = $_POST['b_edit'];
$temp['b_price'] = $_POST['b_price'];
$temp['b_inventory'] = $_POST['b_inventory'];
$temp['bid'] = $_POST['bid'];

$_SESSION['temp'] = $temp;

if($temp['b_name']== null || $temp['b_author'] == null || $temp['b_edit'] == null || $temp['b_price'] == null){
    echo "<script> {window.alert('書名、作者、版本、價格請物留空，並請先選取書本進行編輯！');location.href='book.php'} </script>";
}

?>

<script> var sure=confirm( '確認要更改這本書的資訊嗎 ');
    if (1==sure){
        location.href = 'edit_book_finish.php';
    }
    else {
        location.href = 'book.php';
    }
</script>