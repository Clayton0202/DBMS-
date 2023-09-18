<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['username'] == null)
{
	echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}

$id = $_SESSION['username'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$ship = $_POST['ship'];
$address = $_POST["$ship"];
$payment = $_POST['payment'];
$invoice = $_POST['invoice'];
$c = $_POST['c'];

$cart = $_SESSION["cart"];


$total = $_SESSION['total'];
if($ship == 1){
	if($address != null){
		$find = " SELECT * FROM pickup_location where P_address = '$address'";
		$r = mysqli_query($conn,$find);
		$r = @mysqli_fetch_row($r);
		if($r != null){
			$address = $r[0];
		}
		else{
			$sql_add_PU = "INSERT INTO pickup_location(P_address,S_ID) values('$address', 1)";
			mysqli_query($conn,$sql_add_PU);
			$address = mysqli_insert_id($conn);
		}	
	}
	else{
		echo "<script> {window.alert('您有資料未填!');location.href='take_order.php'} </script>";
	}
}

$f_vip = "SELECT * FROM user where U_ID = $id";
$fr = mysqli_query($conn,$f_vip);
$frow = mysqli_fetch_assoc($fr);

if($c == "Y"){
	$total = $total * 0.7;
}


if($name != null && $phone != null && $ship != null && $address != null)
{
	if($frow['U_Isvip'] == "Y"){
		$total = ceil($total*0.9);
		$sql = "INSERT INTO order_ (P_ID, S_ID, O_name, O_phone, O_Coupon, Pay_ID, Inv_ID, O_Date, O_Total, U_ID) VALUES ('$address', $ship, '$name',  '$phone', '$c', '$payment', '$invoice', now(), $total, $id)";
		$sql_f = "INSERT INTO financial(F_startDate, F_Type, F_Descript, F_Total) values (now(), '收', '訂單付款', $total)";
	}
	else{
		$sql = "INSERT INTO order_ (P_ID, S_ID, O_name, O_phone, O_Coupon, Pay_ID, Inv_ID, O_Date, O_Total, U_ID) VALUES ('$address', $ship, '$name',  '$phone', '$c', '$payment', '$invoice', now(), $total, $id)";
		$sql_f = "INSERT INTO financial(F_startDate, F_Type, F_Descript, F_Total) values (now(), '收', '訂單付款', $total)";
	}
	
	
	if(mysqli_query($conn,$sql))
	{
		$o_id = mysqli_insert_id($conn);
		
		mysqli_query($conn,$sql_f);
		foreach($cart as $k => $v){
			$sql_list = "INSERT INTO order_list(O_ID, O_Booknum, Book_ID) values ($o_id, $v, $k) ";
			
			$sqlo = "UPDATE inventory SET I_num = I_num - $v where Book_ID = $k ";
			mysqli_query($conn,$sql_list);
			mysqli_query($conn,$sqlo);
		}
		$sqlc = "UPDATE user SET U_Coupon = U_Coupon - 1 where U_ID = $id ";
		if ($c == "Y"){
			mysqli_query($conn,$sqlc);
		}
		unset($_SESSION['cart']);
		echo "<script> {window.alert('下訂成功!');location.href='../user_page.php'} </script>";
	}
	else
	{
		echo "<script> {window.alert('下訂失敗!');location.href='take_order.php'} </script>";
	}

	
}
else
{
	echo "<script> {window.alert('您有資料未填!');location.href='take_order.php'} </script>";
}
?>
