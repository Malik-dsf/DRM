<?php

require_once ("include\log_bdd.php");
include ('include\theme.php');
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}

$messageBienvenue = "<h2>Bienvenue sur votre tableau de bord </h2>" . $_SESSION["username"] . "!";

?>


<!DOCTYPE html>
<html>
	<head>
		<title>AppliFrais</title>
    </head>

    <body>
      <div class="planche_p">
        

      </div>
      <div class="dashboard-container">

      <?php
        
        echo($messageBienvenue);
      ?>

        <div class="">
        <h3>Liste des Frais de Notes</h3>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="suivie_facture.php">inspecter</td>
                    <td>JJ-MM-YYYY</td>
                    <td>Frais de repas</td>
                    <td>0.00 EUR</td>
                </tr>
                
                <!-- Ajoute d'autres lignes de frais de notes ici -->
            </tbody>

        </div>

        
        </table>

    </div>

    </div>
    </body>
</html>