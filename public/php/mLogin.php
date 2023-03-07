<?php
class mLogin
{
    function comprobarUsuario($acc, $pass)
    {
        $sql = "
            select 	* from persona
            where persona.correo='$acc' and persona.password='$pass'
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
