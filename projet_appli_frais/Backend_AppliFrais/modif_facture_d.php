<?php
require_once("include\log_bdd.php"); //connection a la base de données
include('include\theme.php');
include("include/styles_link.php");

$username = $_SESSION["username"];

$requete = $connexion->prepare("SELECT u.idroles, r.libelle FROM utilisateur u JOIN roles r ON u.idroles = r.id_role WHERE u.nom_user=:username");
$requete->bindValue(':username', $username, PDO::PARAM_STR);
$requete->execute();
$resultat = $requete->fetch(PDO::FETCH_ASSOC);
$role = $resultat['libelle'];
if ($role != "Comptable" && $role != "Administrateur") {
    echo ("vous n'avez pas accés");
    header("Location: index.php");
    exit();
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que les données du formulaire sont présentes
    if(isset($_POST['idNoteDeFrais'], $_POST['montant'], $_POST['type'], $_POST['status'])) {
        $idNoteDeFrais = $_POST['idNoteDeFrais'];
        $montant = $_POST['montant'];
        $idType = $_POST['type'];
        $idStatus = $_POST['status'];

        // Préparez la requête de mise à jour
        $requeteModification = $connexion->prepare("UPDATE note_de_frais SET montant = :montant, idType = :idType, idStatus = :idStatus WHERE idnotedefrais = :idNoteDeFrais");
        error_log("UPDATE note_de_frais SET montant = :montant, idType = :idType, idStatus = :idStatus WHERE idnotedefrais = :idNoteDeFrais");
        // Liez les valeurs aux paramètres de la requête
        $requeteModification->bindValue(':montant', $montant, PDO::PARAM_STR);
        $requeteModification->bindValue(':idType', $idType, PDO::PARAM_INT);
        $requeteModification->bindValue(':idStatus', $idStatus, PDO::PARAM_INT);
        $requeteModification->bindValue(':idNoteDeFrais', $idNoteDeFrais, PDO::PARAM_INT);

        // Exécutez la requête de mise à jour
        $requeteModification->execute();
        exit();
    }
}
else{
    error_log("test");

}









if (isset($_GET['id'])) {
    // recupère la note de frais
    $idNoteDeFrais = $_GET['id'];
    $requete = $connexion->prepare("SELECT ndf.idnotedefrais , ndf.date, ndf.montant, ndf.idType , ndf.idUtilisateur , ndf.idStatus, s.libelle, t.libelle AS type_libelle  FROM note_de_frais ndf JOIN utilisateur u ON ndf.idUtilisateur = u.idUtilisateur JOIN status s ON ndf.idStatus = s.id_status JOIN types t ON ndf.idType = t.id_types WHERE idnotedefrais = :id");
    $requete->bindValue(':id', $idNoteDeFrais, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirigez l'utilisateur s'il ya pas d'ID
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>note de frais n°<?php echo ($idNoteDeFrais) ?></title>
</head>

<body>
    <div class="container-ndf">
        <h1>Modification de la note de frais n° <?php echo ($idNoteDeFrais) ?></h1>


        <form action="modif_facture_d.php" method="POST">
            <label for="idNoteDeFrais">id :</label>
            <input type="text" id="idNoteDeFrais" name="idNoteDeFrais" value="<?php if(isset($_GET['id'])){echo($_GET['id']);}else{"";}; ?>" disabled="disabled">
            <br>
            <label for="utilisateur">Utilisateur :</label>
            <input type="text" id="utilisateur" name="utilisateur" value="<?php echo $resultat['idUtilisateur']; ?>" disabled="disabled">
            <br>
            <label for="date">Date :</label>
            <input type="text" id="date" name="date" value="<?php echo $resultat['date']; ?>" disabled="disabled">
            <br>
            <label for="montant">Montant :</label>
            <input type="text" id="montant" name="montant" value="<?php echo $resultat['montant']; ?>">
            <br>

            <label for="type">Type :</label>
            <select name="type" id="type">
                <?php
                $requeteTypes = $connexion->prepare("SELECT * FROM types");
                $requeteTypes->execute();

                $listeT = $requeteTypes->fetchAll(PDO::FETCH_ASSOC);
                foreach ($listeT as $type) {
                    $selected = ($type['id_types'] == $resultat['idType']) ? 'selected' : '';
                    echo '<option value="' . $type['id_types'] . '" ' . $selected . '>' . $type['libelle'] . '</option>';
                }
                ?>

            </select>
            <br>
            <label for="status">Status :</label>
            <select name="status" id="status">
                <?php
                $requeteStatus = $connexion->prepare("SELECT * FROM Status");
                $requeteStatus->execute();

                $listeS = $requeteStatus->fetchAll(PDO::FETCH_ASSOC);
                foreach ($listeS as $status) {
                    $selected = ($status['id_status'] == $resultat['idStatus']) ? 'selected' : '';
                    echo '<option value="' . $status['id_status'] . '" ' . $selected . '>' . $status['libelle'] . '</option>';
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Enregistrer les modifications">
        </form>
    </div>

    <?php

    

    ?>

</body>

</html>