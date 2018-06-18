<?php
  $user = 'listmovies';
  $pas = '';
  $col = 'mysql:host=localhost;dbname=my_listmovies';
  $db = new PDO($col, $user, $pass);
  session_start();
  $user = $_SESSION["id"];
  $film = $_SESSION["film"];
  $sql = $db->prepare("DELETE FROM FilmVisti WHERE id_film = '$film' AND id_user = '$user'");
  $sql->execute();
  $sql2 = $db->prepare("SELECT * FROM FilmVisti WHERE id_film='$film'");
  $sql2->execute();
  $cont = $sql2->rowCount();
  echo $cont;
  if ($cont == 0) {
    $sql3 = $db->prepare("DELETE FROM Film WHERE id = '$film'");
    $sql3->execute();
  }
  header("Location: scheda.php?id=" . $_SESSION["film"]);
?>
