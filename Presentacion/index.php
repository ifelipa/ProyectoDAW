<?php
//comprueba que la session este iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//asigna a la variable de sesion el valor de no logueado
$_SESSION['signUp'] = 0;
include_once("../Logica/controllerGoogle.php");
?>
<!DOCTYPE html>
<html lang="en" spellcheck="true">
<head>
    <meta charset="utf-8">
    <title>The Escape</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.ico"/>
    <!-- JQUERY-->
    <script src="https://code.jquery.com/jquery-2.2.3.js"
            integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

    <!-- Fuente Google -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>


    <!-- CSS & JS -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/map_search.js" type="text/javascript" charset="utf-8" async defer></script>
    <script src="js/application.js" type="text/javascript" charset="utf-8" async defer></script>
        
        <!--codigo de google analytics-->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-78158913-1', 'auto');
      ga('send', 'pageview');
    
    </script>
</head>
<body>

<!--MENU-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid ">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#nav-bar-ThEscape">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">The Escape</a>
        </div>

        <div class="collapse navbar-collapse" id="nav-bar-ThEscape">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <b>Login</b>
                        <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="social-buttons">
                                        <!-- INICIA SESION CON FACEBOOK-->
                                        <a id="loginFB" href="../Logica/controllerFB.php" class="btn btn-fb"><i
                                                class="fa fa-facebook"></i> Facebook</a>
                                        <!-- INICIA SESION CON GOOGLE-->

                                        <?php if (isset($authUrl)) { ?>
                                            <a id="loginGo" href="<?php echo $authUrl; ?>" class="btn btn-go"><i
                                                    class="fa fa-google"></i> Google</a>
                                        <?php } ?>
                                    </div>
                                    <label> or </label>

                                    <form action="../Logica/controller.php" class="form" role="form" method="post"
                                          action="login" accept-charset="UTF-8" id="login-nav">
                                        <div class="form-group">
                                            <label class="sr-only" for="username">Username</label>
                                            <input type="text" class="form-control" placeholder="Enter your user"
                                                   name="username" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" class="form-control"
                                                   placeholder="Enter your password" name="password" required>

                                            <div class="help-block text-right">
                                                <a href="" data-toggle="modal" data-target="#forgetpass">Forgot your
                                                    password?</a>
                                            </div>
                                        </div>

                                        <button type="submit" name='boto' value='Log In'
                                                class="btn btn-primary btn-block">Sign in
                                        </button>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name='Recordam'> keep me logged-in
                                            </label>
                                        </div>

                                    </form>
                                </div>
                                <div class="bottom text-center">
                                    <a href="#" data-toggle="modal" data-target="#addUser"><b>New in The Escape?</b></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END MENU -->

<!-- MODAL ADD USER -->
<div id="addUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new User</h4>
            </div>
            <div class="modal-body">
                <form id="createUser" role="form" action="../Logica/controller.php" method="POST">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label" for="add-new-user">Name</label>
                        </div>
                        <div class="info-1 col-md-6">
                            <input class="label-adduser form-control" id="user-name" type="text"
                                   placeholder="Enter your name" name="name" required="required">
                        </div>
                        <div class="col-md-6">
                            <input class="label-adduser form-control" id="user-surname" type="text"
                                   placeholder="Enter your surname" name="surname" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-user">Username</label>
                            <input class="label-adduser form-control" id="user-username" type="text"
                                   placeholder="Enter your user" name="username" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-user">Password</label>
                            <input class="label-adduser form-control" id="user-pass" type="password"
                                   placeholder="Enter your password" name="password" required="required">
                        </div>
                        <div class="col-md-12">
                            <label for="add-new-user">Email</label>
                            <input class="label-adduser form-control" id="user-email" type="email"
                                   placeholder="Enter your email" name="email" required="required">
                        </div>
                        <div class="col-md-8">
                            <label for="add-new-user">Phone Number</label>
                            <input class="label-adduser form-control" id="user-phone" type="text"
                                   placeholder="Enter your phone" name="phone" required="required">
                        </div>
                        <div class="col-md-4">
                            <label for="add-new-user">Post Code</label>
                            <input class="label-adduser form-control" id="user-cp" type="text"
                                   placeholder="Enter your zip code" name="zip_code" required="required">
                        </div>
                        <div class="col-md-8">
                            <label for="add-new-user">Gender</label>
                            <input type="radio"
                                   name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>
                                   value="female">Female
                            <input type="radio"
                                   name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>
                                   value="male">Male
                        </div>
                        <div class="col-md-8">
                            <label for="add-new-user">Admin</label>
                            <input type="radio"
                                   name="isAdmin" <?php if (isset($admin) && $admin == "isAdmin") echo "checked"; ?>
                                   value="isAdmin">is Admin
                            <input type="radio"
                                   name="isAdmin" <?php if (isset($admin) && $admin == "isnotAdmin") echo "checked"; ?>
                                   value="isnotAdmin">is not Admin
                        </div>
                        <input type='submit' id='createUser' name='createUser' class="btn btn-default"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer"><h1></h1></div>
        </div>
    </div>
</div>
<!--END MODAL -->

<!-- MODAL FORGET PASSWORD -->
<div id="forgetpass" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Password assistance</h4>

                <p>Enter the email address associated with your The Escape account, then click Continue.
                    Email&hellip;</p>
            </div>
            <div class="modal-body">
                <form action="../Logica/controller.php" method="POST">
                    <input type="email" placeholder="Enter your email" name="email_remenber" required="required">
                    <input type="submit" name="send_password" value="Continue"/>
                </form>
            </div>
        </div>
    </div>
</div>

<!--END MODAL FORGET PASSWORD-->

<!-- SEARCH -->
<div class="container">
    <?php require 'view/search.php'; ?>
</div>
<!-- END SEARCH -->

<!--FOOTER-->
<footer class="footer center">
    <?php include 'view/footer.php'; ?>
</footer>

</body>
</html>
