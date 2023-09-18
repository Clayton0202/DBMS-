<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接 MySQL就要include它
include("../mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
//搜尋資料庫資料
$sql = "SELECT * FROM sys_manager where SM_Account = '$id'";
$result = mysqli_query($conn,$sql);
$row = @mysqli_fetch_row($result);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($id != null && $pw != null && $row[4] == $id && strcmp($row[5], $pw) == 0)
{
	//將帳號寫入session，方便驗證使用者身份
	$_SESSION['sysname'] = $row[0];
	$_SESSION['name'] = $row[1];

	echo '<meta http-equiv=REFRESH CONTENT=1;url=sys_page.php>';
}
else
{
	echo "<script> {window.alert('登入失敗!');location.href='sys_login.php'} </script>";
}
?>
<body style="background-color: #33527a;"></body>