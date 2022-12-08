<link rel="stylesheet" href="./assets/css/navbar.css">
<link rel="icon" type="image/x-icon" href="../photos/logo.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/bootstrap.css">

<nav class="navbar navbar-expand-sm fixed-top navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><a href="index.php" class="text-black"><span class="text-primary"><img src="../photos/logo.png" width="200" height="70"></a></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav  ms-auto mb-2 mb-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                <li class="nav-item px-2">
                    <a class="nav-link" id="index" aria-current="page" href="./index.php"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Acceuil</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" id="menu" href="./menu.php"><i class="fas fa-scroll"></i>&nbsp;&nbsp;&nbsp;Notre Menu</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" id="contact" href="./contact.php"><i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Contact</a>
                </li>
                <?php if (isset($_SESSION["AdminLoginId"]) === FALSE) { ?>
                    <li class="nav-item px-2">
                        <a class="nav-link btn btn-login" id="login" href="./login.php">Se connecter</a>
                    </li>
                <?php } else { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mon Compte
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" id="settings" href="./settings.php"><i class="fas fa-cog"></i>&nbsp;&nbsp;&nbsp;Paramètres</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" id="logout" href="./logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a></li>
                        </ul>
                    </li>
                    <?php
                    $client = $_SESSION['AdminLoginId'];
                    $sql = "select sum(qte) from panier where client = '$client'";
                    if(!isset(mysqli_fetch_row(mysqli_query($conn, $sql))[0])) $nb = 0;
                    else $nb = mysqli_fetch_row(mysqli_query($conn, $sql))[0];

                    ?>
                    <li class="nav-item px-2" alt="Mon panier">
                        <a class="nav-link position-relative" id="panier" href="./panier.php"><i class="fas fa-shopping-cart"></i><span id="numberCart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $nb ?></span></a>

                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<div class="bg"></div>

<script src="https://kit.fontawesome.com/3c8382cb1c.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<style>


    a.nav-link::before {
        display: none;
    }

    .close {
        background-color: transparent !important;
        border: none;
    }

    .table td,
    .table th {
        text-align: center;
    }
</style>

<script>
    var path = window.location.pathname;
    var page = path.split("/").pop().split('.')[0];

    if(document.getElementById(page)){
    document.getElementById(page).classList.add("active");
    }
    //  if(location.href == '')
</script>