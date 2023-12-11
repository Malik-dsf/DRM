<?php
  include("Backend_AppliFrais\include\log_bdd.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - DRM</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="media/LogoSwissPharma.png" type="image/x-icon">
  <?php
  include("Backend_AppliFrais/include/bootstrap_link.php");
  ?>
</head>

<body>
  <div class="Accueil d-flex justify-content-center align-items-center">
    <div class="d-flex flex-column justify-content-center align-items-center">
      <img id="img_main" src="media/LogoSwissPharma.png" alt="Image de présentation">
      <span id="btnAbsoluteAcc" class="btn btn-outline-light">A propo de nous</span>
    </div>

    <div class="form login-container">
      <div class="login-form">
        <h5 class="card-title text-center">Bienvenue sur SwissPharma</h5>

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        //zone SQL
        $requete = $connexion->prepare("SELECT nom_user, motDePasse FROM utilisateur  WHERE nom_user=:username AND motDePasse=:passwords");
        $requete->bindValue(':username', $username, PDO::PARAM_STR);
        $requete->bindValue(':passwords', $password ,PDO::PARAM_STR);
        $requete->execute();

        // Vérification des informations d'authentification (en dur pour l'exemple)
        if ($requete->rowCount() > 0) {
          // Authentification réussie
          session_start();  // Démarre une nouvelle session ou reprend la session existante
          echo "Connexion réussie !";
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;
          header("Location: backend_AppliFrais/index.php");
        } 
        else {
          // Authentification échouée
          echo "<p style='padding:10px; background-color:rgba(255, 117, 117, 0.77); border-radius:6px; margin-bottom:10px;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
          }
        }
      ?>

        <form action="index.php" method="POST">
          <div class="form-group">
              <label for="username">Nom d'utilisateur :</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Entrez votre nom d'utilisateur" required>
          </div>

          <div class="form-group">
              <label for="password">Mot de passe :</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" required>
          </div>

          <button type="submit" name="connexion" class="btn btn-primary btn-block">Se connecter</button>
        </form>
      </div>
    </div>
  </div>




  <?php
  include("Backend_AppliFrais/include/bootstrap_script.php");
  ?>
</body>

</html>