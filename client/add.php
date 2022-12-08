<?php 
    require_once "dbconn.php";
 
    $cons = $_POST['cons'];
    $qte = $_POST['qte'];
    $client = $_POST['client'];
    $sql0 = "select * from panier where client = '$client' and consommation = '$cons'";
    $res = mysqli_query($conn,$sql0);
    if(mysqli_num_rows($res) > 0){
        $oldqte = mysqli_fetch_row($res)[2];
        $qte = $qte + $oldqte;
        $sql = "update panier set qte = '$qte' where client = '$client' and consommation = '$cons'";
    }else{
        $sql = "insert into panier (client,consommation,qte)values('$client', '$cons', '$qte')";
    }
 
 
    if(!mysqli_query($conn, $sql)) {
       echo "Error: " . $sql . "" . mysqli_error($conn);
    }
 
    mysqli_close($conn);
 
?>