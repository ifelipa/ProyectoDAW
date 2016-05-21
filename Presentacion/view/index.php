<?php  //comprueba que la session este iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
//verifica si el usuario esta logueado
if ($_SESSION['signUp']!=1){ header("Location: ../"); }; ?>
<!DOCTYPE html>
<html lang="en" spellcheck="true">
<head>
    <meta charset="utf-8">
    <title>The Escape</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.ico" />
    <?php include 'head.php' ?>`

</head>
<body>
<?php include_once 'menu.php'; ?>
<!-- SEARCH -->
<div class="container">
    <?php include_once 'search.php'; ?>
</div>
<!-- END SEARCH -->

<!--FOOTER-->
<footer class="footer center">
    <?php include_once 'footer.php'; ?>
</footer>
</body>
</html>