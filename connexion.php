<?php
// connexion.php
$serveur       = "localhost";
$utilisateur   = "root";
$motDePasse    = "";   // adapter : vide ("") par défaut sous WampServer
$baseDeDonnees = "uadb_cours";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if (!$connexion) {
    die("Échec de connexion à MySQL : " . mysqli_connect_error());
}
mysqli_set_charset($connexion, "utf8mb4");
?>
