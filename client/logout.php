<?php 
session_start();
if(!isset($_SESSION['AdminLoginId'])){
    die();
}
else{
    session_destroy();
    echo "<script>location.href = './index.php'</script>";
}


?>