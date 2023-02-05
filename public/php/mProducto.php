<?php
class mProducto
{

  function insertar($producto)
  {
    $sql = "
          INSERT INTO producto
            (id,categoria_id,nombre_producto,precio,marca_id,imagen,descripcion,stock)
          VALUES
            ($producto[id],$producto[categoria_id],'$producto[nombre_producto]',$producto[precio],'$producto[marca_id]','$producto[imagen]','$producto[descripcion]','$producto[stock]')
          ON DUPLICATE KEY UPDATE categoria_id='$producto[categoria_id]', nombre_producto='$producto[nombre_producto]', precio='$producto[precio]',marca_id='$producto[marca_id]',imagen='$producto[imagen]', descripcion='$producto[descripcion]', stock='$producto[stock]'";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function eliminar($id_producto)
  {

    $sql = "DELETE FROM producto WHERE producto.id_productol=$id_producto";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listar()
  {
    $sql = "
            select	* from producto
          ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }

  function select_msql($sql)
  {
    // echo $sql;
    $cnx = cnx();
    $rsql = mysqli_query($cnx, $sql);
    try {
      return $rsql;
    } catch (Exception $e) {
      return null;
    }
  }
}
