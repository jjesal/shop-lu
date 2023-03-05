<?php
class mOrden
{

  function insertar($orden_compra)
  {
    $sql = "
          INSERT INTO orden_compra
            (id,persona_id, estado)
          VALUES
            ($orden_compra[id], $orden_compra[persona_id], '$orden_compra[estado]')
          ON DUPLICATE KEY UPDATE persona_id=$orden_compra[persona_id], estado='$orden_compra[estado]'";
    $lastId = $this->select_msql($sql, true);
    for ($i = 0; $i < sizeof($orden_compra['listaProductos']); $i++) {
      $this->insertarHas($lastId, $orden_compra['listaProductos'][$i]);
    }

    return "#" . str_pad($lastId, 6, "0", STR_PAD_LEFT);
  }

  function insertarHas($lastId, $orden_compra_has_producto)
  {
    $sql = "
          INSERT INTO orden_compra_has_producto
            (orden_compra_id,producto_id, precio, cantidad)
          VALUES
            ($lastId, $orden_compra_has_producto[id], $orden_compra_has_producto[precio], $orden_compra_has_producto[cantidad])";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }

  function actualizarEstado($orden_compra)
  {
    $fecha = $orden_compra['estado'] === 'Entregado' ? ", fecha_ejecucion = NOW() " : "";

    $sql = "
    UPDATE `mydb`.`orden_compra`
    SET `estado` = '$orden_compra[estado]' 
    $fecha
    WHERE `id` = $orden_compra[id]";
    // echo $sql;
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function eliminar($id_producto)
  {

    $sql = "DELETE FROM orden_compra WHERE orden_compra.id_producto=$id_producto";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listar()
  {
    $sql = "
    select
      CONCAT('#', LPAD(orden_compra.id, 6, '0')) id_show, orden_compra.id, orden_compra.fecha_compra,orden_compra.fecha_ejecucion, orden_compra.estado,
      CONCAT(persona.nombres , ', ' , persona.apellidos) AS nombre_persona, persona.dni, persona.celular, persona.correo, persona.direccion,
      orden_compra_has_producto.precio, orden_compra_has_producto.cantidad,
      producto.nombre_producto, producto.stock,
      categoria.nombre_categoria,
      marca.nombre_marca
    from orden_compra
      inner join persona
      on orden_compra.persona_id=persona.id
      inner join orden_compra_has_producto
      on orden_compra.id=orden_compra_has_producto.orden_compra_id
      inner join producto
      on orden_compra_has_producto.producto_id=producto.id
      inner join categoria
      on producto.categoria_id=categoria.id
      inner join marca
      on producto.marca_id=marca.id
          ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }

  function select_msql($sql, $returnId = false)
  {
    // echo $sql;
    $cnx = cnx();
    $rsql = mysqli_query($cnx, $sql);
    try {
      if ($returnId) {
        // printf("Nuevo registro con el id %d.\n", $cnx->insert_id);
        return  $cnx->insert_id;
      }
      return $rsql;
    } catch (Exception $e) {
      return null;
    }
  }
}
