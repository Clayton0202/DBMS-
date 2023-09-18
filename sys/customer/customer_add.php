<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$account = $_POST['account'];
$password = $_POST['password'];
$email = $_POST['email'];
//$coupon = $_POST['coupon'];
//$vip = $_POST['vip'];
//$i_num = $_POST['i_num'];

$sql1 = "SELECT U_ID FROM user where (U_Name = '$name' and U_Phone = '$phone') or U_Account = '$account'";
$find_customer_exist = mysqli_query($conn,$sql1);
$row_exist = @mysqli_fetch_row($find_customer_exist);

$sql_customer_book = "INSERT INTO user (U_Name, U_Address, U_Phone, U_Account, U_Password, U_Email) VALUES ('$name', '$address', '$phone', '$account', '$password', '$email' )";


//$sql2 = "SELECT Book_ID FROM book where Book_Name = '$b_id' AND Book_Arthor = '$author' AND Book_Edition = '$edit'";


//判斷是否為空值
if($name != null && $address!= null && $phone != null && $account != null && $password != null && $email != null)
{
 //新增資料進資料庫語法

	if($row_exist == null){
        
        //$find_book_ID = mysqli_query($conn,$sql2);
        //$row_ID = @mysqli_fetch_row($find_book_ID);
        //$sql_add_inventory = "INSERT INTO inventory (I_num,Book_ID) VALUES ($i_num,$row_ID[0])";

		if(mysqli_query($conn,$sql_customer_book))
		{
			echo "<script> {window.alert('新增成功!');location.href='customer_manage.php'} </script>";
		}
		else
		{
			echo "<script> {window.alert('新增失敗!');location.href='customer_manage.php'} </script>";
		}
	}
	else{
        echo "<script> {window.alert('資料已存在!');location.href='customer_manage.php'} </script>";
	}
	
}		
else
{
    echo "<script> {window.alert('資料未填!');location.href='customer_manage.php'} </script>";
}
?> 