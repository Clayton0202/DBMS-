<head>
	<?php session_start(); ?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> User page </title>
        	<link rel = "stylesheet" href="user_page.css"></link>
	<?php
include("../mysql_connect.inc.php");

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['username'] == null)
{
	echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../bookstore.php'} </script>";
}

if(isset($_POST['name']))
{
	$regex = str_replace(' ','|',str_replace(',','|',$_POST['name'])); 

	$sql_query = "SELECT * FROM `BOOK`Left JOIN inventory USING(Book_ID) WHERE `book_edition` REGEXP '$regex'
	or `book_name` REGEXP '$regex'
	or `book_arthor` REGEXP '$regex'
	or`book_price` REGEXP '$regex'";

	$result = mysqli_query($conn, $sql_query);
	$num_rows = mysqli_num_rows($result);
}

?>

<?php 
 $query = "SELECT Book_ID, Book_Name, Book_Arthor, Book_Edition, Book_Price, I_num FROM book Left JOIN inventory USING(Book_ID)"; 
 $query_run = mysqli_query($conn,$query); 
?>

<body>
	<div class="top">
        <h1 class = "subtitle"> i'm a bookstore </h1>
        <div class="web">
            <form action="user_page.php" method="post" >
                    <input class ="input"  type="search" name="name" placeholder="輸入書籍關鍵字" style="float: left;"/>
                    <input class="output"  type="submit" name="button" value="確認" />        
            </form>
    </div><br>
            <div class="top1">
				<form action="user_page.php">
                    <input class="output"type="submit" name="button" value="全部書籍" />
                </form>
                <form action="user_logout.php">
                    <input class="output"type="submit" name="button" value="登出" />
                </form>
            </div>
			
    </div><br>

	<div class="wraper">
		<div class="board">
			<h3 class="title"> 歡迎 <?php echo $_SESSION['name']?> ！</h3><br>
			<div class="board2">

				<form action="order/myorder.php">
					<input class="button2" type="submit" name="button" value="您的訂單" /><br>
				</form>

				<form action="order/cart.php">
					<input class="button2" type="submit" name="button" value="查看購物車" /><br>
				</form>

				<form action="user_info/info.php">
					<input class="button2" type="submit" name="button" value="會員資料修改" /><br>
				</form>
				
				
			</div>
		</div>

		<?php 
			if(isset($_POST['name'])){
		?>

			<div class="container">
				<div class="container3">
					<h4 class="subsubtitle"> 搜尋結果 </h4>
				</div>
				<div class="container2" >
					
						<table class="table table-sm table-bordered"style="text-align:center;">

							<?php
									if($num_rows > 0)
									{
										
							?>
							<thead style="text-align:center;">
								<tr style="text-align:center;">
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
									
										foreach($result as $row)
										{
								?>
										<tr>
											<!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
											<td class="content"><?php echo $row['Book_Name']; ?></td> 
											<td class="content"><?php echo $row['Book_Arthor']; ?></td> 
											<td class="content"><?php echo $row['Book_Edition']; ?></td>
											<td class="content">$<?php echo $row['Book_Price']; ?></td>
											<td class="content"><?php echo $row['I_num']; ?></td>
											<td>
												<form action="order/add_cart.php" method="post">
													<input type ="hidden" name="b_id" value="<?php echo $row['Book_ID']; ?>">
													<?php if($row['I_num'] == null) { ?>
														<label style="float:left">準備中，敬請期待 ！</label>
													<?php }else if($row['I_num'] == 0){ ?>
														<label style="float:left">暫無庫存 ！</label>
													<?php }else{ ?>
													<input class="button"type="number" name="num" value="0" min="1" max="99999" oninput=
														"if(value><?php echo $row['I_num']; ?>){value=<?php echo $row['I_num']; ?>}
														else if(value<0){value=0}" 
														style="float:left"/>
													<input class="button1" type="submit" name="button" value="加入購物車" />
													<?php } ?>

												</form>
											</td>
						
										</tr>
									<?php
										
										}
									}else{
									?>
									
										<h4 class="subsubtitle"> 找不到相關書籍！ </h4>

									<?php
									}
									?>
						</tbody>
						<body>
					
				</div>
			</div>

		<?php 
			}else{
		?>

			<div class="container">
				<div class="container3">
					<h4 class="subsubtitle"> 目前書籍清單與庫存 </h4>
				</div>
				<div class="container2" >
					
						<table class="table table-sm table-bordered"style="text-align:center;">
							<thead style="text-align:center;">
								<tr style="text-align:center;">
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
											<td class="content"><?php echo $row['Book_Name']; ?></td> 
											<td class="content"><?php echo $row['Book_Arthor']; ?></td> 
											<td class="content"><?php echo $row['Book_Edition']; ?></td>
											<td class="content">$<?php echo $row['Book_Price']; ?></td>
											<td class="content"><?php echo $row['I_num']; ?></td>
											<td>
												<form action="order/add_cart.php" method="post">
													<input type ="hidden" name="b_id" value="<?php echo $row['Book_ID']; ?>">
													<?php if($row['I_num'] == null) { ?>
														<label style="float:left">準備中，敬請期待 ！</label>
													<?php }else if($row['I_num'] == 0){ ?>
														<label style="float:left">暫無庫存 ！</label>
													<?php }else{ ?>
													<input class="button"type="number" name="num" value="0" min="1" max="99999" oninput=
														"if(value><?php echo $row['I_num']; ?>){value=<?php echo $row['I_num']; ?>}
														else if(value<0){value=0}" 
														style="float:left"/>
													<input class="button1" type="submit" name="button" value="加入購物車" />
													<?php } ?>

												</form>
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

		
		<?php 
			}
		?>


	</div>


	
<body>

<head>