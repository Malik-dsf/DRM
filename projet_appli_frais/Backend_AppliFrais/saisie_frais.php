<?php

require_once("include\log_bdd.php"); //connection a la base de données
include ('include\theme.php');
include("include/styles_link.php");
$username = $_SESSION["username"];
$dateduj = date('Y-m-d');
$jour = date('d', strtotime($dateduj));
$mois = date('m', strtotime($dateduj));
$années = date('Y', strtotime($dateduj));
if($jour > 15){
    $mois++;
    if($mois == 12){
        $années++;
        $mois = 1;
    }
}
else{

}
?>


<script>
function ajoutLigne() {
    var container = document.getElementById("ContainerHorsForfait");
    var newRow = container.children[0].cloneNode(true);

    // Effacer les valeurs des champs clonés
    var inputs = newRow.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = "";
    }

    // Ajouter la nouvelle ligne clonée au conteneur
    container.appendChild(newRow);
}

</script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saisie de frais</title>
</head>
<body>
<div class="containerMain tab-content" id="v-pills-tabContent">

        <!-- Formulaire de saisie de frais -->
        <h3 style='font-weight: 900!important; font-size:40px; text-transform:uppercase;'>Saisie de Frais</h3>
        <form action="saisie_frais.php" method="post" class="container mt-5">
            <h4 class="mb-4">Période d'engagement</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mois" class="form-label">Mois :</label>
                    <input type="number" id="mois" name="mois" class="form-control" min="1" max="12" value="<?php echo $mois; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="années" class="form-label">Année :</label>
                    <input type="number" id="années" name="années" class="form-control" min="1900" max="9999" value="<?php echo $années; ?>" required>
                </div>
            </div>

            <h4 class="mb-3">Frais au forfait</h4>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="repmidi" class="form-label">Repas midi :</label>
                    <input type="number" id="repmidi" name="repmidi" class="form-control" step="1" required>
                </div>
                <div class="col-md-3">
                    <label for="nuitee" class="form-label">Nuitées :</label>
                    <input type="number" id="nuitee" name="nuitee" class="form-control" step="1" required>
                </div>
                <div class="col-md-3">
                    <label for="etape" class="form-label">Étape :</label>
                    <input type="number" id="etape" name="etape" class="form-control" step="1" required>
                </div>
                <div class="col-md-3">
                    <label for="km" class="form-label">KM :</label>
                    <input type="number" id="km" name="km" class="form-control" step="0.1" required>
                </div>
            </div>

            <h4 class="mb-3">Hors forfait</h4>
            <div id="ContainerHorsForfait" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="dateM" class="form-label">mois MM :</label>
                        <input type="number" id="dateM" name="dateM[]" class="form-control" min="1" max="12" value="<?php echo $mois; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="dateA" class="form-label">année AAAA:</label>
                        <input type="number" id="dateA" name="dateA[]" class="form-control" min="1900" max="9999" value="<?php echo $années; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="libelle" class="form-label">Libellé :</label>
                        <input type="text" name="libelleHorsForfait[]" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="Qt" class="form-label">Quantité :</label>
                        <input type="number" name="QtHorsForfait[]" class="form-control" step="1" required>
                    </div>
                </div>
            </div>
            <button type="button" onclick="ajoutLigne()" style="background-color:#87CEFA;" class="btn btn-swiss w-25 mb-3">+</button>

            <h4 class="mb-3">Hors Classification</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="justificatif" class="form-label">Nombre de justificatifs :</label>
                    <input type="number" id="justificatif" name="justificatif" class="form-control" step="1" required>
                </div>
                <div class="col-md-6">
                    <label for="MontantT" class="form-label">Montant total :</label>
                    <input type="number" id="MontantT" name="MontantT" class="form-control" step="0.01" required>
                </div>
            </div>

            <div class="d-flex mb-5">
                <button type="submit" class="btn btn-success mr-2">Envoyer</button>
                <button type="reset" class="btn btn-danger ">Annuler</button>
            </div>
        </form>

    </div>
</body>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['mois'], $_POST['années'], $_POST['MontantT'])) {
            $mois = $_POST["mois"];
            $années = $_POST["années"];
            $repmidi = $_POST["repmidi"];
            $nuitee = $_POST["nuitee"];
            $etape = $_POST["etape"];
            $km = $_POST["km"];
            $dateHorsForfaitM = $_POST["dateM"]; // var mois
            $dateHorsForfaitA = $_POST["dateA"]; // var année
            $libelleHorsForfait = $_POST["libelleHorsForfait"];
            $QtHorsForfait = $_POST["QtHorsForfait"];
            $justificatif = $_POST["justificatif"];
            $MontantT = $_POST["MontantT"];

            // Concaténer les dates mois et année si nécessaire
            $dateHorsForfait = array();
            foreach ($dateHorsForfaitM as $key => $value) {
                $dateHorsForfait[] = $value . "-" . $dateHorsForfaitA[$key];
            }
            $dateHorsForfait = implode(", ", $dateHorsForfait);

            // Préparer la requête SQL
            $stmt = $connexion->prepare("INSERT INTO note_de_frais(date, montant, idType, idUtilisateur, idStatus, idFraisForfait, idFraisHorsForfait, Mois, Années) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?)");

            // Liaison des paramètres
            $stmt->bind_param("iiiiiiii", $MontantT, $idType, $idUtilisateur, $idStatus, $idFraisForfait, $idFraisHorsForfait, $mois, $années);
            // Définition des valeurs pour les variables non présentes dans votre code
            $idType = 1; 


            $username = $_SESSION["username"];
            $requete = $connexion->prepare("SELECT idUtilisateur FROM utilisateur WHERE u.nom_user=:username");
            $requete->bindValue(':username', $username, PDO::PARAM_STR);
            $requete->execute();
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $idUtilisateur = $resultat['idUtilisateur'];

            $idStatus = 1; 
            $idFraisForfait = 1; 
            $idFraisHorsForfait = 1;

            // Exécution de la requête
            $stmt->execute();
            $stmt->close();
            
            // Redirection vers la page saisie_frais.php
            header("Location: saisie_frais.php");
            exit();
        }
    }
}



?>


</html>