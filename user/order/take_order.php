<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" href="take_order.css"></link>
<?php
include("../../mysql_connect.inc.php");

//判定權限
if($_SESSION['username'] == null)
{
	echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}
$cart=$_SESSION["cart"];

if($cart == null)
{
	echo "<script> {window.alert('您的購物車為空!趕快挑選商品吧！');location.href='../user_page.php'} </script>";
}


foreach($cart as $k => $v){
    $temp = $_POST["id_$k"];
    if($temp != null){
        $_SESSION["cart"][$k] = $temp;
    }
}


$cart=$_SESSION["cart"];

$u_id = $_SESSION["username"];
$sql_find = "SELECT * FROM user WHERE U_ID = $u_id";
$result = mysqli_query($conn,$sql_find);
$row = @mysqli_fetch_row($result);

$query = "SELECT * FROM shipping_method "; 
$query_run = mysqli_query($conn,$query); 
?>

<body>
	<div class="top">
        <h1 class = "subtitle"> i'm a bookstore </h1>
		<div class="top1">
			<form action="../user_page.php">
				<input class="output"type="submit" name="button" value="返回上一頁" />
			</form>
		</div>
    </div><br>


<div class="block"> 
    <div class="block1">
            <div class="container4">

                    <form name="form" method="post" action="take_order_finish.php">
                        <h4 > 確認訂單資訊 </h4>     
                        收件人姓名：<input class="input"type="text" name="name" value="<?php echo $row[1] ?>" /> <br>
                        手機號碼：<input class="input"type="text" name="phone" value="<?php echo $row[3] ?>"/> <br>
                        
                        配送方式：
                        <select name="ship" id="method">
                            <?php foreach($query_run as $row1){ ?>
                                <option value = "<?php echo $row1['S_ID'] ?>"><?php echo $row1['S_method'] ?></option>
                            <?php } ?>
                        </select><br>
                        

                        <div id="1" style="display:block;">
                            
                            收件地址：<input class="input" type="text" name="1" value="<?php echo $row[2] ?>"/> <br>
                                
                        </div>

                        <div id="2" style="display:none;">
                            門市：
                            <select name="2" id="2_ad">
                                <?php
                                    $query1 = "SELECT * FROM pickup_location left join shipping_method using(S_ID) where S_ID = 2"; 
                                    $query_run1 = mysqli_query($conn,$query1); 
                                    foreach($query_run1 as $row2){ 
                                ?>
                                    <option value = "<?php echo $row2['P_ID'] ?>"><?php echo $row2['P_address'] ?></option>
                                <?php } ?>
                            </select><br>		
                        </div>

                        <div id="3" style="display:none;">
                            門市：
                            <select name="3" id="3_ad">
                                <?php
                                    $query2 = "SELECT * FROM pickup_location left join shipping_method using(S_ID) where S_ID = 3"; 
                                    $query_run2 = mysqli_query($conn,$query2); 
                                    foreach($query_run2 as $row3){ 
                                ?>
                                    <option value = "<?php echo $row3['P_ID'] ?>"><?php echo $row3['P_address'] ?></option>
                                <?php } ?>
                            </select><br>		
                        </div>

                        付款方式：
                        <select name="payment" >
                            <?php
                                $query3 = "SELECT * FROM payment "; 
                                $query_run3 = mysqli_query($conn,$query3); 
                                foreach($query_run3 as $row4){ 
                            ?>
                                <option value = "<?php echo $row4['Pay_ID'] ?>"><?php echo $row4['Pay_method'] ?></option>
                            <?php } ?>
                        </select><br>
                        
                        發票方式：
                        <select name="invoice" >
                            <?php
                                $query4 = "SELECT * FROM invoice"; 
                                $query_run4 = mysqli_query($conn,$query4); 
                                foreach($query_run4 as $row5){ 
                            ?>
                                <option value = "<?php echo $row5['Inv_ID'] ?>"><?php echo $row5['Inv_method'] ?></option>
                            <?php } ?>
                        </select><br>	

                        是否使用七折優惠卷：
                        <input type ="radio" name="c" id = "c1" value="Y" <?php if($row[7] == 0)echo "disabled"  ?>>是
                        <input type ="radio" name="c" id = "c2" value="N" checked>否 <br>

                        <div class="block">
                        <input class="button1" type="submit" name="button" value="送出訂單" />
                        
                    </form>
            </div>

    

    
            

    </div>
    <div class="container2">

        <div >
    
            <h4 class="order"> 訂單內容 </h4> 
        </div>
        <div class="block">
        <table class="table table-sm table-bordered"style="text-align:center;">
            <thead style="text-align:center;">
                <tr style="text-align:center;">
                    <th class="order">書名</th>
                    <th class="order">作者</th>
                    <th class="order">版本</th>
                    <th class="order">單價</th>
                    <th class="order">數量</th>
                    <th class="order">小計</th>
                    <th class="order"></th>
                </tr>
                
            </thead>
            </div>
            <tbody>
                
                    <?php
                        $total = 0;
                        foreach($cart as $k => $v)
                        {
                            $query = "SELECT Book_ID, Book_Name, Book_Arthor, Book_Edition, Book_Price, I_num FROM book Left JOIN inventory USING(Book_ID) where Book_ID = $k"; 
                            $query_run = mysqli_query($conn,$query);
                            foreach($query_run as $rowo)
                            { 
                                $total = $total + $v * $rowo['Book_Price'];
                                
                    ?>
                                    <tr>
                                        <!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
                                        <td><?php echo $rowo['Book_Name']; ?></td> 
                                        <td><?php echo $rowo['Book_Arthor']; ?></td> 
                                        <td><?php echo $rowo['Book_Edition']; ?></td>
                                        <td><?php echo $rowo['Book_Price']; ?></td>
                                        <td><?php echo $v ?></td>
                                        <td><?php echo "$"; echo $v * $rowo['Book_Price'] ?></td>
                                    </tr>
                    <?php
                                $total_c = $total * 0.7;
                                $_SESSION['total'] = $total;
                            }

                        }
                        if ($row[8] == 'Y'){
                            $total = ceil($total * 0.9);
                            $total_c = ceil($total_c * 0.9);
                        }
                    ?>

                
            </tbody>
            
        </body>
    
    
        
</div>     

                        
        <div class="control">         
            <div class="window">
                    <?php
                    
                    if($row[8] == 'Y'){
                ?>
                    <h4   >您有VIP九折優惠！  </h4>
                <?php
                    }
                ?>
                <h4 id = "total" > 打折後總共： $<?php echo $total; ?> </h4>  
            </div>
        </div>    


</body>

<script>
		document.getElementById("method").addEventListener("click", contentShow)
        document.getElementById("c1").addEventListener("click", total)
        document.getElementById("c2").addEventListener("click", total)
		
        function contentShow(event){
            var code1 = document.getElementById("1");
            var code2= document.getElementById("2");
            var code3 = document.getElementById("3");
            if(event.target.value == 2){
                code1.style.display = "none";
                code3.style.display = "none";
                code2.style.display = "block";
            }
            else if(event.target.value == 3){
                code2.style.display = "none";
                code1.style.display = "none";
                code3.style.display = "block";
            }
            else{
                code2.style.display = "none";
                code3.style.display = "none";
                code1.style.display = "block";
            }
        }

        function total(event){
            if(event.target.value == "N"){
                document.getElementById("total").innerHTML = "打折後總共： $" + <?php echo $total; ?>
                
            }
            else if(event.target.value == "Y"){
                
                document.getElementById("total").innerHTML = "打折後總共： $" + <?php echo $total_c; ?>
                
               
            }
        }

	</script>