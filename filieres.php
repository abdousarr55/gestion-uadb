<?php
include "connexion.php";
include "menu.php";
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_POST["ajouter"]))  mysqli_query($connexion, "INSERT INTO filieres (nom) VALUES ('$_POST[nom]')");
if (isset($_POST["modifier"])) mysqli_query($connexion, "UPDATE filieres SET nom='$_POST[nom]' WHERE id=$_POST[id]");
if (isset($_GET["supprimer"])) mysqli_query($connexion, "DELETE FROM filieres WHERE id=$_GET[supprimer]");

$edit = ["id" => "", "nom" => ""];
if (isset($_GET["modifier"])) $edit = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM filieres WHERE id=$_GET[modifier]"));
$resultat = mysqli_query($connexion, "SELECT * FROM filieres");
?>
<h1>Filières</h1>
<form method="post">
  <input type="hidden" name="id" value="<?= $edit["id"] ?>">
  <input type="text" name="nom" value="<?= $edit["nom"] ?>" required>
  <button name="<?= $edit["id"] ? "modifier" : "ajouter" ?>">Valider</button>
</form>
<table border="1">
<?php while ($f = mysqli_fetch_assoc($resultat)) { ?>
  <tr>
    <td><?= $f["id"] ?></td><td><?= $f["nom"] ?></td>
    <td><a href="?modifier=<?= $f["id"] ?>">Modifier</a> | <a href="?supprimer=<?= $f["id"] ?>">Supprimer</a></td>
  </tr>
<?php } ?>
</table>
