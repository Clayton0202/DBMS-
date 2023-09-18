<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
include("mysql_connect.inc.php");

$regex = str_replace(' ','|',str_replace(',','|',$_POST['name'])); 

$sql_query = "SELECT * FROM `BOOK` left join inventory using(Book_ID) WHERE `book_edition` REGEXP '$regex'
or `book_name` REGEXP '$regex'
or `book_arthor` REGEXP '$regex'
or`book_price` REGEXP '$regex'";

$result = mysqli_query($conn, $sql_query);
$num_rows = mysqli_num_rows($result);	

?>	
		
<title> Search </title>		
<link rel = "stylesheet" href="search.css"></link>        	
	
<body>
    <div class="top">
        <h1 class = "subtitle"> i'm a bookstore </h1>
        <div class="web">
            <form action="search.php" method="post" >
                    <input class ="input"  type="search" name="name" placeholder="輸入書籍關鍵字" style="float: left;"/>
                    <input class="output"  type="submit" name="button" value="確認" />        
            </form>
    </div><br>
            <div class="top1">
                <form action="bookstore.php">
                    <input class="output"type="submit" name="button" value="首頁" />
                </form>
                <form action="user/user_login.php">
                    <input class="output"type="submit" name="button" value="登入" />
                </form>
            </div>
    </div><br>

    

    <h1 class="title2"> 搜尋結果 </h1>
    <div class="block1">
        <div class="block">
            <?php
                if (!$result) {
            ?>

                <h1 class="title2"> 未輸入字元 </h1>
            
            <?php
                }else{
                    if(mysqli_num_rows($result) > 0)
                    {
            ?>


			    <div class="container2">
				
				    <table class="table table-sm table-bordered"style="text-align:center;">

						<thead style="text-align:center;">
							<tr style="text-align:center;">
								<th class="order">書名</th>
								<th class="order">作者</th>
								<th class="order">版本</th>
								<th class="order">價格</th>
								<th class="order">庫存</th>
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
										<td class="content"><?php echo $row['Book_Price']; ?></td>
										<td class="content"><?php echo $row['I_num']; ?></td>
									</tr>
							<?php
									
									}
							?>

					    </tbody>
					<body>
				
			    </div>
		
                
            
            <?php 
                    }else{
            ?>
                    
                <label>找不到相關書籍</label>
            
            <?php
                    }
                }
            ?>


        </div>

    </div>  
    
<body>
