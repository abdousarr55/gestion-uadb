<?php
require "connexion.php";
$titre = "Accueil";
function compter($c, $table) {
    $r = mysqli_query($c, "SELECT COUNT(*) AS n FROM $table");
    return mysqli_fetch_assoc($r)["n"];
}
require "entete.php";
?>
<p>Application de gestion : base <strong>uadb_cours</strong>, 3 tables.</p>
<table>
  <tr><th>Table</th><th>Enregistrements</th><th>Gérer</th></tr>
  <tr><td>Filières</td><td><?= compter($connexion, "filieres") ?></td><td><a href="filieres.php">Ouvrir</a></td></tr>
  <tr><td>Étudiants</td><td><?= compter($connexion, "etudiants") ?></td><td><a href="etudiants.php">Ouvrir</a></td></tr>
  <tr><td>Matières</td><td><?= compter($connexion, "matieres") ?></td><td><a href="matieres.php">Ouvrir</a></td></tr>
</table>
<?php require "pied.php"; ?>
