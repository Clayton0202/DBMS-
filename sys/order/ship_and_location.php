<head>
	<?php session_start(); ?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>運送方式與地址管理</title>
        	<link rel = "stylesheet" href="shipping_and_location.css"></link>
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
	$query = "SELECT * FROM shipping_method "; 
	$query_run = mysqli_query($conn,$query); 
	$query2 = "SELECT * FROM pickup_location left join shipping_method using(S_ID)"; 
	$query_run2 = mysqli_query($conn,$query2); 
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
	<h3 class="title1"> Shipping and Address Management </h3>

	<div class="wraper">
		<div class="board2">
			<div class="board">
					<div class="board3">
                        <h4 class="title"> 加入運送方式 </h4>
                        <form class="edit1" name="form" method="post" action="ship/add_ship.php">
                            運送方式：<input class="input"  type="text" name="method" /> 
                            <input class="button2" type="submit" name="button" value="加入" />
                        </form>

                        <h4 class="title"> 加入地址 </h4>
                        <form  class="edit1" name="form" method="post" action="location/add_location.php">
                            運送方式：
                            <select class="select" name="method">
                                <?php foreach($query_run as $row){ ?>
                                    <option class="option" value = "<?php echo $row['S_ID'] ?>"><?php echo $row['S_method'] ?></option>
                                <?php } ?>
                            </select>
                            地址：<input class="input" class="input" type="text" name="address" /> 
                            <input class="button2"type="submit" name="button" value="加入" />
                        </form>
					</div>
			</div>
		</div>

        
		
		<div class="container">

			<div class="block">
                        <div  id="123" style="display: none;">
                            <h4 class="title"> 更改運送方式 </h4>
							<div class="window">
								<form class="form" action="ship/edit_ship.php" method="post">
									運送編號：<input class="input" type ="text" name="id" id="id" value="" size="5" readonly><br>
									運送方式：<input class="input" type ="text" name="method" id="method" value=""size="10">
									<input class="button2" type="submit" name="button" value="確認更改" />
								</form>
							</div>
                        </div>


                        <div id="456" style="display: none;">
                            <h4 class="title"> 更改地址 </h4>
							<div class="window">
								<form class="form"action="location/edit_location.php" method="post">
									地址編號：<input class="input" type ="text" name="id" id="p_id" value="" size="5" readonly><br>
									地址___：  <input class="input" type="text" name="address" id="p_address" value="" /> <br>
									運送方式：
									<select class="select1"name="method" id="p_method">
										<?php foreach($query_run as $row1){ ?>
											<option value = "<?php echo $row1['S_ID'] ?>"> <?php echo $row1['S_method'] ?> </option>
										<?php } ?>
									</select>
									
									<input class="button2" type="submit" name="button" value="確認更改" />
								</form>
							</div>
                        </div>
                
				
				<div class="container2">
					
						<table class="table table-sm table-bordered"style="text-align:center;">
							<thead style="text-align:center;">
								<tr style="text-align:center;">
                                    <th class="order">編號</th>
				                    <th class="order">運送方式</th>
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
                                                        <td class="content"><?php echo $row['S_ID']; ?></td> 
                                                        <td class="content"><?php echo $row['S_method']; ?></td> 
                                                        <td>

                                                            <form action="ship/delete_ship.php" method="post">
                                                                <input type ="hidden" name="delete_id" value="<?php echo $row['S_ID']; ?>">
                                                                <input class="button2" type="submit" name="button" value="刪除" style="float:left"/>
                                                            </form>
                                                        
                                                            <button class="button2" id="showCode<?php echo $row['S_ID']; ?>" style="float:left">編輯</button>

                                                            <style>
                                                                form{
                                                                    display:inline;
                                                                }
                                                            </style>

                                                            <div id="code<?php echo $row['S_ID']; ?>" style="display:none;">
                                                                <form action="ship/edit_ship.php" method="post">
                                                                    運送方式：<input type ="text" name="method" value="<?php echo $row['S_method']; ?>"size="10">

                                                                    <input type ="hidden" name="id" value="<?php echo $row['S_ID']; ?>">
                                                                    <input class="button2" type="submit" name="button" value="確認更改" />
                                                                </form>
                                                            </div>


                                                            <script>
                                                                    document.getElementById("showCode<?php echo $row['S_ID']; ?>").addEventListener("click", function(){
                                                                        var temp = document.getElementById("id");
                                                                        temp.removeAttribute("value");
                                                                        temp.setAttribute("value", '<?php echo $row['S_ID']; ?>');
                                                                        var temp = document.getElementById("method");
                                                                        temp.removeAttribute("value");
                                                                        temp.setAttribute("value", '<?php echo $row['S_method']; ?>');
                                                                        
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
                        <table class="table table-sm table-bordered"style="text-align:center;">
                                <thead style="text-align:center;">
                                    <tr style="text-align:center;">
                                        <th class="order">運送方式</th>
                                        <th class="order">地址</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                    <?php
                                        if(mysqli_num_rows($query_run2) > 0)
                                        {
                                            foreach($query_run2 as $row)
                                            {
                                    ?>
                                                    <tr>
                                                        <!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
                                                        <td class="content"><?php echo $row['S_method']; ?></td> 
                                                        <td class="content"><?php echo $row['P_address']; ?></td> 
                                                        <td>

                                                            <form action="location/delete_location.php" method="post">
                                                                <input type ="hidden" name="delete_id" value="<?php echo $row['P_ID']; ?>">
                                                                <input class="button2" type="submit" name="button" value="刪除" style="float:left"/>
                                                            </form>
                                                        
                                                            <button class="button2" id="showCod<?php echo $row['P_ID']; ?>" style="float:left">編輯</button>

                                                            <style>
                                                                form{
                                                                    display:inline;
                                                                }
                                                            </style>

                                                            <div id="cod<?php echo $row['P_ID']; ?>" style="display:none;">
                                                                <form action="location/edit_location.php" method="post">
                                                                    運送方式：
                                                                    <select name="method" >
                                                                        <?php foreach($query_run as $row1){ ?>
                                                                            <option value = "<?php echo $row1['S_ID'] ?>" <?php if($row1['S_ID'] == $row['S_ID'])echo "selected" ?>><?php echo $row1['S_method'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    地址：<input type="text" name="address" value="<?php echo $row['P_address']; ?>" /> 

                                                                    <input type ="hidden" name="id" value="<?php echo $row['P_ID']; ?>">
                                                                    <input  class="button2" type="submit" name="button" value="確認更改" />
                                                                </form>
                                                            </div>


                                                            <script>
                                                                    document.getElementById("showCod<?php echo $row['P_ID']; ?>").addEventListener("click", function(){
                                                                        var temp = document.getElementById("p_id");
                                                                        temp.removeAttribute("value");
                                                                        temp.setAttribute("value", '<?php echo $row['P_ID']; ?>');
                                                                        var temp = document.getElementById("p_address");
                                                                        temp.removeAttribute("value");
                                                                        temp.setAttribute("value", '<?php echo $row['P_address']; ?>');
                                                                        
                                                                        var code = document.getElementById("456");
                                                                        if(code.style.display === "none"){
                                                                            code.style.display = "block";
                                                                        }

                                                                        var i=null;
                                                                        var obj = document.getElementById("p_method");
                                                                        for (i=0; i< obj.options.length; i++)
                                                                        {
                                                                            if (obj.options[i].value == '<?php echo $row['S_ID']; ?>')
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


	
<body>

<head>