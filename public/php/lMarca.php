<?php
function insertarMarca()
{
    global $axios_data;
    $funciones = new mMarca();
    if (isset($axios_data)) {
        $funciones->insertar($axios_data);
        listarMarca();
    }
}

function listarMarca()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mMarca();
    $result = $funciones->listar();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}

function eliminarMarca()
{
    global $axios_data;
    $funciones = new mMarca();
    $id_Marca = $axios_data['id_Marca'];
    $funciones->eliminar($id_Marca);
    listarMarca();
}
