<?php
class mPersonal
{

  function insertar($persona)
  {
    $sql = "
          INSERT INTO persona
            (id,rol_id,nombres,apellidos,correo,celular,dni,password,direccion)
          VALUES
            ($persona[id],$persona[rol_id],'$persona[nombres]','$persona[apellidos]','$persona[correo]','$persona[celular]','$persona[dni]','$persona[password]','$persona[direccion]')
          ON DUPLICATE KEY UPDATE rol_id='$persona[rol_id]', nombres='$persona[nombres]', apellidos='$persona[apellidos]',correo='$persona[correo]',celular='$persona[celular]', dni='$persona[dni]', password='$persona[password]', direccion='$persona[direccion]'";
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
