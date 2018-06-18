<html>
	<head>
		<title>Search</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<link rel="stylesheet" type="text/css" href="CSS/stile.css">
		<style>
			input[type=text] {
					margin: 30px;
                    height: 50px;
					width: 50%;
					box-sizing: border-box;
					border: 2px solid #ccc;
					border-radius: 4px;
					font-size: 16px;
					background-color: white;
					background-image: url('https://cdn1.iconfinder.com/data/icons/hawcons/32/698627-icon-111-search-512.png');
					background-position: 10px 10px;
					background-repeat: no-repeat;
					padding: 12px 20px 12px 40px;
					-webkit-transition: width 0.4s ease-in-out;
					transition: width 0.4s ease-in-out;
					color: grey;
			}
			#search {
				height: 50px;
        		width: 51px;
                bottom: 1.5px;
                position: relative;
                border-radius: 0px 5px 5px 0px;
                right: 35;
			}
			#main {
				background-color:rgba(0, 0, 0, 0.5);
				display: inline-block;
				border-radius: 30px;
				padding: 10px;
                margin: 30px;
			}
			#main img {
				width: 200px;
                height: 283px;
			}
			#main h3 {
				padding: 10px;
                width: 300px;
                color: black;
			}
			#main button {
				margin: 20px;
			}
            #link {
            	color: white;
                text-decoration: none;
            }
            @media only screen and (max-width: 750px) {
                #cont {
                    width: 100%;
                }
                #area {
            		margin-left: 0%;
            	}
                input[type=text] {
                        height: 50px;
                        width: 70%;
                        margin: 0px;
                        margin-left: 5%;
                        box-sizing: border-box;
                        border: 2px solid #ccc;
                        border-radius: 4px;
                        font-size: 16px;
                        background-color: white;
                        background-image: url('https://cdn1.iconfinder.com/data/icons/hawcons/32/698627-icon-111-search-512.png');
                        background-position: 10px 10px;
                        background-repeat: no-repeat;
                        -webkit-transition: width 0.4s ease-in-out;
                        transition: width 0.4s ease-in-out;
                        color: grey;
                }
                #search {
                    height: 50px;
                    width: 51px;
                    bottom: 1.5px;
                    position: relative;
                    border-radius: 0px 5px 5px 0px;
                    right: 35;
                }
                #main {
                  background-color:rgba(0, 0, 0, 0.5);
                  display: inline-block;
                  margin: 10px;
				}
            }
		</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        	<center>
        	<form action="" method="POST">
				<div style="margin-left: 8%;"><input type="text" name="user" placeholder="Search..." id="key"><button style="margin-right: 8%" id="search" type="submit" class="btn btn-danger" onclick="search()"><span class="glyphicon glyphicon-search"></span></button></div>
            </form>
            <br>
            <div style="margin-left: 20%; margin-right: 20%; ">
            <?php
            	if(isset($_POST["user"])){
                    $user = 'listmovies';
                    $pas = '';
                    $col = 'mysql:host=localhost;dbname=my_listmovies';
                    $db = new PDO($col, $user, $pass);
                    $nome = $_POST["user"];
                  	$sql = "SELECT * FROM dati WHERE nome LIKE '%$nome%' AND confirmed = 1";
                    foreach($db->query($sql) as $row){
                    	echo "<div style='display: inline-block; margin-left: 10px; margin-right: 10px;'><a id='link' href='user_profile.php?id=" . $row["id"] . "'><div style='background-size: cover; width: 200px; height: 200px; background-image: url(" . $row["image"] . ");'></div><h5>" . $row["nome"] . "</h5></div></a>";
                    }
                }
            ?>
            </div>
            </center>
		</div>
	</body>
</html>
