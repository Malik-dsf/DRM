<?php
$hote = "127.0.0.1";
$base = "swisspharma";// nom de la bdd
$user = "root";
$mdp = "";


// connexion a la bdd

try{
    $connexion = new PDO("mysql:host=" . $hote . ";dbname=" . $base, $user, $mdp);
    $connexion->exec('set names utf8');
}
catch(PDOException $e){
    echo "<p Style='position:absolute; background-color:red; color:#fff; padding:10px; border-radius:6px;'>PROBLEME DE CONNECTION A LA BDD!!!!</p>";
}

?>
