<!--
    PÀGINA PHP ON POSEM TOTES LES FUNCIONS DE LES ESCAPES ROOMS
    #Autor = Jordi Felip i Ismael Felipa
-->

<?php
require_once 'DB_Connect.php';
// fitxer on es troba les funcions per conectar i desconectar de la BBDD //

/**
 * FUNCION PARA AGREGAR UN ESCAPE ROOM (ER)
 * @param $name
 * @param $address
 * @param $descrip
 * @param $mark
 * @param $price
 * @param $duration
 * @param $administrator
 * @return string
 */
function addEscapeRoom($name, $address, $descrip, $mark, $price, $duration, $administrator)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $cod = $administrator . "." . str_replace(' ', '', $name);
    $queryAddEscapeRoom = "INSERT INTO escaperoom (coder,name,address,descrip,mark,price, duration,administrator)
    VALUES(
            lower(translate('$cod','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
            lower(translate('$name','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
            lower(translate('$address','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
            lower(translate('$descrip','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
            lower(translate('$mark','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
            '$price','$duration',
            lower(translate('$administrator','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ'))
        )";
    if (pg_query($conn, $queryAddEscapeRoom)) {
        // cas que hi hagi insercio d'escaperoom //
        return "0";
    } else {
        // cas que no s'hagi executat be la query, no hi ha insercio //
        return "1";
    }
}

/**
 *
 * FUNCION ELIMINA ER
 * @param $coder
 * @param $admin
 * @return string
 */
function deleteEscapeRoom($coder, $admin)
{
    try {
        $conn1 = valid_connection();
        $conn2 = valid_connection();

    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query1 = "DELETE FROM erxparking where coder ='$coder'";
    $result1 = pg_query($conn1,$query1);
    $query2 = "DELETE FROM escaperoom where coder ='$coder' and administrator = '$admin';";
    if (pg_query($conn2, $query2)) {
        close_connection($result1, $conn1);
        return "0";
    } else {
        close_connection($result1, $conn1);
        return "1";
    }
}


/**
 *
 * FUNCTION QUE EDITA LOS ER
 * @param $coder
 * @param $name
 * @param $address
 * @param $descrip
 * @param $mark
 * @param $price
 * @param $duration
 * @param $administrator
 * @return int
 */
function editEscapeRoom($coder, $name, $address, $descrip, $mark, $price, $duration, $administrator)
{

    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "UPDATE escaperoom SET name='$name', address = '$address', descrip='$descrip', mark ='$mark',price ='$price', administrator = '$administrator' WHERE coder='$coder'";
    $result = pg_query($query);
    if ((pg_num_rows($result)) != 0) {
        close_connection($result, $conn);
        return 0;
    }
    close_connection($result, $conn);
    return 1;
}


/**
 *  FUNCION QUE LISTA LOS ER DE CADA ADMINISTRADOR
 * @param $admin
 * @return array|null
 */
function listEscapeRoom($admin)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "SELECT * FROM escaperoom WHERE administrator='$admin'";
    $result = pg_query($query);
    $room = array();
    if ((pg_num_rows($result)) != 0) {
        $i = 0;
        while ($value = pg_fetch_array($result)) {
            $room[$i] = $value[0] . "-" . $value[1] . "-" . $value[3];
            $i++;
        }

        return $room;
    }
    close_connection($result, $conn);
    return null;
}

/**
 * LISTA TODOS LOS ESCAPE ROOM
 * @return array|null
 */
function listAllEscapeRoom()
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        $e->getMessage();
    }
    $query = "SELECT * FROM escaperoom";
    $result = pg_query($query);
    $result = pg_query($query);
    $room = array();
    if ((pg_num_rows($result)) != 0) {
        $i = 0;
        while ($value = pg_fetch_array($result)) {
            $room[$i] = $value[0] . "-" . $value[1] . "-" . $value[3] . "-" . $value[2];
            $i++;
        }

        return $room;
    }
    close_connection($result, $conn);
    return null;
}


/**
 * FUNCION QUE RECUPERA EL CODIGO DE ER A TRAVES DE SU NOMBRE
 * @param $escaperoom
 * @return mixed
 */
function ercode($escaperoom)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "SELECT coder FROM escaperoom where name ='$escaperoom';";
    $result = pg_query($query);
    $result = pg_fetch_array($result);
    // we return the code //
    return $result[0];
}


/**
 *
 * FUNCION QUE RECUPERA EL PRECIO DEL ER
 * @param $escaperoom
 * @return mixed
 */
function erprice($escaperoom)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "SELECT price FROM escaperoom where name ='$escaperoom';";
    $result = pg_query($query);
    $result = pg_fetch_array($result);
    // we return the price //
    return $result[0];
}


/**
 * FUNCION QUE RECUPERA EL PRECIO DEL PARKING
 * @param $codiparking
 * @return mixed
 */
function priceparking($codiparking)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "SELECT price FROM parking where codparking ='$codiparking';";
    $result = pg_query($query);
    $result = pg_fetch_array($result);
    // we return the price //
    return $result[0];
}


/**
 * FUNCION QUE RECUPERA EL CODIGO DEL PARKING
 * @param $parking
 * @return mixed
 */
function parkingCode($parking)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "SELECT codparking FROM parking where name ='$parking';";
    $result = pg_query($query);
    $result = pg_fetch_array($result);
    // we return the code //
    return $result[0];
}


/**
 * FUNCION QUE RECUPERA EL NOMBRE DEL PARKING
 * @param $codiparking
 * @return mixed
 */
function nameParking($codiparking)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "SELECT name FROM parking where codparking ='$codiparking';";
    $result = pg_query($query);
    $result = pg_fetch_assoc($result);
    // we return the price //
    return $result['name'];
}

/**
 *
 * LISTA DE RESERVACIONES POR USUARIOS
 * @param $user
 * @return array|null
 */
function reservationXuser($user)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        $e->getMessage();
    }
    $query = "SELECT * FROM bookings WHERE coduser = '$user'";

    $result = pg_query($query);

    if ((pg_num_rows($result)) != 0) {
        $i = 0;
        while ($value = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
            $room[$i] = $value['coduser'] . ";" . $value['coder'] . ";" . $value['startdate'] . ";" . $value['start'] . ";" . $value['codparking'] . ";" . $value['price'];
            $i++;
        }
        close_connection($result, $conn);
        return $room;
    }
    close_connection($result, $conn);
    return null;
}

