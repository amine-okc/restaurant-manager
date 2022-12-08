<?php 
    require_once "dbconn.php";
    session_start();




    $client = $_SESSION['AdminLoginId'];

    // Vérifier si le client a réservé une table
    $date = date("Y-m-d");

    $sql = "select * from asseoir where client = '$client' and dateServ = '$date'";
    if(mysqli_num_rows(mysqli_query($conn,$sql)) == 0){
        echo json_encode(array('success'=>'false_table'));
        exit();
    }



    $sql = "select * from panier where client = '$client'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
        echo json_encode(array('success'=>'false_panier'));
        exit();  
    }


    $sql = "insert into commandes (client)values('$client')";
    if(!mysqli_query($conn,$sql)){
        die("error !");
    }

    $sql = "select max(numCmd) from commandes where client = '$client'";
    $cmd = mysqli_fetch_array(mysqli_query($conn,$sql))[0];


    while($i = mysqli_fetch_array($res)){
        $cons = $i['consommation'];
        $qte = $i['qte'];

        $sql = "insert into contenir (consommation, commande, qte)values('$cons','$cmd','$qte')";
        if(!mysqli_query($conn,$sql)){
            echo "<script>alert('Erreur.')</script>";
            die();
        }
    }
    $sql = "delete from panier where client = '$client'";
    mysqli_query($conn,$sql);
    echo json_encode(array('success'=>'true'));


?>