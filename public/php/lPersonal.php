<?php
function insertarPersonal()
{
    global $axios_data;
    $funciones = new mPersonal();
    if (isset($axios_data['persona'])) {
        $persona = $axios_data['persona'];
        $funciones->insertar($persona,);
        listarPersona();
    }
}

function listarPersona()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mPersonal();
    $result = $funciones->listar();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}

function listarRol()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mPersonal();
    $result = $funciones->listarRol();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}

function eliminarPersonal()
{
    global $axios_data;
    $funciones = new mPersonal();
    $id_personal = $axios_data['id_personal'];
    $funciones->eliminar($id_personal);
}
