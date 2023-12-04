<?php
session_start();  // Toujours commencer la session sur chaque page qui utilise les sessions

// Détruire toutes les données de session
$_SESSION = array();
unset($_SESSION["loggedin"]);
unset($_SESSION["username"]);

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion par exemple
header("location: ..\..\index.php");
echo("fdsfds")
exit();
?>
