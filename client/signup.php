<?php

include("./dbconn.php");

?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Inscription - Restaurant L'Etoile</title>
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
  <?php include("./navbar.php") ?><br><br><br>
  <br><br><br><br>




  <div class="login-form col-md-6 mx-auto d-flex aligns-items-center justify-content-center">
    <form name="frmContact" method="post" enctype="multipart/form-data" action="./signup.php" onsubmit="return FormValidation()" >
      <h2 class="text-center">Inscription</h2>

      <div class="form-group row d-flex aligns-items-center justify-content-center">
        <div class="col">
          <label for="nom">Nom de famille</label>
          <input type="text" oninput="NameVerify()" class="form-control form-control-sm" id="nom" name="nom" placeholder="Nom de famille...">
        </div>
        <div class="col">
          <label for="prenom">Prénom</label>
          <input type="text" oninput="NameVerify()" class="form-control form-control-sm" id="prenom" name="prenom" placeholder="Prénom...">
        </div>
      </div><br>

      <div class="form-group row d-flex aligns-items-center justify-content-center">
        <div class="col">
          <label for="email">Email</label>
          <input type="email" oninput="EmailVerify()" class="form-control" id="email" name="email" placeholder="Email...">
        </div>
      </div><br>
      <div class="form-group row d-flex aligns-items-center justify-content-center">
        <div class="col">
          <label for="tel">Téléphone</label>
          <input type="tel" oninput="PhoneVerify()" class="form-control" id="tel" name="tel" placeholder="Téléphone..">
        </div>
      </div><br>


      <div class="form-group">
        <label for="date">Date de naissance</label>
        <input oninput="BirthdayVerify()" type="date" class="form-control" id="date" name="date">
      </div><br>


      <div class="form-group row">
        <div class="col">
          <label for="pass">Mot de passe</label>
          <input type="password" class="form-control form-control-sm" name="pass" placeholder="Mot de passe...">
        </div>
        <div class="col">
          <label for="pass">Conf. mdp</label>
          <input type="password" class="form-control form-control-sm"  placeholder="Conf. mot de passe...">
        </div>
      </div><br>
      <div class="form-group d-flex aligns-items-center justify-content-center"><button type="submit" class="btn btn-primary" name="submit" style="border-radius: 25px;">S'inscrire</button></div>
      <br>
      <div class="text-center"><a class="signup" href="./login.php" style="color: rgb(194, 194, 194)"><span>Vous avez un compte ? Se connecter</span></a></div>
    </form>
  </div><br>
  <br><br>
</body>

</html>


<script>
  function NameVerify(){
    nom = document.getElementById("nom");
    prenom = document.getElementById("prenom");
    if(/^[A-Za-z\s]*$/.test(nom.value) == false || nom.value == '')
    {
      nom.style.border = "2px solid red";
      return false;
    }
    else{
      nom.style.border= "2px solid #999999c0";
    }
    if(/^[A-Za-z\s]*$/.test(prenom.value) == false || prenom.value == '')
    {
      prenom.style.border = "2px solid red";
      return false;
    }    
    else{
      prenom.style.border= "2px solid #999999c0";
      return true;
    }
  }
  
  function BirthdayVerify(){
    birthday = document.getElementById("date");

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd; 

    if(birthday.value > today || birthday.value == '')
    {
      birthday.style.border = "2px solid red";
      return false;
    }
    else{
      birthday.style.border= "2px solid #999999c0";
      return true;
    }
  }

  function PhoneVerify(){
    tel = document.getElementById("tel");
    if(/^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/.test(tel.value) == false || tel.value == '')
    {
      tel.style.border = "2px solid red";
      return false;
    }
    else{
      tel.style.border= "2px solid #999999c0";
      return true;
    }
  }
  function EmailVerify(){
    email = document.getElementById("email");
    if(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email.value) == false || email.value == '')
    {
      email.style.border = "2px solid red";
      return false;
    }
    else{
      email.style.border= "2px solid #999999c0";
      return true;
    }
  }
  function FormValidation(){
    return (EmailVerify() & PhoneVerify() & BirthdayVerify() & NameVerify());
  }
</script>

<?php
if (isset($_POST['submit'])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $dateNaiss = $_POST['date'];
  $tel = $_POST['tel'];
  $email = $_POST['email'];
  $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  $id = uniqid();
  $sql = "insert into clients(idClient,nom,prenom,dateNaiss,email,tel,mdp)VALUES('$id','$nom','$prenom','$dateNaiss','$email','$tel','$pass')";
  if (mysqli_query($conn, $sql) === TRUE) {
    echo "<script>window.alert('Compte enregistré !')</script>";
  } else {
    echo "<script>window.alert('Erreur lors de la création du compte.')</script>";
  }
}
?>