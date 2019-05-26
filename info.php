<?php
session_start();
if (isset($_SESSION["name"]) == false && $_SESSION["logged"] == false) {
    header("Location: login.php");
}
?>
<html>
    <head>
        <title>Information</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="icon" href="https://d30y9cdsu7xlg0.cloudfront.net/png/2385-200.png">    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
        <link rel="stylesheet" type="text/css" href="CSS/stile.css">
        <style>
            #form input, #form textarea {
                width: 80%;
            }
            #form {
                margin-left: 20%;
                margin-right: 20%;
            }
            @media only screen and (max-width: 720px) {
                #cont {
                    width: 100%;
                }
                #form input, #form textarea {
                    width: 95%;
                }
                #form {
                    margin-left: 5%;
                    margin-right: 5%;
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

        <?php
        $user = 'listmovies';
        $pas = '';
        $col = 'mysql:host=localhost;dbname=my_listmovies';
        $db = new PDO($col, $user, $pass);
        $id = $_SESSION["id"];
        $sql = "SELECT name,surname,description,birth FROM dati WHERE id = $id";
        foreach ($db->query($sql) as $row) {
            $name = $row["name"];
            $surname = $row["surname"];
            $descr = $row["description"];
            $birth = $row["birth"];
        }
        ?>

        <div class="container" id="cont">
            <form method="POST" action="addInfo.php" id="form">
                <h3>Insert personal data:</h3>
                <div class="form-group">
                    <label for="exampleInputEmail1">Insert your name:</label>
                    <input value="<?php echo $name ?>" name="name" type="text" class="form-control" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Insert your surname:</label>
                    <input value="<?php echo $surname ?>" name="surname" type="text" class="form-control" placeholder="Enter surname">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Insert your birthdate:</label>
                    <input value="<?php echo $birth ?>" name="date" type="date" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="comment">Add description:</label>
                    <textarea name="descr" class="form-control" rows="5" id="comment" maxlength="250"><?php echo $descr ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <br><br>
            <form method="POST" action="changePassword.php" id="form">
                <h3>Change password:</h3>
                <div class="form-group">
                    <label for="exampleInputPassword1">Insert old password:</label>
                    <input name="old" type="password" class="form-control" placeholder="Insert old password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Insert new password:</label>
                    <input name="new" type="password" class="form-control" placeholder="Insert new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <br><br>
            <form method="POST" action="setImage.php" id="form">
                <h3>Change profile picture:</h3>
                <div class="form-group">
                    <label for="exampleInputPassword1">Insert image URL:</label>
                    <input type="text" class="form-control" placeholder="Enter URL" id="url"><br>
                    <button type="button" class="btn btn-primary" onclick="visualizza()">Preview</button><br><br>
                    <div id="anteprima"></div>
                    <span id="invia"></span>
                </div>
            </form>
            <script>
                function visualizza() {
                    $(document).ready(function () {
                        var x = document.getElementById("url").value;
                        $("#anteprima").attr("style", "width: 200px; height: 200px; background-size: cover; background-image: url('" + x + "')");
                        document.getElementById("invia").innerHTML = "<br><br><button type='submit' class='btn btn-primary'>Submit</button><br><input style='visibility: hidden;' name='url' readonly type='text' value='" + x + "'>";
                    });
                }
            </script>
            <a id="form" style="color: white;" href="removeAccount.php">Do you want to remove your account?</a>
        </div>
    </body>
</html>
