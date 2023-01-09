<?php

function listarCargo()
{
    global $serverResponse;
    $funciones = new mConf();
    $registros = array();
    $result = $funciones->listarCargo();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}
function listarTurno()
{
    global $serverResponse;
    $funciones = new mConf();
    $registros = array();
    $result = $funciones->listarTurno();
    // echo json_encode($result)."<hr>";
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    // echo json_encode($registros)."<hr><hr>";
    return $serverResponse = $registros;
}
function listarCuenta()
{
 
    global $serverResponse;
    
    $funciones = new mConf();
    $registros = array();
    $result = $funciones->listarCuenta($_SESSION['user']['id_usuario']);
    
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    
    return $serverResponse = $registros;
}
function insertarCargo()
{
    global $axios_data;
    $funciones = new mConf();
    if (isset($axios_data['cargo'])) {
        $cargo = $axios_data['cargo'];
        $funciones->insertarCargo($cargo);
        listarConf();
    }
}
function insertarDepartamento()
{
    global $axios_data;
    $funciones = new mConf();
    if (isset($axios_data['departamento'])) {
        $departamento = $axios_data['departamento'];
        $funciones->insertarDepartamento($departamento);
        listarConf();
    }
}
function insertarEspecialidad()
{
    global $axios_data;
    $funciones = new mConf();
    if (isset($axios_data['especialidad'])) {
        $especialidad = $axios_data['especialidad'];
        $funciones->insertarEspecialidad($especialidad);
        listarConf();
    }
}
function insertarServicio()
{
    global $axios_data;
    $funciones = new mConf();
    if (isset($axios_data['servicio'])) {
        $servicio = $axios_data['servicio'];
        $funciones->insertarServicio($servicio);
        listarConf();
    }
}
function editarTurno()
{
    global $axios_data;
    $funciones = new mConf();
    if (isset($axios_data['turno'])) {
        $turno = $axios_data['turno'];
        $funciones->editarTurno($turno);
        listarConf();
    }
}
function editarCuenta()
{
    global $axios_data;
    
    $funciones = new mConf();
    if (isset($axios_data['cuenta'])) {
        $cuenta = $axios_data['cuenta'];
        $funciones->editarCuenta($_SESSION['user']['id_usuario'],$cuenta);
        listarConf();
    }
}
function listarDepartamento()
{
    global $serverResponse;
    $funciones = new mConf();
    $registros = array();
    $result = $funciones->listarDepartamento();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}
function listarEspecialidad()
{
    global $serverResponse;
    $funciones = new mConf();
    $registros = array();
    $result = $funciones->listarEspecialidad();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}
function listarServicio()
{
    global $serverResponse;
    $funciones = new mConf();
    $registros = array();
    $result = $funciones->listarServicio();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}
function listarConf()
{
    global $serverResponse;
    $Conf = [
        "cargos" => listarCargo(),
        "departamentos" => listarDepartamento(),
        "especialidades" => listarEspecialidad(),
        "servicios" => listarServicio(),
        "turnos" => listarTurno(),
        "usuario"=>listarCuenta()
    ];
    return $serverResponse = $Conf;
}
function eliminarDepartamento()
{
    global $axios_data;
    $funciones = new mConf();
    $id_departamento = $axios_data['id_departamento'];
    $funciones->eliminarDepartamento($id_departamento);
    listarConf();
}

function eliminarCargo()
{
    global $axios_data;
    $funciones = new mConf();
    $id_cargo = $axios_data['id_cargo'];
    $funciones->eliminarCargo($id_cargo);
    listarConf();
}

function eliminarEspecialidad()
{
    global $axios_data;
    $funciones = new mConf();
    $id_especialidad = $axios_data['id_especialidad'];
    $funciones->eliminarEspecialidad($id_especialidad);
    listarConf();
}
function eliminarservicio()
{
    global $axios_data;
    $funciones = new mConf();
    $id_servicio = $axios_data['id_servicio'];
    $funciones->eliminarServicio($id_servicio);
    listarConf();
}
