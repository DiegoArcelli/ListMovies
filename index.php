<html>
	<head>
		<title>Home</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
			#foto img {
				margin-left: 15px;
			}
			body {
              background-color: #3a3f47
              color: white;
      		}
					#cont {
							width: 60%;
					}
            @media only screen and (max-width: 750px) {
                #cont {
                    width: 100%;
                }
                #immagini, #myCarousel {
                	display: none;
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
			<div id="cont">
			<h3>ListMovies</h3>
			<p>ListMoivies is a website created for cinema passionates who want to keep track of the films they watch. In a very
			simple and intuitive way, users can create an account on the website, search for the films they watched and add them
			to a list. Users can also give a personal score to the varius film, in this way users can suggest to each other the
		 	best film to watch indirectly. In fact the main goal of the page is create a commuity where user can share opinions
			about the films and search for the most appreciated movies.</p>
			<center id="immagini">
				<div id="foto" style="padding: 10px;">
					<img id="fotine" height="300" src="https://kapodaco.files.wordpress.com/2017/03/shining-5.jpg">
					<img id="fotine" height="300" src="https://images-na.ssl-images-amazon.com/images/I/41VXPrZfDXL.jpg">
					<img id="fotine" height="300" src="https://imgc.allpostersimages.com/img/posters/a-clockwork-orange-a-stanley-kubrick-movie_u-L-F8SZ2S0.jpg?src=gp&w=300&h=375">
				</div>
                <span>« If it can be written, or thought, it can be filmed »</span><br><span>( Stanley Kubrick )</span><br>
			</center>
			<p><br>In order to incentivate the opinion sharing users can write comments in each film information box. They can
			write short review about the film or just give a presonal impression. In this way users can communicate directly and share
            detailed opinions. If you want know more precisely how the site works and which possibilities it offers click on the
            home field on the navigation bar and than click again in the How To field.</p>
			<center id="immagini"><img style="padding-bottom: 20px" width="600" src="https://www.factinate.com/wp-content/uploads/2017/01/Feature-Image-2-Edited.jpg"><p>« Run, Forrest, Run! »</p></center>
		</div>
	</body>
</html>
