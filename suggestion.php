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
			#main {
				background-color:rgba(0, 0, 0, 0.5);
				display: inline-block;
        		margin: 30px;
			}
			#main img {
				width: 200px;
			}
			#main h3 {
				padding: 10px;
                width: 300px;
                color: white;
			}
			#main button {
				margin: 20px;
			}
            @media only screen and (max-width: 750px) {
                #cont {
                    width: 100%;
                }
                #main {
                  background-color:rgba(0, 0, 0, 0.5);
                  display: inline-block;
                  margin: 10px;
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
        	<form action="" method="POST" style="margin-left: 5%;">
            <h3>Suggestions</h3>
        	<?php
                $user = 'listmovies';
                $pas = '';
                $col = 'mysql:host=localhost;dbname=my_listmovies';
                $db = new PDO($col, $user, $pass);
                $sql = "SELECT * FROM Film";
                $gen = array("Not specified");
                $s = [];
                $cont = 0;
                foreach($db->query($sql) as $row){
                	$s = explode(",",$row["genere"]);
                    for($i=0;$i<count($s);$i++){
                    	$s[$i] = str_replace(' ', '', $s[$i]);
                        $cont = 0; 
                        for($j=0;$j<count($gen);$j++){
                        	if(strcmp($s[$i],$gen[$j])==0){
                            	$cont++;
                            }
                        }
                        if($cont == 0){
                        	$gen[] = $s[$i];
                        }
                    }
                }
                echo "Select film genre: <select name='genere'  class='form-control' style='width: auto;'>";
                for($x=0;$x<count($gen);$x++){
                	echo "<option value='" . $gen[$x] . "'>" . $gen[$x] . "</option>";
                }
                echo "</select>";
                
                $sql = "SELECT * FROM Film GROUP BY regista";
                $gen = array("Not specified");
                $s = [];
                $cont = 0;
                foreach($db->query($sql) as $row){
                	$s = explode(",",$row["regista"]);
                    for($i=0;$i<count($s);$i++){

                        $cont = 0; 
                        for($j=0;$j<count($gen);$j++){
                        	if(strcmp($s[$i],$gen[$j])==0){
                            	$cont++;
                            }
                        }
                        if($cont == 0){
                        	$gen[] = $s[$i];
                        }
                    }
                }
                echo "<br>Select film director: <select name='director' class='form-control' style='width: auto;'>";
                for($x=0;$x<count($gen);$x++){
                	echo "<option value='" . $gen[$x] . "'>" . $gen[$x] . "</option>";
                }
                echo "</select>";                
                
            ?>
			  <br><button type="submit" class="btn btn-primary" value="Search">Submit</button>
            </form>
            <center>
            <?php
            	if(isset($_POST["genere"])){
                	$genere = $_POST["genere"];
                    $regista = $_POST["director"];
                    if(strcmp($regista,"Not specified")==0){
                 		$regista = "%%";
                    } else {
                    	$regista = "%" . $regista . "%";
                    }
                    if(strcmp($genere,"Not specified")==0){
                 		$genere = "%%";
                    } else {
                    	$genere = "%" . $genere . "%";
                    }
            		$sql = "SELECT cover,id_film,titolo,AVG(grade) as media FROM Film INNER JOIN FilmVisti ON Film.id = FilmVisti.id_film WHERE genere LIKE '$genere' AND regista LIKE '$regista' GROUP BY id_film ORDER BY media DESC";
                    foreach($db->query($sql) as $row){
                        echo '<div id="main"><center><a href="scheda.php?id=' . $row["id_film"] . '"><h3 align="center">' . $row["titolo"] . '</h3><img style="padding-bottom: 50px;" src="' . $row["cover"] . '"></a></center></div>';
                    }
                }
            ?>
            </center>
		</div>
	</body>
</html>