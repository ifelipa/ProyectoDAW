<?php //comprueba que la session este iniciada
if (session_status() != PHP_SESSION_ACTIVE) {
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
    <?php include_once 'head.php'; ?>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiwfKzEg1rsTtjmxUp6uySyOjow6teJPM&callback=initMap">
    </script>
</head>

<body>
<?php include_once 'menu.php';
require '../../Logica/functions.php';
?>

<div class="container" id="admin-page">
    <div class="divisor"></div>
    <div class="col-md-3">
        <!--formulario de busqueda en el mapa-->
        <form name="search-map" id="search-map" method="post">
            <input type="text" class="form-control" type="text" name="input-search-map" id="input-search-map"
                   autocomplete="on" placeholder="Search for...">
        </form>
        <div id="result-map"></div>
    </div>
    <!--<div class="col-md-2 "><input type="checkbox" id="allMap" value="View all"> </input></div>-->
    <div class="col-md-9">
        <div id="googleMap" style="width:100%;height:620px;"></div>
    </div>


</div>

<!--FOOTER-->
<footer class="footer center">
    <?php include_once 'footer.php'; ?>
</footer>
</body>
</html>