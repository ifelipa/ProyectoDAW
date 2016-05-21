<!--
    PÀGINA PHP QUE UTILITZEM DE CONTROLADOR
    #Autor = Ismael Felipa i Jordi Felip
-->


<?php
// comprueba que la session este activa //
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
// fichero donde se encuentran las funciones relacionadas con el usuario //
require '../Persistencia/userFunctions.php';

// funciones donde se encuentran las funciones relacionadas con Escape Room //
require '../Persistencia/ERFunctions.php';

// del formulari d'entrada venim al controller //
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // si se presiona el boton d'entrada de INDEX.PHP //
    if (isset($_POST['boto'])) {
        // cogemos los valores de la cookie y los guardamos en una session
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        // guardamos los valores en unas variables //
        $username = $_SESSION['username'];
        $passwordUser = $_SESSION['password'];
        //evitamos inyeccion codigo con htmlentities //
        $username = htmlentities($username, ENT_QUOTES | ENT_IGNORE, "UTF-8");
        $passwordUser = htmlentities($passwordUser, ENT_QUOTES | ENT_IGNORE, "UTF-8");
        // validamos al usuario con la funcion //
        $validacio = validacioUser($username, $passwordUser);
        // caso que el usuario sea o no admin //
        if ($validacio == 1 || $validacio == 2) {
            //variable que asigna que el usuario esta logueado
            $_SESSION['signUp'] = 1;
            // si esta activada creamos una cookie con el nombre del username //
            if (isset($_POST['Recordam'])) {
                setcookie("loguejat", $username, time() + 3600, "/");
                echo "Cookie should have been made";
            }
            date_default_timezone_set('UTC');
            // Guardamos la constante que representa la data actual que se connecta el usuario //
            $dataActual = date(DATE_RFC2822);
            // creamos la cookie de la data //
            setcookie('dataActual', $dataActual, time() + 3600, "/");
            // creamos una cookie 
            //setcookie('signUp', '1', time() + 3600, "/");

            // CASO ADMIN: redirigimos a la pagina de administrador //
            if ($validacio == 1) {
                // declara que user es admin //
                $_SESSION['isAdmin'] = true;
                echo mensaje("WELCOME " . $_SESSION['username']);

                header("refresh:1; ../Presentacion/view/index.php");
                // CASO USER: redirigimos a la pagina de user //
            } else if ($validacio == 2) {
                // declara que user no es admin //
                $_SESSION['isAdmin'] = false;
                echo mensaje("WELCOME " . $_SESSION['username']);

                header("refresh:1; ../Presentacion/view/index.php");
            }
        } else {
            // Error message //
            // echo "User not found in the system";
            echo mensaje("User not found in the system");
            // redirigimos a la pagina inicial del web //
            header("refresh:1; url=../Presentacion/");
        }
    }
    // implementacion log out //
    if (isset($_POST['log_out'])) {
        // funcion que cierra la session para  user/admin //
        $missatge = closeSession();
        // mostramos mensaje  //
        echo mensaje($missatge . $_SESSION['username']);
        // redirigimos a la pagina inicial del web//
        header("refresh:1; url=../Presentacion/");
    }

    // implementacion usuario nuevo //
    // boton INDEX.PHP //
    if (isset($_POST['createUser'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $zip_code = $_POST['zip_code'];
        $phone_number = $_POST['phone'];
        $admin = $_POST['isAdmin'];
        $gender = $_POST['gender'];
        $userAdd = addUser($name, $surname, $username, $email, $admin, $password, $zip_code, $phone_number, $gender);
        // caso que exista el username //
        if ($userAdd == "3") {
            echo mensaje("Username exists");
            // caso que exista el email //    
        } elseif ($userAdd == "2") {
            echo mensaje("Email already exists");
            // caso que el usuario no se haya podido crear //
        } elseif ($userAdd == "1") {
            echo mensaje("User not created");
            // ok, usuario creado correctamente //
        } elseif ($userAdd == "0") {
            echo mensaje("User created");
        }
        //volvemos a la pagina inicial del web //
        header("refresh:1; url=../Presentacion/");
    }
    // Caso que interactuemos con el boton de eliminar usuario PAGINA: SETTINGs.PHP//
    if (isset($_POST['DeleteAccountAdmin'])) {
        $username = $_SESSION['username'];
        // caso que no sea admin //
        if (!(isAdmin($username))) {
            // usuario borrado correctamente //
            if (deleteUser($username) == "1") {
                echo mensaje("We are removing your user account");
                //volvemos a la pagina inicial del web //
                header("refresh:1;url=../Presentacion/");
            } else {
                // caso que no se pueda borrar el usuario //
                echo mensaje("We can't remove your account");
                //redireccion, volvemos  a la pagina donde estabamos //
                header("refresh:1;url=../Presentacion/view/settings.php");
            }
        } else {
            // caso que sea admin //
            if (deleteAdmin($username) == "1") {
                // caso que se pueda borrar el admin //
                echo mensaje("We are removing your admin account");
                //volvemos a la pagina inicial del web //
                header("refresh:1;url=../Presentacion/");
            } else {
                // caso que no se pueda borrar el admin //
                echo mensaje("We can't remove your account");
                //redireccion, volvemos  a la pagina donde estabamos //
                header("refresh:1;url=../Presentacion/view/settings.php");
            }
        }
        // en ambos casos, cerramos la sessiones si estan activas //
        closeSession();
    }
    // editar usuario //
    if (isset($_POST['editUser'])) {
        $username = $_SESSION['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $zip_code = $_POST['zip_code'];
        $phone_number = $_POST['phone'];
        $editUser = editUser($username, $password, $email, $phone_number, $zip_code);
        // caso que se pueda editar el usuario //
        if ($editUser == "1") {
            echo mensaje("You have modified correctly your account");
            //volvemos a la pagina, redireccion //
            header("refresh:1;url=../Presentacion/view/profile.php");
        } else {
            // caso que no podamos borrar la cuenta //
            echo mensaje("We are not able to modify your account");
            header("refresh:1;url=../Presentacion/view/settings.php");
        }
    }


    /*recordar contraseña*/
    if (isset($_POST['send_password'])) {
        if (retrievesPas($_POST['email_remenber'])) {
            echo mensaje("Check your email for a link to reset your password. If it doesn't appear within a few minutes, check your spam folder.");
            header("refresh:3;url=../Presentacion/index.php");

        } else {
            echo mensaje("Your email is not registered.");
            header("refresh:2;url=../Presentacion/index.php");
        };
    }

    // cas que l'admin vulgui afegir un ER //
    if (isset($_POST['AddER'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $descrip = $_POST['descrip'];
        $mark = $_POST['mark'];
        $price = $_POST['price'];
        $duration = "60";
        $administrator = $_SESSION['username'];
        $ERAdd = addEscapeRoom($name, $address, $descrip, $mark, $price, $duration, $administrator);
        if ($ERAdd == "0") {
            echo mensaje("Escape room added");
            header("refresh:1;url=../Presentacion/view/erAdmin.php");
        } elseif ($userAdd == "1") {
            echo mensaje("Escape room not added");
        }
    }
    // cas que l'admin vulgui borrar una ER //
    if (isset($_POST['DelER'])) {
        $administrator = $_SESSION['username'];
        $code = $_POST['cod_er'];
        if (deleteEscapeRoom($code, $administrator) == "0") {
            echo mensaje("Escape room remove");
            header("refresh:1;url=../Presentacion/view/erAdmin.php");
        } elseif ($userAdd == "1") {
            echo mensaje("Escape room not removed");
        }
    }
    // cas que es vulgui reservar una ER //
    if (isset($_POST['reserveER'])) {
        // coduser //
        $user = $_SESSION['username'];
        // escape room name //
        $escapeRoom = $_POST['multiple'];
        // echo "Escape room code: " . $coder . "<br>";
        $startdate = $_POST['date'];
        $start = $_POST['time'];
        $people = $_POST['people'];


        $parking = (isset($_REQUEST['parking'])) ? $_POST['listParking'] : null;

        // cas que no s'hagi seleccionat el checkbox del parking //

        if (reservarER($parking, $user, $escapeRoom, $startdate, $start, $people) == '1') {
            echo mensaje("Booked correctly.\n");
            header("refresh:1;url=../Presentacion/view/erUser.php");
        } else {
            echo mensaje("This date has been booked before.\n");
            header("refresh:4;url=../Presentacion/view/erUser.php");
        }
    }

    // cas que es vulgui modificar una ER //
    if (isset($_POST['ModER'])) {
        $admin = $_SESSION['username'];
        $ERName = $_POST['list_er_modify'];
        echo "ER Name: " . $ERName . "<br>";
        $coder = $admin . "." . $ERName;
        $codERSelect = ercode($_POST['list_er_modify']);
        $address = $_POST['address'];
        $descrip = $_POST['descrip'];
        $mark = $_POST['mark'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];
        $admin = $_SESSION['username'];
        $modificacionER = editEscapeRoom($codERSelect, $ERName, $address, $descrip, $mark, $price, $duration, $admin);
        if ($modificacionER == "1") {
            // tornem a la pagina principal //
            echo mensaje("You have modified correctly your escape room");
            header("refresh:1;url=../Presentacion/view/erAdmin.php");
        } else {
            // cas que no puguem borrar l'usuari //
            echo mensaje("We are not able to modify your escape room");
            header("refresh:1;url=../Presentacion/view/erAdmin.php");
        }
    }

    //Carga los parking que pertenecen a cada ER
    if (isset($_POST['dataParking'])) {
        if (!parkingXER($_POST['dataParking'])) {
            return false;
        }
    }

    //Usuario quiere eliminar una reserva
    if (isset($_POST['DeleteBook'])) {
        $nombreER = $_POST['ERName'];
        $user = $_SESSION['username'];
        $date = $_POST['date'];
        $hour = $_POST['hour2'];
        $resultat = deleteBook($user, $nombreER, $date, $hour);
        if ($resultat == "0") {
            // tornem a la pagina principal //
            echo mensaje("You have deleted your booking");
            header("refresh:1;url=../Presentacion/view/profile.php");
        } else if ($resultat == "1") {
            // tornem a la pagina principal //
            echo mensaje("There is no slot in this hour");
            header("refresh:1;url=../Presentacion/view/profile.php");
        }
    }

    //cuando se realiza la peticion de logout de google se revoca la autorizacion y borramos la sesiones
    if (isset($_REQUEST['log_out'])) {
        // lo requerimos para cuando se realice el logout de google 
        include_once 'controllerGoogle.php';
        $client->revokeToken();
        closeSession();
        header("refresh:1; url = ../Presentacion/");
    }

}//post general


function mensaje($msg)
{
    $html = '<div style="
    position: absolute;
    top: 11%;
    left: 15%;
    width: 19%;
    height: 55%;
    font-size: 18px;
    font-family: monospace;
    color: #f0ad4e;
    border: 8px solid rgba(0, 0, 0, 0.78);
    border-bottom: 30px solid rgba(201, 173, 106, 0.52);
"><h3 style="text-align: center">' . $msg . '</h3></div>';
    return $html;
}

?>
