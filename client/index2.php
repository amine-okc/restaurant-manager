

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Commune d'Akfadou - Site Officiel</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400&display=swap" rel="stylesheet">
</head>

<style>
  body{
    font-family: 'Nunito Sans', sans-serif;
  }
</style>

<body style="font-family: 'Nunito Sans', sans-serif;">

    

<br><br><br>
 <!-- write here -->

 <div class="login-form col-md-6 mx-auto">
   <form name="frmContact" method="post" enctype="multipart/form-data" action="" onsubmit="">
        <h2 class="text-center">Session Administrateur</h2>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Nom d'utilisateur</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Nom d'utilisateur..">
          </div>
        </div>
        <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Mot de passe</label>
        <div class="col-sm-10">
          <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Mot de passe..">
          <small class="form-text text-danger" id="errormsg" style="display: none;">Mot de passe incorrect !.</small>
        </div>
      </div>
        <br>
        <div class="form-group"><button type="submit" class="btn btn-primary" name="submit" style="border-radius: 25px;">Se connecter</button></div>
    </form></div><br><br><br>

    <?php
      include("../dbconn.php");
      session_start();
      if (isset($_SESSION['AdminLoginId']))
      {
          header("location: admin_dash.php");
      }
      
      if (isset($_POST["submit"]))
      {
        $username = $_POST["username"];
        $tmp = $_POST["password"];
        $query = "SELECT * FROM `admins` WHERE (`username` = '$username' OR `id` = '$username')";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) == 1)
        {
          $x = mysqli_fetch_array($result);
          if (password_verify($tmp, $x['password']))
          {
            $_SESSION['AdminLoginId'] = $x['function'];
            $_SESSION['username'] = $x['username'];
            $_SESSION['id'] = $x['id'];
            header("location: admin_dash.php");
          }
        }
        else
          echo "<script>alert('Nom d\'utilisateur ou mot de passe incorrect')</script>";
      }
    ?>
  <!-- end -->


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
</body>
    
</html>