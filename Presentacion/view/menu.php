<?php//comprueba que la session este iniciada
if (session_status() != PHP_SESSION_ACTIVE) {session_start();}
?>
<!-- MENU -->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!--DERECHA MENU-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"  data-target="#nav-bar-ThEscape">
                <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
            </button>
            <a class="navbar-brand" href="index.php">The Escape</a>
        </div>
        <div class="collapse navbar-collapse" id="nav-bar-ThEscape">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="index.php" id="link-search">Search</a>
                </li>
                <li>
                    <a href="map.php" id="link-map">Map</a>
                </li>
                <li>
                   <a href="<?php
                   if ($_SESSION['isAdmin']){
    echo 'erAdmin.php';
}
else{
    echo 'erUser.php';
}
?>" id="link-er">Escape Room</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Account
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img  id="img-profile" src="../img/login.png"
                                              alt="Alternate Text" class="img-responsive" />
                                    </div>
                                    <div class="col-md-7">
                                        <span><?php echo $_SESSION['username'];
?></span>
                                        <div class="divider"> </div>
                                        <a href="profile.php" class="btn btn-primary btn-sm active">View Profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="navbar-footer">
                                <div class="navbar-footer-content">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-2">
                                            <a href="settings.php" class="btn btn-default pull-left">Settings</a>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="../../Logica/controller.php" method="post">
                                                <input type="submit" name='log_out' value="log out" class="btn btn-default pull-right">
                                            </form>
                                        </div>
                                    </div>
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
