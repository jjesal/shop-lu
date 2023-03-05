<?php
function insertarOrden()
{
    global $axios_data;
    global $serverResponse;
    $funciones = new mOrden();
    $orden = $axios_data;
    return $serverResponse = $funciones->insertar($orden);
}
function actualizarEstado()
{
    global $axios_data;
    global $serverResponse;
    $funciones = new mOrden();
    $orden = $axios_data;
    return $serverResponse = $funciones->actualizarEstado($orden);
}


function listarOrden()
{
    global $axios_data;
    global $serverResponse;
    $registros = array();
    $funciones = new mOrden();
    $condiciones = $axios_data;
    $result = $funciones->listar($condiciones);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = parseOrders($registros);
}

function parseOrders($rows)
{
    $orders = array_reduce($rows, function ($acc, $row) {
        $id = $row['id'];
        if (!isset($acc[$id])) {
            $acc[$id] = array(
                'id' => $id,
                'id_show' => $row['id_show'],
                'fecha_compra' => $row['fecha_compra'],
                'fecha_ejecucion' => $row['fecha_ejecucion'],
                'estado' => $row['estado'],
                'nombre_persona' => $row['nombre_persona'],
                'dni' => $row['dni'],
                'celular' => $row['celular'],
                'correo' => $row['correo'],
                'direccion' => $row['direccion'],
                'productos' => array(),
                'costo_total' => 0, // agregamos el campo costo_total
            );
        }
        $total_cost = $row['cantidad'] * $row['precio']; // calculamos el costo total del producto
        $total_cost = number_format($total_cost, 2);
        $acc[$id]['productos'][] = array(
            'precio' => $row['precio'],
            'cantidad' => $row['cantidad'],
            'nombre_producto' => $row['nombre_producto'],
            'stock' => $row['stock'],
            'nombre_categoria' => $row['nombre_categoria'],
            'nombre_marca' => $row['nombre_marca'],
            'costo_total' => $total_cost, // agregamos el campo costo_total
        );
        $acc[$id]['costo_total'] += $total_cost; // sumamos el costo total al campo costo_total de la orden de venta
        return $acc;
    }, array());
    $orders = array_values($orders);
    return $orders;
}

function eliminarOrden()
{
    global $axios_data;
    $funciones = new mOrden();
    $id_productol = $axios_data['id_productol'];
    $funciones->eliminar($id_productol);
    listarOrden();
}
