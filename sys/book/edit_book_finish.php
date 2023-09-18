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

$b_name = $temp['b_name'];
$b_author = $temp['b_author'];
$b_edit = $temp['b_edit'] ;
$b_price = $temp['b_price'];
$b_inventory = $temp['b_inventory'];
$bid = $temp['bid'];


$sql_change = "UPDATE book SET Book_Name = '$b_name', Book_Arthor = '$b_author', Book_Edition = '$b_edit', Book_Price = $b_price WHERE Book_ID = $bid";
$sql_find = "SELECT Book_ID FROM inventory where Book_ID = $bid";
$find_book_exist = mysqli_query($conn,$sql_find);
$row_exist = @mysqli_fetch_row($find_book_exist);

$sql_add_inventory = "INSERT INTO inventory (I_num, Book_ID) VALUES ($b_inventory, $bid)";
$sql_change_inventory = "UPDATE inventory SET I_num = $b_inventory WHERE Book_ID = $bid";
$sql_delete = "DELETE FROM inventory WHERE Book_ID = $bid ";
$sql_check = "SET foreign_key_checks = 0";
$sql_check_back = "SET foreign_key_checks = 1";  

mysqli_query($conn,$sql_change);
        
if($row_exist == null && $b_inventory != null){
    mysqli_query($conn,$sql_add_inventory);
}
else if($row_exist != null && $b_inventory != null){
    mysqli_query($conn,$sql_change_inventory);
}
else if($b_inventory == null){
    mysqli_query($conn,$sql_check); 
    mysqli_query($conn,$sql_delete);
    mysqli_query($conn,$sql_check_back);
}

echo "<script> {window.alert('更改成功！');location.href='book.php'} </script>";
?>
