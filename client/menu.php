<?php
session_start();

include("./dbconn.php");

?>


<!--- INTERFACE START --->

<!DOCTYPE HTML>
<html>

<head>
    <title>Notre Menu - Restaurant L'Etoile</title>
    <link rel="stylesheet" href="./assets/css/menu.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <?php include("./navbar.php");


    ?><br><br><br>
    <br><br><br><br>

    <main>
        <div class="container">
            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-entree-tab" data-bs-toggle="pill" data-bs-target="#pills-entree" type="button" role="tab" aria-controls="pills-entree" aria-selected="false">Entrée</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-plat-tab" data-bs-toggle="pill" data-bs-target="#pills-plat" type="button" role="tab" aria-controls="pills-plat" aria-selected="true">Plats</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-dessert-tab" data-bs-toggle="pill" data-bs-target="#pills-dessert" type="button" role="tab" aria-controls="pills-dessert" aria-selected="false">Desserts</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-boisson-tab" data-bs-toggle="pill" data-bs-target="#pills-boisson" type="button" role="tab" aria-controls="pills-boisson" aria-selected="false">Boissons</button>
                </li>
            </ul>
            <hr>
            <div class="tab-content" id="pills-tabContent">



            <div class="tab-pane fade" id="pills-entree" role="tabpanel" aria-labelledby="pills-entree-tab" tabindex="0">
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                            <?php
                            $sql = "SELECT * from consommations where type = 'entree'";
                            $res = mysqli_query($conn, $sql);
                            while ($i = mysqli_fetch_array($res)) { ?>
                                <div class="col" style="margin-bottom : 20px">
                                    <div class="card h-100 shadow-sm" > <img style="padding:0;object-fit: cover" height='200' width="300" src="../photos/cons/<?php echo $i['photo'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="clearfix mb-3 d-flex aligns-items-center justify-content-center">
                                                <h4><span class=" badge rounded-pill bg-success"><?php echo $i['prix'] ?> DA</span></h4>
                                            </div>
                                            <h4 class="card-title d-flex aligns-items-center justify-content-center"><?php echo $i['nom'] ?></h4>
                                            <div class="text-center my-4">
                                                <form> <a type="button" id="<?php echo $i['numCons'] ?>" class="submit btn-panier">Ajouter au panier</a></form>
                                            </div>
                                            <div class="quantity mb-1 d-flex aligns-items-center justify-content-center">
                                                <button id="decQuantity" onclick="decQuantity('<?php echo $i['numCons'] ?>')" style="border : 0;  border-radius : 50%"><span><i class="fas fa-minus"></i></span></button>
                                                <span id="cons<?php echo $i['numCons'] ?>" style="padding-right : 10px; padding-left : 10px;">1</span>
                                                <button id="incQuantity" onclick="incQuantity('<?php echo $i['numCons'] ?>')" style="border : 0; border-radius : 50%"><span><i class="fas fa-plus"></i></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>


                <div class="tab-pane fade show active" id="pills-plat" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                            <?php
                            $sql = "SELECT * from consommations where type = 'plat'";
                            $res = mysqli_query($conn, $sql);
                            while ($i = mysqli_fetch_array($res)) { ?>
                                <div class="col" style="margin-bottom : 20px">
                                    <div class="card h-100 shadow-sm" style="background-"> <img style="padding:0;object-fit: cover" height='200' width="300" src="../photos/cons/<?php echo $i['photo'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="clearfix mb-3 d-flex aligns-items-center justify-content-center">
                                                <h4><span class=" badge rounded-pill bg-success"><?php echo $i['prix'] ?> DA</span></h4>
                                            </div>
                                            <h4 class="card-title d-flex aligns-items-center justify-content-center"><?php echo $i['nom'] ?></h4>
                                            <div class="text-center my-4">
                                                <form> <a type="button" id="<?php echo $i['numCons'] ?>" class="submit btn-panier">Ajouter au panier</a></form>
                                            </div>
                                            <div class="quantity mb-1 d-flex aligns-items-center justify-content-center">
                                                <button id="decQuantity" onclick="decQuantity('<?php echo $i['numCons'] ?>')" style="border : 0;  border-radius : 50%"><span><i class="fas fa-minus"></i></span></button>
                                                <span id="cons<?php echo $i['numCons'] ?>" style="padding-right : 10px; padding-left : 10px;">1</span>
                                                <button id="incQuantity" onclick="incQuantity('<?php echo $i['numCons'] ?>')" style="border : 0; border-radius : 50%"><span><i class="fas fa-plus"></i></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-dessert" role="tabpanel" aria-labelledby="pills-dessert-tab" tabindex="0">
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                            <?php
                            $sql = "SELECT * from consommations where type = 'dessert'";
                            $res = mysqli_query($conn, $sql);
                            while ($i = mysqli_fetch_array($res)) { ?>
                                <div class="col" style="margin-bottom : 20px">
                                    <div class="card h-100 shadow-sm" style="background-"> <img style="padding:0;object-fit: cover" height='200' width="300" src="../photos/cons/<?php echo $i['photo'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="clearfix mb-3 d-flex aligns-items-center justify-content-center">
                                                <h4><span class=" badge rounded-pill bg-success"><?php echo $i['prix'] ?> DA</span></h4>
                                            </div>
                                            <h4 class="card-title d-flex aligns-items-center justify-content-center"><?php echo $i['nom'] ?></h4>
                                            <div class="text-center my-4">
                                                <form> <a type="button" id="<?php echo $i['numCons'] ?>" class="submit btn-panier">Ajouter au panier</a></form>
                                            </div>
                                            <div class="quantity mb-1 d-flex aligns-items-center justify-content-center">
                                                <button id="decQuantity" onclick="decQuantity('<?php echo $i['numCons'] ?>')" style="border : 0;  border-radius : 50%"><span><i class="fas fa-minus"></i></span></button>
                                                <span id="cons<?php echo $i['numCons'] ?>" style="padding-right : 10px; padding-left : 10px;">1</span>
                                                <button id="incQuantity" onclick="incQuantity('<?php echo $i['numCons'] ?>')" style="border : 0; border-radius : 50%"><span><i class="fas fa-plus"></i></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>


 



                <div class="tab-pane fade" id="pills-boisson" role="tabpanel" aria-labelledby="pills-boisson-tab" tabindex="0">
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                            <?php
                            $sql = "SELECT * from consommations where type = 'boisson'";
                            $res = mysqli_query($conn, $sql);
                            while ($i = mysqli_fetch_array($res)) { ?>
                                <div class="col" style="margin-bottom : 20px">
                                    <div class="card h-100 shadow-sm" style="background-"> <img style="padding:0;object-fit: cover" height='200' width="300" src="../photos/cons/<?php echo $i['photo'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="clearfix mb-3 d-flex aligns-items-center justify-content-center">
                                                <h4><span class=" badge rounded-pill bg-success"><?php echo $i['prix'] ?> DA</span></h4>
                                            </div>
                                            <h4 class="card-title d-flex aligns-items-center justify-content-center"><?php echo $i['nom'] ?></h4>
                                            <div class="text-center my-4">
                                                <form> <a type="button" id="<?php echo $i['numCons'] ?>" class="submit btn-panier">Ajouter au panier</a></form>
                                            </div>
                                            <div class="quantity mb-1 d-flex aligns-items-center justify-content-center">
                                                <button id="decQuantity" onclick="decQuantity('<?php echo $i['numCons'] ?>')" style="border : 0;  border-radius : 50%"><span><i class="fas fa-minus"></i></span></button>
                                                <span id="cons<?php echo $i['numCons'] ?>" style="padding-right : 10px; padding-left : 10px;">1</span>
                                                <button id="incQuantity" onclick="incQuantity('<?php echo $i['numCons'] ?>')" style="border : 0; border-radius : 50%"><span><i class="fas fa-plus"></i></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>




    <br><br>
</body>

</html>






<!--- INTERFACE END --->

<script>
    function incQuantity(cons) {
        const q = document.getElementById("cons" + cons);
        q.textContent = String(parseInt(q.textContent) + 1);
    }

    function decQuantity(cons) {
        const q = document.getElementById("cons" + cons);
        if (parseInt(q.textContent) == 0) {
            return;
        }
        q.textContent = String(parseInt(q.textContent) - 1);
    }
</script>


<script>
    $(document).ready(function() {

        $(".submit").click(function(e) {
            var cons = e.currentTarget.id;
            var qte = $("#cons" + cons).text();
            <?php if (isset($_SESSION['AdminLoginId'])) { ?>
                var client = "<?php echo $_SESSION['AdminLoginId'] ?>";

                $.ajax({
                    type: "POST",
                    url: "add.php",
                    data: {
                        cons: cons,
                        qte: qte,
                        client: client
                    },
                    cache: false,
                    success: function(data) {
                        document.getElementById("cons" + cons).textContent = 1;

                        nb = document.getElementById("numberCart");
                        nb.textContent = String(parseInt(nb.textContent) + parseInt(qte));
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            <?php  } else { ?>
                location.href = 'login.php';
            <?php  } ?>

        });

    });
</script>