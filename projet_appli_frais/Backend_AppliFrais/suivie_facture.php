<?php

require_once("include\log_bdd.php"); //connection a la base de données
include('include\theme.php');


$username = $_SESSION["username"];
$requete = $connexion->prepare("SELECT ndf.idnotedefrais, ndf.montant, ndf.date, ndf.idStatus, s.libelle, t.libelle AS type_libelle  FROM note_de_frais ndf JOIN utilisateur u ON ndf.idUtilisateur = u.idUtilisateur JOIN status s ON ndf.idStatus = s.id_status JOIN types t ON ndf.idType = t.id_types  WHERE u.nom_user = :username");
$requete->bindValue(':username', $username, PDO::PARAM_STR);
$requete->execute();
$resultat = $requete->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Note de Frais</title>
</head>

<body>
    <h1 class="h1_ndf">Note de Frais</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID Note de Frais</th>
                <th>Montant</th>
                <th>Date</th>
                <th>type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($resultat) {
                echo "<tr>";
                echo "<td>{$resultat['idnotedefrais']}</td>";
                echo "<td>{$resultat['montant']}€</td>";
                echo "<td>{$resultat['date']}</td>";
                echo "<td>{$resultat['type_libelle']}</td>";
                echo "<td>{$resultat['libelle']}</td>";
                echo "</tr>";

                $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            }

            ?>
        </tbody>
    </table>
</body>

</html>