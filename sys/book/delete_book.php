<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//此判斷為判定觀看此頁有沒有權限
//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}

$_SESSION['temp'] = $_POST['delete_id'];

?>

<script> var sure=confirm( '確認要刪除這本書嗎 ');
    if (1==sure){
        location.href = 'delete_book_finish.php';
    }
    else {
        location.href = 'book.php';
    }
</script>
                                                    
                                                    
                                                    
                                                    
                                                
                                                
                                                    
                                                    
                                                
