<?php
global $usuario;
function comprobarUsuario()
{
    // global $_SESSION;
    global $serverResponse;
    global $axios_data;
    $loggedIn = false;
    global $usuario;
    if (isset($axios_data['user'])) {
        $usuario = $axios_data['user'];
        $funciones = new mLogin();
        $result = $funciones->comprobarUsuario($usuario["acc"], $usuario["pass"]);
        if ($fila=mysqli_fetch_assoc($result)) {
            $usuario=$fila;
            $_SESSION['user'] = $usuario;
            $loggedIn = true;
        }
    }
    // echo "<hr>" . json_encode($_SESSION) . "<hr>";
    isLoggedIn();
    return $serverResponse = $loggedIn;
}
function isLoggedIn()
{
    // global $_SESSION;
    // echo "<hr>isLoggedIn " . json_encode($_SESSION) . "<hr>";
    global $serverResponse;
    $loggedIn = false;
    if (isset($_SESSION['user'])) {
        $loggedIn = true;
    }

    return $serverResponse = ['connected' => $loggedIn,"acc"=>isset($_SESSION['user'])?$_SESSION['user']['correo']:null];
}
function cerrarSesion()
{
    // global $_SESSION;
    global $serverResponse;
    session_destroy();

    return $serverResponse;
}
