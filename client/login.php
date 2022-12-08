<?php
session_start();
if (isset($_SESSION['AdminLoginId'])) {
  echo "<script>location.href = './index.php'</script>";
}
include("./dbconn.php");

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




  <div class="login-form col-md-6 mx-auto d-flex aligns-items-center justify-content-center">
    <form name="frmContact" method="post" enctype="multipart/form-data" action="./login.php">
      <h2 class="text-center">Connexion</h2>
      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm float-center">Nom d'utilisateur</label>
        <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Nom d'utilisateur..">
        <span class="form-text text-warning" id="errormsg_email" style="display: none;">Aucun compte n'est associé à cet email.</span>
      </div><br>

      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm float-center">Mot de passe</label>
        <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Mot de passe..">
        <span class="form-text text-danger" id="errormsg_pass" style="display: none;">Mot de passe incorrect !</span>


      </div>
      <br>
      <div class="form-group d-flex aligns-items-center justify-content-center"><button type="submit" class="btn btn-primary" name="submit" style="border-radius: 25px;">Se connecter</button></div>
      <br>
      <div class="text-center"><a class="signup" href="./signup.php" style="color: rgb(194, 194, 194)"><span>Nouveau ? Créer un compte</span></a></div>
    </form>
  </div><br>
  <br><br>
</body>

</html>






<!--- INTERFACE END --->



<?php
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $sql = "select mdp, idClient from clients where email = '$email'";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) == 0) {
    echo "<script>document.getElementById('errormsg_email').style.display = 'inline'</script>";
    die();
  }
  $hashed_pass = mysqli_fetch_row($res)[0];
  // echo ($hashed_pass.'<br>');echo (password_hash($pass,PASSWORD_DEFAULT));die();
  if (password_verify($pass, $hashed_pass) === TRUE) {
    $res = mysqli_query($conn, $sql);
    $id = mysqli_fetch_row($res)[1];
    session_start();
    $_SESSION['AdminLoginId'] = $id;

    echo "<script>location.href = './index.php'</script>";
  } else {
    echo "<script>document.getElementById('errormsg_pass').style.display = 'inline'</script>";
  }
}
?>
