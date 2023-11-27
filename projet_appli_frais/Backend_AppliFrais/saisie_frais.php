

<?php


include ('include\theme.php');

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saisie de frais</title>
</head>
<body>
<div class="dashboard-container">

        <!-- Formulaire de saisie de frais -->
        <h3>Saisie de Frais</h3>
        <form action="traitement_saisie_frais.php" method="post">
            <label for="date">periode d'engagement :</label>
            <input type="date" id="date" name="date" required>


        
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
            <label for="date">date d'hors forfait :</label>
            <input type="date" id="date" name="date" required>
            <label for="repmidi">libelle :</label>
            <input type="text" id="libelle" name="libelle" step="1" required>
            
            <h3>Hors Classification</h3>
            <label for="justificatif">nombre de Justificatif :</label>
            <input type="number" id="justificatif" name="justificatif" step="1" required>
            <label for="MontantT">Montant total :</label>
            <input type="number" id="MontantT" name="MontantT" step="0.01" required>

            <button type="submit">Envoyer</button>
            <button type="clear">Annuler</button>

        </form>
    </div>
</body>
</html>