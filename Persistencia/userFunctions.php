<?php
/**
 * PÀGINA PHP ON POSEM TOTES LES FUNCIONS DELS USUARIS
 * User: Jordi Felip i Ismael Felipa
 */

require_once("DB_Connect.php");


/**
 * FUNCION PARA PARA VALIDAR EL USERNAME Y CONTRASEÑA
 * @param $username
 * @param $password
 * @return bool|int
 */
function validacioUser($username, $password)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    // SQL QUERY TO VERIFY USER //
    $query = "select * from users where username='" . $username . "' and password=md5('" . $password . "');";
    // executem la consulta //
    $result = pg_query($query);
    if ($result && pg_num_rows($result) != 0) {
        // guardem el valor de la consulta
        $camps = pg_fetch_array($result);
        // mirem el valor del camp isAdmin //
        $isAdmin = $camps[5];
        if (pg_num_rows($result) == 1) {
            // cas que sigui admin retornem un 1
            if ($isAdmin == 't') {
                return 1;
            }
            // cas que no sigui admin retornem un 2
            return 2;
        }
        // cas que no s'hagi trobat resultat //
        close_connection($conn, $result);
        return false;
    }
}

/**
 * FUNCTION QUE COMPRUEBA SI EL USUARIO ES ADMIN
 * @param $username
 * @return null
 */
function isAdmin($username)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "select admin from users where username= '$username'";
    $result = pg_query($query);
    $camps = pg_fetch_array($result);
    $isAdmin = $camps[0];
    if ($isAdmin == 't') {
        close_connection($result, $conn);
        return true;
    }
    close_connection($result, $conn);
    return false;
}

/**
 * FUNCION QUE CIERRA LAS SESIONES
 * @return string
 */
function closeSession()
{
    if (isset($_SESSION['signUp'])) {
        unset($_SESSION['signUp']);
    }
    if (isset($_SESSION['fbID'])) {
        unset($_SESSION['fbID']);
    }
    if (isset($_SESSION['goID'])) {
        unset($_SESSION['goID']);
    }


    if (isset($_COOKIE['dataActual'])) {
        setcookie('dataActual', '', time() - 3600, "/");
    }
    // mirem si el usuari havia donat el check de recordar //
    if (isset($_COOKIE['loguejat'])) {
        setcookie('loguejat', '', time() - 3600, "/");
    }
    session_destroy();

    return "Bye...";
}

/**
 * FUNCION QUE AGREGA UN USUARIO A LA BBDD
 * @param $name
 * @param $surname
 * @param $username
 * @param $email
 * @param $admin
 * @param $password
 * @param $zip_code
 * @param $phone_number
 * @param $gender
 * @return string
 */
