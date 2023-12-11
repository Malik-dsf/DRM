<?php

require_once("include\log_bdd.php"); //connection a la base de données
include ('include\theme.php');
include("include/styles_link.php");

$dateduj = date('Y-m-d');
$jour = date('d', strtotime($dateduj));
$mois = date('m', strtotime($dateduj));
$annee = date('Y', strtotime($dateduj));
if($jour > 15){
    $mois++;
    if($mois == 12){
        $annee++;
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
<div class="dashboard-container containerMain">

        <!-- Formulaire de saisie de frais -->
        <h3>Saisie de Frais</h3>
        <form action="traitement_saisie_frais.php" method="post">
            <h2>periode d'engagement</h2>
            <label for="mois">Mois :</label>
            <input type="number" id="mois" name="mois" min="1" max="12" value="<?php echo $mois; ?>" required>
            <label for="annee">Année :</label>
            <input type="number" id="annee" name="annee" min="1900" max="9999" value="<?php echo $annee; ?>" required>


        
            <h3>Frais au forfait</h3>
            <label for="repmidi">repas midi :</label>
            <input type="number" id="repmidi" name="repmidi" step="1" required>
            <label for="nuitee">Nuitées :</label>
            <input type="number" id="nuitee" name="nuitee" step="1" required>
            <label for="etape">Etape :</label>
            <input type="number" id="etape" name="etape" step="1" required>
            <label for="km">KM :</label>
            <input type="number" id="km" name="km" step="0.1" required>


            <h3>Hors forfait</h3>
            <div id="ContainerHorsForfait">
                <div class="ligneHorsForfait">
                    <label for="date">Date d'hors forfait :</label>
                    <input type="date" name="dateHorsForfait[]" required>
                    <label for="libelle">Libellé :</label>
                    <input type="text" name="libelleHorsForfait[]" required>
                    <label for="Qt">Quantité :</label>
                    <input type="number" name="QtHorsForfait[]" step="1" required>
                </div>
            </div>
            <button type="button" onclick="ajoutLigne()">+</button>
            
            <h3>Hors Classification</h3>
            <label for="justificatif">nombre de Justificatif :</label>
            <input type="number" id="justificatif" name="justificatif" step="1" required>
            <label for="MontantT">Montant total :</label>
            <input type="number" id="MontantT" name="MontantT" step="0.01" required>

            <button type="submit">Envoyer</button>
            <button type="reset">Annuler</button>

        </form>
    </div>
</body>
</html>