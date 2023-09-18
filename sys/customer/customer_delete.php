<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../../mysql_connect.inc.php");

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['sysname'] == null)
{
    echo "<script> {window.alert('您無權限觀看此頁面!');location.href='../../bookstore.php'} </script>";
}
$_SESSION['temp'] = $_POST['deleteid'];

//$sql_check = "SET foreign_key_checks = 0";
//$sql_delete = "DELETE FROM user WHERE U_ID = $delete_id ";
//$sql_check_back = "SET foreign_key_checks = 1";


?>

<script> var sure=confirm( '確認要刪除顧客資料嗎 ');
    if (1==sure){
        <?php 
        //mysqli_query($conn,$sql_check); 
        //mysqli_query($conn,$sql_delete);
        //mysqli_query($conn,$sql_check_back);
        ?>
        //alert( '刪除成功'); 
        location.href = 'customer_delete_finish.php';
    }
    else {
        location.href = 'customer_manage.php';
    }
</script>
                                                    
                                                    
                                                    
                                                    
                                                
                                                
                                                    
                                                    
                                                