/**
 * FUNCION QUE RETORNA LOS DATOS DEL ER DE ACUERDO A SU CODIGO
 * @param $code
 * @return array|null
 */
function returnDataER($code)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }

    $room = array();
    $query = "SELECT * FROM escaperoom WHERE coder = '$code';";
    $result = pg_query($query);
    if ((pg_num_rows($result)) != 0) {
        $i = 0;
        while ($value = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
            $room[$i] = $value['name'] . "-" . $value['address'] . "-" . $value['price'] . "-" . $value['duration'];
            $i++;
        }
        close_connection($result, $conn);
        return $room;
    }
    close_connection($result, $conn);
    return null;
}


/**
 * FUNCION QUE RETORNA EL ADMINSTRADOR DE UN ER
 * @param $code
 * @return array|null
 */
function returnAdmin($nombre)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "SELECT administrator FROM escaperoom WHERE name = '$nombre';";
    $result = pg_query($query);
    $result = pg_fetch_assoc($result);
    return $result['administrator'];
}

/**
 *
 * LISTA LAS RESERVAS DE LAS ER DE UN ADMIN
 * @param $user
 * @return array|null
 */
function bookingsERUser($admin)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        $e->getMessage();
    }
    $query = "SELECT * FROM bookings WHERE coder IN (select coder FROM escaperoom where administrator = '$admin')";

    $result = pg_query($query);

    if ((pg_num_rows($result)) != 0) {
        $i = 0;
        while ($value = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
            $room[$i] = $value['coduser'] . ";" . $value['coder'] . ";" . $value['startdate'] . ";" . $value['start'] . ";" . $value['codparking'] . ";" . $value['price'];
            $i++;
        }
        close_connection($result, $conn);
        return $room;
    }
    close_connection($result, $conn);
    return null;
}



/**
 * FUNCION PARKINGXER
 * retorna los parking cercanos de cada escape room
 * @param $selected
 * @return bool
 */
function parkingXER($selected)
{
    $codER = ercode($selected);
    $query = "select name from parking where codparking in (select codparking from erxparking where coder='$codER');";
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        $e->getMessage();
    }
    $result = pg_query($query);
    //$fila = pg_fetch_assoc($result);
    if (pg_num_rows($result) != 0) {
        while ($fila = pg_fetch_array($result)) {
            echo "<option value='$fila[0]'> " . $fila[0] . "</option>";
        }
    } else {
        return false;
    }
}

/**
 *
 * FUNCION RESERVAR UN ESCAPE ROOM
 * @param $parking
 * @param $user
 * @param $escapeRoom
 * @param $startdate
 * @param $start
 * @param $people
 * @return string
 */
function reservarER($parking, $user, $escapeRoom, $startdate, $start, $people)
{
    $coder = ercode($escapeRoom);
    $price = erprice($escapeRoom);
    $fin = 1 + intval($start);
    // cas que no s'hagi seleccionat el checkbox del parking //
    if (!isset($parking) || trim($parking) === '') {
        
        // els altres camps de parking estan a null a la bbdd //
        //aquest hauria de ser el preu Total //
        $price = $price * $people;
        $queryBooking = "INSERT INTO bookings (coduser, coder,startdate,start,finish,people,codparking,price)
                                  VALUES('$user','$coder','$startdate','$start','$fin','$people',0,'$price')";
        $result = pg_query($queryBooking);
        if (!$result) {
            return "0";
        } else {
            return "1";
        }
    } else {
        $codiparking = parkingCode($parking);
        $precioParking = priceparking($codiparking);
        // calculamos el precio total con parking //
        $price = $price * $people + $precioParking;
        $queryBooking = "INSERT INTO bookings (coduser,coder,startdate,start,finish,people,codparking,price)
                                  VALUES('$user','$coder','$startdate','$start','$fin','$people',$codiparking,'$price')";
        $result = pg_query($queryBooking);
        if (!$result) {
            return "0";
        } else {
            return "1";
        }
    }
}

?>
