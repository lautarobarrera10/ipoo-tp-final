<?php

// Cada pasajero guarda  su nombre, apellido, numero de documento y teléfono.

// La clase Pasajero tiene como atributos el nombre, el número de asiento y el número de ticket del pasaje del viaje.


class Pasajero extends Persona
{
    private $telefono;
    private $idViaje;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->telefono = 0;
        $this->idViaje = 0;
    }


    public function cargar($nombre, $apellido, $documento, $telefono = 0, $idViaje = 0)
    {
        parent::cargar($nombre, $apellido, $documento);
        $this->setTelefono($telefono);
        $this->setIdViaje($idViaje);
    }



    public function insertar()
    {
        $database = new Database;
        $resp = false;
        if (parent::insertar()){
            $consulta = "INSERT INTO pasajero(pdocumento, ptelefono, idviaje) VALUES (
            '". $this->getDocumento() ."',
            ". $this->getTelefono() .",
            ". $this->getIdViaje() ."
            )";

            if ($database->iniciar()) {
                if ($database->ejecutar($consulta)) {
                    $resp =  true;
                } else {
                    $this->setMensajeoperacion($database->getError());
                }
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        }

        return $resp;
    }

    public function buscar($documento){
        $database = new Database;
        $consulta = "SELECT * FROM pasajero WHERE pdocumento='" . $documento . "'";
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                if ($pasajero = $database->registro()) {
                    parent::buscar($pasajero['pdocumento']);
                    $this->setTelefono($pasajero['ptelefono']);
                    $this->setIdViaje($pasajero['idviaje']);
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
            $consulta = "UPDATE pasajero SET 
            ptelefono = " . $this->getTelefono() . ",
            idviaje = " . $this->getIdViaje() .
            " WHERE pdocumento = ". $this->getDocumento();

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
        $consulta = "DELETE FROM pasajero WHERE pdocumento = '" . $this->getDocumento() . "'";
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


    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($value)
    {
        $this->telefono = $value;
    }

    public function getIdViaje()
    {
        return $this->idViaje;
    }

    public function setIdViaje($value)
    {
        $this->idViaje = $value;
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
        $cadena .=  "Teléfono: " . $this->getTelefono() . "\n" .
            "Id de viaje: " . $this->getIdViaje() . "\n";
        return $cadena;
    }

    public function darPorcentajeIncremento()
    {
        $porcentaje = 0;
        return $porcentaje;
    }
}
