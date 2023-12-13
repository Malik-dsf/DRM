<?php 
 session_start();
 $username = $_SESSION["username"];
 $requete = $connexion->prepare("SELECT u.idroles, r.libelle FROM utilisateur u JOIN roles r ON u.idroles = r.id_role WHERE u.nom_user=:username");
 $requete->bindValue(':username', $username, PDO::PARAM_STR);
 $requete->execute();
 $resultat = $requete->fetch(PDO::FETCH_ASSOC);
 $role = $resultat['libelle'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("include/styles_link.php"); ?>
</head>
<body>

<nav class="nav flex-column justify-content-between ">
    <div class="d-flex flex-column ">
    <div id="userLog" class="d-flex align-items-center"><span style="color:#87CEFA; font-size:34px!important;" class="material-symbols-outlined">account_circle</span><p style="font-size:30px!important;"><?php echo $username; ?></p> </div>
    <a href="index.php"><span class="material-symbols-outlined">window</span>Menu</a>
    <a href="suivie_facture.php"><span class="material-symbols-outlined">description</span>Mes Notes de Frais</a>

    <?php
        if($role == "Comptable" || $role == "Administrateur"){
            echo('<a href="gestion_ndf.php"><span class="material-symbols-outlined">edit_document</span>Gérer les Notes</a>');
        }
    ?>

    <a href="saisie_frais.php"><span class="material-symbols-outlined">note_add</span>Nouvelles Saisies</a>
    </div>
    <a class="justify-self-around " href="include\deconnexion.php" style="color:#87CEFA;"><span  class="material-symbols-outlined">logout</span>Déconnexion</a>

</nav>

    
</body>
</html>