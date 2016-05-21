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
<?php /*MENU*/
require_once '../../Logica/functions.php';
include_once 'menu.php';
?>

<div class="container" id="admin-page">
    <p class="title_seccion">PROFILE</p>

    <div class="col-md-2">
        <div class="list-btn-profile user-img">
            <img src="../img/250x250.png" class="img-rounded img-responsive"/>
        </div>
        <div id="text_profile">
            <p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                ullamcorper suscipit lobortis nisl ut aliquip</div>
        </p>
    </div>

    <?php
    /**AQUI VA TODO EL CONTENIDO DE ADMIN **/
    if ($_SESSION['isAdmin']) {
        ?>
        <div class="col-md-10 info-reservation">
            <h4>BOOKINGS MADE IN THE ESCAPE ROOMS THAT YOU MANAGE</h4>

            <div class="list-booking">
                   <?php
                   $dataB = bookingsERAdmin($_SESSION['username']) ;
                   if ($dataB != null) {
                       foreach ($dataB as $value) {
                           $dataBooking = explode(";", $value);
                           echo "<div class='data_reser_admin col-md-4'>";
                           echo "<div> DATE:  ".$dataBooking[2]."</div>";
                           echo "<div> HOUR:  ".$dataBooking[3]."</div>";

                            $dataER = returnDataER($dataBooking[1]);
                            foreach ($dataER as $val){
                            $dataEscape = explode("-", $val);
                              echo "<div> ESCAPE ROOM:  ".$dataEscape[0]."</div>";
                              echo "<div> ADDRESS:  ".$dataEscape[1]."</div>";
                            }

                           echo "</div>";
                       }
                   }
                   ?>
               </div>
        </div>

    <?php
    } else {
        /**AQUI VA TODO EL CONTENIDO DE USER **/
        ?>

        <div class="col-md-10 info-reservation">

            <!-- Sub-Menu Nav tabs -->
            <div class="tabs_ER col-md-12">
                <a class="btn list-btn-profile" data-target="#madeUserBooking" data-toggle="tab">BOOKINGS MADE BY THE
                    USER</a>
                <a class="btn list-btn-profile" data-target="#deleteUserBooking" data-toggle="tab">DELETE A BOOK</a>
            </div>
            <div class="tab-content">

                <div class="tab-pane active" id="madeUserBooking">
                    <div class="list-booking">
                           <?php
                           $dataB = hasBooking($_SESSION['username']) ;
                           if ($dataB != null) {
                               foreach ($dataB as $value) {
                                   echo "<div class='col-md-6 databooking'>";
                                   $dataBooking = explode(";", $value);
                                   echo "<div> DATE:  ".$dataBooking[2]."</div>";
                                   echo "<div> HOUR:  ".$dataBooking[3]."</div>";

                                   $dataER = returnDataER($dataBooking[1]);
                                   foreach ($dataER as $val){
                                       $dataEscape = explode("-", $val);
                                       echo "<div> ESCAPE ROOM:  ".$dataEscape[0]."</div>";
                                       echo "<div> ADDRESS:  ".$dataEscape[1]."</div>";
                                   }

                                   /*verificando  si tiene parking reservado*/
                                   if (!empty($dataBooking[4])){
                                       echo "<div> PARKING:  ". parkingName($dataBooking[4])."</div>";
                                   }else{
                                       echo "<div> PARKING: You don't have parking spot</div>";
                                   }
                                   echo "<div> PRICE:  ".$dataBooking[5]."</div>";


                                   echo "</div>";
                               }
                           }
                           ?>
                       </div>

                </div>

                <div class="tab-pane" id="deleteUserBooking">
                    <div class="col-md-10 list-booking">

                        <!-- form para borrar reserva -->
                        <form action="../../Logica/controller.php" method="POST">
                            <h4><strong>Delete a Book</strong></h4>
                            <br/>
                            <div class='input-group col-md-4' id="lisERBook">
                                <label for="Escape Room"> Escape Room </label>
                                <select id="list_ER" name="ERName" class="form-control">
                                    <?php
                                    $data = listDataEscapeRoomUser();
                                    if ($data != null) {
                                        $index = 0;
                                        foreach ($data as $value) {
                                            $dataER = explode("-", $value);
                                            echo "<option value='$dataER[1]'>" . $dataER[1] . "</option>";
                                            $index++;
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group col-md-4 ">
                                <label> Date </label>
                                <input type="date" name="date" required>
                            </div>
                            <div class="input-group col-md-4">
                                <label>Hour </label>
                                <input type="number" min="1" max="24" name="hour2" required>
                            </div>
                            <input type="submit" class="btn btn-default" name="DeleteBook" value="DeleteBook"/>
                        </form>
                    </div>
                </div>

            </div>
        </div>




    <?php } ?>
</div>
<!--FOOTER-->
<footer class="footer center">
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>
