
<head>
    <meta http-equiv="Content-Type : text/css" content="text/html; charset=utf-8" />
        <title> I'm A BookStore </title>
        <link rel = "stylesheet" href="bookstore.css"></link>
<body >

    <div class="top">
        <h1 class = "subtitle"> i'm a bookstore </h1>
    </div>

    <h1 class="title"> I'm A BookStore </h1>

    <div class="web">
        <form action="search.php" method="post" >
                <input class ="input"  type="search" name="name" placeholder="輸入書籍關鍵字" style="float: left;"/>
                <input type="submit" name="button" value="確認" />        
        </form>
    </div><br>

    <div class="click">
        <form action="user/user_login.php">
            <input type="submit" name="button" value="顧客登入" /></form>
        <form action="sys/sys_login.php">
            <input type="submit" name="button" value="系統登入" /></form>   
    </div>
    
    <div class ="bottom">
        <div class ="book" >
            <div class = "box-1">
                <form action="user/user_login.php">
                    <input class="pic" type="image" name="button" img src="PYTHON.png" onClick="document.form.submit()"/>
                </form>
            </div>
            <div class = "box-2">
                <form action="user/user_login.php">
                    <input class="pic" type="image" name="button" img src="醫療保健.png" onClick="document.form1.submit()"/>
                </form>
            </div>
            <div class = "box-3">
                <form action="user/user_login.php">
                    <input class="pic" type="image" name="button" img src="紅樓夢.png" onClick="document.form2.submit()"/>
                </form>
            </div>
            <div class = "box-1">
                <form action="user/user_login.php">
                    <input class="pic" type="image" name="button" img src="彭政閔.png" onClick="document.form3.submit()"/>
                </form>
            </div>
            <div class = "box-2">
                <form action="user/user_login.php">
                    <input class="pic" type="image" name="button" img src="山君.png" onClick="document.form4.submit()"/>
                </form>
            </div>
            <div class = "box-3">
                <form action="user/user_login.php">
                    <input class="pic" type="image" name="button" img src="TOYZ.png" onClick="document.form5.submit()"/>
                </form>
            </div>   
        </div>
    </div>   
    <div class="box box-animation word">新書上架</div>

<body>
<head>



