<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header("location : index.php");
}
require_once("./dbconn.php");

?>


<!--- INTERFACE START --->

<!DOCTYPE HTML>
<html>

<head>
    <title>Mon Panier - Restaurant L'Etoile</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <?php include("./navbar.php") ?><br><br><br>



    <!--- INTERFACE START --->



    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="menu.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Retour</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-0" id="numberCartForm">Vous avez <script>
                                                document.write(document.getElementById('numberCart').textContent)
                                            </script> éléments dans le panier.</p>
                                    </div>
                                </div>
                                <?php
                                $total_price = 0;
                                $client = $_SESSION['AdminLoginId'];
                                $sql1 = "select * from panier where client = '$client'";
                                $res = mysqli_query($conn, $sql1);
                                while ($row = mysqli_fetch_array($res)) {
                                    $cons = $row['consommation'];
                                    $sql2 = "select * from consommations where numCons = '$cons'";
                                    $c = mysqli_fetch_array(mysqli_query($conn, $sql2))
                                ?>
                                    <div class="card mb-3 consCards" id="cons<?php echo $cons ?>">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="../photos/cons/<?php echo $c['photo'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5><?php echo $c['nom'] ?></h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div class="quantity" style="width: 50px;">
                                                        <a type="button" class="inc" id="<?php echo $c['numCons'] ?>"><i style="color : black" class="fas fa-chevron-up"></i></a>
                                                        <h5 id="qte<?php echo $c['numCons']  ?>" class="fw-normal mb-0"><?php echo $row['qte'] ?></h5>
                                                        <a type="button" class="dec" id="<?php echo $c['numCons'] ?>"><i style="color : black" class="fas fa-chevron-down"></i></i></a>
                                                    </div>
                                                    <div style="width: 80px;">

                                                        <h5 id="price<?php echo $cons ?>" class="mb-0"><?php echo $c['prix'] * $row['qte'] . ' DA';
                                                                                                        $total_price = $total_price + $c['prix'] * $row['qte'] ?></h5>

                                                    </div>
                                                    <a type="button" class="delete" id="<?php echo $c['numCons'] ?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-5">

                                <div class="card text-white rounded-3" style="background-color : rgba(56, 56, 56, 0.966)">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center align-items-center mb-4">
                                            <h5 class="mb-0">Détails</h5>

                                        </div>

                                        <p class="small mb-2">Type de carte</p>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                                        <form class="mt-4" method="post" action="./panier.php">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="typeName">Nom et Prénom</label>
                                                <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Cardholder's Name" />

                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="typeText">Numéro de la carte</label>
                                                <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />

                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <label class="form-label" for="typeExp">Date d'expiration</label>
                                                        <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <label class="form-label" for="typeText">Cvv</label>
                                                        <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />

                                                    </div>
                                                </div>
                                            </div>



                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Sous-total</p>
                                                <p id="stotal" class="mb-2"><?php echo $total_price . ' DA' ?></p>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Frais de livraison</p>
                                                <p class="mb-2">100 DA</p>
                                            </div>
                                            </form>
                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total</p>
                                                <p id="total" class="mb-2"><?php echo ($total_price + 100) . " DA"; ?></p>
                                            </div>
                                            <div class="d-flex aligns-items-center justify-content-center">
                                                <button type="submit" name="submitCommand" class="btn-validation">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Valider la commande <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>
                                            </div>
                                        
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





    <!--- INTERFACE END --->






</body>

</html>






<!--- INTERFACE END --->

<script>
    $(document).ready(function() {

        $(".delete").click(function(e) {
            var cons = e.currentTarget.id;
            var qte = $("#qte" + cons).text();
            var client = "<?php echo $_SESSION['AdminLoginId'] ?>";

            $.ajax({
                type: "POST",
                url: "delete.php",
                data: {
                    cons: cons,
                    client: client
                },
                cache: false,
                success: function(data) {
                    nb = document.getElementById("numberCart");
                    nb.textContent = String(parseInt(nb.textContent) - parseInt(qte));
                    price = document.getElementById("price" + cons).innerText;
                    document.getElementById("cons" + cons).remove();
                    document.getElementById("numberCartForm").textContent = "Vous avez " + nb.textContent + " éléments dans le panier.";
                    document.getElementById("stotal").textContent = String(parseInt(document.getElementById("stotal").textContent) - parseInt(price)) + ' DA';
                    document.getElementById("total").textContent = String(parseInt(document.getElementById("stotal").textContent) + 100) + ' DA'
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });

        });
        $(".dec").click(function(e) {
            var cons = e.currentTarget.id;
            var qte = $("#qte" + cons).text();
            var client = "<?php echo $_SESSION['AdminLoginId'] ?>";
            $.ajax({
                type: "POST",
                url: "dec.php",
                data: {
                    cons: cons,
                    client: client,
                    qte: qte
                },
                cache: false,
                success: function(data) {
                    if (qte == 1) {
                        document.getElementById("cons" + cons).remove();
                        document.getElementById("numberCartForm").textContent = "Vous avez " + nb.textContent + " éléments dans le panier.";
                        document.getElementById("stotal").textContent = String(parseInt(document.getElementById("stotal").textContent) - parseInt(price)) + ' DA';
                        document.getElementById("total").textContent = String(parseInt(document.getElementById("stotal").textContent) + 100) + ' DA';
                    } else {
                        price = document.getElementById("price" + cons);
                        nb = document.getElementById("numberCart");
                        nb.textContent = String(parseInt(nb.textContent) - 1);
                        console.log(parseInt(nb.textContent));
                        document.getElementById("qte" + cons).innerHTML = String(parseInt(qte) - 1);
                        price.innerHTML = String(parseInt(data) * (parseInt(qte) - 1)) + ' DA';
                        document.getElementById("numberCartForm").textContent = "Vous avez " + nb.textContent + " éléments dans le panier.";
                        document.getElementById("stotal").textContent = String(parseInt(document.getElementById("stotal").textContent) - parseInt(data)) + ' DA';
                        document.getElementById("total").textContent = String(parseInt(document.getElementById("stotal").textContent) + 100) + ' DA'
                    }

                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });

        });
        $(".inc").click(function(e) {
            var cons = e.currentTarget.id;
            var qte = $("#qte" + cons).text();
            var client = "<?php echo $_SESSION['AdminLoginId'] ?>";
            $.ajax({
                type: "POST",
                url: "inc.php",
                data: {
                    cons: cons,
                    client: client,
                    qte: qte
                },
                cache: false,
                success: function(data) {
                    price = document.getElementById("price" + cons);
                    nb = document.getElementById("numberCart");
                    nb.textContent = String(parseInt(nb.textContent) + 1);

                    price.innerHTML = String(parseInt(data) * (parseInt(qte) + 1)) + ' DA';
                    document.getElementById("qte" + cons).innerHTML = String(parseInt(qte) + 1);
                    document.getElementById("numberCartForm").textContent = "Vous avez " + nb.textContent + " éléments dans le panier.";
                    document.getElementById("stotal").textContent = String(parseInt(document.getElementById("stotal").textContent) + parseInt(data)) + ' DA';
                    document.getElementById("total").textContent = String(parseInt(document.getElementById("stotal").textContent) + 100) + ' DA'


                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });

        });

        $(".btn-validation").click(function(e) {
            $.ajax({
                type: "POST",
                url: "submitCmd.php",
                cache: false,
                data: {

                },
                success: function(data) {
                    
                    if(JSON.parse(data).success == 'false_table'){
                        alert("Vous n'avez pas réservé une table.");
                        return;
                    }
                    if(JSON.parse(data).success == 'false_panier'){
                        alert("Votre panier est vide.");
                        return;
                    }
                    cards = Array.from(document.getElementsByClassName("consCards"));
                    len = cards.length;
                   // for(i = 0 ; i < len ; i++){
                    //    cards[i].remove();
                  //  }
                    cards.forEach(card => {
                        card.remove();
                    });
                    console.log(data);
                    document.getElementById("numberCart").textContent = "0" ;
                    document.getElementById("numberCartForm").textContent = "Vous avez 0 élément dans le panier.";
                    document.getElementById("stotal").textContent = '0 DA';
                    document.getElementById("total").textContent = '0 DA';
                    alert("Commande validé !");

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });

        });

    });
</script>

<?php 
/*
if(isset($_POST['submitCommand'])){
    $client = $_SESSION['AdminLoginId'];
    $sql = "select * from panier where client = '$client'";
    $res = mysqli_query($conn,$sql);


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
    echo "<script>alert('Commande validée !'); location.href = 'menu.php'</script>";
}

*/
?>



<style>
    .btn-validation {
        padding: 20px 20px !important;
        border: none !important;
        background: 0 0;
        box-shadow: none;
        text-shadow: none;
        opacity: .9;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: .4px;
        line-height: 1;
        outline: 0 !important;
        border-radius: 25px !important;

    }



    .btn-validation:active {
        transform: translateY(1px)
    }

    .btn-validation {
        background-color: rgb(143, 32, 32) !important;
        color: #fff;
        display: flex;
        justify-content: center;
    }

    .quantity {
        display: flex;
        justify-content: center;
        justify-items: center;
        flex-direction: column;
        align-items: flex-start;
    }

    @media (max-width: 1025px) {
        .btn-validation {
            padding: 5px 40px 5px 40px;
        }
    }

    @media (max-width: 250px) {
        .btn-validation {
            padding: 5px 30px 5px 30px;
        }
    }
</style>