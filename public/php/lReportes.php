<?php

function reporteIndividual($month, $year, $code, $extra)
{
    global $g_cargo;
    $funciones = new mReportes();
    $registros = array();
    $result = $funciones->reporteIndividual($month, $year, $code, $extra, $g_cargo);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $registros;
}
function rptTurnos($month, $year, $code, $extra)
{
    global $g_cargo;
    $funciones = new mReportes();
    $registros = array();
    $result = $funciones->rptTurnos($month, $year, $code, $extra, $g_cargo);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $registros;
}
function rptGeneralTotales($month, $year)
{
    global $g_cargo;
    $funciones = new mReportes();
    $registros = array();
    $result = $funciones->rptGeneralTotales($month, $year, $g_cargo);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $registros;
}
function horasPersonal()
{
    global $serverResponse;
    global $g_cargo;
    global $Calendar_month;
    global $Calendar_year;
    setDate();
    $funciones = new mReportes();
    $registros = array();
    $result = $funciones->horasPersonal($Calendar_month, $Calendar_year, $g_cargo);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $serverResponse = $registros;
}
function viewGeneralReport()
{
    global $serverResponse;
    global $g_cargo;
    global $Calendar_month;
    global $Calendar_year;
    $rptGeneral = [
        "programacion" => [],
        "M"  => [
            "rows" => 0,
            "all" => 0,
            "ordinario" => 0,
            "extra" => 0,
        ],
        "T" => [
            "rows" => 0,
            "all" => 0,
            "ordinario" => 0,
            "extra" => 0,
        ],
        "N" => [
            "rows" => 0,
            "all" => 0,
            "ordinario" => 0,
            "extra" => 0,
        ],
        "R" => [
            "rows" => 0,
            "all" => 0,
            "ordinario" => 0,
            "extra" => 0,
        ],
        "V" => [
            "rows" => 0,
            "all" => 0,
            "ordinario" => 0,
            "extra" => 0,
        ],"turnos"=>listarTurno()
    ];
    $rptGeneral["programacion"] = viewCalendar();
    $rows = maxPersonalTurno($Calendar_month, $Calendar_year, $g_cargo);

    for ($i = 0; is_array($rows) && $i < sizeof($rows); $i++) {
        switch ($rows[$i]["id_turno"]) {
            case '1':
                $rptGeneral["M"]["rows"] = $rows[$i]["max_personal"];
                break;
            case '2':
                $rptGeneral["T"]["rows"] = $rows[$i]["max_personal"];
                break;
            case '3':
                $rptGeneral["N"]["rows"] = $rows[$i]["max_personal"];
                break;
            case '4':
                $rptGeneral["R"]["rows"] = $rows[$i]["max_personal"];
                break;
            case '5':
                $rptGeneral["V"]["rows"] = $rows[$i]["max_personal"];
                break;

            default:
                # code...
                break;
        }
    }
    $rows = rptGeneralTotales($Calendar_month, $Calendar_year);
    for ($i = 0; is_array($rows) && $i < sizeof($rows); $i++) {
        switch ($rows[$i]["id_turno"]) {
            case '1':
                switch ($rows[$i]["tipo"]) {
                    case 'all':
                        $rptGeneral["M"]["all"] = $rows[$i]["total_horas"];
                        break;
                    case 'ordinario':
                        $rptGeneral["M"]["ordinario"] = $rows[$i]["total_horas"];
                        break;
                    case 'extra':
                        $rptGeneral["M"]["extra"] = $rows[$i]["total_horas"];
                        break;
                    default:
                        # code...
                        break;
                }
                break;
            case '2':
                switch ($rows[$i]["tipo"]) {
                    case 'all':
                        $rptGeneral["T"]["all"] = $rows[$i]["total_horas"];
                        break;
                    case 'ordinario':
                        $rptGeneral["T"]["ordinario"] = $rows[$i]["total_horas"];
                        break;
                    case 'extra':
                        $rptGeneral["T"]["extra"] = $rows[$i]["total_horas"];
                        break;
                    default:
                        # code...
                        break;
                }
                break;
            case '3':
                switch ($rows[$i]["tipo"]) {
                    case 'all':
                        $rptGeneral["N"]["all"] = $rows[$i]["total_horas"];
                        break;
                    case 'ordinario':
                        $rptGeneral["N"]["ordinario"] = $rows[$i]["total_horas"];
                        break;
                    case 'extra':
                        $rptGeneral["N"]["extra"] = $rows[$i]["total_horas"];
                        break;
                    default:
                        # code...
                        break;
                }
                break;
            case '4':
                switch ($rows[$i]["tipo"]) {
                    case 'all':
                        $rptGeneral["R"]["all"] = $rows[$i]["total_horas"];
                        break;
                    case 'ordinario':
                        $rptGeneral["R"]["ordinario"] = $rows[$i]["total_horas"];
                        break;
                    case 'extra':
                        $rptGeneral["R"]["extra"] = $rows[$i]["total_horas"];
                        break;
                    default:
                        # code...
                        break;
                }
                break;
            case '5':
                switch ($rows[$i]["tipo"]) {
                    case 'all':
                        $rptGeneral["V"]["all"] = $rows[$i]["total_horas"];
                        break;
                    case 'ordinario':
                        $rptGeneral["V"]["ordinario"] = $rows[$i]["total_horas"];
                        break;
                    case 'extra':
                        $rptGeneral["V"]["extra"] = $rows[$i]["total_horas"];
                        break;
                    default:
                        # code...
                        break;
                }
                break;
            default:
                # code...
                break;
        }
    }
    return $serverResponse = $rptGeneral;
}
function maxPersonalTurno($month, $year) //para saber cuántas filas dibujar en reporte general
{
    global $g_cargo;
    $funciones = new mReportes();
    $registros = array();
    $result = $funciones->maxPersonalTurno($month, $year, $g_cargo);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $registros;
}
function viewIndividualReport()
{
    global $serverResponse;
    global $g_cargo;
    global $Calendar_month;
    global $Calendar_year;
    global $axios_data;
    global $code;
    setDate();

    if (isset($axios_data['codigo'])) {
        $code = $axios_data['codigo'];
        $respuesta = [
            "rptOrdinario" => [],
            "rptExtras" => [],
            "turnos"=>listarTurno()
        ];
        $reporteIndividual = reporteIndividual($Calendar_month, $Calendar_year, $code, 0, $g_cargo);
        $rptTurnos = rptTurnos($Calendar_month, $Calendar_year, $code, 0, $g_cargo);
        $respuesta["rptOrdinario"] = repeat($reporteIndividual, $rptTurnos);

        $reporteIndividual = reporteIndividual($Calendar_month, $Calendar_year, $code, 1, $g_cargo);
        $rptTurnos = rptTurnos($Calendar_month, $Calendar_year, $code, 1, $g_cargo);
        $respuesta["rptExtras"] = repeat($reporteIndividual, $rptTurnos);
        return $serverResponse = $respuesta;
    }
}
function repeat($registros, $rptTurnos)
{
    $structureDay = function () {
        $scheduledDay = ['fecha' => [], 'M' => [], 'T' => [], 'N' => [], 'R' => [],'V' => [],'L' => []];
        return $scheduledDay;
    };
    $joinCalendarData = function ($scheduledDay, $registros, $i) {
        $key1 = "id_turno";
        switch ($registros[$i][$key1]) { //se agrupan según el turno 
            case "1": {
                    $scheduledDay["M"] = [
                        "id_turno" => $registros[$i]["id_turno"],
                        "horas" => $registros[$i]["horas"],
                    ];
                    break;
                }
            case "2": {
                    $scheduledDay["T"] = [
                        "id_turno" => $registros[$i]["id_turno"],
                        "horas" => $registros[$i]["horas"]
                    ];
                    break;
                }
            case "3": {
                    $scheduledDay["N"] = [
                        "id_turno" => $registros[$i]["id_turno"],
                        "horas" => $registros[$i]["horas"]
                    ];
                    break;
                }
            case "4": {
                    $scheduledDay["R"] = [
                        "id_turno" => $registros[$i]["id_turno"],
                        "horas" => $registros[$i]["horas"]
                    ];
                    break;
                }
                case "5": {
                    $scheduledDay["V"] = [
                        "id_turno" => $registros[$i]["id_turno"],
                        "horas" => $registros[$i]["horas"]
                    ];
                    break;
                }
            default: {
                    break;
                }
        }
        return $scheduledDay;
    };
    $reporte = [
        "personal" => [
            "id_personal" => $rptTurnos[0]["id_personal"],
            "codigo" => $rptTurnos[0]["codigo"],
            "nombres" => $rptTurnos[0]["nombres"],
            "apellidos" => $rptTurnos[0]["apellidos"],
            "total_horas" => $rptTurnos[0]["total_horas"],
            "total_turnos" => $rptTurnos[0]["total_turnos"],
            "dni" => $rptTurnos[0]["dni"],
            "nro_colegiatura" => $rptTurnos[0]["nro_colegiatura"],
            "reg_especialidad" => $rptTurnos[0]["reg_especialidad"],
        ],
        "turnos" => [
            "M" => [],
            "T" => [],
            "N" => [],
            "R" => [],
            "V" => []
        ],
        "programacion" => []
    ];
    for ($i = 0; $i < sizeof($rptTurnos); $i++) {
        $key1 = "id_turno";
        switch ($rptTurnos[$i][$key1]) { //se agrupan según el turno 
            case "1": {
                    $reporte["turnos"]["M"] = [
                        "id_turno" => $rptTurnos[$i]["id_turno"],
                        "total_horas_turno" => $rptTurnos[$i]["total_horas_turno"],
                        "total_turnos_turno" => $rptTurnos[$i]["total_turnos_turno"],
                        "horas" => $rptTurnos[$i]["horas"]
                    ];
                    break;
                }
            case "2": {
                    $reporte["turnos"]["T"] = [
                        "id_turno" => $rptTurnos[$i]["id_turno"],
                        "total_horas_turno" => $rptTurnos[$i]["total_horas_turno"],
                        "total_turnos_turno" => $rptTurnos[$i]["total_turnos_turno"],
                        "horas" => $rptTurnos[$i]["horas"]
                    ];
                    break;
                }
            case "3": {
                    $reporte["turnos"]["N"] = [
                        "id_turno" => $rptTurnos[$i]["id_turno"],
                        "total_horas_turno" => $rptTurnos[$i]["total_horas_turno"],
                        "total_turnos_turno" => $rptTurnos[$i]["total_turnos_turno"],
                        "horas" => $rptTurnos[$i]["horas"]
                    ];
                    break;
                }
            case "4": {
                    $reporte["turnos"]["R"] = [
                        "id_turno" => $rptTurnos[$i]["id_turno"],
                        "total_horas_turno" => $rptTurnos[$i]["total_horas_turno"],
                        "total_turnos_turno" => $rptTurnos[$i]["total_turnos_turno"],
                        "horas" => $rptTurnos[$i]["horas"]
                    ];
                    break;
                }
                case "5": {
                    $reporte["turnos"]["V"] = [
                        "id_turno" => $rptTurnos[$i]["id_turno"],
                        "total_horas_turno" => $rptTurnos[$i]["total_horas_turno"],
                        "total_turnos_turno" => $rptTurnos[$i]["total_turnos_turno"],
                        "horas" => $rptTurnos[$i]["horas"]
                    ];
                    break;
                }
            default: {
                    break;
                }
        }
    }
    $reporte["programacion"] = Calendario($registros, $structureDay, $joinCalendarData);

    return $reporte;
}
function listarPersonalVacaciones($month, $year) //para saber cuántas filas dibujar en reporte general
{
    global $g_cargo;
    $funciones = new mReportes();
    $registros = array();
    $result = $funciones->listarPersonalVacaciones($month, $year, $g_cargo);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $registros;
}
function listarProgramacionVacaciones($month, $year) //para saber cuántas filas dibujar en reporte general
{
    global $g_cargo;
    $funciones = new mReportes();
    $registros = array();
    $result = $funciones->listarProgramacionVacaciones($month, $year, $g_cargo);
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $registros;
}
function reporteVacaciones()
{
    global $serverResponse;
    global $Calendar_month;
    global $Calendar_year;
    setDate();
    $nameOfMonth = setMonthName($Calendar_month);

    $f_estructuraVacaciones = function () {
        $estructuraVacaciones = [
            'listaVacaciones' => [], //almacena objetoVacaciones
            'fecha' => []
        ];
        return $estructuraVacaciones;
    };
    $f_objetoVacaciones = function () { //individual
        $objetoVacaciones = [
            'arrayDias' => [], //array programacion vacaciones mes
            'sumaHoras' => []
        ];
        return $objetoVacaciones;
    };
    $registroPersonalVacaciones = listarPersonalVacaciones($Calendar_month, $Calendar_year);
    $registroProgramacionVacaciones = listarProgramacionVacaciones($Calendar_month, $Calendar_year);
    $estructuraVacaciones = $f_estructuraVacaciones();
    $estructuraVacaciones["fecha"] = [
        "month" => $Calendar_month,
        "nameOfMonth" => $nameOfMonth,
        "year" => $Calendar_year,
    ];
    $size=sizeof($registroPersonalVacaciones);
    $scape=false;
    if ($size<1) {
        $size=1;
        $scape=true;
    }
    // echo "<hr>".json_encode($registroPersonalVacaciones)."<hr>";
    // echo "<hr>".json_encode($registroProgramacionVacaciones)."<hr>";
    for ($i = 0; is_array($registroPersonalVacaciones) && $i < $size; $i++) { //recorro personal único de vacaciones
        $objetoVacaciones = $f_objetoVacaciones();
        if (!$scape) {
            $codigoAnalizar = $registroPersonalVacaciones[$i]["codigo"];
        }else{
            $codigoAnalizar="0";
        }
        $sumaHoras = 0;
        $cuttedArray = false;
        $cutArray = false;
        $indice = 0;
        for ($day = 1; $day < 32; $day++) { //Cada día del mes
            if (checkdate($Calendar_month, $day, $Calendar_year) == true) { //Controla que no se sobrepasen los días
                //--- Hasta aquí valido las fechas
                if (!$cuttedArray||!$scape) {
                    if (($indice) < sizeof($registroProgramacionVacaciones)) {
                        if ($codigoAnalizar == $registroProgramacionVacaciones[$indice]["codigo"]) {
                            if ($day == $registroProgramacionVacaciones[$indice]["day"]) { //si o es igual intuyo que day es menor
                                array_push($objetoVacaciones["arrayDias"], $codigoAnalizar);
                                $sumaHoras += $registroProgramacionVacaciones[$indice]["horas"];
                                $indice++;
                            } else { //si ya no lo encuentra en el array programacion
                                // $registroProgramacionVacaciones=array_slice($registroProgramacionVacaciones,($indice),sizeof($registroProgramacionVacaciones));
                                $cutArray = true;//este bug cortará cuando este for finalice naturalmente
                                array_push($objetoVacaciones["arrayDias"], ' ');
                            }
                        } else {
                            $cutArray = true;
                            $cuttedArray = true;
                            array_push($objetoVacaciones["arrayDias"], ' ');
                        }
                    } else { //Si array programacion es más pequeño
                        array_push($objetoVacaciones["arrayDias"], ' ');
                    }
                } else {
                    array_push($objetoVacaciones["arrayDias"], ' ');
                }
            } else { //termina cuando sobrepasen los días del mes
                break;
            }
        }
        
        // if ($cutArray) {
            $registroProgramacionVacaciones = array_slice($registroProgramacionVacaciones, ($indice), sizeof($registroProgramacionVacaciones));
            $cutArray = false;
            $cuttedArray = true;
            // echo "<hr>CORTADO:<BR>".json_encode($registroProgramacionVacaciones)."<hr>";
        // }
        $objetoVacaciones["sumaHoras"] = $sumaHoras;
        array_push($estructuraVacaciones["listaVacaciones"], $objetoVacaciones);
    }
    return $serverResponse = $estructuraVacaciones;
}
