<?php

// De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.
// El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero
//  También se desea guardar la información de la persona responsable de realizar el viaje,
// Modificar la clase viaje para almacenar el costo del viaje, la suma de los costos abonados por los pasajeros

Class Viaje {
    private $codigo;
    private $destino;
    private $cantidadMaximaDePasajeros;
    private $colObjPasajeros;
    private $objResponsableV;
    private $costoDelViaje;
    private $sumaDeCostosAbonadosPorPasajeros;
    private $objEmpresa;
    private $mensajeoperacion;

    public function __construct( ){
        $this->destino = '';
        $this->cantidadMaximaDePasajeros = 0;
        $this->colObjPasajeros = [];
        $this->costoDelViaje = 0;
        $this->sumaDeCostosAbonadosPorPasajeros = $this->iniciarCostosAbonados();
    }

    public function cargar(string $destino, int $cantidadMaximaDePasajeros, array $colObjPasajeros, ResponsableV $objResponsableV, float $costoDelViaje, Empresa $empresa){
        $this->setDestino($destino);
        $this->setCantidadMaximaDePasajeros($cantidadMaximaDePasajeros);
        $this->setColObjPasajeros($colObjPasajeros);
        $this->setObjResponsableV($objResponsableV);
        $this->setCostoDelViaje($costoDelViaje);
        $this->setObjEmpresa($empresa);
    }

    public function insertar(){
        $base = new database;
		$resp = false;
        $consultaInsertar = "INSERT INTO viaje (vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte) VALUES ('".$this->getDestino()."',".$this->getCantidadMaximaDePasajeros().",'". $this->getObjEmpresa()->getId() ."','".$this->getObjResponsableV()->getNumeroDeEmpleado()."',".$this-> getCostoDelViaje().")";
	
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setCodigo($id);
			    $resp=  true;

			}	else {
					$this->setMensajeoperacion($base->getError());
					
			}

		} else {
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp;
    }

    public function buscar(int $idviaje){
        $database = new Database;
		$consulta="SELECT * FROM viaje WHERE idviaje=".$idviaje;
        $rta = false;
        if ($database->iniciar()){
            if ($database->ejecutar($consulta)){
                if ($viaje = $database->registro()){
                    $this->setCodigo($viaje['idviaje']);
                    $this->setDestino($viaje['vdestino']);
                    $this->setCantidadMaximaDePasajeros($viaje['vcantmaxpasajeros']);
                    $empresa = new Empresa;
                    $empresa->buscar($viaje['idempresa']);
                    $this->setObjEmpresa($empresa);
                    $empleado = new ResponsableV;
                    $empleado->buscar($viaje['rnumeroempleado']);
                    $this->setObjResponsableV($empleado);
                    $this->setCostoDelViaje($viaje['vimporte']);
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
        // Preparar la consulta asegurándonos de que todos los valores estén correctamente concatenados
        $consulta = "UPDATE viaje SET 
                     vdestino = '" . $this->getDestino() . "',
                     vcantmaxpasajeros = " . $this->getCantidadMaximaDePasajeros() . ",
                     idempresa = " . $this->getObjEmpresa()->getId() . ",
                     rnumeroempleado = " . $this->getObjResponsableV()->getNumeroDeEmpleado() . ",
                     vimporte = " . $this->getCostoDelViaje() . "
                     WHERE idviaje = " . $this->getCodigo();
    
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
        $consulta = "DELETE FROM viaje WHERE idviaje = " . $this->getCodigo();
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

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($value){
        $this->codigo = $value;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function setDestino($value){
        $this->destino = $value;
    }

    public function getCantidadMaximaDePasajeros(){
        return $this->cantidadMaximaDePasajeros;
    }

    public function setCantidadMaximaDePasajeros($value){
        $this->cantidadMaximaDePasajeros = $value;
    }

    public function getColObjPasajeros(){
        return $this->colObjPasajeros;
    }

    public function setColObjPasajeros($value){
        $this->colObjPasajeros = $value;
    }

    public function getObjResponsableV(){
        return $this->objResponsableV;
    }

    public function setObjResponsableV($value){
        $this->objResponsableV = $value;
    }

    public function getCostoDelViaje(){
        return $this->costoDelViaje;
    }

    public function setCostoDelViaje($value){
        $this->costoDelViaje = $value;
    }

    public function getSumaDeCostosAbonadosPorPasajeros(){
        return $this->sumaDeCostosAbonadosPorPasajeros;
    }

    public function setSumaDeCostosAbonadosPorPasajeros($value){
        $this->sumaDeCostosAbonadosPorPasajeros = $value;
    }

    public function getObjEmpresa(){
        return $this->objEmpresa;
    }

    public function setObjEmpresa(Empresa $empresa){
        $this->objEmpresa = $empresa;
    }

    public function setMensajeoperacion($mensaje){
        $this->mensajeoperacion = $mensaje;
    }

    public function __toString(){
        $pasajeros = $this->getColObjPasajeros();
        $pasajerosString = "";
        foreach ($pasajeros as $pasajero){
            $pasajerosString .= $pasajero . "\n";
        }
        return
        "Código: " . $this->getCodigo() . "\n" .
        "Destino: " . $this->getDestino() . "\n" .
        "Cantidad máxima de pasajeros: " . $this->getCantidadMaximaDePasajeros() . "\n" .
        "Pasajeros: " . $pasajerosString . "\n" .
        "Responsable: " . $this->getObjResponsableV() . "\n" .
        "Costo del viaje: " . $this->getCostoDelViaje() . "\n" .
        "Suma de los costos abonados por los pasajeros: " . $this->getSumaDeCostosAbonadosPorPasajeros() . "\n";
    }

    public function buscarPasajero(int $numeroDeDocumento){
        $colPasajeros = $this->getColObjPasajeros();
        $pasajeroEncontrado = null;
        $encontrado = false;
        $i = 0;
        while (!$encontrado && count($this->getColObjPasajeros()) > $i){
            if ($colPasajeros[$i]->getNumeroDeDocumento() == $numeroDeDocumento){
                $encontrado = true;
                $pasajeroEncontrado = $colPasajeros[$i];
            }
            $i++;
        }
        return $pasajeroEncontrado;
    }

    public function agregarPasajero(Pasajero $pasajero){
        $colPasajeros = $this->getColObjPasajeros();
        $pasajeroAgregado = false;
        if ($this->hayPasajesDisponibles()){
            $pasajeroRepetido = false;
            $i = 0;
            while (!$pasajeroRepetido && $i < count($colPasajeros)){
                if ($colPasajeros[$i]->getNumeroDeDocumento() == $pasajero->getNumeroDeDocumento()){
                    $pasajeroRepetido = true;
                }
                $i++;
            }
            if (!$pasajeroRepetido){
                array_push($colPasajeros, $pasajero);
                $this->setColObjPasajeros($colPasajeros);
                $pasajeroAgregado = true;
            }
        }
        return $pasajeroAgregado;
    }

    //  e implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros ( solo si hay espacio disponible), actualizar los costos abonados y retornar el costo final que deberá ser abonado por el pasajero.

    public function venderPasaje(Pasajero $objPasajero){
        $agregado = $this->agregarPasajero($objPasajero);
        $costoAbonado = -1;
        if ($agregado){
            $sumaCostos = $this->getSumaDeCostosAbonadosPorPasajeros();
            $incremento = $objPasajero->darPorcentajeIncremento();
            $costoAbonado = $this->getCostoDelViaje() * $incremento / 100;
            $sumaCostos += $costoAbonado;
            $this->setSumaDeCostosAbonadosPorPasajeros($sumaCostos);
        }
        return $costoAbonado;
    }

    public function iniciarCostosAbonados(){
        $pasajeros = $this->getColObjPasajeros();
        $costoTotal = 0;
        foreach ($pasajeros as $pasajero){
            $incremento = $pasajero->darPorcentajeIncremento();
            $costoAbonado = $this->getCostoDelViaje() * $incremento / 100;
            $costoTotal += $costoAbonado;
        }
        return $costoTotal;
    }

    // Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y falso caso contrario

    public function hayPasajesDisponibles(){
        $colPasajeros = $this->getColObjPasajeros();
        $hayPasaje = count($colPasajeros) < $this->getCantidadMaximaDePasajeros();
        return $hayPasaje;
    }
}