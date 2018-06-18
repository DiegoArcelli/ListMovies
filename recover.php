<html>
	<head>
		<title>Home</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<link rel="stylesheet" type="text/css" href="CSS/stile.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            @media only screen and (max-width: 750px) {
                #cont {
                    width: 100%;
                }
            }
        </style>
	</head>
    <body>
    <nav class="navbar navbar-inverse"  style="border-radius: 0px; border: none; z-index: 1;">
        <div class="class="container-fluid>
          <div class="navbar-header">
              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a href="index.php" class="navbar-brand">ListMovies</a>
          </div>
          <div id="navbarCollapse" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">Home<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="index.php">Main Page</a></li>
                          <li><a href="howto.php">How To</a></li>
                          <li><a href="whoweare.php">Why</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">Search<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="search.php">Film</a></li>
                          <li><a href="suggestion.php">Suggestions</a></li>
                          <li><a href="search_user.php">User</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">Suggestions<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="bestFilm.php">Highest Score</a></li>
                          <li><a href="mostFilm.php">Most Seen</a></li>
                      </ul>
                  </li>
              </ul>
			  <?php
            	session_start();
				if(isset($_SESSION["name"]) && $_SESSION["logged"]==true){
                  echo "
                  <ul class='nav navbar-nav navbar-right' id='element'>
                  <li><a href='profilo.php'><span class='glyphicon glyphicon-user'></span> Profile</a></li>
                  <li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
                  </ul>";
                } else {
                  echo "
                  <ul class='nav navbar-nav navbar-right' id='element'>
                  <li><a href='register.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                  <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
                  </ul>";
				}
			   ?>
          </div>
        </div>
    </nav>
		<div class="container" id="cont">
			<form method="POST" action="" style="padding-left: 20%; padding-right: 20%;" id="sign">
            	<h3>Password Recovery</h3>
				<div class="form-group">
			    <label for="exampleInputEmail1">Insert email address:</label>
			    <input name="mail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Insert username:</label>
			    <input name="user" type="text" class="form-control" id="exampleInputPassword1" placeholder="Username">
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			<br><br>
			<?php

				if(isset($_POST["user"])){

                    $name = $_POST["user"];
                    $email = $_POST["mail"];

                    $user = 'listmovies';
                    $pas = '';
                    $col = 'mysql:host=localhost;dbname=my_listmovies';
                    $db = new PDO($col, $user, $pass);
                	$sql = "SELECT * FROM dati WHERE confirmed = 1";
                    $cont = 0;
                    foreach($db->query($sql) as $row){
                    	if(strcmp($row["email"],$email)==0 && strcmp($row["nome"],$name)==0){
                        	$cont = 1;
                            $id = $row["id"];
                        }
                    }
                    if($cont == 1){
                    	$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $lower = "abcdefghijklmnopqrstuvwxyz";
                        $numb = "0123456789";
                        $pass = "";
                        for($i=0;$i<10;$i++){
                        	if($i < 3){
                            	$x = rand(0,25);
                                $pass = $pass . $upper[$x];
                            } else if($i >= 3 && $i < 8){
                            	$x = rand(0,25);
                                $pass = $pass . $lower[$x];
                            } else {
                                $x = rand(0,9);
                                $pass = $pass . $numb[$x];
                            }
                            
                        }
                        echo $pass . $id;
                        $passc = password_hash($pass, PASSWORD_DEFAULT);
                        echo $passc . $id;
                        $q = $db->prepare("UPDATE dati SET password = '$passc' WHERE id = $id");
                        $q->execute();
                        
                    	$nome_mittente = "ListMovies";
                        $mail_mittente = "listmovies@gmail.com";
                        $mail_destinatario = $email;
                        $mail_oggetto = "Your new password";
                        $mail_corpo = "Your new password is: " . $pass;

                        $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
                        $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
                        $mail_headers .= "X-Mailer: PHP/" . phpversion();

                        if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers))
                          echo "New password sent to " . $mail_destinatario;
                        else
                          echo "Error";
                    } else {
                    	echo "Not existing user";
                    }
                }
			?>

           </form>
         </div>
	</body>
</html>

