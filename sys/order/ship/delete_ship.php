<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../../mysql_connect.inc.php");

//判定權限
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../../bookstore.php'} </script>";
}

$_SESSION['temp'] = $_POST['delete_id'];

?>

<script> var sure=confirm( '確認要刪除嗎？ ');
    if (1==sure){
        location.href = 'delete_ship_finish.php';
    }
    else {
        location.href = '../ship_and_location.php';
    }
</script>
                                                    
                                                    
                                                    
                                                    
                                                
                                                
                                                    
                                                    
                                                
