<?php
class mProgramacion
{

  function insertarFecha($fecha)
  {
    $sql = "INSERT INTO tb_fecha (fecha) VALUES ('$fecha') ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function ultimaFecha()
  {
    $sql = "select fecha, month(fecha) lastMonth, year(fecha) lastYear 
            from tb_fecha 
            inner join tb_programacion on tb_fecha.id_fecha=tb_programacion.id_fecha
            order by fecha desc 
            limit 1 ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function insertarProgramacion($id_turno, $fecha, $persona)
  {
    $sql = "
    INSERT INTO tb_programacion (id_turno, id_fecha, id_personal,extra,cobro) 
    VALUES ($id_turno,(select id_fecha from tb_fecha where fecha='$fecha'),
            (select id_personal from tb_personal where codigo='$persona[codigo]'),
            $persona[extra],$persona[cobro] )
          ";

    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function insertarProgramacionMultiple($id_turno, $fecha, $personal)
  {
    $values = "";
    $n = sizeof($personal);
    for ($i = 0; $i < $n; $i++) {

      if ($personal[$i]["codigo"] != "...") {

        $values .= "select $id_turno,
        (select id_fecha from tb_fecha where fecha='$fecha'),
        (select id_personal from tb_personal where codigo='" . $personal[$i]['codigo'] . "' )," .
          $personal[$i]['extra'] . " extra, " . $personal[$i]['cobro'] . " cobro from DUAL  
          where NOT exists 
          (select tb_personal.codigo 
             from tb_programacion
               inner join tb_personal on tb_programacion.id_personal=tb_personal.id_personal
               inner join tb_fecha on tb_programacion.id_fecha=tb_fecha.id_fecha
             where tb_personal.codigo='" . $personal[$i]['codigo'] . "' 
               and tb_fecha.fecha='$fecha' 
               and (" .
          ($id_turno < 5 ? "tb_programacion.id_turno>4" : ("tb_programacion.id_turno<5 or tb_programacion.id_turno=" .( $id_turno == 5 ? '6' : '5')))
          . ")
             LIMIT 1
           )
         ";

        if ($i < ($n - 1)) {
          $values .= " union ";
        }
      }
    }
    $sql = "
    INSERT INTO tb_programacion (id_turno, id_fecha, id_personal,extra,cobro) 
      select * from ( $values ) t1";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function insertarProgramacionMultipleCondicional($id_turno, $fecha, $personal)
  {
    //ESTO ES PARA EVITAR INSERTAR EL MISMO PERSONAL MÁS DE 
    //UNA VEZ EN EL MISMO TURNO A LA HORA DE AÑADIR
    $values = "";
    $n = sizeof($personal);
    for ($i = 0; $i < $n; $i++) {
      if ($personal[$i]["codigo"] != "...") {
        //DUAL ES PARA CREAR PSEUDOCOLUMNAS, COMO "SELECT FROM NADA"
        //WHERE NOT EXISTS (subquery) DEVUELVE TRUE SI LA SUBQUERY NO TRAE FILAS
        $values .= " select $id_turno, (select id_fecha from tb_fecha where fecha='$fecha'), (select id_personal from tb_personal where codigo='" . $personal[$i]['codigo'] . "' )," . $personal[$i]['extra'] . " extra, " . $personal[$i]['cobro'] . " cobro 
                     from DUAL
                     where NOT exists 
                     (select tb_personal.codigo 
                        from tb_programacion
                          inner join tb_personal on tb_programacion.id_personal=tb_personal.id_personal
                          inner join tb_fecha on tb_programacion.id_fecha=tb_fecha.id_fecha
                        where tb_personal.codigo='" . $personal[$i]['codigo'] . "' 
                          and tb_fecha.fecha='$fecha' 
                          and (" .
          ($id_turno < 5 ? ("tb_programacion.id_turno=$id_turno or tb_programacion.id_turno>4") : ("tb_programacion.id_turno=$id_turno or tb_programacion.id_turno<5 or tb_programacion.id_turno=" .( $id_turno == 5 ? '6' : '5')))
          . ")
                        LIMIT 1
                      )";
        if ($i < ($n - 1)) {
          $values .= " union ";
        }
      }
    }

    $sql = "
            INSERT INTO tb_programacion (id_turno, id_fecha, id_personal,extra,cobro) 
              select * from ( $values ) t1
           ";

    // echo "<hr>$sql<hr>";

    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function eliminarProgramacion($id_programacion)
  {
    $sql = "
          DELETE FROM tb_programacion WHERE tb_programacion.id_programacion=$id_programacion
              ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function eliminarProgramacionRango($id_turno, $fecha_inicio, $fecha_fin)
  {
    $sql = "
    delete from tb_programacion
    where tb_programacion.id_programacion>0 
          and tb_programacion.id_turno=$id_turno 
          and tb_programacion.id_fecha 
            in (select tb_fecha.id_fecha from tb_fecha 
                where tb_fecha.fecha>='$fecha_inicio' 
                  and tb_fecha.fecha<='$fecha_fin')
                  ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listar($month, $year, $g_cargo)
  {
    $sql = "
      select tb_programacion.id_programacion, tb_fecha.id_fecha, tb_fecha.fecha, day(tb_fecha.fecha) day, month(tb_fecha.fecha) month, year(tb_fecha.fecha) year, 
          tb_turno.id_turno,tb_programacion.extra,tb_programacion.cobro, tb_turno.nombre,tb_turno.horas, 
          tb_personal.id_personal, tb_personal.codigo, tb_personal.nombres, tb_personal.apellidos, tb_personal.estado
      from tb_programacion inner join tb_personal on tb_programacion.id_personal=tb_personal.id_personal
      inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
      inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
      where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year and tb_personal.id_cargo=$g_cargo";
    // echo "<hr>$sql<hr>";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }

  function select_msql($sql)
  {
    $cnx = cnx();
    $rsql = mysqli_query($cnx, $sql);
    try {
      return $rsql;
    } catch (Exception $e) {
      return null;
    }
  }
}
