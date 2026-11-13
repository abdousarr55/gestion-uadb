<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $titre ?> - Gestion UADB</title>
<style>
  body{font-family:Arial,sans-serif;margin:0;background:#f4f6f8;color:#222}
  nav{background:#1f4e79;padding:12px}
  nav a{color:#fff;text-decoration:none;margin-right:18px;font-weight:bold}
  main{max-width:900px;margin:20px auto;padding:0 12px}
  table{width:100%;border-collapse:collapse;background:#fff;margin-top:15px}
  th,td{border:1px solid #ccc;padding:8px;text-align:left}
  th{background:#e3ecf5}
  form{background:#fff;padding:12px;border:1px solid #ccc}
  input,select,button{padding:7px;margin:4px 4px 4px 0}
  button{background:#1f4e79;color:#fff;border:0;cursor:pointer}
  .msg{background:#dff0d8;padding:10px;border:1px solid #b6d7a8}
  .sup{color:#b00020}
</style>
</head>
<body>
<nav>
  <a href="index.php">Accueil</a>
  <a href="filieres.php">Filières</a>
  <a href="etudiants.php">Étudiants</a>
  <a href="matieres.php">Matières</a>
</nav>
<main>
<h1><?= $titre ?></h1>
<?php if (!empty($_GET["msg"])) { echo "<p class='msg'>" . htmlspecialchars($_GET["msg"]) . "</p>"; } ?>
