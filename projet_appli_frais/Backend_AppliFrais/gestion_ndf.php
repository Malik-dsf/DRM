<?php

require_once("include\log_bdd.php"); //connection a la base de données
include('include\theme.php');
include("include/styles_link.php");


$requete = $connexion->prepare("SELECT u.idroles, r.libelle FROM utilisateur u JOIN roles r ON u.idroles = r.id_role WHERE u.nom_user=:username");
$requete->bindValue(':username', $username, PDO::PARAM_STR);
$requete->execute();
$resultat = $requete->fetch(PDO::FETCH_ASSOC);
$role = $resultat['libelle'];
if ($role != "Comptable" && $role != "Administrateur") {
    echo("vous n'avez pas accés");
    header("Location: index.php");
    exit();
}

$username = $_SESSION["username"];
$requete = $connexion->prepare("SELECT u.prenom, u.nom, u.idroles, u.email, u.dateEmbauche, r.libelle FROM utilisateur u JOIN roles r ON u.idroles = r.id_role WHERE u.nom_user=:username");
$requete->bindValue(':username', $username, PDO::PARAM_STR);
$requete->execute();
$role = $resultat['libelle'];
?>


<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Notes de Frais</title>
</head>
<?php
    $requete = $connexion->prepare("SELECT ndf.idnotedefrais, ndf.montant, ndf.mois, ndf.années, ndf.idStatus, ndf.idUtilisateur, s.libelle, u.prenom, ndf.idType, t.libelle AS type_libelle FROM note_de_frais ndf JOIN utilisateur u ON ndf.idUtilisateur = u.idUtilisateur JOIN status s ON ndf.idStatus = s.id_status JOIN types t ON ndf.idType = t.id_types ORDER BY ndf.idnotedefrais ASC");
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    $total = count($resultat);
?>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>ID Note de Frais</th>
                <th>Montant</th>
                <th>Type</th>
                <th>mois - Annee</th>
                <th>Status</th>
                <th>Affecter</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($resultat) {
                echo "<tr>";
                echo "<td>{$resultat['idnotedefrais']}</td>";
                echo "<td>{$resultat['montant']}€</td>";
                echo "<td>{$resultat['type_libelle']}</td>";
                echo "<td>{$resultat['mois']} - {$resultat['années']}</td>";
                echo "<td>{$resultat['libelle']}</td>";
                echo "<td>{$resultat['prenom']}</td>";
                echo("<td><a href='modif_facture_d.php?id={$resultat['idnotedefrais']}'> modifier</td>");
                echo "</tr>";

                $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            }

            ?>
        </tbody>
    </table>
</body>


</html>