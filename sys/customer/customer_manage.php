<head>
	<?php session_start(); ?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>顧客管理系統</title>
        	<link rel = "stylesheet" href="customer_manage.css"></link>
	<?php
include("../../mysql_connect.inc.php");

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['sysname'] == null)
{
	echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../bookstore.php'} </script>";
}

?>

<?php 
	$query = "SELECT U_ID, U_Name, U_Address, U_Phone, U_Account, U_Password, U_Email, U_Coupon, U_Isvip FROM user" ; 
	$query_run = mysqli_query($conn,$query); 
?>

<body>
	<div class="top">
        <h1 class = "subtitle"> i'm a bookstore </h1>
		<div class="top1">
			<form action="../sys_page.php">
				<input class="output"type="submit" name="button" value="返回上一頁" />
			</form>
		</div>
    </div><br>
	<h3 class="title1"> Customer Management System </h3>

	<div class="wraper">
		<div class="board2">
			<div class="board">
				<h3 class="title"> 增加新顧客 </h3>
					
						<form class="edit1"name="form" method="post" action="customer_add.php">
							<div class="board3">
								姓名：<input class="input"type="text" name="name" /> 
								地址：<input class="input"type="text" name="address" />
								電話：<input class="input"type="text" name="phone" /> 
								帳號：<input class="input"type="text" name="account" />
								密碼：<input class="input"type="text" name="password" />
								E-mail：<input class="input"type="text" name="email" /><br> 
							</div>
							<div class="board5">	
								<input class="button2" type="submit" name="button" value="新增顧客" />
							</div>
						</form>
					
			</div>
		</div>
		
		<div class="container">

			<div class="block">
				<div class="container4" id="123" style="display: none;">
					編輯<br>
					<form class="edit"action="customer_edit.php" method="post">
						
						編號：<input class="input"type ="text" name="uid" id="u_id" value="" size="20"readonly><br>
						姓名：<input class="input"type ="text" name="uname" id="uname" value="" size="20"><br>
						地址：<input class="input"type ="text" name="uaddress" id="uaddress" size="20"><br>
						電話：<input class="input"type ="text" name="uphone" id="uphone" value="" size="20"><br>
						帳號：<input class="input"type ="text" name="uaccount" id="uaccount" value="" size="20"><br>
						密碼：<input class="input"type ="text" name="upassword" id="upassword" value="" size="20"><br>
						E-MAIL：<input class="input"type ="text" name="uemail" id="uemail" value="" size="20"><br>
						優惠券：
						<input class="input" type="number" name="ucoupon" id="ucoupon" value="" min="0" max="99" oninput="if(value<0){value=0}"/><br>
						VIP：
						<select class="vip" name="uvip" id="uvip">
						<option value = "Y" >是</option>
						<option value = "N" >否</option>
						</select><br>	
		
						<input class="button1" type="submit" name="button" value="確認更改" />
					</form>
				</div>
				
				<div class="container2">
					<div class="board4">
						<h4> 所有顧客清單 </h4>
					</div >
						<table class="table table-sm table-bordered"style="text-align:center;">
							<thead style="text-align:center;">
								<tr style="text-align:center;">
									<th class="order">編號</th>
									<th class="order">姓名</th>
									<th class="order">地址</th>
									<th class="order">電話</th>
									<th class="order">帳號</th>
									<th class="order">密碼</th>
									<th class="order">Email</th>
									<th class="order">優惠券</th>
									<th class="order">VIP</th>
								</tr>
							</thead>

							<tbody>
			
								<?php
									if(mysqli_num_rows($query_run) > 0)
									{
										foreach($query_run as $row)
										{
								?>
											<tr>
												<!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
												<td class="content"><?php echo $row['U_ID']; ?></td> 
												<td class="content"><?php echo $row['U_Name']; ?></td> 
												<td class="content"><?php echo $row['U_Address']; ?></td>
												<td class="content"><?php echo $row['U_Phone']; ?></td>
												<td class="content"><?php echo $row['U_Account']; ?></td>
												<td class="content"><?php echo $row['U_Password']; ?></td>
												<td class="content"><?php echo $row['U_Email']; ?></td>
												<td class="content"><?php echo $row['U_Coupon']; ?></td>
												<td class="content"><?php if($row['U_Isvip'] == "Y"){echo "是";}else{echo "否";}  ?></td>
												<td>

													<form action="customer_delete.php" method="post">
														<input type ="hidden" name="deleteid" value="<?php echo $row['U_ID']; ?>">
														<input class="button" type="submit" name="button" value="刪除" style="float:left"/>
													</form>
												
													<button class="button" id="showCode<?php echo $row['U_ID']; ?>" style="float:left">編輯</button>

													<style>
														form{
															display:inline;
														}
													</style>


													<script>
															document.getElementById("showCode<?php echo $row['U_ID']; ?>").addEventListener("click", function(){
																var temp = document.getElementById("uname");
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_Name']; ?>');
																var temp = document.getElementById("uaddress");
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_Address']; ?>');
																var temp = document.getElementById("uphone");
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_Phone']; ?>');
																var temp = document.getElementById("uaccount");
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_Account']; ?>');
																var temp = document.getElementById("upassword");
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_Password']; ?>');
																var temp = document.getElementById("uemail");
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_Email']; ?>');
																var temp = document.getElementById("ucoupon");
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_Coupon']; ?>');

																var temp = document.getElementById("u_id");												
																temp.removeAttribute("value");
																temp.setAttribute("value", '<?php echo $row['U_ID']; ?>');
																
																var code = document.getElementById("123");
																if(code.style.display === "none"){
																	code.style.display = "block";
																}

																var i=null;
																var obj = document.getElementById("uvip");
																for (i=0; i< obj.options.length; i++)
																{
																	if (obj.options[i].value == '<?php echo $row['U_Isvip']; ?>')
																	{
																		obj.selectedIndex = i;
																		return;
																	}
																}

																
															});

													</script>
													
												</td>
											</tr>
									<?php
										
										}
										}
									?>
						</tbody>
						<body>
					
				</div>
			</div>
			
										

		</div>


		
	</div>


	
<body>

<head>