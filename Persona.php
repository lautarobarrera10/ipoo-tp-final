<?php
class Persona
{
    private $nombre;
    private $apellido;
    private $documento;
    private $mensajeoperacion;



    public function __construct($nombre, $apellido, $documento)
    {

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->documento = $documento;
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

// se declaran todas las variables porque sino salta error de tipado en la funcion cargar de pasajero y responsableV
    // carga los datos de la persona a la base de datos
    // public function cargar( $nombre,  $apellido,  $documento, $telefono,  $numeroDeAsiento,  $numeroDeTicket,  $idViaje)
    public function cargar($nombre,  $apellido,  $documento, $telefono,  $numeroDeAsiento,  $numeroDeTicket,  $idViaje)
    {
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setDocumento($documento);
    }



    // consultar con kathe porque tantos errores  revisar 
    public function insertar()
    {
        $database = new Database;
        $persona = false;
        $consultaInsertar = "INSERT INTO persona(nombre, apellido ,documento) VALUES ("  . $this->getNombre() . "," . $this->getApellido() . "," . $this->getDocumento() .")";

        if ($database->iniciar()) {

            if ($id = $database->devuelveIDInsercion($consultaInsertar)) {
                // $this->setNumeroDeEmpleado($id);
                $persona =  true;
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }
        return $persona;
    }

    // salta error en el mensajeoperacion get error  revisar where y funcion completa 
    public function buscar($documento)
    {
        $database = new Database;
        $consulta = "SELECT * FROM persona WHERE documento = ". $documento;
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                if ($persona = $database->registro()) {
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
                    WHERE documento = " . $this->getDocumento();
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
        //controlar el where revisar 
        $consulta = "DELETE FROM Persona WHERE documento = " . $this->getDocumento();
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
