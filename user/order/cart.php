<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" href="cart.css"></link>
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

    <h3 class="title1"> 我的購物車 </h3>
	
    <div class="wraper">
		<div class="board2">
			<div class="board">

                

                <div class="block">
                    
                    <form action="take_order.php" style="display:inline-block" method="post">
                        <?php foreach($cart as $k => $v){ ?>
                            <input type ="hidden" name="id_<?php echo $k; ?>" id="id_<?php echo $k; ?>" value="<?php echo $v; ?>">
                            
                        <?php } ?>
                        <input class="button1"type="submit" name="button" value="去結帳" onclick="save()">
                    </form>  
                    
                
                
                    <div class="container2">
                        <table class="table table-sm table-bordered"style="text-align:center;">
                            <thead style="text-align:center;">
                                <tr style="text-align:center;">
                                    <th class="order">書名</th>
                                    <th class="order">作者</th>
                                    <th class="order">版本</th>
                                    <th class="order">單價</th>
                                    <th class="order">數量</th>
                                    <th class="order"></th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                
                                    <?php
                                        foreach($cart as $k => $v)
                                        {
                                            $query = "SELECT Book_ID, Book_Name, Book_Arthor, Book_Edition, Book_Price, I_num FROM book Left JOIN inventory USING(Book_ID) where Book_ID = $k"; 
                                            $query_run = mysqli_query($conn,$query);
                                            foreach($query_run as $row)
                                            { 
                                    ?>
                                                    <tr>
                                                        <!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
                                                        <td class="content"><?php echo $row['Book_Name']; ?></td> 
                                                        <td class="content"><?php echo $row['Book_Arthor']; ?></td> 
                                                        <td class="content"><?php echo $row['Book_Edition']; ?></td>
                                                        <td class="content"><?php echo $row['Book_Price']; ?></td>
                                                        <td>
                                                            <form action="delete_cart.php" method="post">
                                                                <input type ="hidden" name="b_id" value="<?php echo $row['Book_ID']; ?>">
                                                                <input type="number" name="num<?php echo $k; ?>" value="<?php echo $v ?>" min="0" max="9999" oninput=
                                                                    "if(value><?php echo $row['I_num']; ?>){value=<?php echo $row['I_num']; ?>}
                                                                    else if(value<0){value=0}" 
                                                                style="float:left"/>
                                                                <input type="submit" name="button" value="移除" style="float:left"/>
                                                            

                                                            </form>
                                                        
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
    </div>
</body>




<script>
    function save(){
        num=[]
        <?php foreach($cart as $k => $v){ ?>
            numElement = document.getElementsByName('num<?php echo $k; ?>');
            num = numElement[0].value;

            var code = document.getElementById('id_<?php echo $k; ?>');
            code.removeAttribute("value");
            code.setAttribute("value",num);   
        <?php } ?>  
    }
</script>