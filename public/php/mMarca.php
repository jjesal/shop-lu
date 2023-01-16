<?php
class mMarca
{

  function insertar($marca)
  {
    $sql = "
          INSERT INTO marca
            (id,nombre_marca)
          VALUES
            ($marca[id],'$marca[nombre_marca]')
          ON DUPLICATE KEY UPDATE nombre_marca='$marca[nombre_marca]'";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function eliminar($id_marcal)
  {

    $sql = "DELETE FROM marca WHERE marca.id_marcal=$id_marcal ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listar()
  {
    $sql = "
            select	* from marca
          ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }

  function select_msql($sql)
  {
    echo $sql;
    $cnx = cnx();
    $rsql = mysqli_query($cnx, $sql);
    try {
      return $rsql;
    } catch (Exception $e) {
      return null;
    }
  }
}
