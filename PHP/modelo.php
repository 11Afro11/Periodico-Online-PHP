<meta charset="utf-8">
<?php

include "config.php";


class BaseDatos
{
    protected $conexion;

    public function conectar()
    {
        $DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
        $DBUser   = 'user';
        $DBPass   = 'pass';
        $DBName   = 'mydomain';
        $this->conexion = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

        if ($this->conexion->connect_error) {
            trigger_error('Database connection failed: '  . $this->conexion->connect_error, E_USER_ERROR);
        }
        mysqli_set_charset($this->conexion,"utf8");

        return true;

    }

    public function desconectar()
    {
        if ($this->conectar->conexion) {
            mysqli_close($this->conexion);
        }

    }

    public function qwery($sql){
        return $this->conexion->query($sql);
    }



}
?>