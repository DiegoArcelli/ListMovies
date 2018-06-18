<?php
  $user = 'listmovies';
  $pas = '';
  $col = 'mysql:host=localhost;dbname=my_listmovies';
  $db = new PDO($col, $user, $pass);
  session_start();
  $user = $_SESSION["id"];
  $film = $_SESSION["film"];
  $score = $_POST["score"];
  $f = 0;
  $sql = $db->prepare("INSERT INTO FilmVisti (id_user,id_film,grade,favourite) VALUES (:user,:film,:score,:fav)");
  $sql->bindParam(":user",$user);
  $sql->bindParam(":film",$film);
  $sql->bindParam(":score",$score);
  $sql->bindParam(":fav",$f);
  $sql->execute();
  $sql2 = $db->prepare("SELECT id FROM Film WHERE id='$film'");
  $sql2->execute();
  $cont = $sql2->rowCount();
  if ($cont == 0) {
    $titolo = $_GET["tit"];
    $poster = $_GET["pos"];
    $director = $_GET["dir"];
    $genre = $_GET["gen"];
    $sql3 = $db->prepare("INSERT INTO Film (id,titolo,cover,genere,regista) VALUES (:film,:titolo,:pos,:gen,:dir)");
    $sql3->bindParam(":film",$film);
    $sql3->bindParam(":titolo",$titolo);
    $sql3->bindParam(":pos",$poster);
    $sql3->bindParam(":gen",$genre);
    $sql3->bindParam(":dir",$director);
    $sql3->execute();
  }
  header("Location: scheda.php?id=" . $_SESSION["film"]);
?>
