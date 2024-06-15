<?php

class Empresa {
    private $nombre;
    private $direccion;
    private $id;
	private $mensajeoperacion;

    public function __construct(){
        $this->nombre = "";
        $this->direccion = "";
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getId(){
        return $this->id;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }

    public function setDireccion(string $direccion){
        $this->direccion = $direccion;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensaje){
        $this->mensajeoperacion = $mensaje;
    }

    public function __toString(){
        return
        "ID: " . $this->getId() . "\n" .
        "Nombre: " . $this->getNombre() . "\n" .
        "Dirección: " . $this->getDireccion() . "\n";
    }

    public function cargar(string $nombre, string $direccion){
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
    }

    public function insertar(){
        $database = new Database;
        $resp = false;
        $consultaInsertar = "INSERT INTO empresa(enombre, edireccion) VALUES ('".$this->getNombre()."','".$this->getDireccion()."')";
		
		if($database->iniciar()){

			if($id = $database->devuelveIDInsercion($consultaInsertar)){
                $this->setId($id);
			    $resp=  true;

			}	else {
					$this->setMensajeoperacion($database->getError());
			}

		} else {
				$this->setMensajeoperacion($database->getError());
		}
		return $resp;
    }

    public function buscar(int $id){
        $database = new Database;
		$consulta="SELECT * FROM empresa WHERE idempresa='".$id."'";
        $rta = false;
        if ($database->iniciar()){
            if ($database->ejecutar($consulta)){
                if ($empresa = $database->registro()){
                    $this->setId($empresa['idempresa']);
                    $this->setNombre($empresa['enombre']);
                    $this->setDireccion($empresa['edireccion']);
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

    public function modificar(){
        $database = new Database;
        $consulta = "UPDATE empresa SET enombre = '". $this->getNombre() ."', edireccion = '". $this->getDireccion() ."' WHERE idempresa = " . $this->getId();
        $rta = false;
        if ($database->iniciar()){
            if ($database->ejecutar($consulta)){
                $rta = true;
            } else {
                $this->setMensajeoperacion($database->getError());
            }
        } else {
            $this->setMensajeoperacion($database->getError());
        }
        return $rta;
    }

    public function eliminar(){
        $database = new Database;
        $consulta = "DELETE FROM empresa WHERE idempresa = " . $this->getId();
        $rta = false;
        if ($database->iniciar()){
            if ($database->ejecutar($consulta)){
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