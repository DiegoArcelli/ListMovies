<?php
session_start();
if (isset($_SESSION["name"]) && $_SESSION["logged"] == true) {
    header("Location: profilo.php");
}
?>
<html>
    <head>
        <title>Confirmation</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="icon" href="https://d30y9cdsu7xlg0.cloudfront.net/png/2385-200.png">    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
        <link rel="stylesheet" type="text/css" href="CSS/stile.css">
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
            <center>
                <br><br>
                <?php
                //connessione al database
                $user = 'listmovies';
                $pas = '';
                $col = 'mysql:host=localhost;dbname=my_listmovies';
                $db = new PDO($col, $user, $pass);

                $code = $_GET['code'];
                $id = $_GET['id'];
                $cont = 0;
                $sql = "SELECT * FROM dati";

                foreach ($db->query($sql) as $row) {
                    if ($row["confiremd_code"] == $code && $row["id"] == $id && $cont == 0) {
                        $q1 = $db->prepare("UPDATE dati SET confirmed=1 WHERE id=:id");
                        $q1->bindParam(":id", $id);
                        $q1->execute();
                        $q2 = $db->prepare("UPDATE dati SET confiremd_code=0 WHERE id=:id");
                        $q2->bindParam(":id", $id);
                        $q2->execute();
                        echo "<h3>Successful confirmation</h3>";
                        $cont = 1;
                    }
                }
                if ($cont == 0) {
                    echo "<h3>Unsuccessful confirmation</h3>";
                }
                ?>
                <br><br><br>
            </center>
        </div>
    </body>
</html>
