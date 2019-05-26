<html>
	<head>
		<title>How To Use</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" href="https://d30y9cdsu7xlg0.cloudfront.net/png/2385-200.png">
    	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<link rel="stylesheet" type="text/css" href="CSS/stile.css">
		<style>
          * {
            font-size: 16px;
          }
			#name {
				color: white;
			}

			#name:hover {
				color: darkred;
			}
            @media only screen and (max-width: 750px) {
                #cont {
                    width: 100%;
                }
                #immagini, #myCarousel {
                	display: none;
                }
            }
			#foto img {
				margin-left: 15px;
			}
			body {
      		background-color: #3a3f47
          color: white;
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
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
              	<ol class="carousel-indicators">
                	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                	<li data-target="#myCarousel" data-slide-to="1"></li>
                	<li data-target="#myCarousel" data-slide-to="2"></li>
              	</ol>
              	<div class="carousel-inner">
                	<div class="item active">
                  		<img src="Foto/slides3.jpg" alt="Taxi Driver" style="width:100%;">
                  		<div class="carousel-caption">
                  	</div>
                </div>

                <div class="item">
                  	<img src="Foto/slides1.jpg" alt="Pulp Fiction" style="width:100%;">
                  	<div class="carousel-caption"></div>
                </div>

                <div class="item">
                  <img src="Foto/slides2.jpg" alt="Il Padrino" style="width:100%;">
                  <div class="carousel-caption"></div>
                </div>

              </div>
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
		<div class="container" id="cont">
			<h3>How To Use</h3>
			<p >Using ListMovies is very simple and intuitive. First you need to get an account, so click on the
            Sign Up icon. Then insert your email address, your user name and your password (the password must contain eight
            characters, one capital letter, one small letter and a number). After that wait
            for the confirmation email (this operation could require some minutes). Once you have received the email open it and click on
            the link to confirm your account. Finally click on the login icon and insert your email address and your
            password to login.<br><br>Now to search for a film click on the search field on the navigation bar and then click on
            the film sub-field. Now insert the title of the film you're searching or a keyword and then click on the search
            button. After a few seconds the site will display a list of the films that correspond with the text entered before.
            Once you have found the right film click on the info button to open the page with the information of the film.<br><br>
            Select a score with the drop down menu and click on the add button to add the film to your list. If you want to
            remove it click on the remove button, otherwise you can also write a comment in the text area on the bottom of the page.
            If you want to see the films with the highest score, click on the suggesion field on the navigation bar, and then
            click on highest score. The site will display a table of the films ordered by the highest average score.
            Do the same operation, but click on most watched, to order the table by the number of users that added the film
            to their personal list.<br><br>
            If you want some suggestions you can click on the search film and then suggestion. With the two drop down menus you can
            select the director or the genre of the film you're searching for. Then click on search to show the list of the films
            that correspond with the parameters you set previously.<br><br>
            If you want to search for a specific user click on the search field, in the navigation bar, and then click on users.
            Then insert in the text field the name of the user and click on the search button to show the results. If the user
            you're searching for is on the list, click on his name or picture to show his profile.<br><br>
            If you want to add information to your profile, click on the profile field in the navigation bar. Then click in the
            gear icon on your profile picture. In the new page you can choose to:
            <ul style="margin-left: 40px;">
            	<li>In the first form, you can insert your name, surname,birth date and a short description of yourself.</li>
                <li>In second form, you can change your password.</li>
                <li>In the third form you can change your profile picture by entering the URL of the image.</li>
            </ul>
            These are the main things you need to know to use the functionalities of the web site.
            <br><br>
		</div>
	</body>
</html>
