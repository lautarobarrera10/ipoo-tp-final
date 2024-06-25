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
        // llama a los metodos de la clase padre y se le agrega el numero de licencia
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
        $consulta = "SELECT * FROM responsable INNER JOIN persona ON responsable.rdocumento = persona.documento WHERE rnumeroempleado=" . $numeroEmpleado;
        $rta = false;
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                if ($empleado = $database->registro()) {
                    $this->cargar(
                        $empleado["nombre"], 
                        $empleado["apellido"], 
                        $empleado["documento"], 
                        $empleado["rnumerolicencia"]
                    );

                    // Como la función cargar no recibe el número de empleado como parametro, lo seteamos aparte
                    $this->setNumeroDeEmpleado($empleado["rnumeroempleado"]);
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
        $rta = false;

        // Eliminamos el responsable
        $consulta = "DELETE FROM responsable WHERE rnumeroempleado = " . $this->getNumeroDeEmpleado();
        if ($database->iniciar()) {
            if ($database->ejecutar($consulta)) {
                // Si pudimos borrar el responsable, borramos la persona
                parent::eliminar();
                $rta = true;
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }

        return $rta;
    }

    public function listar($condicion = ""){
        $arregloResponsables = null;
        $database = new Database;
        $consulta = "SELECT * FROM responsable INNER JOIN persona ON persona.documento = responsable.rdocumento ";
        if ($condicion != ""){
            $consulta .= "WHERE $condicion ";
        }
        $consulta .= "ORDER BY rdocumento";

        if ($database->iniciar()){
            if ($database->ejecutar($consulta)){
                $arregloResponsables = [];
                while ($responsableEncontrado = $database->registro()){
                    $responsable = new self;
                    $responsable->cargar(
                        $responsableEncontrado["nombre"],
                        $responsableEncontrado["apellido"],
                        $responsableEncontrado["rdocumento"],
                        $responsableEncontrado["rnumerolicencia"]
                    );
                    $responsable->setNumeroDeEmpleado($responsableEncontrado["rnumeroempleado"]);
                    array_push($arregloResponsables, $responsable);
                }
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }

        return $arregloResponsables;
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
