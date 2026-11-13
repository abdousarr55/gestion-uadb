<?php
include "connexion.php";
include "menu.php";
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_POST["ajouter"]))  mysqli_query($connexion, "INSERT INTO matieres (intitule, coefficient, filiere_id) VALUES ('$_POST[intitule]', $_POST[coefficient], $_POST[filiere_id])");
if (isset($_POST["modifier"])) mysqli_query($connexion, "UPDATE matieres SET intitule='$_POST[intitule]', coefficient=$_POST[coefficient], filiere_id=$_POST[filiere_id] WHERE id=$_POST[id]");
if (isset($_GET["supprimer"])) mysqli_query($connexion, "DELETE FROM matieres WHERE id=$_GET[supprimer]");

$edit = ["id" => "", "intitule" => "", "coefficient" => "", "filiere_id" => ""];
if (isset($_GET["modifier"])) $edit = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM matieres WHERE id=$_GET[modifier]"));
$filieres = mysqli_query($connexion, "SELECT * FROM filieres");
$resultat = mysqli_query($connexion, "SELECT m.*, f.nom AS filiere FROM matieres m JOIN filieres f ON m.filiere_id = f.id");
?>
<h1>Matières</h1>
<form method="post">
  <input type="hidden" name="id" value="<?= $edit["id"] ?>">
  <input type="text" name="intitule" placeholder="Intitulé" value="<?= $edit["intitule"] ?>" required>
  <input type="number" name="coefficient" placeholder="Coefficient" value="<?= $edit["coefficient"] ?>" required>
  <select name="filiere_id">
    <?php while ($f = mysqli_fetch_assoc($filieres)) { ?>
      <option value="<?= $f["id"] ?>" <?= $f["id"] == $edit["filiere_id"] ? "selected" : "" ?>><?= $f["nom"] ?></option>
    <?php } ?>
  </select>
  <button name="<?= $edit["id"] ? "modifier" : "ajouter" ?>">Valider</button>
</form>
<table border="1">
<?php while ($m = mysqli_fetch_assoc($resultat)) { ?>
  <tr>
    <td><?= $m["id"] ?></td><td><?= $m["intitule"] ?></td><td><?= $m["coefficient"] ?></td><td><?= $m["filiere"] ?></td>
    <td><a href="?modifier=<?= $m["id"] ?>">Modifier</a> | <a href="?supprimer=<?= $m["id"] ?>">Supprimer</a></td>
  </tr>
<?php } ?>
</table>
