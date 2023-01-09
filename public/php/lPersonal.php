<?php
function insertarPersonal()
{
    global $axios_data;
    $funciones = new mPersonal();
    if (isset($axios_data['persona'])) {
        $persona = $axios_data['persona'];
        $funciones->insertar($persona,);
        listarPersonal();
    }
}

function listarPersonal()
{
    global $serverResponse;
    $registros = array();
    $funciones = new mPersonal();
    $result = $funciones->listar();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}

function listarPersonalDiasLibres()
{ //devuelve array de personas
    global $serverResponse;
    global $axios_data;
    global $Calendar_month;
    global $Calendar_year;
    setDate();
    if ($Calendar_month <= 1) {
        $diasMesAnterior = date('t', mktime(0, 0, 0, 12, 1, $Calendar_year - 1));
        // $diasMesAnterior = cal_days_in_month(CAL_GREGORIAN, 12, $Calendar_year - 1);
    } else {
        $diasMesAnterior = date('t', mktime(0, 0, 0, $Calendar_month - 1, 1, $Calendar_year));
        // $diasMesAnterior = cal_days_in_month(CAL_GREGORIAN, $Calendar_month-1, $Calendar_year);
    }
    $registros = array();
    $funciones = new mPersonal();
    $result = $funciones->personalHorasTrabajadas($Calendar_month, $Calendar_year, $g_cargo);
    $fecha_actual = $axios_data['fecha_actual'];
    $turno_actual = $axios_data['turno_actual'];
    while ($fila = mysqli_fetch_assoc($result)) { //consulta por cada persona
        $codigo = $fila["codigo"];
        $result2 = $funciones->diasLibres($fecha_actual, $turno_actual, $codigo, $g_cargo);
        $fila2 = mysqli_fetch_assoc($result2);
        $fila["dias_libres"] = $fila2["dias_libres"] == null ? "no ha venido en el mes, hasta la fecha seleccionada" : $fila2["dias_libres"];
        $fila["horas_libres"] = $fila2["horas_libres"];
        $fila["fromServ"] = 0;
        if ($diasMesAnterior < 31) {
            $fila["evaluar_cobro"] = 0;
        }
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}

function eliminarPersonal()
{
    global $axios_data;
    $funciones = new mPersonal();
    $id_personal = $axios_data['id_personal'];
    $funciones->eliminar($id_personal);
    listarPersonal();
}
