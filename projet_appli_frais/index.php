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
  include("Backend_AppliFrais/include/styles_link.php");
  ?>
</head>

<body>
  <div class="Accueil d-flex justify-content-center align-items-center">

    <div id="AccRapNav" class="d-flex align-items-center">
        <div id="div1" class="animated-content animate__animated" ></div>
        <div id="div2" class="animated-content animate__animated"></div>
        <div id="div3" class="animated-content animate__animated"></div>
        <div id="div4" class="animated-content animate__animated"></div>
    </div>

      <img id="img_main" src="media/LogoSwissPharma.png" alt="Image de présentation">
   

    <div>
    <div class="form login-container">
        <div class="login-form card">
            <h3 class="card-title text-left" style="font-size:24px;">Bienvenue sur <br><span style="color:#87CEFA; font-size:40px;">SwissPharma</span></h3><br>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                $password = $_POST["password"];

                //zone SQL
                $requete = $connexion->prepare("SELECT nom_user, motDePasse FROM utilisateur  WHERE nom_user=:username AND motDePasse=:passwords");
                $requete->bindValue(':username', $username, PDO::PARAM_STR);
                $requete->bindValue(':passwords', $password, PDO::PARAM_STR);
                $requete->execute();

                // Vérification des informations d'authentification (en dur pour l'exemple)
                if ($requete->rowCount() > 0) {
                    // Authentification réussie
                    session_start();  // Démarre une nouvelle session ou reprend la session existante
                    echo "Connexion réussie !";
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;
                    header("Location: backend_AppliFrais/index.php");
                } else {
                    // Authentification échouée
                    echo "<p style='padding:10px; background-color:rgba(255, 117, 117, 0.77); border-radius:6px; margin-bottom:10px;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
                }
            }
            ?>

                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label class="d-flex align-items-center" for="username"><i class="material-symbols-outlined">account_circle</i> Nom d'utilisateur :</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Entrez votre nom d'utilisateur" required>
                    </div>

                    <div class="form-group">
                        <label class="d-flex align-items-center" for="password"><i class="material-symbols-outlined">lock</i> Mot de passe :</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" required>
                    </div>

                    <button type="submit" name="connexion" class="btn btn-primary btn-block d-flex align-items-center justify-content-center"><span class="material-symbols-outlined">login</span> Se connecter</button>
                </form>
            </div>
        </div>
    </div>
  </div>

      <section id="NavRapSec" class="d-flex flex-column container mb-5">
      <div class="navRapLigne d-flex align-items-center justify-content-between w-100">
        <span class="flex-fill"></span>
        <p class=" ml-2 mr-2">Navigation Rapide</p>
        <span class="flex-fill"></span>
      </div>

      <div id="navRapidAcc" class="d-flex justify-content-around mt-2 mb-5">
        <div class="icon d-flex flex-column align-items-center" onmouseover="showContent('div1')" >
          <i class="material-symbols-outlined">design_services</i>
          <p>Nos services</p>
        </div>
        <div class="icon d-flex flex-column align-items-center" onmouseover="showContent('div2')" >
          <i class="material-symbols-outlined">source_environment</i>
          <p>Apropos de nous</p>
        </div>
        <div class="icon d-flex flex-column align-items-center" onmouseover="showContent('div3')" >
          <i class="material-symbols-outlined">groups</i>
          <p>Notre equipe</p>
        </div>
        <div class="icon d-flex flex-column align-items-center" onmouseover="showContent('div4')" >
          <i class="material-symbols-outlined">home_pin</i>
          <p>Notre emplacement</p>
        </div>
      </div>
    </section>


    <footer class="footer-section">
        <div>
          <p>&copy;<?php echo date('Y'); ?> Swiss Pharma. Tous droits réservés.</p>
        </div>
      </footer>

  <?php
  include("Backend_AppliFrais/include/bootstrap_script.php");
  ?>
</body>

</html>