

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
            <input type="number" id="description" name="repmidi" step="1" required>
            <label for="nuitee">Nuitées :</label>
            <input type="number" id="nuitee" name="description" step="1" required>
            <label for="etape">Etape :</label>
            <input type="number" id="etape" name="description" step="1" required>
            <label for="km">KM :</label>
            <input type="number" id="km" name="description" step="0.1" required>


            <h3>Hors forfait</h3>
            <label for="date">date d'hors forfait :</label>
            <input type="date" id="date" name="date" required>

            <h3>Hors Classification</h3>

            <button type="submit">Envoyer</button>
            
        </form>
    </div>
</body>
</html>