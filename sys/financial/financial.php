<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" href="financial.css"></link>
<?php
include("../../mysql_connect.inc.php");

//此判斷為判定觀看此頁有沒有權限 
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}
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

	<h3 class="title1"> Financial System </h3>

	<div class="wraper">

		<div class="board2">
			<div class="board">
				<h3 class="title"> 新增財務紀錄 </h3>
				<div class="board3">
					<form class="edit1"name="form" method="post" action="add_financial.php">
						種類：
						<select name="type">
							<option value = "收" >收</option>
							<option value = "支" >支</option>
						</select>
						說明：<input class="input", type="text" name="descrit" /> 	
    					金額：<input class="input", type="text" name="total" /> 
    
    					<input class="button2" type="submit" name="button" value="加入" /><br><br>
					</form>
				</div>
			</div>
		</div>				


		<div class="container">
			<div class="block">
				
				<div class="container4" id="123" style="display: none;">
						編輯<br>
							
					<form class="edit"action="edit_financial.php" method="post">

						編號：<input class="input",type ="text" name="fid" id="id" value="" size="5" readonly><br>
						種類：
						<select name="type" id="type">
							<option value = "收" >收</option>
							<option value = "支" >支</option>
						</select><br>
						說明：<input class="input",type="text" name="descript" id="descript" value="" /> <br>	
						收支：<input class="input",type ="text" name="F_TOTAL" id="F_TOTAL" value="" size="15"><br>
				
						<input class="button1"type="submit" name="button" value="確認更改" />
					</form>
				</div>
			
		

				<?php 
					$queryfin = "SELECT * FROM financial where F_TYPE = '收' ";
					$query_runfin = mysqli_query($conn,$queryfin); 

					$queryfout = "SELECT * FROM financial where F_TYPE = '支' ";
					$query_runfout = mysqli_query($conn,$queryfout); 
				?>

				
				<div class="container2">
					
					<table class="table table-sm table-bordered">
						<h4 class="mark"> 財務狀況-收 </h4>
						<thead style="text-align:center;">
							<tr style="text-align:center;">
								<th class="order">編號</th>
								<th class="order">紀錄日期</th>
								<th class="order">最後更改日期</th>
								<th class="order">種類</th>
								<th class="order">說明</th>
								<th class="order">金額</th>
								<th></th>
							</tr>
						</thead>

						<tbody>

							<?php

								if(mysqli_num_rows($query_runfin) > 0)
								{
									foreach($query_runfin as $row )
									{
							?>

									<tr>
										<!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
										<td><?php echo $row['F_ID']; ?></td>
										<td><?php echo $row['F_startDate']; ?></td>
										<td><?php echo $row['F_changeDate']; ?></td>         
										<td><?php echo $row['F_Type']; ?></td> 
										<td><?php echo $row['F_Descript']; ?></td> 
										<td><?php echo $row['F_Total']; ?></td>
										<td>

											<form action="delete_financial.php" method="post">
													<input type ="hidden" name="delete_id" value="<?php echo $row['F_ID']; ?>">
													<input class="button"type="submit" name="button" value="刪除" style="float:left"/>
											</form>
											
											<button class="button" id="showCode<?php echo $row['F_ID']; ?>" style="float:left">編輯</button>

											<style>
												form{
													display:inline;
												}
											</style>
												


											<script>
													document.getElementById("showCode<?php echo $row['F_ID']; ?>").addEventListener("click", function(){
														var temp = document.getElementById("id");
														temp.removeAttribute("value");
														temp.setAttribute("value", '<?php echo $row['F_ID']; ?>');
														var temp = document.getElementById("descript");
														temp.removeAttribute("value");
														temp.setAttribute("value", '<?php echo $row['F_Descript']; ?>');
														var temp = document.getElementById("F_TOTAL");
														temp.removeAttribute("value");
														temp.setAttribute("value", '<?php echo $row['F_Total']; ?>');
											
														
														var code = document.getElementById("123");
														if(code.style.display === "none"){
															code.style.display = "block";
														}

														var i=null;
														var obj = document.getElementById("type");
														for (i=0; i< obj.options.length; i++)
														{
															if (obj.options[i].value == '<?php echo $row['F_Type']; ?>')
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
					</body>
				</div>


				<div class="container3">
					
					<table class="table table-sm table-bordered">
						<br><br><h4 class="mark"> 財務狀況-支 </h4>
						<thead style="text-align:center;">
							
								<tr style="text-align:center;">
									<th class="order">編號</th>
									<th class="order">紀錄日期</th>
									<th class="order">最後更改日期</th>
									<th class="order">種類</th>
									<th class="order">說明</th>
									<th class="order">金額</th>
									<th></th>
								</tr>
						</thead>
				
			
							<?php

								if(mysqli_num_rows($query_runfout) > 0)
								{
									foreach($query_runfout as $row )
									{
							?>
									<tr>
										<!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
										<td><?php echo $row['F_ID']; ?></td>
										<td><?php echo $row['F_startDate']; ?></td>
										<td><?php echo $row['F_changeDate']; ?></td>         
										<td><?php echo $row['F_Type']; ?></td> 
										<td><?php echo $row['F_Descript']; ?></td> 
										<td><?php echo $row['F_Total']; ?></td>
										<td>

											<form action="delete_financial.php" method="post">
													<input type ="hidden" name="delete_id" value="<?php echo $row['F_ID']; ?>">
													<input class="button" type="submit" name="button" value="刪除" style="float:left"/>
											</form>
										
											<button class="button" id="showCode<?php echo $row['F_ID']; ?>" style="float:left">編輯</button>

											<style>
												form{
													display:inline;
												}
											</style>


											<script>
													document.getElementById("showCode<?php echo $row['F_ID']; ?>").addEventListener("click", function(){
														var temp = document.getElementById("id");
														temp.removeAttribute("value");
														temp.setAttribute("value", '<?php echo $row['F_ID']; ?>');
														var temp = document.getElementById("descript");
														temp.removeAttribute("value");
														temp.setAttribute("value", '<?php echo $row['F_Descript']; ?>');
														var temp = document.getElementById("F_TOTAL");
														temp.removeAttribute("value");
														temp.setAttribute("value", '<?php echo $row['F_Total']; ?>');
											
														
														var code = document.getElementById("123");
														if(code.style.display === "none"){
															code.style.display = "block";
														}

														var i=null;
														var obj = document.getElementById("type");
														for (i=0; i< obj.options.length; i++)
														{
															if (obj.options[i].value == '<?php echo $row['F_Type']; ?>')
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
					</body>
				</div>
				
				
			</div>
		</div>
				

								


	</div>
</body>


