<?php
class mCategoria
{

  function insertar($categoria)
  {
    $sql = "
          INSERT INTO categoria
            (id,nombre_categoria)
          VALUES
            ($categoria[id],'$categoria[nombre_categoria]')
          ON DUPLICATE KEY UPDATE id='$categoria[id]', nombre_categoria='$categoria[nombre_categoria]'";
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
            select id, nombre_categoria nombre from categoria
          ";
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
