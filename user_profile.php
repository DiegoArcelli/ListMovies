<?php
session_start();
if ($_SESSION["id"] == $_GET["id"]) {
    header("Location: profilo.php");
}
?>
<html>
    <head>
        <title>Profile</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" href="https://d30y9cdsu7xlg0.cloudfront.net/png/2385-200.png">    
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
        <link rel="stylesheet" type="text/css" href="CSS/stile.css">
        <style>
            #main{
                display: inline-block;
            }
            #spost {
                padding-left: 10px;
            }
            .tel  {
                display: none;
            }
            #lista img {
                height: 200px;
            }
            #lista {
                margin-top: 50px;
            }
            #lista td, #lista th {
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
            #data td,th {
                text-align: left;
            }
            #setting {
                font-size: 20px;
                color: white;
                padding: 5px;
                visibility: hidden;
                background-color: rgba(0, 0, 0, 0.5);
                margin-top: -1px;
            }
            #picture:hover span {
                visibility: visible;
            }
            @media only screen and (max-width: 750px) {
                #cont {
                    width: 120%;
                }
                #nav {
                    width: 120%;
                }
                #lista td, #lista th {
                    padding: 0px;
                    text-align: center;
                }
                #lista img {
                    height: 80px;
                }
                .comp {
                    display: none;
                }
                .tel {
                    display: inline;
                    text-align: left;
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
                    if (isset($_SESSION["name"]) && $_SESSION["logged"] == true) {
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
            <?php
            $user = 'listmovies';
            $pas = '';
            $col = 'mysql:host=localhost;dbname=my_listmovies';
            $db = new PDO($col, $user, $pass);
            $id = $_GET["id"];
            $sql = "SELECT * FROM dati WHERE id='$id'";
            $q = $db->prepare($sql);
            $q->execute();
            $res = $q->fetchAll();
            foreach ($res as $row) {
                $user = $row["nome"];
                $nome = $row["name"];
                $sur = $row["surname"];
                $birth = $row["birth"];
                $join = $row["joined"];
                $img = $row["image"];
                $descr = $row["description"];
            }

            $sql = "SELECT  AVG(grade) AS avg, COUNT(id_film) AS num FROM FilmVisti WHERE id_user = $id";
            $q = $db->prepare($sql);
            $q->execute();
            $res = $q->fetchAll();
            foreach ($res as $row) {
                $num = $row["num"];
                $avg = $row["avg"];
            }
            $sql = "SELECT COUNT(id_film) AS fav FROM FilmVisti WHERE id_user = $id AND favourite = 1";
            $q = $db->prepare($sql);
            $q->execute();
            $res = $q->fetchAll();
            foreach ($res as $row) {
                $fav = $row["fav"];
            }
            $sql = "SELECT COUNT(id_commento) AS com FROM Commenti WHERE id_user = $id";
            $q = $db->prepare($sql);
            $q->execute();
            $res = $q->fetchAll();
            foreach ($res as $row) {
                $com = $row["com"];
            }
            ?>

            <h3 align="center"><?php echo $user ?></h3><br>
            <center>
                <table id="data" class="comp">
                    <tr>
                        <td style="padding: 10px;" rowspan="4"><div id="picture" style="width: 200px; height: 200px; background-image: url('<?php echo $img; ?>'); background-size: cover;"></div></td>
                        <th>Name:</th>
                        <td id="spost"><?php
                            if ($nome === NULL) {
                                echo " Not set";
                            } else {
                                echo $nome;
                            }
                            ?></td>
                        <th id="spost">Film watched:</th>
                        <td id="spost"><?php echo $num; ?></td>
                    </tr>
                    <tr>
                        <th>Surname:</th>
                        <td id="spost"><?php
                            if ($sur === NULL) {
                                echo " Not set";
                            } else {
                                echo $sur;
                            }
                            ?></td>
                        <th id="spost">Medium score:</th>
                        <td id="spost"><?php echo round($avg, 2); ?></td>
                    </tr>
                    <tr>
                        <th>Birthday:</th>
                        <td id="spost"><?php
                            if ($birth === NULL) {
                                echo " Not set";
                            } else {
                                echo $birth;
                            }
                            ?></td>
                        <th id="spost">Nickname:</th>
                        <td id="spost"><?php echo $user; ?></td>
                    </tr>
                    <tr>
                        <th>Joined:</th>
                        <td id="spost"><?php
                            $x = explode(" ", $join);
                            echo $x[0];
                            ?></td>
                        <th id="spost">Comments:</th>
                        <td id="spost"><?php echo $com; ?></td>                       
                    </tr>
                    <tr> 
                        <th style="text-align: right; vertical-align: text-top; padding-right: 10px;">Description: </th>
                        <td colspan="4" style="max-width: 500px; padding-left: 10px;"><?php echo $descr; ?></td>
                    </tr>
                </table>
            </center>
            <center>
                <table id="data" class="tel">
                    <tr>
                        <td colspan="2" style="padding-bottom: 10px;"><div id="picture" style="width: 200px; height: 200px; background-image: url('<?php echo $img; ?>'); background-size: cover;"></div></td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td><?php
                            if ($sur === NULL) {
                                echo " Not set";
                            } else {
                                echo $sur;
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <th>Surname:</th>
                        <td><?php
                            if ($nome === NULL) {
                                echo " Not set";
                            } else {
                                echo $nome;
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <th>Birthday:</th>
                        <td><?php
                            if ($birth === NULL) {
                                echo " Not set";
                            } else {
                                echo $birth;
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <th>Joined:</th>
                        <td><?php
                            $x = explode(" ", $join);
                            echo $x[0];
                            ?></td>
                    </tr>
                    <tr>
                        <th>Film watched:</th>
                        <td><?php echo $num; ?></td>
                    </tr>
                    <tr>
                        <th>Medium score:</th>
                        <td><?php echo round($avg, 2); ?></td>
                    </tr>
                    <tr>
                        <th>Nickname:</th>
                        <td><?php echo $user; ?></td>   
                    </tr>
                    <tr>
                        <th>Comments:</th>
                        <td><?php echo $com; ?></td>   
                    </tr>
                    <tr> 
                    </tr>
                </table>
                <br><br>
                <table boder="0" class="tel">
                    <tr>
                        <td><b>Description:</b> <?php echo $descr; ?></td>
                    </tr>
                </table>
            </center>
            <center>
                <table border = "1" id="lista" class="comp">
                    <?php
                    if ($num > 0) {
                        echo "<tr>
                          <th>#</th>
                          <th>Poster</th>
                          <th>Title</th>
                          <th>Score</th>
                          <th>Genre</th>
                          <th>Director</th>
						</tr>";
                    }
                    ?>
                    <?php
                    $user = 'listmovies';
                    $pas = '';
                    $col = 'mysql:host=localhost;dbname=my_listmovies';
                    $db = new PDO($col, $user, $pass);
                    $id = $_GET["id"];
                    $cont = 1;
                    $sql = "SELECT * FROM FilmVisti INNER JOIN Film ON FilmVisti.id_film = Film.id WHERE id_user = $id ORDER BY data_aggiunta DESC";
                    foreach ($db->query($sql) as $row) {
                        echo "<tr>";
                        echo "<td>$cont</td>";
                        echo "<td><img src='" . $row["cover"] . "'></td>";
                        echo "<td><a href='scheda.php?id=" . $row["id_film"] . "'>" . $row["titolo"] . "</td>";
                        echo "<td>" . $row["grade"] . "</td>";
                        echo "<td>" . $row["genere"] . "</td>";
                        echo "<td>" . $row["regista"] . "</td>";
                        echo "<tr>";
                        $cont++;
                    }
                    ?>
                </table>
                <br><br>
                <table border = "1" id="lista" class="tel">
                    <?php
                    if ($num > 0) {
                        echo "<tr>
                          <th>Poster</th>
                          <th>Title</th>
                          <th>Score</th>
                          <th>Genre</th>
                          <th>Director</th>
                      	</tr>";
                    }
                    ?>
                    <?php
                    $user = 'listmovies';
                    $pas = '';
                    $col = 'mysql:host=localhost;dbname=my_listmovies';
                    $db = new PDO($col, $user, $pass);
                    $id = $_GET["id"];
                    $sql = "SELECT * FROM FilmVisti INNER JOIN Film ON FilmVisti.id_film = Film.id WHERE id_user = $id ORDER BY data_aggiunta DESC";
                    foreach ($db->query($sql) as $row) {
                        echo "<tr>";
                        echo "<td><img src='" . $row["cover"] . "'></td>";
                        echo "<td><a href='scheda.php?id=" . $row["id_film"] . "'>" . $row["titolo"] . "</td>";
                        echo "<td>" . $row["grade"] . "</td>";
                        echo "<td>" . $row["genere"] . "</td>";
                        echo "<td>" . $row["regista"] . "</td>";
                        echo "<tr>";
                    }
                    ?>
                </table>
            </center>
        </div>
    </body>
</html>
