<head>
	<?php session_start(); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title> Sys page </title>
        <link rel = "stylesheet" href="sys_page.css"></link>
	<?php

	include("../mysql_connect.inc.php");

	//判定權限
	if($_SESSION['sysname'] == null)
	{
		echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../bookstore.php'} </script>";
	}
	?>
<body>
	<div class="top">
        <h1 class = "subtitle"> i'm a bookstore </h1>
		<div class="top1">
			<form action="sys_logout.php">
				<input class="output"type="submit" name="button" value="登出" />
			</form>
		</div>
    </div>

	<h1 class="title"> 歡迎<?php echo $_SESSION['name']?> ！ </h1>
	

	<div class="big_container">
		<div class="container">
			<div class = "box-1">
				<form action="book/book.php">
					<input class="input" type="submit" name="button" value="書籍與庫存系統" />
				</form>
			</div>
			<div class = "box-2">
			 	<form action="order/order.php">
				 	<input class="input" type="submit" name="button" value="訂單管理系統" />
				</form>
			</div>
			<div class = "box-1">
				<form action="customer/customer_manage.php">
					<input class="input" type="submit" name="button" value="顧客管理系統" />
				</form>
			</div>
			<div class = "box-2">
				<form action="financial/financial.php">
					<input class="input" type="submit" name="button" value="財務管理系統" />
				</form>
			</div>
		</div>	
	</div><br>
	<div class="box box-animation word"></div>
<body>
<head>