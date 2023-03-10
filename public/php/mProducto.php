<?php
class mProducto
{

  function insertar($producto)
  {
    $imagen = isset($producto["imagen"]) ? "imagen='$producto[imagen]'," : "";
    $sql = "
          INSERT INTO producto
            (id,categoria_id,nombre_producto,precio,marca_id,imagen,descripcion,stock)
          VALUES
            ($producto[id],$producto[categoria_id],'$producto[nombre_producto]',$producto[precio],'$producto[marca_id]','$producto[imagen]','$producto[descripcion]','$producto[stock]')
          ON DUPLICATE KEY UPDATE categoria_id='$producto[categoria_id]', nombre_producto='$producto[nombre_producto]', precio='$producto[precio]',marca_id='$producto[marca_id]',$imagen descripcion='$producto[descripcion]', stock='$producto[stock]'";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function eliminar($id_producto)
  {

    $sql = "DELETE FROM producto WHERE producto.id_productol=$id_producto";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listar($condiciones = null)
  {
    $sql = "
            select	producto.*, categoria.nombre_categoria, marca.nombre_marca from producto
            inner join categoria
              on producto.categoria_id=categoria.id
            inner join marca
              on producto.marca_id=marca.id
          ";
    if (isset($condiciones['campo'])) {
      $sql .= " WHERE $condiciones[campo] $condiciones[operador] '$condiciones[valor]' ";
    }
    if (isset($condiciones['orderType'])) {
      $sql .= " ORDER BY producto.precio $condiciones[orderType]";
    }
    // echo $sql;
    $rsql = $this->select_msql($sql);
    return $rsql;
  }

  function select_msql($sql)
  {
    // echo $sql;
    $cnx = cnx();
    try {
      $rsql = mysqli_query($cnx, $sql);
      return $rsql;
    } catch (Exception $e) {
      var_dump($e);
      return null;
    }
  }
}
