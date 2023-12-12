<?php

require_once("include\log_bdd.php"); //connection a la base de données
include('include\theme.php');




$username = $_SESSION["username"];
$requete = $connexion->prepare("SELECT u.prenom, u.nom, u.idroles, u.email, u.dateEmbauche, r.libelle FROM utilisateur u JOIN roles r ON u.idroles = r.id_role WHERE u.nom_user=:username");
$requete->bindValue(':username', $username, PDO::PARAM_STR);
$requete->execute();
$resultat = $requete->fetch(PDO::FETCH_ASSOC);
if ($resultat) {
    $prenom = $resultat['prenom'];
    $nom = $resultat['nom'];
    $role = $resultat['libelle'];
    $email = $resultat['email'];
    $dateEmbauche = $resultat['dateEmbauche'];

    // Tu peux maintenant utiliser ces variables comme nécessaire
    $messageBienvenue = "Bienvenue sur votre tableau de bord <u>" . $prenom . "</u>!";
} else {
    // Gérer le cas où aucune donnée n'a été trouvée
    $messageBienvenue = "Aucun utilisateur trouvé pour le nom d'utilisateur : " . $username;
}



if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $messageBienvenue = "error";
} else {
    $messageBienvenue = "<font style='font-weight: 900!important; font-size:40px;'>BIENVENUE</font><br>Voici votre tableau de bord <u><font style='color:#87CEFA;'>" . $prenom . "</font></u>!";
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>AppliFrais</title>
    <?php include("include/styles_link.php"); ?>
</head>

<body>
<div class="containerMain">
    <div class="planche_p">
        <h2 id="messageBienV">
            <?php echo ($messageBienvenue); ?>
        </h2><br><br>
    </div>

    <div class="d-flex align-items-center">
        <?php 
            include("include/img-anim.php");
        ?>
        <div class="">
            <h3>Mes Informations</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Date d'Embauche</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        echo ("<td>$prenom</td>");
                        echo ("<td>$nom</td>");
                        echo ("<td>$email</td>");
                        echo ("<td>$dateEmbauche</td>");
                        echo ("<td>$role</td>");
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
    <div class="my-4">
        <h3>Liste de mes Frais de Notes</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Numéro de Notes de frais</th>
                        <th>Mois - Année</th>
                        <th>Description</th>
                        <th>Montant</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $requete = $connexion->prepare("SELECT ndf.idnotedefrais, ndf.montant, ndf.date, ndf.idStatus, s.libelle , ndf.idType, t.libelle AS type_libelle  FROM note_de_frais ndf JOIN utilisateur u ON ndf.idUtilisateur = u.idUtilisateur JOIN status s ON ndf.idStatus = s.id_status JOIN types t ON ndf.idType = t.id_types WHERE u.nom_user = :username");
                    $requete->bindValue(':username', $username, PDO::PARAM_STR);
                    $requete->execute();
                    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
                    $total = count($resultat);
                    $x = 0;
                    if ($total > 0) {
                        foreach ($resultats as $resultat) {
                            echo("<tr>");
                            echo("<td>{$resultat['idnotedefrais']}</td>");
                            echo("<td>{$resultat['date']}</td>");
                            echo("<td>{$resultat['type_libelle']}</td>");
                            echo("<td>{$resultat['montant']}€</td>");
                            echo("<td>{$resultat['libelle']}</td>");
                            echo("</tr>");
                        }
                    } else {
                        echo("<tr><td colspan='5'>Aucune note de frais trouvée.</td></tr>");
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    if ($role == "Administrateur") {
        echo ('<div class="my-4">
            <h3>Gestion des Utilisateurs</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom & Prénom</th>
                            <th>Date Embauche</th>
                            <th>Email</th>
                            <th>Numéro Téléphone</th>
                            <th>Nombre de Notes Affectées</th>
                        </tr>
                    </thead>
                    <tbody>');
        $requete = $connexion->prepare("SELECT * FROM utilisateur");
        $requete->execute();
        $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultats as $resultat) {
            echo("<tr>");
            echo("<td>{$resultat['idUtilisateur']}</td>");
            echo("<td>{$resultat['nom']} {$resultat['prenom']}</td>");
            echo("<td>{$resultat['dateEmbauche']}</td>");
            echo("<td>{$resultat['email']}</td>");
            echo("<td>{$resultat['numTel']}</td>");
            $requete = $connexion->prepare("SELECT idUtilisateur, COUNT(idnotedefrais) AS nombre_notes FROM note_de_frais WHERE idUtilisateur = :iduser");
            $requete->bindValue(':iduser', $resultat['idUtilisateur'], PDO::PARAM_STR);
            $requete->execute();
            $resultats2 = $requete->fetchAll(PDO::FETCH_ASSOC);
            if (array_key_exists('nombre_notes', $resultats2)) {
                echo("<td> " . $resultats2['nombre_notes'] . "</td>");
            } else {
                echo("<td> Aucune note de frais trouvée.<td>");
            }
            echo("</tr>");
        }
        echo ('</tbody></table></div></div>');
    }
    ?>
</div>


</body>

</html>