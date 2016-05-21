<?php //comprueba que la session este iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//verifica si el usuario esta logueado
if ($_SESSION['signUp'] != 1) {
    header("Location: ../");
}; ?>

<!DOCTYPE html>
<html lang="en" spellcheck="true">

<head>
    <meta charset="utf-8">
    <title>The Escape</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.ico"/>
    <?php include 'head.php'; ?>
</head>

<body>
<?php
/*MENU*/
require 'menu.php';
?>

<div class="container" id="admin-page">
    <div id="settings-content">

        <div class="settings-content col-md-offset-1 col-md-10 ">
            <p class="title_seccion">Settings</p>
            <div class="divisor"></div>

            <div id="form-settings">
                <form action="../../Logica/controller.php" method="POST">
                    <div class="col-md-6">
                        <label for="add-new-user">Password</label>
                        <input class="label-edituser form-control" id="user-input" type="password"
                               placeholder="Enter your password" name="password" required="required">
                    </div>
                    <div class="col-md-12">
                        <label for="add-new-user">Email</label>
                        <input class="label-edituser form-control" id="user-input" type="email"
                               placeholder="Enter your email" name="email" required="required">
                    </div>
                    <div class="col-md-8">
                        <label for="add-new-user">Phone Number</label>
                        <input class="label-edituser form-control" id="user-input" type="text"
                               placeholder="Enter your phone" name="phone" required="required">
                    </div>
                    <div class="col-md-4">
                        <label for="edit-user">Post Code</label>
                        <input class="label-edituser form-control" id="user-input" type="text"
                               placeholder="Enter your zip code" name="zip_code" required="required">
                    </div>
                    <div class="col-md-4">
                        <input type='submit' name='editUser' class="btn btn-default" value="Confirm"/>
                    </div>
                </form>
            </div>
        </div>

        <div class="deleteacount col-md-2 col-md-offset-10">
            <h6>DELETE ACCOUNT</h6>
            <!-- BOTON PARA BORRAR CUENTA -->
            <form action="../../Logica/controller.php" method="post">
                <input type="submit" name='DeleteAccountAdmin' value="Delete Account" class="btn btn-default"><br/>
            </form>
        </div>

    </div>

</div>

<!--FOOTER-->
<footer class="footer center">
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>