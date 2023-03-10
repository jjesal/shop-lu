<?php

// header('Set-Cookie: TRACKID=xxxr; Path=/; SameSite=None; Secure');
session_start();
include("./cnx.php");
include("./lPersonal.php");
include("./mPersonal.php");
include("./lLogin.php");
include("./mLogin.php");
include("./lProducto.php");
include("./mProducto.php");
include("./lCategoria.php");
include("./mCategoria.php");
include("./lMarca.php");
include("./mMarca.php");
include("./lOrden.php");
include("./mOrden.php");

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
    case 'listarRol': {
        listarRol();
        $typeData = 1;
        break;
      }
    case 'listarProducto': {
        listarProducto();
        $typeData = 1;
        break;
      }
    case 'insertarProducto': {
        insertarProducto();
        $typeData = 1;
        break;
      }
    case 'insertarOrden': {
        insertarOrden();
        $typeData = 1;
        break;
      }
    case 'insertarCategoria': {
        insertarCategoria();
        $typeData = 1;
        break;
      }
    case 'insertarMarca': {
        insertarMarca();
        $typeData = 1;
        break;
      }
    case 'listarCategoria': {
        listarCategoria();
        $typeData = 1;
        break;
      }
    case 'listarMarca': {
        listarMarca();
        $typeData = 1;
        break;
      }
    case 'listarPersona': {
        listarPersona();
        $typeData = 1;
        break;
      }
    case 'listarOrden': {
        listarOrden();
        $typeData = 1;
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
    case 'actualizarEstado': {
        actualizarEstado();
        isLoggedIn();
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
  if (!isset($axios_data)) {
    $axios_data = $_POST;
  }
}
