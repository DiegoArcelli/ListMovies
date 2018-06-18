<?php
  $user = 'listmovies';
  $pas = '';
  $col = 'mysql:host=localhost;dbname=my_listmovies';
  $db = new PDO($col, $user, $pass);
  session_start();
  $url = $_POST["url"];
  $id = $_SESSION["id"];
  $sql = "UPDATE dati SET image='$url' WHERE id = $id";
  $q = $db->prepare($sql);
  $q->execute();
  header("Location: profilo.php");
?>
