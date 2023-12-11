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
    $messageBienvenue = "<h2>Bienvenue sur votre tableau de bord <u>" . $prenom . "</u>!</h2>";
} else {
    // Gérer le cas où aucune donnée n'a été trouvée
    $messageBienvenue = "Aucun utilisateur trouvé pour le nom d'utilisateur : " . $username;
}



if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $messageBienvenue = "error";
} else {
    $messageBienvenue = "<h2>Bienvenue sur votre tableau de bord <u>" . $prenom . "</u>!</h2>";
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>AppliFrais</title>
</head>

<body>
    <div class="planche_p">
        <?php
        echo ($messageBienvenue);
        ?>

    </div>

    </div>
    <div class="dashboard-container">

        <div class="">
            <h3>Mes Information</h3>
            <table>
                <thead>
                    <tr>
                        <th>prénom</th>
                        <th>nom</th>
                        <th>email</th>
                        <th>date d'Embauche</th>
                        <th>role</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <?php
                        echo ("<td>$prenom </td>");
                        echo ("<td>$nom </td>");
                        echo ("<td>$email </td>");
                        echo ("<td>$dateEmbauche </td>");
                        echo ("<td>$role </td>");
                        ?>
                    </tr>

                </tbody>

            </table>

        </div>
    </div>


    <div class="dashboard-container">


        <div class="">
            <h3>Liste de mes Frais de Notes</h3>
            <table>
                <thead>
                    <tr>
                        <th>numéro de Notes de frais</th>
                        <th>Date</th>
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
        echo ('<div class="dashboard-container">
        <div class="">
            <h3>gestion des Utilisateur</h3>
            <table>
                <thead>
                <tr><th>id</th>
                    <th>nom & prénom</th>
                    <th>date Embauche</th>
                    <th>Email</th>
                    <th>numero téléphone</th>
                    <th>nombre de notes affecter</th>
                </tr>
            </thead>
        </div>
        <tbody>');
        $requete = $connexion->prepare("SELECT * FROM utilisateur");
        $requete->execute();
        $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach ($resultats as $resultat){
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
                echo("<td> ".$resultats2['nombre_notes'] ."</td>");
            } else {
                echo("<td> Aucune note de frais trouvée.<td>");
            }
            
            echo("</tr>");
        }
        
        echo ('</tbody></div></table></div>');
    }
    ?>

</body>

</html>