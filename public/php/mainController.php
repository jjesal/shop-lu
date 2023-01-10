<?php

// header('Set-Cookie: TRACKID=xxxr; Path=/; SameSite=None; Secure');
session_start();
include("./cnx.php");
include("./lPersonal.php");
include("./mPersonal.php");
include("./lLogin.php");
include("./mLogin.php");


// $cookieParams = session_get_cookie_params();
// $cookieParams['samesite'] = "none";
// $cookieParams['httponly'] = true;
// $cookieParams['secure'] = true;
// $cookieParams['domain'] = $cookieParams['domain']."; SameSite=None";
// session_set_cookie_params($cookieParams['lifetime'],$cookieParams['path'],$cookieParams['domain'],$cookieParams['secure'],$cookieParams['httponly']);



// header('Access-Control-Allow-Origin: *');
#header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Content-Type: application/json');


$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
  die();
}
////////////////////////////////
global $_POST;
global $_GET;
global $respuesta;
global $serverResponse;
global $g_cargo;

// global $_SESSION;
if (isset($_POST['op'])) {
  $op = $_POST['op'];
}
if (isset($_GET['op'])) {
  $op = $_GET['op'];
}
$typeData = 0; //int
//$typeData=1//string

getAxiosData();
isLoggedIn();
if ($serverResponse['connected'] === true) {
  switch ($op) {
    case 'listarPersonal': {
        listarPersonal();
        $typeData = 1;
        break;
      }
    case 'listarPersonalDiasLibres': {
        listarPersonalDiasLibres();

        break;
      }
    case 'eliminarPersonal': {
        eliminarPersonal();
        break;
      }
    case 'cerrarSesion': {
        cerrarSesion();
        break;
      }
    default:
      break;
  }
} else {
  switch ($op) {
    case 'insertarPersonal': {
        insertarPersonal();
        $typeData = 1;
        break;
      }
    case 'comprobarUsuario': {
        comprobarUsuario();
        isLoggedIn();
        break;
      }
    case 'isLoggedIn': {
        isLoggedIn();
        break;
      }
      case 'isLoggedIn2': {
        $_SESSION['user'] = 'hola';
        break;
      }
      case 'isLoggedIn3': {
        // $_SESSION['user'] = 'hola';
        break;
      }
    default:
      break;
  }
}

http_response_code(200);
if ($typeData == 0) { //int
  echo  json_encode($serverResponse == null ? [] : $serverResponse, JSON_NUMERIC_CHECK);
} else {
  echo  json_encode($serverResponse == null ? [] : $serverResponse);
}

function getAxiosData()
{
  global $axios_data;
  $axios_data = json_decode(file_get_contents("php://input"), true);
}
