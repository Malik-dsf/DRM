<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("include/styles_link.php"); ?>
</head>
<body>

<nav class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <a href="index.php" ><img class="img_nav" src="media_back\LogoSwissPharma.png" alt="logo"></a>
    <a href="index.php">Menu</a>
    <a href="suivie_facture.php">Mes Notes de Frais</a>

    <?php
        session_start();
        $username = $_SESSION["username"];
        $requete = $connexion->prepare("SELECT u.idroles, r.libelle FROM utilisateur u JOIN roles r ON u.idroles = r.id_role WHERE u.nom_user=:username");
        $requete->bindValue(':username', $username, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $role = $resultat['libelle'];
        if($role == "Comptable" || $role == "Administrateur"){
            echo('<a href="gestion_ndf.php">gérer les notes de Frais</a>');
        }
    ?>

    <a href="saisie_frais.php">Nouvelles Saisies</a>
    <a href="include\deconnexion.php">Déconnexion</a>

</nav>

    
</body>
</html>