<?php
class Persona
{
    private $nombre;
    private $apellido;
    private $documento;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->nombre = "";
        $this->apellido = "";
        $this->documento = "";
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($value)
    {
        $this->nombre = $value;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($value)
    {
        $this->apellido = $value;
    }
    public function getDocumento()
    {
        return $this->documento;
    }

    public function setDocumento($value)
    {
        $this->documento = $value;
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
        return "Nombre: " . $this->getNombre() . "\n" .
            "Apellido: " . $this->getApellido() . "\n".
            "Documento: " . $this->getDocumento() . "\n";

    }

    public function cargar($nombre,  $apellido,  $documento)
    {
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setDocumento($documento);
    }

    public function insertar()
    {
        $database = new Database;
        $persona = false;
        $consultaInsertar = "INSERT INTO persona(nombre, apellido ,documento) VALUES (
        '"  . $this->getNombre() . "',
        '" . $this->getApellido() . "',
        '" . $this->getDocumento() . "'
        )";

        if ($database->iniciar()) {

            if ($database->ejecutar($consultaInsertar)) {
                $persona =  true;
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }
        return $persona;
    }

    public function buscar($documento)
    {
        $database = new Database;
        $consulta = "SELECT * FROM persona WHERE documento = '". $documento ."'";
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                if ($persona = $database->registro()) {
                    $this->setDocumento($persona['documento']);
                    $this->setNombre($persona['nombre']);
                    $this->setApellido($persona['apellido']);
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
        $consulta = "UPDATE persona SET 
                    nombre = '" . $this->getNombre() . "',
                    apellido = '" . $this->getApellido() . "' 
                    WHERE documento = '" . $this->getDocumento() . "'";
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
        $consulta = "DELETE FROM Persona WHERE documento = '" . $this->getDocumento() . "'";
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
}
