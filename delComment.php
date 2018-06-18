<?php
  $user = 'listmovies';
  $pas = '';
  $col = 'mysql:host=localhost;dbname=my_listmovies';
  $db = new PDO($col, $user, $pass);
  session_start();
  $id = $_GET["id"];
  $sql = $db->prepare("DELETE FROM Commenti WHERE id_commento = $id");
  $sql->execute();
  header("Location: scheda.php?id=" . $_SESSION["film"]);
?>