function addUser($name, $surname, $username, $email, $admin, $password, $zip_code, $phone_number, $gender)
{
    // validamos el username que pasa el usuario para que no se repita
    if (validateUsername($username)) {
        if (validateEmail($email)) { //validamos el email que pasa el usuario para que no este registrado
            try {
                $conn = valid_connection();
            } catch (Exception $e) {
                echo 'Connection Error--> ' . $e->getMessage();
            }
            $cod = $username;
            if ($admin == "isAdmin") {
                $isAdmin = 't';
            } else {
                $isAdmin = 'f';
            }
            if ($gender == "male") {
                $sex = 'M';
            } else {
                $sex = 'F';
            }
            $queryAddUser = "INSERT INTO users (coduser,name,surname,username,email,admin, password,zip_code,phone_number,gender)
            VALUES( lower(translate('$cod','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    lower(translate('$name','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    lower(translate('$surname','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    '$username',
                    lower(translate('$email','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    lower(translate('$isAdmin','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    md5('$password'),
                    lower(translate('$zip_code','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    lower(translate('$phone_number','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    lower(translate('$sex','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ'))
                );";

            if (pg_query($conn, $queryAddUser)) {
                return "0";
            } else {
                return "1";
            }
        } else {
            return "2";
        }
    } else {
        return "3";
    }
}

/**
 * FUNCION QUE VERIFICA QUE EL USERNAME NO ESTA REGISTRADO EN LA BBDD
 * @param $username
 * @return bool
 */
function validateUsername($username)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "select * from users where username= '$username'";
    $result = pg_query($query);
    if ((pg_num_rows($result)) != 0) {
        close_connection($result, $conn);
        return false;
    }
    close_connection($result, $conn);
    return true;
}


/**
 * FUNCION QUE VALIDA QUE EL EMAIL NO ESTE REPETIDO EN LA BBDD
 * @param $email
 * @return bool
 */
function validateEmail($email)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "select * from users where email='$email'";
    $result = pg_query($query);
    if ((pg_num_rows($result)) != 0) {
        close_connection($result, $conn);
        return false;
    }
    close_connection($result, $conn);
    return true;
}


/**
 * FUNCION QUE ELIMINA UN USUARIO
 * @param $username
 * @return int
 */
function deleteUser($username)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "DELETE FROM bookings where coduser ='$username';";
    $result = pg_query($query);
    $query = "DELETE FROM users where username ='$username';";
    $result = pg_query($query);
    if ((pg_num_rows($result)) != 0) {
        close_connection($result, $conn);
        return 0;
    }
    close_connection($result, $conn);
    return 1;
}



/**
 * FUNCION QUE ELIMINA UN ADMIN
 * @param $username
 * @return int
 */
function deleteAdmin($username)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    // we delete relations between admin escape rooms and parkings //
    $query = "DELETE FROM erxparking where coder IN (select coder FROM escaperoom where administrator = '$username')";
    $result = pg_query($query);
    // we delete admin escape rooms //
    $query = "DELETE FROM escaperoom where administrator ='$username';";
    $result = pg_query($query);
    // we delete admin //
    $query = "DELETE FROM users where username ='$username';";
    $result = pg_query($query);
    if ((pg_num_rows($result)) != 0) {
        close_connection($result, $conn);
        return 0;
    }
    close_connection($result, $conn);
    return 1;
}


/**
 * FUNCION QUE ELIMINA LA RESERVA DE UN USUARIO
 * @param $user
 * @param $nameER
 * @param $date
 * @param $hour
 * @return string
 */
function deleteBook($user, $nameER, $date, $hour)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    // transforma el nombre en codigo //
    $codeER = ercode($nameER);
    $query = pg_query($conn,"DELETE FROM bookings where coduser='$user' and coder ='$codeER' and startdate = '$date' and start = '$hour' ;");
    if (pg_affected_rows($query) > 0) {
        return 0;
    }else{
        return 1;
    }
}


/**
 *
 * FUNCION EDITAR USUARIO
 * @param $username
 * @param $password
 * @param $email
 * @param $phone_number
 * @param $zip_code
 * @return int
 */
function editUser($username, $password, $email, $phone_number, $zip_code)
{
    try {
        $conn = valid_connection();
    } catch (Exception $e) {
        echo 'Connection Error--> ' . $e->getMessage();
    }
    $query = "UPDATE users  SET password=md5('$password'),
                    email=lower(translate('$email','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    phone_number = lower(translate('$phone_number','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ')),
                    zip_code=lower(translate('$zip_code','áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜñç', 'aeiouAEIOUaeiouAEIOUaeiouAEIOUÑÇ'))
                    WHERE username='$username'";

    $result = pg_query($query);
    if ((pg_num_rows($result)) != 0) {
        close_connection($result, $conn);
        return 0;
    }
    close_connection($result, $conn);
    return 1;
}


/**
 * FUNCION QUE RECUPERA LA CONTRASEÑA
 * @param $email
 * @return bool
 */
function retrievesPas($email)
{

    // if email exists //
    if (validateEmail($email) == 0) {
        try {
            $conn = valid_connection();
        } catch (Exception $e) {
            echo 'Connection Error--> ' . $e->getMessage();
        }
        $query = "SELECT * FROM users WHERE email = '$email';";
        $result2 = pg_query($query);
        $user = pg_fetch_row($result2);
        $user_pass = $user[6];
        return true;
    } else {
        // is not needed to look for a password because user don't exist //
        return false;
    }
}

/*
 * FUNCION QUE ENVIA LA CONTRASEÑA AL EMAIL INDICADO
 * @param $email
 * @param $pass

function sendEmail($email, $pass)
{
    $text = $pass . "<br>";
    echo '*********' . $email . "<br>";
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    echo "l'email es: " . $email . "<br>";
    $subject = "subject";
    $text = "hola Que tal";
    echo "el subject es: " . $subject . "<br>";
    echo "el text es: " . $text . "<br>";
    echo $headers;
    mail($email, $subject, $text, $headers);
    print phpinfo();
}
*/

?>
