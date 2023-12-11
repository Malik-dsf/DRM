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
</head>

<body>







  <div id="mainHeader">
    
  <img id="img_main" src="media/LogoSwissPharma.png" alt="Image de présentation">


    <div class="container login-container">
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




  <div class="main-section">
    <!-- Exemple de trois cartes pour la description de l'entreprise -->
    <div class="card">
      <i class="fas fa-tasks"></i>
      <h5 class="card-title">Gestion Complète des Frais</h5>
      <p>
        Notre application offre une solution centralisée pour enregistrer avec précision tous les frais liés à l'activité directe, tels que les déplacements, la restauration et l'hébergement, ainsi que les activités annexes telles que les événements et les conférences.
      </p>
    </div>

    <div class="card">
      <i class="fas fa-calendar-check"></i>
      <h5 class="card-title">Suivi Daté des Opérations</h5>
      <p>
        Nos fonctionnalités avancées incluent un suivi daté des opérations effectuées par le service comptable, couvrant la réception des pièces, la validation des demandes de remboursement, la mise en paiement et le remboursement effectué.
      </p>
    </div>

    <div class="card">
      <i class="fas fa-lock"></i>
      <h5 class="card-title">Accessibilité et Sécurité</h5>
      <p>
        L'environnement de notre application est strictement réservé aux membres autorisés de notre entreprise. Chaque utilisateur doit s'authentifier avant d'accéder au contenu, garantissant ainsi la confidentialité et la sécurité des données. Tous les échanges de données sont cryptés par notre serveur Web, garantissant la sécurité des informations.
      </p>
    </div>
  </div>


  <section class="company-presentation">
    <div class="containerP">
      <div class="presentation-content">
        <div class="presentation-text">
          <h2>Présentation de l'entreprise</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur nulla vel ultricies faucibus. Sed malesuada velit nec tortor euismod condimentum.</p>
          <p>Integer et augue non odio tempor tincidunt. Donec sodales magna vel suscipit cursus. Quisque non efficitur odio. Fusce gravida justo ac quam accumsan, nec tincidunt mi ullamcorper.</p>
        </div>
        <div class="presentation-image">
          <img src="media/pexels-pixabay-257736.jpg" alt="Image de présentation">
        </div>
      </div>
    </div>
  </section>




  <div class="team-section">
    <div class="team-member">
      <img src="media/pexels-allan-mas-5383809.jpg" alt="Membre1">
      <div class="member-info">
        <h3>Malik</h3>
        <p>Description du Membre 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>

    <div class="team-member">
      <img src="media/pexels-allan-mas-5383809.jpg" alt="Membre2">
      <div class="member-info">
        <h3>Radu</h3>
        <p>Description du Membre 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="team-member">
      <img src="media/pexels-allan-mas-5383809.jpg" alt="Membre2">
      <div class="member-info">
        <h3>Davi</h3>
        <p>Description du Membre 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="team-member">
      <img src="media/pexels-allan-mas-5383809.jpg" alt="Membre2">
      <div class="member-info">
        <h3>Ryan</h3>
        <p>Description du Membre 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <!-- Ajoutez plus de membres selon le même modèle -->
  </div>


  <section class="company-location">
    <div class="containerL">
      <div class="location-details">
        <h2>Notre Emplacement</h2>
        <p>123 Rue de l'Entreprise</p>
        <p>Ville, Pays</p>
        <p>Code Postal</p>
        <p>Téléphone: +XX XXX XXX XXX</p>
        <p>Email: contact@entreprise.com</p>
      </div>
      <div class="location-map">
        <!-- Intégrez ici votre carte ou un iframe pour afficher la carte -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.73555550828!2dlongitude!3dlatitude!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDA2JzI5LjciTiAxMjjCsDQ3JzI1LjgiVw!5e0!3m2!1sen!2sus!4v1637823202940!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </section>





  <footer class="footer-section">
    <div>
      <p>&copy; 2023 Votre Entreprise. Tous droits réservés.</p><br>
      <nav>
        <a href="#">Accueil</a>
        <a href="#">À Propos</a>
        <a href="#">Contact</a>
        <!-- Ajoutez d'autres liens selon vos besoins -->
      </nav>
    </div>
  </footer>

</body>

</html>