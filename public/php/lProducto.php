<?php
function insertarProducto()
{
    global $axios_data;
    $funciones = new mProducto();
    $producto = $axios_data;
    $producto["imagen"] = getImage();
    $funciones->insertar($producto);
    listarProducto();
}

function getImage()
{
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        $image = $_FILES['imagen']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        return $imgContent;
    } else {
        return "";
    }
}

function listarProducto()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mProducto();
    $result = $funciones->listar();
    while ($fila = mysqli_fetch_assoc($result)) {
        $fila["imagen"] = base64_encode($fila["imagen"]);
        $registros[] = $fila;
    }
    // var_dump($registros);
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
