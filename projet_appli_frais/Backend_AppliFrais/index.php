<?php

require_once ("include\log_bdd.php");
include ('include\theme.php');

session_start(); 


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $messageBienvenue = "error";
}
else{
    $messageBienvenue = "<h2>Bienvenue sur votre tableau de bord <u>" . $_SESSION["username"] . "</u>!</h2>";
}


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
                <?php

                    $sql = "SELECT idFrais , date , montant , type  FROM note_de_frais WHERE idUtilisateur = utilisateur.idUtilisateur";
                    $requete = $connexion->prepare($sql);
                    $requete->execute();


                ?>
                <tr>
                    <td><a href="tmp/facture_d.php">inspecter</td>
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