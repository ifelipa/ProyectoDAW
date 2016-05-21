<?php
//comprueba que la session este iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//date_default_timezone_set('Europe/Madrid');
require($_SERVER['DOCUMENT_ROOT'] . '/The_Escape/Persistencia/ERFunctions.php');


/**
 * Funcion que retorna todas las escape room de un admin en concreto
 * @param $userAdmin
 * @return array|null
 */
function listDataEscapeRoom($userAdmin)
{
    if (listEscapeRoom($userAdmin) != null) {
        return listEscapeRoom($userAdmin);
    } else {
        echo "Empty list";
    }
}

/**
 * Funcion que retorna todas las escaperoom de la base de datos
 * @return array|null
 */
function listDataEscapeRoomUser()
{
    if (listAllEscapeRoom() != null) {
        return listAllEscapeRoom();
    } else {
        echo "Empty list";
    }
}

/**
 * Funcion que te devuelve las reservas del usuario. PROFILE.PHP
 */
function hasBooking($username)
{
    if (reservationXuser($username) != null) {
        return reservationXuser($username);
    } else {
        return false;
    }
}

/*
 * funcion que retorna el nombre del parking. PROFILE.PHP
 * */
function parkingName($codparking)
{
    if (!empty(nameParking($codparking))) {
        return nameParking($codparking);
    }

}

/*
*   Retorna reservas hechas en las escape rooms de un cierto admin. PROFILE.PHP
*
*/
function bookingsERAdmin($admin)
{
    if (bookingsERUser($admin) != null) {
        return bookingsERUser($admin);
    } else {
        return false;
    }
}

?>
