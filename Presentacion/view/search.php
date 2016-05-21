<?php //comprueba que la session este iniciada
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
//variable que ayuda a reconocer al usuario para direccionar el buscador controller
$user = "false";
if (isset($_SESSION['username'])) {
    $user = "true";
}
?>

<div class="search-wrapper">
    <div class="divisor col-sm-12 "></div>
    <div class="col-md-6 col-sm-10 col-xs-12">
        <h2 class="home-heading">Search your favourite escape room</h2>

        <form name="search" id="search" method="post" data-user="<?php echo $user; ?>">
            <input type="text" class="form-control" type="text" name="search" id="search-input" autocomplete="on"
                   placeholder="Search for...">

        </form>

    </div>
    <div class="col-md-4 col-sm-8 col-xs-12 viewall">
        <input type="checkbox" class="viewall_checkbox"> view all
    </div>


</div>

<div id="result-wrapper" class="col-md-12"></div>