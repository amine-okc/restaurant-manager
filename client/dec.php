<?php 
    require_once "dbconn.php";
 
    $cons = $_POST['cons'];
    $qte = $_POST['qte'];
    $client = $_POST['client'];
    if($qte > 1){
        $qte = $qte - 1;
        $sql = "update panier set qte = '$qte' where client = '$client' and consommation = '$cons'";    
    }else{
        $sql = "delete from panier where client = '$client' and consommation = '$cons'";
    }

 
 
    if(!mysqli_query($conn, $sql)) {
       echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    $sql = "select prix from consommations where numCons = '$cons'";
    $prix = mysqli_fetch_array(mysqli_query($conn,$sql))[0];
    echo $prix;
    mysqli_close($conn);
 
?>