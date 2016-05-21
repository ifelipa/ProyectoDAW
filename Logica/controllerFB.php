<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


/*LOGIN CON FACEBOOK*/
require_once 'Facebook/autoload.php';
require_once '../Persistencia/userFunctions.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

// Iniciamos el objeto facebool con las claves de la api
FacebookSession::setDefaultApplication('1687189074874690', 'a4896e1fec2d7a950550cf87d697cb99');

// Enlace que ayuda al incio de sesion
$helper = new FacebookRedirectLoginHelper('http://localhost/The_Escape/Logica/controllerFB.php');

try {
    $session = $helper->getSessionFromRedirect();
} catch (FacebookRequestException $ex) {
    // When Facebook returns an error
} catch (Exception $ex) {
    // When validation fails or other local issues
}
// see if we have a session
if (isset($session)) {
    $_SESSION['signUp'] = 1;
    $_SESSION['isAdmin'] = false;

    // graph api request for user data
    $request = new FacebookRequest($session, 'GET', '/me');
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');
    $fbfullname = $graphObject->getProperty('name');
    /* ---- Session Variables -----*/
    $_SESSION['fbID'] = $fbid;
    $userF = explode(" ", $fbfullname);
    $femail = $userF[0] . "." . $userF[1] . '@facebook.com';
    $usernamefacebook = strtolower($userF[0] . "_facebook");

    if (validateUsername($usernamefacebook)) {

        addUser($userF[0], $userF[1], $usernamefacebook, $femail, 'f', $usernamefacebook, '00000', '0000', 'x');
    }
    $_SESSION['username'] = $usernamefacebook;
    header("Location: ../Presentacion/view/index.php");
} else {
    $loginUrl = $helper->getLoginUrl();
    header("Location: " . $loginUrl);
}

?>