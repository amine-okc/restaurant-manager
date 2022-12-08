<?php 
    require_once "dbconn.php";
 
    $cons = $_POST['cons'];
    $client = $_POST['client'];
    $sql = "delete from panier where client = '$client' and consommation = '$cons'";


    if(!mysqli_query($conn, $sql)) {
       echo "Error: " . $sql . "" . mysqli_error($conn);
    }
 
    mysqli_close($conn);
 
?>