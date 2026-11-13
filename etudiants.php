<?php
include "connexion.php";
include "menu.php";
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_POST["ajouter"])) {
    $passe = password_hash($_POST["passe"], PASSWORD_DEFAULT);
    mysqli_query($connexion, "INSERT INTO etudiants (nom, filiere_id, moyenne, passe) VALUES ('$_POST[nom]', $_POST[filiere_id], $_POST[moyenne], '$passe')");
}
if (isset($_POST["modifier"])) mysqli_query($connexion, "UPDATE etudiants SET nom='$_POST[nom]', filiere_id=$_POST[filiere_id], moyenne=$_POST[moyenne] WHERE id=$_POST[id]");
if (isset($_GET["supprimer"])) mysqli_query($connexion, "DELETE FROM etudiants WHERE id=$_GET[supprimer]");

$edit = ["id" => "", "nom" => "", "filiere_id" => "", "moyenne" => ""];
if (isset($_GET["modifier"])) $edit = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM etudiants WHERE id=$_GET[modifier]"));
$filieres = mysqli_query($connexion, "SELECT * FROM filieres");
$resultat = mysqli_query($connexion, "SELECT e.*, f.nom AS filiere FROM etudiants e JOIN filieres f ON e.filiere_id = f.id");
?>
<h1>Étudiants</h1>
<form method="post">
  <input type="hidden" name="id" value="<?= $edit["id"] ?>">
  <input type="text" name="nom" placeholder="Nom" value="<?= $edit["nom"] ?>" required>
  <select name="filiere_id">
    <?php while ($f = mysqli_fetch_assoc($filieres)) { ?>
      <option value="<?= $f["id"] ?>" <?= $f["id"] == $edit["filiere_id"] ? "selected" : "" ?>><?= $f["nom"] ?></option>
    <?php } ?>
  </select>
  <input type="number" step="0.01" name="moyenne" placeholder="Moyenne" value="<?= $edit["moyenne"] ?>" required>
  <?php if (!$edit["id"]) { ?><input type="password" name="passe" placeholder="Mot de passe" required><?php } ?>
  <button name="<?= $edit["id"] ? "modifier" : "ajouter" ?>">Valider</button>
</form>
<table border="1">
<?php while ($e = mysqli_fetch_assoc($resultat)) { ?>
  <tr>
    <td><?= $e["id"] ?></td><td><?= $e["nom"] ?></td><td><?= $e["filiere"] ?></td><td><?= $e["moyenne"] ?></td>
    <td><a href="?modifier=<?= $e["id"] ?>">Modifier</a> | <a href="?supprimer=<?= $e["id"] ?>">Supprimer</a></td>
  </tr>
<?php } ?>
</table>
