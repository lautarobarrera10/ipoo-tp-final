<?php


// Cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido.
class ResponsableV extends Persona
{
    private $numeroDeEmpleado;
    private $numeroDeLicencia;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->numeroDeEmpleado = 0;
        $this->numeroDeLicencia = 0;
    }

    public function cargar($nombre, $apellido, $documento, $numeroDeLicencia = 0)
    {
        parent::cargar($nombre, $apellido, $documento);
        $this->setNumeroDeLicencia($numeroDeLicencia);
    }

    public function insertar()
    {
        $database = new Database;
        $resp = false;
        if (parent::insertar()){
            $consulta = "INSERT INTO responsable(rnumerolicencia, rdocumento) VALUES (
            " . $this->getNumeroDeLicencia() . ",
            '" . $this->getDocumento() . "')";

            if ($database->iniciar()){
                if ($numeroEmpleado = $database->devuelveIDInsercion($consulta)){
                    $this->setNumeroDeEmpleado($numeroEmpleado);
                    $resp =  true;
                } else {
                    $this->setMensajeoperacion($database->getError());
                }
            } else {
                $this->setMensajeoperacion($database->getError());
            }

            return $resp;
        }
    }

    public function buscar($numeroEmpleado)
    {
        $database = new Database;
        $consulta = "SELECT * FROM responsable WHERE rnumeroempleado=" . $numeroEmpleado;
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                if ($empleado = $database->registro()) {
                    parent::buscar($empleado['rdocumento']);
                    $this->setNumeroDeEmpleado($empleado['rnumeroempleado']);
                    $this->setNumeroDeLicencia($empleado['rnumerolicencia']);
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
        $rta = false;
        if (parent::modificar()){
            $consulta = "UPDATE responsable SET rnumerolicencia = " . $this->getNumeroDeLicencia() . 
            " WHERE rnumeroempleado = ". $this->getNumeroDeEmpleado();

            if ($database->iniciar()) {
                if ($database->ejecutar($consulta)) {
                    $rta = true;
                } else {
                    $this->setMensajeoperacion($database->getError());
                }
            } else {
                $this->setMensajeoperacion($database->getError());
            }
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

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

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
