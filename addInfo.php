<?php
  $user = 'listmovies';
  $pas = '';
  $col = 'mysql:host=localhost;dbname=my_listmovies';
  $db = new PDO($col, $user, $pass);
  session_start();
  $nome = $_POST["name"];
  $surname = $_POST["surname"];
  $date = $_POST["date"];
  $descr = $_POST["descr"];
  $id = $_SESSION["id"];
  $sql = "UPDATE dati SET name='$nome', surname='$surname', birth='$date', description='$descr' WHERE id = $id";
  $q = $db->prepare($sql);
  $q->execute();
  header("Location: profilo.php");
?>
