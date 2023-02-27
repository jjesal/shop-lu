<?php
class mOrden
{

  function insertar($orden_compra)
  {
    $sql = "
          INSERT INTO orden_compra
            (id,persona_id)
          VALUES
            ($orden_compra[id],$orden_compra[persona_id])
          ON DUPLICATE KEY UPDATE persona_id=$orden_compra[persona_id]";
    $lastId = $this->select_msql($sql, true);
    for ($i = 0; $i < sizeof($orden_compra['listaProductos']); $i++) {
      $this->insertarHas($lastId, $orden_compra['listaProductos'][$i]);
    }
    return $lastId;
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
  function eliminar($id_producto)
  {

    $sql = "DELETE FROM orden_compra WHERE orden_compra.id_producto=$id_producto";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listar()
  {
    $sql = "
            select	orden_compra.*, categoria.nombre_categoria, marca.nombre_marca from orden_compra
            inner join categoria
              on orden_compra.categoria_id=categoria.id
            inner join marca
              on orden_compra.marca_id=marca.id
          ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }

  function select_msql($sql, $returnId = false)
  {
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
