<?php
function insertarCategoria()
{
    global $axios_data;
    $funciones = new mCategoria();
    if (isset($axios_data)) {
        $funciones->insertar($axios_data,);
        listarCategoria();
    }
}

function listarCategoria()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mCategoria();
    $result = $funciones->listar();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}

function eliminarCategoria()
{
    global $axios_data;
    $funciones = new mCategoria();
    $id_Categoria = $axios_data['id_Categoria'];
    $funciones->eliminar($id_Categoria);
    listarCategoria();
}
