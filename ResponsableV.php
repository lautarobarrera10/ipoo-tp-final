<?php

// Cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido.
// Cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido.
class ResponsableV extends Persona
{
    private $numeroDeEmpleado;
    private $numeroDeLicencia;
    //lo comente por que son parametros del padre
    // private $nombre;
    // private $apellido;
    private $mensajeoperacion;

    public function __construct($nombre, $apellido, $documento)
    {
        parent::__construct($nombre, $apellido, $documento);
        $this->numeroDeEmpleado = 0;
        $this->numeroDeLicencia = 0;
        // $this->nombre = "";
        // $this->apellido = "";
    }

    // empezo saltando error cuando agregue la funcion al persona 
    public function cargar($documento,  $nombre,  $apellido, $numeroDeLicencia, $numeroDeAsiento,  $numeroDeTicket,  $idViaje)
    {
        $this->setNumeroDeLicencia($numeroDeLicencia);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setDocumento($documento);
    }

    public function insertar()
    {
        $database = new Database;
        $resp = false;
        $consultaInsertar = "INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) VALUES (" . $this->getNumeroDeLicencia() . ",'" . $this->getNombre() . "','" . $this->getApellido() . "')";

        if ($database->iniciar()) {

            if ($id = $database->devuelveIDInsercion($consultaInsertar)) {
                $this->setNumeroDeEmpleado($id);
                $resp =  true;
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }
        return $resp;
    }

    public function buscar( $numeroEmpleado)
    {
        $database = new Database;
        $consulta = "SELECT * FROM responsable WHERE rnumeroempleado=" . $numeroEmpleado;
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                if ($empleado = $database->registro()) {
                    $this->setNumeroDeEmpleado($empleado['rnumeroempleado']);
                    $this->setNumeroDeLicencia($empleado['rnumerolicencia']);
                    $this->setDocumento($empleado['rdocumento']);
                    $this->setNombre($empleado['rnombre']);
                    $this->setApellido($empleado['rapellido']);
                    $rta = true;
                }
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }
        return $rta;
    }



    public function modificar()
    {
        $database = new Database;
        $consulta = "UPDATE responsable SET 
                    rnumerolicencia = " . $this->getNumeroDeLicencia() . ",
                    rdocumento = " . $this->getDocumento() . ",
                    rnombre = '" . $this->getNombre() . "',
                    rapellido = '" . $this->getApellido() . "' 
                    WHERE rnumeroempleado = " . $this->getNumeroDeEmpleado();
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }
        return $rta;
    }

    public function eliminar()
    {
        $database = new Database;
        $consulta = "DELETE FROM responsable WHERE rnumeroempleado = " . $this->getNumeroDeEmpleado();
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }
        return $rta;
    }

    public function getNumeroDeEmpleado()
    {
        return $this->numeroDeEmpleado;
    }

    public function setNumeroDeEmpleado($value)
    {
        $this->numeroDeEmpleado = $value;
    }

    public function getNumeroDeLicencia()
    {
        return $this->numeroDeLicencia;
    }

    public function setNumeroDeLicencia($value)
    {
        $this->numeroDeLicencia = $value;
    }

    // public function getNombre()
    // {
    //     return $this->nombre;
    // }

    // public function setNombre($value)
    // {
    //     $this->nombre = $value;
    // }

    // public function getApellido()
    // {
    //     return $this->apellido;
    // }

    // public function setApellido($value)
    // {
    //     $this->apellido = $value;
    // }

    public function setMensajeoperacion($mensaje)
    {
        $this->mensajeoperacion = $mensaje;
    }

    public function __toString()
    {
        $cadena = parent::__toString();

        $cadena .=   "Número de empleado: " . $this->getNumeroDeEmpleado() . "\n" .
            "Número de licencia: " . $this->getNumeroDeLicencia() . "\n";
        return $cadena;
    }
}
