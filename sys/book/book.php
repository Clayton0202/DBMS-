<head>
	<?php session_start(); ?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>書籍與庫存管理系統</title>
        	<link rel = "stylesheet" href="book.css"></link>
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
 $query = "SELECT Book_ID, Book_Name, Book_Arthor, Book_Edition, Book_Price, I_num FROM book Left JOIN inventory USING(Book_ID)"; 
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
	<h3 class="title1"> Inventory System </h3>

	<div class="wraper">
		<div class="board2">
			<div class="board">
				<h3 class="title"> 新書登記 </h3>
					<div class="board3">
						<form class="edit1"name="form" method="post" action="add_book.php">
							書名：<input class="input"type="text" name="b_id" /> 
							作者：<input class="input"type="text" name="author" />
							版本：<input class="input"type="text" name="edit" /> 
							價格：<input class="input"type="text" name="price" />
							庫存：<input class="input"type="text" name="i_num" /> 	
							<input class="button2" type="submit" name="button" value="加入新書" />
						</form>
					</div>
			</div>
		</div>
		
		<div class="container">

			<div class="block">
				<div class="container4" id="123" style="display: none;">
					編輯<br>
					
					<form class="edit"action="edit_book.php" method="post">
						書本代號：<input class="input"type ="text" name="bid" id="bid" value="" readonly><br>
						書名：<input class="input"type ="text" name="b_name" id="b_name" value="" size="20"><br>
						作者：<input class="input"type ="text" name="b_author" id="b_author" value="" size="20"><br>
						版本：<input class="input"type ="text" name="b_edit" id="b_edit" value="" size="20"><br>
						價格：<input class="input"type ="text" name="b_price" id="b_price" value="" size="20"><br>
						庫存：<input class="input"type ="text" name="b_inventory" id="b_inventory" value="" size="20"><br>
						
						<input class="button1" type="submit" name="button" value="確認更改" />
					</form>
				</div>
				 
				<div class="container2">
					
						<table class="table table-sm table-bordered"style="text-align:center;">
							<thead style="text-align:center;">
								<tr style="text-align:center;">
									<th class="order">書本代號</th>
									<th class="order">書名</th>
									<th class="order">作者</th>
									<th class="order">版本</th>
									<th class="order">價格</th>
									<th class="order">庫存</th>
									<th></th>
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
											<td class="content"><?php echo $row['Book_ID']; ?></td>
											<td class="content"><?php echo $row['Book_Name']; ?></td> 
											<td class="content"><?php echo $row['Book_Arthor']; ?></td> 
											<td class="content"><?php echo $row['Book_Edition']; ?></td>
											<td class="content"><?php echo $row['Book_Price']; ?></td>
											<td class="content"><?php echo $row['I_num']; ?></td>
											<td>

												<form action="delete_book.php" method="post">
													<input type ="hidden" name="delete_id" value="<?php echo $row['Book_ID']; ?>">
													<input class="button" type="submit" name="button" value="刪除" style="float:left"/>
												</form>
											
												<button class="button" id="showCode<?php echo $row['Book_ID']; ?>" style="float:left">
												編輯</button>

												<style>
													form{
														display:inline;
													}
												</style>



												<script>
														document.getElementById("showCode<?php echo $row['Book_ID']; ?>").addEventListener("click", function(){
															var temp = document.getElementById("b_name");
															temp.removeAttribute("value");
															temp.setAttribute("value", '<?php echo $row['Book_Name']; ?>');
															var temp = document.getElementById("b_author");
															temp.removeAttribute("value");
															temp.setAttribute("value", '<?php echo $row['Book_Arthor']; ?>');
															var temp = document.getElementById("b_edit");
															temp.removeAttribute("value");
															temp.setAttribute("value", '<?php echo $row['Book_Edition']; ?>');
															var temp = document.getElementById("b_price");
															temp.removeAttribute("value");
															temp.setAttribute("value", '<?php echo $row['Book_Price']; ?>');
															var temp = document.getElementById("b_inventory");
															temp.removeAttribute("value");
															temp.setAttribute("value", '<?php echo $row['I_num']; ?>');
															var temp = document.getElementById("bid");
															temp.removeAttribute("value");
															temp.setAttribute("value", '<?php echo $row['Book_ID']; ?>');

															var code = document.getElementById("123");
															if(code.style.display === "none"){
																code.style.display = "block";
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