<?php
function insertarProducto()
{
    global $axios_data;
    $funciones = new mProducto();
    if (isset($axios_data['producto'])) {
        $producto = $axios_data['producto'];
        $funciones->insertar($producto,);
        listarProducto();
    }
}

function listarProducto()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mProducto();
    $result = $funciones->listar();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}

function eliminarProducto()
{
    global $axios_data;
    $funciones = new mProducto();
    $id_productol = $axios_data['id_productol'];
    $funciones->eliminar($id_productol);
    listarProducto();
}
