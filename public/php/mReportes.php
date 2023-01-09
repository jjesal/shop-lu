<?php
class mReportes
{
  function reporteIndividual($month, $year, $code, $extra, $g_cargo)
  {
    $sql = "select tb_programacion.id_programacion, tb_programacion.extra,tb_fecha.id_fecha, 
            day(tb_fecha.fecha) day, month(tb_fecha.fecha) month, year(tb_fecha.fecha) year,
            tb_turno.id_turno, tb_turno.nombre,tb_turno.horas, tb_personal.*,
            total_horas, total_turnos
            from tb_programacion 
            inner join tb_personal on tb_programacion.id_personal=tb_personal.id_personal
            inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
            inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha   
            left join (
            select tb_programacion.id_personal,sum(tb_turno.horas) total_horas,count(tb_programacion.id_programacion) total_turnos
              from tb_programacion 
              inner join tb_fecha on tb_programacion.id_fecha=tb_fecha.id_fecha
              inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
              inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
            where tb_personal.codigo='$code'  and tb_personal.id_cargo=$g_cargo and  month(tb_fecha.fecha) =$month 
              and year(tb_fecha.fecha) =$year and tb_programacion.extra=$extra and tb_programacion.id_turno<=5
            ) tb_totales on tb_programacion.id_personal=tb_totales.id_personal  
          where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year  and tb_personal.id_cargo=$g_cargo and tb_personal.codigo='$code' and tb_programacion.extra=$extra";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function rptTurnos($month, $year, $code, $extra, $g_cargo) //creo era un resumen por turno
  {
    $sql = "select tb_personal.*,
            tb_total_turno.id_turno, tb_total_turno.horas, ifnull(total_horas_turno,0) total_horas_turno,ifnull(total_turnos_turno,0) total_turnos_turno,
            ifnull(total_horas,0) total_horas, ifnull(total_turnos,0) total_turnos
              from tb_personal 
                left join (
                select tb_personal.id_personal,sum(tb_turno.horas) total_horas, sum(tb_turno.horas/6) total_turnos
                  from tb_personal
                  left join tb_programacion on tb_personal.id_personal=tb_programacion.id_personal
                  left join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
                  left join tb_fecha on tb_programacion.id_fecha=tb_fecha.id_fecha
                where  tb_personal.id_cargo=$g_cargo and tb_personal.codigo='$code' 
                and  month(tb_fecha.fecha) =$month and year(tb_fecha.fecha) =$year 
                and tb_programacion.extra=$extra " . ($extra == 1 ? " and tb_programacion.id_turno<3 " : " and tb_programacion.id_turno<=5 ") . " 
              ) tb_totales on tb_personal.id_personal=tb_totales.id_personal
                
              left join (
              select tb_programacion.id_personal,tb_turno.id_turno,tb_turno.horas, sum(tb_turno.horas) total_horas_turno,
              sum(tb_turno.horas/6) total_turnos_turno
                from tb_programacion 
                inner join tb_fecha on tb_programacion.id_fecha=tb_fecha.id_fecha
                inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
                    inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
              where  tb_personal.id_cargo=$g_cargo and tb_personal.codigo='$code' and  month(tb_fecha.fecha) =$month and year(tb_fecha.fecha) =$year and tb_programacion.extra=$extra
              group by tb_turno.id_turno
              ) tb_total_turno on tb_personal.id_personal=tb_total_turno.id_personal
            where  tb_personal.id_cargo=$g_cargo and tb_personal.codigo='$code'";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function maxPersonalTurno($month, $year, $g_cargo) //para saber cuántas filas dibujar en reporte general
  {
    $sql = "
              select nombre_turno, max(cant_personal) max_personal, id_turno from (
                select count(tb_programacion.id_programacion) cant_personal,tb_fecha.fecha, tb_programacion.id_turno, tb_turno.nombre nombre_turno          
                  from tb_programacion 
                  inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
                  inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
                  inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
                  where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year
                    and tb_personal.id_cargo=$g_cargo
                  group by tb_fecha.fecha,tb_turno.nombre
                  order by tb_fecha.fecha, tb_turno.nombre
            ) t1
            group by nombre_turno";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function horasPersonal($month, $year, $g_cargo) // lista personal con sus respectivas total horas trabajadas, para la tabla al final del reporte general
  {
    $sql = "
    select t0.codigo,t0.nombres,t0.apellidos,t3.vacac_licenc, ifnull(t1.total_horas,0) total_horas_ordinarias, ifnull(t2.total_horas,0) total_horas_extra
    from
      (select tb_personal.id_personal, tb_personal.codigo,tb_personal.nombres,tb_personal.apellidos,
        fecha from tb_personal
      left join tb_programacion  on tb_programacion.id_personal=tb_personal.id_personal
      inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
      where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year and tb_personal.id_cargo=$g_cargo
      group by tb_personal.codigo
      order by tb_fecha.fecha) t0
    left join #--TRAE HORAS ORDINARIAS
      (select tb_programacion.id_personal, sum(tb_turno.horas) total_horas from tb_programacion 
      inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
      inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
      inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
      where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year 
      and tb_personal.id_cargo=$g_cargo and tb_programacion.id_turno<5 and tb_programacion.extra=0
      group by tb_programacion.id_personal
      order by tb_fecha.fecha, tb_turno.nombre) t1
    on t0.id_personal=t1.id_personal
    left join #--TRAE HORAS EXTRAS
		(select tb_programacion.id_personal,sum(tb_turno.horas) total_horas from tb_programacion 
			inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
			inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
			inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
		where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year 
		and tb_personal.id_cargo=$g_cargo and not tb_programacion.id_turno=3 and tb_programacion.extra=1
		group by tb_programacion.id_personal
		order by tb_fecha.fecha, tb_turno.nombre)  t2
	on t0.id_personal=t2.id_personal 
	left join 
		(
			select * from (
				select tb_programacion.id_personal, tb_turno.id_turno vacac_licenc from tb_programacion 
					inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
					inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
					inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
				where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year 
					and tb_personal.id_cargo=$g_cargo and tb_programacion.id_turno>4 and tb_programacion.extra=0
				order by tb_personal.id_personal asc, tb_turno.id_turno desc
			) x
			group by x.id_personal
		) t3
	on t0.id_personal=t3.id_personal 
order by  SUBSTRING_INDEX(t0.codigo,'-',-1)+0 asc
    ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function rptGeneralTotales($month, $year, $g_cargo) //(ok Working) totales de todos los turnos (M,T,N,R,V) agrupado por tipo de reporte(ordinario,extra,all)
  {
    $sql = "
            (select case when tb_turno.id_turno=1 then 'all'
              when tb_turno.id_turno=2 then 'all'
              when tb_turno.id_turno=3 then 'all'
              when tb_turno.id_turno=4 then 'all' end tipo,
            tb_turno.nombre nombre_turno, sum(tb_turno.horas) total_horas, tb_turno.id_turno
            from tb_programacion 
            inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
            inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
            inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
            where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year
              and tb_personal.id_cargo=$g_cargo
            group by tb_turno.nombre
            order by tb_turno.nombre)
            UNION
            (select case when tb_turno.id_turno=1 then 'ordinario'
                  when tb_turno.id_turno=2 then 'ordinario'
                  when tb_turno.id_turno=3 then 'ordinario'
                  when tb_turno.id_turno=4 then 'ordinario' end tipo,
            tb_turno.nombre nombre_turno, sum(tb_turno.horas) total_horas, tb_turno.id_turno
            from tb_programacion 
            inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
            inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
            inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
            where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year and tb_programacion.extra=0
              and tb_personal.id_cargo=$g_cargo
            group by tb_turno.nombre
            order by tb_turno.nombre)
            UNION
            (select case when tb_turno.id_turno=1 then 'extra'
                  when tb_turno.id_turno=2 then 'extra'
                  when tb_turno.id_turno=3 then 'extra'
                  when tb_turno.id_turno=4 then 'extra' end tipo,
            tb_turno.nombre nombre_turno, sum(tb_turno.horas) total_horas, tb_turno.id_turno
            from tb_programacion 
            inner join tb_personal on tb_personal.id_personal=tb_programacion.id_personal
            inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
            inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
            where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year and tb_programacion.extra=1
              and tb_personal.id_cargo=$g_cargo
            group by tb_turno.nombre
            order by tb_turno.nombre)
    ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listarPersonalVacaciones($month, $year, $g_cargo)
  {
    $sql = "
      select DISTINCT  tb_personal.codigo
      from tb_programacion inner join tb_personal on tb_programacion.id_personal=tb_personal.id_personal
        inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
        inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
      where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year and tb_personal.id_cargo=$g_cargo and tb_turno.id_turno=5
      order by SUBSTRING_INDEX(tb_personal.codigo,'-',-1)+0 asc, tb_fecha.fecha asc
    ";
    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function listarProgramacionVacaciones($month, $year, $g_cargo)
  {
    $sql = "
    select tb_fecha.id_fecha, tb_fecha.fecha, day(tb_fecha.fecha) day, month(tb_fecha.fecha) month, year(tb_fecha.fecha) year, 
        tb_turno.id_turno, tb_turno.nombre,tb_turno.horas, 
        tb_personal.codigo, tb_personal.nombres, tb_personal.apellidos
    from tb_programacion inner join tb_personal on tb_programacion.id_personal=tb_personal.id_personal
        inner join tb_turno on tb_turno.id_turno=tb_programacion.id_turno
        inner join tb_fecha on tb_fecha.id_fecha=tb_programacion.id_fecha
    where month(tb_fecha.fecha)=$month and year(tb_fecha.fecha)=$year and tb_personal.id_cargo=$g_cargo and tb_turno.id_turno=5
    order by SUBSTRING_INDEX(tb_personal.codigo,'-',-1)+0 asc, tb_fecha.fecha asc
    ";

    // echo "$sql <br>";

    $rsql = $this->select_msql($sql);
    return $rsql;
  }
  function select_msql($sql)
  {
    $cnx = cnx();
    $rsql = mysqli_query($cnx, "SET SQL_BIG_SELECTS=1");
    $rsql = mysqli_query($cnx, $sql);
    if (!mysqli_query($cnx, $sql)) {
      printf("Error message: %s\n", mysqli_error($cnx));
    }
    try {
      return $rsql;
    } catch (Exception $e) {
      return $e;
    }
  }
}
