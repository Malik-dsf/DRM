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
    echo "PROBLEME DE CONNECTION A LA BDD!!!!";
}

?>
