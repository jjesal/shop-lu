<?php
function insertarOrden()
{
    global $axios_data;
    global $serverResponse;
    $funciones = new mOrden();
    $orden = $axios_data;
    return $serverResponse = $funciones->insertar($orden);
}


function listarOrden()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mOrden();
    $result = $funciones->listar();
    while ($fila = mysqli_fetch_assoc($result)) {
        $fila["imagen"] = base64_encode($fila["imagen"]);
        $registros[] = $fila;
    }
    // var_dump($registros);
    return $serverResponse = $registros;
}

function eliminarOrden()
{
    global $axios_data;
    $funciones = new mOrden();
    $id_productol = $axios_data['id_productol'];
    $funciones->eliminar($id_productol);
    listarOrden();
}
