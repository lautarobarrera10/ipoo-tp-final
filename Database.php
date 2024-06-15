<?php

class Database {
    private $HOSTNAME;
    private $BASEDATOS;
    private $USUARIO;
    private $CLAVE;
    private $CONEXION;
    private $QUERY;
    private $RESULT;
    private $ERROR;
    /**
     * Constructor de la clase que inicia ls variables instancias de la clase
     * vinculadas a la coneccion con el Servidor de BD
     */
    public function __construct(){
        $this->HOSTNAME = "localhost";
        $this->BASEDATOS = "bdviajes";
        $this->USUARIO = "root";
        $this->CLAVE="";
        // $this->RESULT=0;
        $this->QUERY="";
        $this->ERROR="";
    }

    /**
     * Funcion que retorna una cadena
     * con una peque�a descripcion del error si lo hubiera
     *
     * @return string
     */
    public function getError(){
        return "\n".$this->ERROR;
        
    }

    /**
     * Inicia la coneccion con el Servidor y la  Base Datos Mysql.
     * Retorna true si la coneccion con el servidor se pudo establecer y false en caso contrario
     *
     * @return boolean
     */
    public function iniciar(){
        $resp = false;
        // Usamos el puerto 3306 porque así lo configuré en mi PC, eso puede variar.
        $conexion = new mysqli($this->HOSTNAME, $this->USUARIO, $this->CLAVE, $this->BASEDATOS, 3306);
    
        if ($conexion->connect_error) {
            $this->ERROR = $conexion->connect_errno . ": " . $conexion->connect_error;
        } else {
            $this->CONEXION = $conexion;
            unset($this->QUERY);
            unset($this->ERROR);
            $resp = true;
        }
    
        return $resp;
    }
    
    /**
     * Ejecuta una consulta en la Base de Datos.
     * Recibe la consulta en una cadena enviada por parametro.
     *
     * @param string $consulta
     * @return boolean
     */
    public function ejecutar($consulta){
        $resp = false;
        unset($this->ERROR);
        $this->QUERY = $consulta;
    
        if ($this->RESULT = $this->CONEXION->query($consulta)) {
            $resp = true;
        } else {
            $this->ERROR = $this->CONEXION->errno . ": " . $this->CONEXION->error;
        }
    
        return $resp;
    }

    /**
     * Devuelve el id de un campo autoincrement utilizado como clave de una tabla
     * Retorna el id numerico del registro insertado, devuelve null en caso que la ejecucion de la consulta falle
     *
     * @param string $consulta
     * @return int id de la tupla insertada
     */
    public function devuelveIDInsercion($consulta){
        $resp = null;
        unset($this->ERROR);
        $this->QUERY = $consulta;
    
        if ($this->RESULT = $this->CONEXION->query($consulta)) {
            $resp = $this->CONEXION->insert_id;
        } else {
            $this->ERROR = $this->CONEXION->errno . ": " . $this->CONEXION->error;
        }
    
        return $resp;
    }

        /**
     * Devuelve un registro retornado por la ejecucion de una consulta
     * el puntero se despleza al siguiente registro de la consulta
     *
     * @return boolean
     */
    public function registro() {
        $resp = null;
        if ($this->RESULT){
            unset($this->ERROR);
            if($temp = mysqli_fetch_assoc($this->RESULT)){
                $resp = $temp;
            }else{
                mysqli_free_result($this->RESULT);
            }
        }else{
            $this->ERROR = mysqli_errno($this->CONEXION) . ": " . mysqli_error($this->CONEXION);
        }
        return $resp ;
    }
}