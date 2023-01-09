<?php
function insertarProgramacion()
{
    global $axios_data;
    $funciones = new mProgramacion();
    if (isset($axios_data['nuevaProgramacion'])) {
        $nuevaProgramacion = $axios_data['nuevaProgramacion'];
        $funciones->insertarFecha($nuevaProgramacion["fecha"]);
        for ($i = 0; $i < sizeof($nuevaProgramacion["arr_programacion"]); $i++) {
            $funciones->eliminarProgramacion($nuevaProgramacion["arr_programacion"][$i]);
        }
        for ($i = 0; $i < sizeof($nuevaProgramacion["personal"]); $i++) {
            $persona = $nuevaProgramacion["personal"][$i];
            if ($persona["codigo"] != "...") {
                $funciones->insertarProgramacion($nuevaProgramacion["turno"], $nuevaProgramacion["fecha"], $persona);
            }
        }
        viewCalendar();
    }
}
function insertarMultiple()
{
    global $Calendar_month;
    global $Calendar_year;
    global $axios_data;
    setDate();
    $funciones = new mProgramacion();
    if (isset($axios_data['nuevoMultiple'])) {
        $nuevoMultiple = $axios_data['nuevoMultiple'];
        $fecha_inicio = "$Calendar_year-$Calendar_month-$nuevoMultiple[dia_inicio]";
        $fecha_fin = "$Calendar_year-$Calendar_month-$nuevoMultiple[dia_fin]";

        if (!$nuevoMultiple['modo']) {//PARA REEMPLAZAR
            $funciones->eliminarProgramacionRango($nuevoMultiple["turno"], $fecha_inicio, $fecha_fin);
        }
        // 
        for ($dia = $nuevoMultiple['dia_inicio']; $dia <= $nuevoMultiple['dia_fin']; $dia++) {
            $datePHP = "$dia-$Calendar_month-$Calendar_year"; //Saca la fecha
            //nameOfDay
            if (date('w',  strtotime($datePHP)) != 0) {
                $fecha = "$Calendar_year-$Calendar_month-$dia";
                $funciones->insertarFecha($fecha);
                if (!$nuevoMultiple['modo']) {
                    //REEMPLAZA
                    $funciones->insertarProgramacionMultiple($nuevoMultiple["turno"], $fecha, $nuevoMultiple["personal"]);
                } else {//AGREGA, AÑADE
                    $funciones->insertarProgramacionMultipleCondicional($nuevoMultiple["turno"], $fecha, $nuevoMultiple["personal"]);
                }
            }
        }

        viewCalendar();
    }
}
function listarProgramacion($month, $year)
{
    global $g_cargo;
    $funciones = new mProgramacion();
    $result = $funciones->listar($month, $year, $g_cargo);
    $registros = array();
    while ($result != null && $fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    return $registros;
}
function viewCalendar()
{
    global $serverResponse;
    global $Calendar_month;
    global $Calendar_year;
    setDate();

    $structureDay = function () {
        $scheduledDay = [
            'fecha' => [], 'M' => [
                'personal' => [],
                'arr_programacion' => []
            ], 'T' => [
                'personal' => [],
                'arr_programacion' => []
            ], 'N' => [
                'personal' => [],
                'arr_programacion' => []
            ], 'R' => [
                'personal' => [],
                'arr_programacion' => []
            ], 'V' => [
                'personal' => [],
                'arr_programacion' => []
            ], 'L' => [
                'personal' => [],
                'arr_programacion' => []
            ]
        ];
        return $scheduledDay;
    };
    $joinCalendarData = function ($scheduledDay, $registros, $i) {
        $key1 = "id_turno";
        switch ($registros[$i][$key1]) { //se agrupan según el turno 
            case "1": {
                    array_push($scheduledDay["M"]["personal"], [
                        "id_programacion" => $registros[$i]["id_programacion"],
                        "id_personal" => $registros[$i]["id_personal"],
                        "codigo" => $registros[$i]["codigo"],
                        "id_turno" => $registros[$i]["id_turno"],
                        "nombres" => $registros[$i]["nombres"],
                        "apellidos" => $registros[$i]["apellidos"],
                        "extra" => $registros[$i]["extra"],
                        "cobro" => $registros[$i]["cobro"]
                    ]);
                    array_push(
                        $scheduledDay["M"]["arr_programacion"],
                        $registros[$i]["id_programacion"]
                    );
                    break;
                }
            case "2": {
                    array_push($scheduledDay["T"]["personal"], [
                        "id_programacion" => $registros[$i]["id_programacion"],
                        "id_personal" => $registros[$i]["id_personal"],
                        "codigo" => $registros[$i]["codigo"],
                        "id_turno" => $registros[$i]["id_turno"],
                        "nombres" => $registros[$i]["nombres"],
                        "apellidos" => $registros[$i]["apellidos"],
                        "extra" => $registros[$i]["extra"],
                        "cobro" => $registros[$i]["cobro"]
                    ]);
                    array_push(
                        $scheduledDay["T"]["arr_programacion"],
                        $registros[$i]["id_programacion"]
                    );
                    break;
                }
            case "3": {
                    array_push($scheduledDay["N"]["personal"], [
                        "id_programacion" => $registros[$i]["id_programacion"],
                        "id_personal" => $registros[$i]["id_personal"],
                        "codigo" => $registros[$i]["codigo"],
                        "id_turno" => $registros[$i]["id_turno"],
                        "nombres" => $registros[$i]["nombres"],
                        "apellidos" => $registros[$i]["apellidos"],
                        "extra" => $registros[$i]["extra"],
                        "cobro" => $registros[$i]["cobro"]
                    ]);
                    array_push(
                        $scheduledDay["N"]["arr_programacion"],
                        $registros[$i]["id_programacion"]
                    );
                    break;
                }
            case "4": {
                    array_push($scheduledDay["R"]["personal"], [
                        "id_programacion" => $registros[$i]["id_programacion"],
                        "id_personal" => $registros[$i]["id_personal"],
                        "codigo" => $registros[$i]["codigo"],
                        "id_turno" => $registros[$i]["id_turno"],
                        "nombres" => $registros[$i]["nombres"],
                        "apellidos" => $registros[$i]["apellidos"],
                        "extra" => $registros[$i]["extra"],
                        "cobro" => $registros[$i]["cobro"]
                    ]);
                    array_push(
                        $scheduledDay["R"]["arr_programacion"],
                        $registros[$i]["id_programacion"]
                    );
                    break;
                }
            case "5": {
                    array_push($scheduledDay["V"]["personal"], [
                        "id_programacion" => $registros[$i]["id_programacion"],
                        "id_personal" => $registros[$i]["id_personal"],
                        "codigo" => $registros[$i]["codigo"],
                        "id_turno" => $registros[$i]["id_turno"],
                        "nombres" => $registros[$i]["nombres"],
                        "apellidos" => $registros[$i]["apellidos"],
                        "extra" => $registros[$i]["extra"],
                        "cobro" => $registros[$i]["cobro"]
                    ]);
                    array_push(
                        $scheduledDay["V"]["arr_programacion"],
                        $registros[$i]["id_programacion"]
                    );
                    break;
                }
            case "6": {
                    array_push($scheduledDay["L"]["personal"], [
                        "id_programacion" => $registros[$i]["id_programacion"],
                        "id_personal" => $registros[$i]["id_personal"],
                        "codigo" => $registros[$i]["codigo"],
                        "id_turno" => $registros[$i]["id_turno"],
                        "nombres" => $registros[$i]["nombres"],
                        "apellidos" => $registros[$i]["apellidos"],
                        "extra" => $registros[$i]["extra"],
                        "cobro" => $registros[$i]["cobro"]
                    ]);
                    array_push(
                        $scheduledDay["L"]["arr_programacion"],
                        $registros[$i]["id_programacion"]
                    );
                    break;
                }
            default: {
                    break;
                }
        }
        return $scheduledDay;
    };
    $registros = listarProgramacion($Calendar_month, $Calendar_year); //todos los registros del mes desde la bd
    return $serverResponse = Calendario($registros, $structureDay, $joinCalendarData);
}
function setDate()
{
    global $Calendar_month;
    global $Calendar_year;
    global $axios_data;

    date_default_timezone_set('America/New_York');
    $Calendar_year = date("Y");
    $Calendar_month = date("n");
    $lastDate = ultimaFecha();
    $Calendar_year = $lastDate[0]['lastYear'];
    $Calendar_month = $lastDate[0]['lastMonth'];

    if (isset($axios_data['selectedYear']) && ($axios_data['selectedYear'] != -1)) {
        $Calendar_year = $axios_data['selectedYear'];
    }
    if (isset($axios_data['selectedMonth']) && ($axios_data['selectedMonth'] != -1)) {
        $Calendar_month = $axios_data['selectedMonth'];
    }
}
function ultimaFecha()
{
    global $serverResponse;
    $funciones = new mProgramacion();
    $registros = array();
    $result = $funciones->ultimaFecha();
    while ($fila = mysqli_fetch_assoc($result)) {
        $registros[] = $fila;
    }
    // echo "<hr>".json_encode($registros)."<hr>";
    return $serverResponse = $registros;
}
function Calendario($registros, $structureDay, $joinCalendarData)
{
    global $Calendar_month;
    global $Calendar_year;
    $programacion = [];

    $nameOfMonth = setMonthName($Calendar_month);
    for ($day = 1; $day < 32; $day++) { //Cada día del mes
        if (checkdate($Calendar_month, $day, $Calendar_year) == true) { //Controla que no se sobrepasen los días
            $date = "$day-$Calendar_month-$Calendar_year"; //Saca la fecha
            $nameOfDay = setDayName($date);
            $scheduledDay = $structureDay();
            $scheduledDay["fecha"] = [
                "day" => $day,
                "nameOfDay" => $nameOfDay,
                "month" => $Calendar_month,
                "nameOfMonth" => $nameOfMonth,
                "year" => $Calendar_year,
                "fecha" => "$Calendar_year-$Calendar_month-$day"
            ];
            for ($i = 0; is_array($registros) && $i < sizeof($registros); $i++) { //recorre registros de tb_programacion, no mes
                if ($registros[$i]["day"] == $day) { //los registros que coinciden con el día que se está analizando
                    $scheduledDay = $joinCalendarData($scheduledDay, $registros, $i);
                }
            }
            array_push($programacion, $scheduledDay);
        } else {
            break;
        }
    }
    return $programacion;
}
function setMonthName($Calendar_month)
{
    $nameOfMonth = '';
    switch ($Calendar_month) {
        case 1:
            $nameOfMonth = "ENERO";
            break;
        case 2:
            $nameOfMonth = "FEBRERO";
            break;
        case 3:
            $nameOfMonth = "MARZO";
            break;
        case 4:
            $nameOfMonth = "ABRIL";
            break;
        case 5:
            $nameOfMonth = "MAYO";
            break;
        case 6:
            $nameOfMonth = "JUNIO";
            break;
        case 7:
            $nameOfMonth = "JULIO";
            break;
        case 8:
            $nameOfMonth = "AGOSTO";
            break;
        case 9:
            $nameOfMonth = "SETIEMBRE";
            break;
        case 10:
            $nameOfMonth = "OCTUBRE";
            break;
        case 11:
            $nameOfMonth = "NOVIEMBRE";
            break;
        case 12:
            $nameOfMonth = "DICIEMBRE";
            break;
    };
    return $nameOfMonth;
}
function setDayName($date)
{
    $nameOfDay = '';
    switch (date('w',  strtotime($date))) { //Nombrar días
        case 0:
            $nameOfDay = "D";
            break;
        case 1:
            $nameOfDay = "L";
            break;
        case 2:
            $nameOfDay = "M";
            break;
        case 3:
            $nameOfDay = "M";
            break;
        case 4:
            $nameOfDay = "J";
            break;
        case 5:
            $nameOfDay = "V";
            break;
        case 6:
            $nameOfDay = "S";
            break;
    };
    return $nameOfDay;
}
