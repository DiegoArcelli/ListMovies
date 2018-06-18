<?php
  $user = 'listmovies';
  $pas = '';
  $col = 'mysql:host=localhost;dbname=my_listmovies';
  $db = new PDO($col, $user, $pass);
  session_start();
  $testo = $_POST["comment"];
  $id = $_SESSION["id"];
  $film = $_SESSION["film"];
  $sql = $db->prepare("INSERT INTO Commenti (id_user,id_film,testo) VALUES (:id,:film,:testo)");
  $sql->bindParam(":film",$film);
  $sql->bindParam(":id",$id);
  $sql->bindParam(":testo",$testo);
  $sql->execute();
  header("Location: scheda.php?id=" . $_SESSION["film"]);
?>
