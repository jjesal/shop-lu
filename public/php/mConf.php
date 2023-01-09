<?php
class mConf
{
    function listarCargo()
    {
        $sql = "
            select 	* from tb_cargo
            order by id_cargo
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function listarCuenta($id_usuario)
    {
        $sql = "
            select 	acc, pass  from tb_usuario
            where tb_usuario.id_usuario=$id_usuario
            order by id_usuario
            ";
        // echo "<hr>$sql<hr>";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function listarTurno()
    {
        $sql = "select * from tb_turno
                order by id_turno asc";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function editarTurno($turno)
    {
        $sql = "
                UPDATE tb_turno SET codigo='$turno[codigo]' 
                where id_turno=$turno[id_turno]
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function editarCuenta($id_usuario, $cuenta)
    {
        $sql = "
                UPDATE tb_usuario SET acc='$cuenta[acc]' 
                " . ($cuenta['new_pass_1'] != "" ? ", pass='$cuenta[new_pass_1]'" : "") . "
                where id_usuario=$id_usuario
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function insertarCargo($cargo)
    {
        $sql = "
        INSERT INTO tb_cargo (id_cargo,nombre_cargo) VALUES ($cargo[id_cargo],'$cargo[nombre_cargo]') 
        ON DUPLICATE KEY UPDATE nombre_cargo='$cargo[nombre_cargo]' 
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function insertarDepartamento($departamento)
    {
        $sql = "
        INSERT INTO tb_departamento (id_departamento,nombre_departamento) VALUES ($departamento[id_departamento],'$departamento[nombre_departamento]') 
        ON DUPLICATE KEY UPDATE nombre_departamento='$departamento[nombre_departamento]' 
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function insertarServicio($servicio)
    {
        $sql = "
        INSERT INTO tb_servicio (id_servicio,nombre_servicio) VALUES ($servicio[id_servicio],'$servicio[nombre_servicio]') 
        ON DUPLICATE KEY UPDATE nombre_servicio='$servicio[nombre_servicio]' 
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function insertarEspecialidad($especialidad)
    {
        $sql = "
        INSERT INTO tb_especialidad (id_especialidad,nombre_especialidad) VALUES ($especialidad[id_especialidad],'$especialidad[nombre_especialidad]') 
        ON DUPLICATE KEY UPDATE nombre_especialidad='$especialidad[nombre_especialidad]' 
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function eliminarDepartamento($id_departamento)
    {

        $sql = "DELETE FROM tb_departamento WHERE tb_departamento.id_departamento=$id_departamento ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function eliminarCargo($id_cargo)
    {

        $sql = "DELETE FROM tb_cargo WHERE tb_cargo.id_cargo=$id_cargo ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function eliminarServicio($id_servicio)
    {

        $sql = "DELETE FROM tb_servicio WHERE tb_servicio.id_servicio=$id_servicio ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function eliminarEspecialidad($id_especialidad)
    {

        $sql = "DELETE FROM tb_especialidad WHERE tb_especialidad.id_especialidad=$id_especialidad ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function listarDepartamento()
    {
        $sql = "
            select 	* from tb_departamento
            order by id_departamento
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function listarEspecialidad()
    {
        $sql = "
            select 	* from tb_especialidad
            order by id_especialidad
            ";
        $rsql = $this->select_msql($sql);
        return $rsql;
    }
    function listarServicio()
    {
        $sql = "
            select 	* from tb_servicio
            order by id_servicio
            ";
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
