<html>
    <head>
        <title>Film Profile</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" href="https://d30y9cdsu7xlg0.cloudfront.net/png/2385-200.png">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
        <link rel="stylesheet" type="text/css" href="CSS/stile.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            #tab td, #tab th {
                padding: 10px;
                vertical-align: text-top;
            }
            #commenti {
                margin-left: 20%;
                margin-right: 20%;
            }
            #com td{
                padding: 5px;
            }
            #tab th {
                background-color: #1F1A29;
            }
            #tab td {
                background-color: #3a3f47;
            }
            #vote {
                margin-top: 30px;
                text-align: center;
            }
            #vote td {
                padding: 10px;
            }
            @media only screen and (max-width: 750px) {
                #cont {
                    width: 100%;
                }
                #info {
                    display: none;
                }
                #commenti {
                    margin-left: 1%;
                    margin-right: 1%;
                }
            }
            @media only screen and (min-width: 751px){
                #tel {
                    display: none;
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
            <script type="text/javascript">
                var id;
                <?php
                    echo "id = '" . $_GET['id'] . "';";
                ?>
                $(document).ready(function () {
                    $.getJSON('https://www.omdbapi.com/?i=' + encodeURI(id) + '&apikey=861be021').then(function (response) {
                        console.log(response);
                        document.getElementById("info").innerHTML = "<table border='1' id='tab'><tr><th>Title</th><th>Director</th><th>Genre</th><th>Year</th><th>Actors</th><th>Plot</th></tr><tr><td>"
                                + response.Title + "</td><td>" + response.Director + "</td><td>" + response.Genre + "</td><td>" + response.Year +
                                "</td><td>" + response.Actors + "</td><td> " + response.Plot + "</td></tr></table>";
                        document.getElementById("head").innerHTML = response.Title + " by " + response.Director;
                        $("#poster").attr("src", response.Poster);
                        document.getElementById("tel").innerHTML = "<table border='1' id='tab'><tr><th>Title:</th></tr><tr><td>" + response.Title +
                                "</td></tr><tr><th>Director:</th></tr><tr><td>" + response.Director + "</td></tr><tr><th>Genre:</th></tr><tr><td>" + response.Genre +
                                "</td></tr><tr><th>Year:</th></tr><tr><td>" + response.Year + "</td></tr><tr><th>Actors:</th></tr><tr><td>" + response.Actors +
                                "</td></tr><tr><th>Plot:</th></tr><tr><td>" + response.Plot + "</td></tr></table>";
                        $("#poster").attr("src", response.Poster);
                    })
                });
            </script>
            <center>
                <form method="POST" action="" id="scheda">
                    <h3 align="center" id="head"></h3>
                    <img src="" id="poster">
                    <div style="margin-top: 20px;" id="info"></div>
                    <div style="margin-top: 20px;" id="tel"></div>
                    <?php
                    $user = 'listmovies';
                    $pas = '';
                    $col = 'mysql:host=localhost;dbname=my_listmovies';
                    $db = new PDO($col, $user, $pass);
                    $id = $_GET["id"];
                    $sql = $db->query("SELECT AVG(grade) AS media FROM FilmVisti WHERE id_film='$id'");
                    $f = $sql->fetch();
                    $result = $f["media"];
                    echo "<table id='vote'><tr><td>Average: " . round($result, 1);
                    $sql = $db->query("SELECT COUNT(id_film) as num FROM Film INNER JOIN FilmVisti ON Film.id = FilmVisti.id_film WHERE id_film = '$id'");
                    $f = $sql->fetch();
                    $result = $f["num"];
                    echo "</td></tr><tr><td>Views: " . $result;
                    $us = $_SESSION["id"];
                    $_SESSION["film"] = $id;
                    if (isset($_SESSION["name"]) && $_SESSION["logged"] == true) {
                        $sql = $db->prepare("SELECT id_film FROM FilmVisti WHERE id_film='$id' AND id_user='$us'");
                        $sql->execute();
                        $cont = $sql->rowCount();
                        if ($cont == 0) {
                            echo "</td></tr><tr><td align='center'>Your score: <select name='score' class='form-control' style='width: auto;'>";
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            echo "</select></td></tr><tr><td><button type='submit' class='btn btn-primary'>ADD</button></td></tr><tr><td></table>";
                        } else {
                            $sql = $db->query("SELECT grade FROM FilmVisti WHERE id_film='$id' AND id_user='$us'");
                            $f = $sql->fetch();
                            $score = $f["grade"];
                            echo "</td></tr><tr><td>Your score: " . $score;
                            echo "</td></tr><tr><td><button type='submit' class='btn btn-danger'>DELETE</button></td></tr></table>";
                        }
                    } else {
                        echo "</td></tr></table><br>";
                    }
                    ?>
                </form>
                <script>
                    var t = "";
                    var g = "";
                    var r = "";
                    var p = "";
                    $(document).ready(function () {
                        $.getJSON('https://www.omdbapi.com/?i=' + encodeURI(id) + '&apikey=861be021').then(function (response) {
                            t = response.Title;
                            g = response.Genre;
                            r = response.Director;
                            p = response.Poster;
                            var res;
                            <?php
                                echo "res = $cont;";
                            ?>
                            if (res == 0) {
                                $("#scheda").attr("action", "addFilm.php?tit=" + t + "&pos=" + p + "&dir=" + r + "&pos=" + p + "&gen=" + g);
                            } else {
                                $("#scheda").attr("action", "delFilm.php");
                            }
                        })
                    });
                </script>
            </center>
            <div id="commenti">
                <?php
                if (isset($_SESSION["name"]) && $_SESSION["logged"] == true) {
                    echo '<form method="POST" action="addComment.php">
            <div class="form-group">
              <label for="exampleInputPassword1">Insert comment:</label>
              <textarea name="comment" class="form-control" rows="5" id="comment" maxlength="250"></textarea>
            </div>
            <button type="Add" class="btn btn-primary">Submit</button>
          </form><br>';
                }
                $sql = "SELECT * FROM dati INNER JOIN Commenti ON dati.id = Commenti.id_user INNER JOIN FilmVisti ON dati.id = FilmVisti.id_user WHERE FilmVisti.id_film = '$id' AND Commenti.id_film = '$id' ORDER BY data DESC";
                foreach ($db->query($sql) as $row) {
                    if (isset($_SESSION["name"]) && $_SESSION["logged"] == true && $_SESSION["id"] == $row["id"]) {
                        echo "<div id='" . $row["id_commento"] . "'><table id='com'><tr><td rowspan='3'><div style='width: 75px; height: 75px; background-image: url(" . $row["image"] . "); background-size: cover;'></div></td><td><span><a style='color: white;' href='user_profile.php?id=" . $row['id_user'] . "'><b>" . $row["nome"] . "</b></a></span></td></tr><tr><td>" . $row["data"] . "</td></tr><tr><td>Score: " . $row["grade"] . "</td></tr><table><div style='margin-left: 5px;'>" . $row["testo"] . "</div></div>
            <a href='delComment.php?id=" . $row["id_commento"] . "'><button style='margin: 3px;' type='button' class='btn btn-danger btn-xs' value='Delete'>Delete</button></a><br><br>";
                    } else {
                        echo "<div id='" . $row["id_commento"] . "'><table id='com'><tr><td rowspan='3'><div style='width: 75px; height: 75px; background-image: url(" . $row["image"] . "); background-size: cover;'></div></td><td><span><a style='color: white;' href='user_profile.php?id=" . $row['id_user'] . "'><b>" . $row["nome"] . "</b></a></span></td></tr><tr><td>" . $row["data"] . "</td></tr><tr><td>Score: " . $row["grade"] . "</td></tr><table><div style='margin-left: 5px;'>" . $row["testo"] . "</div></div><br>";
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
