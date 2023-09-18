<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}

$b_id = $_POST['b_id'];
$author = $_POST['author'];
$edit = $_POST['edit'];
$price = $_POST['price'];
$i_num = $_POST['i_num'];


$sql1 = "SELECT Book_ID FROM book where Book_Name = '$b_id' AND Book_Arthor = '$author' AND Book_Edition = '$edit'";
$find_book_exist = mysqli_query($conn,$sql1);
$row_exist = @mysqli_fetch_row($find_book_exist);

$sql_add_book = "INSERT INTO book (Book_Name, Book_Arthor, Book_Edition, Book_Price) VALUES ('$b_id', '$author', '$edit', $price)";


//判斷是否為空值
if($b_id != null && $author!= null && $edit != null && $price != null)
{
 //新增資料進資料庫語法

	if($row_exist == null){


		if(mysqli_query($conn,$sql_add_book))
		{
			echo "<script> {window.alert('新增成功!');location.href='book.php'} </script>";
			$b_id = mysqli_insert_id($conn);
			$sql_add_i = "INSERT INTO inventory (I_num, Book_ID) VALUES ($i_num,$b_id)";
			mysqli_query($conn,$sql_add_i);
		}
		else
		{
			echo "<script> {window.alert('新增失敗!');location.href='book.php'} </script>";
		}
	}
	else{
        echo "<script> {window.alert('書本已存在!');location.href='book.php'} </script>";
	}
	
}		
else
{
    echo "<script> {window.alert('資料未填!');location.href='book.php'} </script>";
}
?> 
