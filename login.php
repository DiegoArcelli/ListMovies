<?php
session_start();
if (isset($_SESSION["name"]) && $_SESSION["logged"] == true) {
    header("Location: profilo.php");
}
?>
<html>
    <head>
        <title>Home</title>
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
            <form method="POST" action="" style="padding-left: 20%; padding-right: 20%;" id="sign">
                <h3>Login</h3>
                <div class="form-group">
                    <label for="exampleInputEmail1">Insert email address:</label>
                    <input name="mail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Insert password:</label>
                    <input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br><br>
                <br><br>
                <?php
                if (isset($_POST["pass"])) {

                    $pass = $_POST['pass'];
                    $mail = $_POST['mail'];

                    $user = 'listmovies';
                    $pas = '';
                    $col = 'mysql:host=localhost;dbname=my_listmovies';
                    $db = new PDO($col, $user, $pass);

                    $sql = "SELECT * FROM dati";
                    $cont = 0;

                    foreach ($db->query($sql) as $row) {
                        if ($row['email'] == $mail && password_verify($pass, $row["password"]) == 1 && $row["confirmed"] == 1) {
                            echo "Login effettuato con successo";
                            $cont = 1;
                            session_start();
                            $_SESSION["logged"] = true;
                            $_SESSION["name"] = $row["nome"];
                            $_SESSION["id"] = $row["id"];
                            header("Location: profilo.php");
                        }
                    }
                    if ($cont == 0) {
                        echo "Login errato";
                        $_SESSION["logged"] = false;
                        $_SESSION["name"] = null;
                    }
                }
                ?>
            </form>
            <a style="padding-left: 20%; color: white;" href="recover.php">Have you forgotten your password?</a>
        </div>
    </body>
</html>
