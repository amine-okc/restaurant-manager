<?php
include("dbconn.php");
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    echo "<script>location.href = './login.php'</script>";
}
?>



<!--- INTERFACE START --->

<!DOCTYPE HTML>
<html>

<head>
    <title>Se connecter - Restaurant L'Etoile</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <?php include("./navbar.php") ?><br><br><br>
    <br><br><br><br>
    <br><br><br>



    </div>
</body>

</html>





<!--- INTERFACE END --->






<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: login.php");
}

?>