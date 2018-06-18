<?php

  $user = 'listmovies';
  $pas = '';
  $col = 'mysql:host=localhost;dbname=my_listmovies';
  $db = new PDO($col, $user, $pass);
  $old = $_POST["old"];
  $new = $_POST["new"];
  session_start();
  $new = password_hash($new, PASSWORD_DEFAULT);
  $id = $_SESSION["id"];
  $sql = "SELECT * FROM dati WHERE id = $id";
  echo $new;
  foreach($db->query($sql) as $row){
    if(password_verify($old,$row["password"])==1){
      $q = $db->prepare("UPDATE dati SET password = '$new' WHERE id = $id");
      $q->execute();
    } else {
      echo "Error";
    }
  }
  header("Location: info.php")
?>
