<head>
	<?php session_start(); ?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Order</title>
        	<link rel = "stylesheet" href="order.css"></link>
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
	$query = "SELECT * from order_
            left join shipping_method on order_.S_ID=shipping_method.S_ID
            left join pickup_location on order_.P_ID=pickup_location.P_ID
            left join payment on order_.Pay_ID=payment.Pay_ID
            left join invoice on order_.Inv_ID=invoice.Inv_ID 
			order by order_.O_ID" ; 

	$query_run = mysqli_query($conn,$query); 
	$query_run1 = mysqli_query($conn,$query);
?>

<body>
	<div class="top">
        <h1 class = "subtitle"> i'm a bookstore </h1>
		<div class="top1">
			<form action="../sys_page.php">
				<input class="output" type="submit" name="button" value="返回上一頁" />
			</form>
			<form action="ship_and_location.php">
				<input class="output" type="submit" name="button" value="運送方式與地址管理" /><br><br><br>
			</form>
		</div>
    </div><br>
	<h3 class="title1"> Order System </h3>

	<div class="wraper">
		
		<div class="container">

			<div class="block">
				
				<div class="container2">
					
						<table class="table table-sm table-bordered"style="text-align:center;">
							<thead style="text-align:center;">
								<tr style="text-align:center;">
                                    <th class="order">訂購人姓名</th>
                                    <th class="order">訂購人電話</th>
                                    <th class="order">訂購時間</th>
                                    <th class="order">配送方式</th>
                                    <th class="order">收件地點</th>
                                    <th class="order">付款方式</th>
                                    <th class="order">發票方式</th>
                                    <th class="order">優惠券</th>
                                    <th class="order">訂單總金額</th>
                                    <th class="order">出貨狀態</th>
                                    
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
                                                            <td class="content"><?php echo $row['O_name']; ?></td>
                                                            <td class="content"><?php echo $row['O_phone']; ?></td>
                                                            <td class="content"><?php echo $row['O_Date']; ?></td>
                                                            <td class="content"><?php echo $row['S_method']; ?></td>
                                                            <td class="content"><?php echo $row['P_address']; ?></td>
                                                            <td class="content"><?php echo $row['Pay_method']; ?></td>
                                                            <td class="content"><?php echo $row['Inv_method']; ?></td>

                                                            <td>
                                                                <?php 
                                                                    if ($row['O_Coupon']=='Y'){
                                                                        echo 'V';
                                                                    }else{
                                                                        echo 'X';
                                                                    }
                                                                ?>
                                                            </td>

                                                            <td><?php echo $row['O_Total']; ?></td>

                                                            <td>
                                                                <?php 
                                                                    if ($row['O_isShip']=='Y'){
                                                                        echo '已出貨';
                                                                    }else{
                                                                        echo '未出貨';
                                                                    }
                                                                ?>
                                                            </td>

                                                            <td>

                                                                <form action="order_out.php" method="post">
                                                                    <input  class="button" type ="hidden" name="deleteoidd" value="<?php echo $row['O_ID']; ?>">
                                                                    <input class="button" type="submit" name="button" value="更改出貨" style="float:left"/>
                                                                </form>


                                                            </td>




                                                            <td>
                                                                
                                                            
                                                                <form action="order_delete.php" method="post">
                                                                    <input class="button" type ="hidden" name="deleteoid" value="<?php echo $row['O_ID']; ?>">
                                                                    <input class="button" type ="hidden" name="deletebid" value="<?php echo $row['Book_ID']; ?>">
                                                                    <input class="button" type="submit" name="button" value="刪除" style="float:left"/>
                                                                </form>
                                                                

                                                                <button  class="button" id="showCode<?php echo $row['O_ID']; ?>" style="float:left">檢視訂單資訊</button>

                                                                <style>
                                                                    form{
                                                                        display:inline;
                                                                    }
                                                                </style>

                                                                <script>
                                                                        document.getElementById("showCode<?php echo $row['O_ID']; ?>").addEventListener("click", function(){
                                                                            
                                                                            <?php
                                                                                foreach($query_run1 as $row1)
                                                                                {
                                                                            ?>
                                                                                    if(<?php echo $row1['O_ID']; ?> == <?php echo $row['O_ID']; ?>){
                                                                                        var code = document.getElementById("123<?php echo $row1['O_ID']; ?>");
                                                                                        if(code.style.display === "none"){
                                                                                            code.style.display = "inline-block";
                                                                                        }else{
                                                                                            code.style.display = "none";
                                                                                        }
                                                                                    }
                                                                                    else{
                                                                                        var code = document.getElementById("123<?php echo $row1['O_ID']; ?>");
                                                                                        if(code.style.display === "none"){
                                                                                            code.style.display = "none";
                                                                                        }else{
                                                                                            code.style.display = "none";
                                                                                        }
                                                                                    }
                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                                
                                                                            
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
                        <?php
                            foreach($query_run as $row){
                        ?>

                                <table class="table table-sm table-bordered" id="123<?php echo $row['O_ID']; ?>" style="text-align:center;display:none">
                                
                                    <thead style="text-align:center;">
                                        <tr style="text-align:center;">
                                            <th class="order1">書名</th>
                                            <th class="order1">作者</th>
                                            <th class="order1">版本</th>
                                            <th class="order1">數量</th>
                                            <th class="order1">單價</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        <?php
                                            $oid = $row['O_ID'];
                                            $sql = "SELECT * FROM order_list left join Book using(Book_ID) where O_ID = $oid";
                                            $query_run = mysqli_query($conn,$sql);

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
                                                            <td class="content"><?php echo $row['O_Booknum']; ?></td>
                                                            <td class="content"><?php echo $row['Book_Price']; ?></td>							
                                                            
                                                        </tr>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </tbody>

                                    
                                </body>
                        
                        <?php
                            }
                        ?>	
				</div>
			</div>
			
										

		</div>


		
	</div>


	
<body>

<head>