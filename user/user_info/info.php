<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['username'] == null)
{
	echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../bookstore.php'} </script>";
}

$id = $_SESSION['username'];
$sql = "SELECT * FROM user where U_ID = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<head>
    <meta http-equiv="Content-Type : text/css" content="text/html; charset=utf-8" />
        <title> 會員資料更改 </title>
        <link rel = "stylesheet" href="info.css"></link>
<body>
    <div class="top">
        <input class="input1" type="button" onclick="location.href='../user_page.php';" value="返回上一頁" />
    </div>
    
        <form name="form" method="post" action="info_edit.php">
            <h1 class="title"> 會員資料 </h1>
            <div class="block1">
                <div class="block">
                    <div class="web1">
						<h2 class="tt">姓名</h2>
						<input class ="input"type="search" name ="name" placeholder="輸入姓名" value="<?php echo $row['U_Name']; ?>" />
						<h2 class="tt">地址</h2>
						<input class ="input"type="search" name ="address" placeholder="輸入地址" value="<?php echo $row['U_Address']; ?>" />
						<h2 class="tt">手機號碼</h2>
						<input class ="input"type="search" name ="phone" placeholder="輸入手機號碼" value="<?php echo $row['U_Phone']; ?>" />
						<h2 class="tt">帳號</h2>
						<input class ="input"type="search" name ="account" placeholder="輸入帳號" value="<?php echo $row['U_Account']; ?>" />
						<h2 class="tt">密碼</h2>
						<input class ="input"type="password" name ="pw" placeholder="輸入密碼" value="<?php echo $row['U_Password']; ?>" />
						<h2 class="tt">再次確認密碼</h2>
						<input class ="input"type="password" name ="pw2" placeholder="輸入密碼" value="<?php echo $row['U_Password']; ?>" />
						<h2 class="tt">E-mail</h2>
						<input class ="input"type="search" name ="email" placeholder="輸入E-mail" value="<?php echo $row['U_Email']; ?>" />
						<h2 class="tt"> </h2>
                    </div>
                </div>
            </div><br>
            <div class="click">
                <input class="input1" type="submit" name="button" value="確認更改" />&nbsp;&nbsp;
            </div>
                
        </form>
<body>
<head>