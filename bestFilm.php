<html>
	<head>
		<title>Highest Score</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="icon" href="https://d30y9cdsu7xlg0.cloudfront.net/png/2385-200.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<link rel="stylesheet" type="text/css" href="CSS/stile.css">
		<style>
      #main,#info {
        display: inline-block;
      }
      .tel {
      	display: none;
      }
			#lista img {
				height: 200px;
			}
			#lista {
				margin-top: 50px;
			}
			#lista td, th {
				padding: 10px;
				text-align: center;
			}
			#lista a {
				text-decoration: none;
				color: white;;
			}
			#lista th {
				background-color: #1F1A29;
			}
			#lista td {
				background-color: #3a3f47;
			}
      @media only screen and (max-width: 750px) {
	      #cont {
	        width: 120%;
	      }
          #nav {
          	width: 120%;
          }
	      #lista td, th {
	      	padding: 0px;
	        text-align: center;
	      }
				#lista img {
					height: 80px;
				}
	      .tel {
	        display: block;
	      }
	      .comp {
	        display: none;
	      }
      }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
  <body>
    <nav id="nav" class="navbar navbar-inverse"  style="border-radius: 0px; border: none; z-index: 1;">
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
                          <li><a href="bestFilm.php">By Score</a></li>
                          <li><a href="mostFilm.php">By Views</a></li>
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
        <?php
            $user = 'listmovies';
            $pas = '';
            $col = 'mysql:host=localhost;dbname=my_listmovies';
            $db = new PDO($col, $user, $pass);
        ?>
		<div id="cont">
      <center>
      	<table border = "1" id="lista" class="comp">
          	<tr>
              <th>#</th>
              <th>Poster</th>
              <th>Title</th>
              <th>Genre</th>
              <th>Director</th>
              <th>Score</th>
              <th>Views</th>
							<?php
								$user = 'listmovies';
							  $pas = '';
							  $col = 'mysql:host=localhost;dbname=my_listmovies';
							  $db = new PDO($col, $user, $pass);
								$id = $_SESSION["id"];
                                $cont = 1;
								$sql = "SELECT genere,regista,id_film,cover,titolo,AVG(grade) as media,COUNT(grade) as num FROM Film INNER JOIN FilmVisti ON Film.id = FilmVisti.id_film GROUP BY id_film ORDER BY media DESC, num DESC";
								foreach ($db->query($sql) as $row){
									echo "<tr>";
                                    echo "<td>$cont</td>";
                  					echo "<td><img src='" . $row["cover"] . "'></td>";
                                    echo "<td><a href='scheda.php?id=" . $row["id_film"] . "'>" . $row["titolo"] . "</a></td>";
                                    echo "<td>" . $row["genere"] . "</td>";
                                    echo "<td>" . $row["regista"] . "</td>";
                  					echo "<td>" . round($row["media"],1) . "</td>";
									echo "<td>" . $row["num"] . "</td>";
									echo "<tr>";
                                    $cont++;
								}
							?>
            </tr>
        </table>

      	<table border = "1" id="lista" class="tel">
          	<tr>
              <th>Poster</th>
              <th>Title</th>
              <th>Director</th>
              <th>Score</th>
              <th>Views</th>
							<?php
								$user = 'listmovies';
							  $pas = '';
							  $col = 'mysql:host=localhost;dbname=my_listmovies';
							  $db = new PDO($col, $user, $pass);
								$sql = "SELECT genere,regista,id_film,cover,titolo,AVG(grade) as media,COUNT(grade) as num FROM Film INNER JOIN FilmVisti ON Film.id = FilmVisti.id_film GROUP BY id_film ORDER BY media DESC, num DESC";
								foreach ($db->query($sql) as $row){
									echo "<tr>";
                  					echo "<td><img src='" . $row["cover"] . "'></td>";
                                    echo "<td><a href='scheda.php?id=" . $row["id_film"] . "'>" . $row["titolo"] . "</a></td>";
                                    echo "<td>" . $row["regista"] . "</td>";
                  					echo "<td>" . round($row["media"],1) . "</td>";
									echo "<td>" . $row["num"] . "</td>";
									echo "<tr>";
								}
							?>
            </tr>
        </table>

      </center>
		</div>
	</body>
</html>
