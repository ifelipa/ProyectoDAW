<?php  //comprueba que la session este iniciada
if (session_status() != PHP_SESSION_ACTIVE) {session_start();}
//verifica si el usuario esta logueado
 if ($_SESSION['signUp']!=1){ header("Location: ../"); }; ?>
<!DOCTYPE html>
<html lang="en" spellcheck="true">
<head>
	<meta charset="utf-8">
	<title>The Escape</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../img/logo.ico" />
	<?php include 'head.php'; ?>
</head>
<body>
	<!--MENU-->
	<?php
		include 'menu.php';
		require '../../Logica/functions.php';
	?>
	<!-- END MENU -->

	<div class="container">	
	<div class="divisor col-md-12"> </div>
		<div id="erUser-content">
			<div class="booking col-md-4">
				<div class="content-booking">
					<form action="../../Logica/controller.php" method="POST">
						<h4><strong>Bookings</strong></h4>
                        <br/>
						<div class='input-group' id="lisERBook">
                            <label for="Escape Room"> Escape Room </label>
							<select id="listER_reservations" name="multiple" class="form-control" required="required">
							<?php
								$data = listDataEscapeRoomUser() ;
								if ($data != null) {
									$index=0;
									foreach ($data as $value) {
										$dataER = explode("-",$value);
										echo "<option value='$dataER[1]'>".$dataER[1]."</option>";
										$index++;
									} 
								}
							?>
							</select>
						</div>

						<div class="input-group col-md-3 ">
							<label> Date</label>
                            <input type="date" name="date" required="required" >
						</div>

						<div class="input-group col-md-3">
							<label> Hours</label>
							<input type="number" min="1" max="24" name="time" required="required">
						</div>
						<div class="input-group col-md-3">
							<label> People</label>
							<input type="number" min="1" max="10" name="people" required="required" >
						</div>
						<div class="input-group col-md-3">
							<label> Parking</label>
							<input id="hasparking" type="checkbox" name="parking" >
						</div>
                        <div id="park-available">
                            <br/><h4>PARKINGS AVAILABLE</h4>
                            <div class="input-group col-md-3">
                                <label> Parking </label>

                                <!--llamada ajax parking-->
                                <select name="listParking" id="listParking">    </select>
                            </div>
                        </div>
						<input type="submit" name="reserveER" value="Reserve" />
					</form>
				</div>
			</div>
		   <!---check_availability-->
			<div class="col-md-8">
				<div id="check_availability">
						<p class="title_seccion"><strong>Booked time slots</strong></p>
					<div class="divisor"> </div>
					<div  id="calendar_availability"  class="col-md-12">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--FOOTER-->
	<footer class="footer center">
		<?php include 'footer.php'; ?>
	</footer>
</body>
</html>
