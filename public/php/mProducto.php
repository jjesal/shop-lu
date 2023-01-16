<?php
class mProducto
{

  function insertar($producto)
  {
    $sql = "
          INSERT INTO producto
            (id,categoria_id,nombre,precio,marca_id,imagen,descripcion,stock)
          VALUES
            ($producto[id],$producto[categoria_id],'$producto[nombre]',$producto[precio],'$producto[marca_id]','$producto[imagen]','$producto[descripcion]','$producto[stock]')
          ON DUPLICATE KEY UPDATE categoria_id='$producto[categoria_id]', nombre='$producto[nombre]', precio='$producto[precio]',marca_id='$producto[marca_id]',imagen='$producto[imagen]', descripcion='$producto[descripcion]', stock='$producto[stock]'";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function eliminar($id_personal)
  {

    $sql = "DELETE FROM persona WHERE persona.id_personal=$id_personal ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listar()
  {
    $sql = "
            select	* from persona
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
