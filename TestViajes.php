<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "Database.php";
include_once "Persona.php";
include_once "ResponsableV.php";
include_once "Empresa.php";
include_once "Viaje.php";
include_once "Pasajero.php";

class TestViajes
{

    public static function showMenu()
    {
        echo "\n Bienvenido al administrador de viajes \n " .
            " ¿Qué quieres hacer hoy? \n " .
            "   1) Ver empresas \n " .
            "   2) Buscar empresa \n " .
            "   3) Agregar empresa \n " .
            "   4) Modificar empresa \n " .
            "   5) Eliminar empresa \n " .
            "   6) Ver responsables \n " .
            "   7) Buscar responsable \n " .
            "   8) Agregar responsable \n " .
            "   9) Modificar responsable \n " .
            "   10) Eliminar responsable \n " .
            "   11) Ver viajes \n " .
            "   12) Buscar viaje \n " .
            "   13) Agregar viaje \n " .
            "   14) Modificar viaje \n " .
            "   15) Eliminar viaje \n " .
            "   16) Ver pasajeros \n " .
            "   17) Buscar pasajero \n " .
            "   18) Agregar pasajero \n " .
            "   19) Modificar pasajero \n " .
            "   20) Eliminar pasajero \n";

        echo "Opción ingresada: ";
        $opcion = trim(fgets(STDIN));
        switch ($opcion) {
            case 1:
                TestViajes::mostrarEmpresas();
                break;
            case 2:
                TestViajes::menuBuscarEmpresa();
                break;
            case 3:
                TestViajes::menuAgregarEmpresa();
                break;
            case 4:
                TestViajes::menuModificarEmpresa();
                break;
            case 5:
                TestViajes::menuEliminarEmpresa();
                break;
            case 6:
                TestViajes::mostrarResponsables();
                break;
            case 7:
                TestViajes::menuBuscarResponsable();
                break;
            case 8:
                TestViajes::menuAgregarResponsable();
                break;
            case 9:
                TestViajes::menuModificarResponsable();
                break;
            case 10:
                TestViajes::menuEliminarResponsable();
                break;
            case 11:
                TestViajes::mostrarViajes();
                break;
            case 12:
                TestViajes::menuBuscarViaje();
                break;
            case 13:
                TestViajes::menuAgregarViaje();
                break;
            case 14:
                TestViajes::menuModificarViaje();
                break;
            case 15:
                TestViajes::menuEliminarViaje();
                break;
            case 16:
                TestViajes::mostrarPasajeros();
                break;
            case 17:
                TestViajes::menuBuscarPasajero();
                break;
            case 18:
                TestViajes::menuAgregarPasajero();
                break;
            case 19:
                TestViajes::menuModificarPasajero();
                break;
            case 20:
                TestViajes::menuEliminarPasajero();
                break;
            default:
                "\n❌ La opción ingresada no es válida";
                break;
        }
    }
    //funcion para validar que sea numerico
    function es_numerico($valor) {
        //retorna true si es numerico y false si es string
        //solo sirve con enteros, los floats los toma como string por el . o ,
 
        // Convertir el valor a cadena si no lo es
        $cadena = strval($valor);
        
        // Utilizar preg_match para verificar si es numérico (sin incluir negativos)
        return preg_match('/^\d+$/', $cadena);
    }

    public static function mostrarEmpresas(){
        $empresa = new Empresa;
        $empresas = $empresa->listar();

        foreach ($empresas as $empresa) {
            echo "\n$empresa";
        }
    }

    public static function buscarEmpresa(int $id)
    {
        $rta = null;
        $empresa = new Empresa;
        if (TestViajes::es_numerico($id)){
            if ($empresa->buscar($id)) {
                $rta = $empresa;
            }
        }else{
            echo "❌ el id de Empresa debe ser un numero mayor a cero";
        }
        return $rta;
    }

    public static function menuBuscarEmpresa()
    {
        TestViajes::mostrarEmpresas();
        echo "\nBuscar empresa \n";
        echo "Ingresa el id de la empresa: ";
        $id = trim(fgets(STDIN));
        if ($empresa = TestViajes::buscarEmpresa($id)) {
            echo $empresa;
        } else {
            echo "❌ Empresa no encontrada";
        }
    }

    public static function agregarEmpresa(string $nombre, string $direccion)
    {
        $empresa = new Empresa;
        $empresa->cargar($nombre, $direccion);
        return $empresa->insertar();
    }

    public static function menuAgregarEmpresa()
    {
        echo "\nAgregar empresa \n";
        echo "Ingresa el nombre de la empresa: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingresa la dirección: ";
        $direccion = trim(fgets(STDIN));
        if (TestViajes::agregarEmpresa($nombre, $direccion)) {
            echo "✅ Empresa agregada";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function modificarEmpresa(int $id, string $nombre, string $direccion)
    {
        $empresa = new Empresa;
        $respuesta = false;
        if (TestViajes::es_numerico($id)) {
            if ($empresa->buscar($id)) {
                if ($nombre !== "") {
                    $empresa->setNombre($nombre);
                }
                if ($direccion !== "") {
                    $empresa->setDireccion($direccion);
                }
                $respuesta = $empresa->modificar();
            }else{
                echo "❌ la empresa no existe";
            }
        }else{
            echo "❌ el id de Empresa debe ser un numero mayor a cero";
        }
        return $respuesta;
    }

    public static function menuModificarEmpresa()
    {
        TestViajes::mostrarEmpresas();
        echo "\nModificar empresa \n";
        echo "Ingresa el id de la empresa: ";
        $id = trim(fgets(STDIN));
        echo "Ingresa el nombre de la empresa: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingresa la dirección: ";
        $direccion = trim(fgets(STDIN));
        if (TestViajes::modificarEmpresa($id, $nombre, $direccion)) {
            echo "✅ Empresa modificada";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function eliminarEmpresa(int $id)
    {
        $empresa = new Empresa;
        $respuesta = false ;
        if (TestViajes::es_numerico($id)){
            if ($empresa->buscar($id)) {
                $respuesta = $empresa->eliminar();
            }else{
                echo "❌ la empresa no existe";
            }
        }else{
            echo "❌ el id de Empresa debe ser un numero mayor a cero";
        }
        return $respuesta;
    }

    public static function menuEliminarEmpresa()
    {
        TestViajes::mostrarEmpresas();
        echo "\nEliminar empresa \n";
        echo "Ingresa el id de la empresa: ";
        $id = trim(fgets(STDIN));
        if (TestViajes::eliminarEmpresa($id)) {
            echo "✅ Empresa eliminada";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function mostrarResponsables(){
        $responsable = new ResponsableV;
        $responsables = $responsable->listar();

        foreach ($responsables as $responsable) {
            echo "\n$responsable";
        }
    }

    public static function buscarResponsable(int $numeroEmpleado)
    {
        $rta = null;
        $responsable = new ResponsableV;
        if (TestViajes::es_numerico($numeroEmpleado)){
            if ($responsable->buscar($numeroEmpleado)) {
                $rta = $responsable;
            }
        }else{
            echo "❌ el numero de empleado del Responsable debe ser mayor a cero";
        }
        return $rta;
    }

    public static function menuBuscarResponsable()
    {
        TestViajes::mostrarResponsables();
        echo "\nBuscar responsable \n";
        echo "Ingresa el número de empleado del responsable: ";
        $numeroEmpleado = trim(fgets(STDIN));
        if ($responsable = TestViajes::buscarResponsable($numeroEmpleado)) {
            echo $responsable;
        } else {
            echo "❌ Responsable no encontrado";
        }
    }

    public static function agregarResponsable(string $nombre, string $apellido, string $documento, int $numeroLicencia)
    {
        $responsable = new ResponsableV;
        $responsable->cargar($nombre, $apellido, $documento, $numeroLicencia);
        return $responsable->insertar();
    }

    public static function menuAgregarResponsable()
    {
        echo "\nAgregar responsable \n";
        echo "Ingresa el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingresa el apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Ingresa el número de documento: ";
        $documento = trim(fgets(STDIN));
        echo "Ingresa el número de licencia: ";
        $numeroLicencia = trim(fgets(STDIN));
        if (TestViajes::agregarResponsable($nombre, $apellido, $documento, $numeroLicencia)) {
            echo "✅ Responsable agregado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function modificarResponsable(int $numeroEmpleado, int $numeroLicencia, string $nombre, string $apellido)
    {
        $responsable = new ResponsableV;
        $respuesta = false;
        if (TestViajes::es_numerico($numeroEmpleado)) {
            if ($responsable->buscar($numeroEmpleado)) {
                if ($nombre !== "") {
                    $responsable->setNombre($nombre);
                }
                if ($apellido !== "") {
                    $responsable->setApellido($apellido);
                }
                if (TestViajes::es_numerico($numeroLicencia)) {
                    $responsable->setNumeroDeLicencia($numeroLicencia);
                }
                $respuesta = $responsable->modificar();
            }else{
                echo "❌ el responsable no existe";
            }
        }else{
            echo "❌ el numero de empleado del Responsable debe ser mayor a cero";
        }
        return $respuesta;
    }

    public static function menuModificarResponsable()
    {
        TestViajes::mostrarResponsables();
        echo "\nModificar responsable \n";
        echo "Ingresa el número de empleado: ";
        $numeroEmpleado = trim(fgets(STDIN));
        echo "Ingresa el número de licencia: ";
        $numeroLicencia = trim(fgets(STDIN));
        echo "Ingresa el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingresa el apellido: ";
        $apellido = trim(fgets(STDIN));
        if (TestViajes::modificarResponsable($numeroEmpleado, $numeroLicencia, $nombre, $apellido)) {
            echo "✅ Responsable modificado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function eliminarResponsable(int $numeroEmpleado)
    {
        $responsable = new ResponsableV;
        $respuesta = false ;
        if (TestViajes::es_numerico($numeroEmpleado)){
            if ($responsable->buscar($numeroEmpleado)) {
                $respuesta = $responsable->eliminar();
            }else{
                echo "❌ el responsable no existe";
            }
        }else{
            echo "❌ el numero de empleado del Responsable debe ser mayor a cero";
        }
        return $respuesta;
    }

    public static function menuEliminarResponsable()
    {
        TestViajes::mostrarResponsables();
        echo "\nEliminar responsable \n";
        echo "Ingresa el número de empleado: ";
        $numeroEmpleado = trim(fgets(STDIN));
        if (TestViajes::eliminarResponsable($numeroEmpleado)) {
            echo "✅ Responsable eliminado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    
    public static function mostrarViajes(){
        $viaje = new Viaje;
        $viajes = $viaje->listar();

        foreach ($viajes as $viaje) {
            echo "\n$viaje";
        }
    }

    public static function buscarViaje(int $id)
    {
        $rta = null;
        $viaje = new Viaje;
        if (TestViajes::es_numerico($id)){
            if ($viaje->buscar($id)) {
                $rta = $viaje;
            }
        }else{
            echo "❌ el id del Viaje debe ser un numero mayor a cero";
        }
        return $rta;
    }

    public static function menuBuscarViaje()
    {
        TestViajes::mostrarViajes();
        echo "\nBuscar viaje \n";
        echo "Ingresa el id del viaje: ";
        $id = trim(fgets(STDIN));
        if ($viaje = TestViajes::buscarViaje($id)) {
            echo $viaje;
        } else {
            echo "❌ Viaje no encontrado";
        }
    }

    public static function agregarViaje(string $destino, int $cantidadMaximaDePasajeros, array $colObjPasajeros, int $nroResponsable, float $costoViaje, int $idEmpresa)
    {
        $viaje = new Viaje;
        $respuesta = false;
        if (TestViajes::es_numerico($nroResponsable)){
            $objResponsableV = new ResponsableV;
            $objResponsableV->buscar($nroResponsable);
            if (TestViajes::es_numerico($idEmpresa)) {
                $objEmpresa = new Empresa;
                $objEmpresa->buscar($idEmpresa);
                if (!TestViajes::es_numerico($cantidadMaximaDePasajeros)) {
                    $cantidadMaximaDePasajeros = 0;
                }
                if ($costoViaje < 0 ) {
                    $costoViaje = 0;
                }
                $viaje->cargar($destino, $cantidadMaximaDePasajeros, $colObjPasajeros, $objResponsableV, $costoViaje, $objEmpresa);
                $respuesta = $viaje->insertar();
            }else{
                echo "❌ el id de Empresa debe ser un numero mayor a cero";
            }
        }else{
            echo "❌ el numero de empleado responsable del viaje tiene que ser mayor a cero";
        }
        return $respuesta;
    }

    public static function menuAgregarViaje()
    {
        echo "\nAgregar viaje \n";
        echo "Ingresa el destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingresa la cantidad máxima de pasajeros: ";
        $cantidadMaxima = trim(fgets(STDIN));
        echo "Ingresa el número de empleado responsable: ";
        $nroResponsable = trim(fgets(STDIN));
        echo "Ingresa el costo del viaje: ";
        $costo = trim(fgets(STDIN));
        echo "Ingresa el id de la empresa: ";
        $idEmpresa = trim(fgets(STDIN));
        if (TestViajes::agregarViaje($destino, $cantidadMaxima, [], $nroResponsable, $costo, $idEmpresa)) {
            echo "✅ Viaje agregado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function modificarViaje(int $idViaje, string $destino, int $cantidadMaximaDePasajeros, array $colObjPasajeros, int $nroResponsable, float $costoViaje, int $idEmpresa)
    {
        $viaje = new Viaje;
        $respuesta = false;
        if (TestViajes::es_numerico($idViaje)) {
            if ($viaje->buscar($idViaje)) {
                $viaje->setColObjPasajeros($colObjPasajeros);
                if ($destino !== "") {
                    $viaje->setDestino($destino);
                }
                if ($costoViaje > 0) {
                    $viaje->setCostoDelViaje($costoViaje);
                }
                if (TestViajes::es_numerico($cantidadMaximaDePasajeros)) {
                    $viaje->setCantidadMaximaDePasajeros($cantidadMaximaDePasajeros);
                }
                if (TestViajes::es_numerico($nroResponsable)) {
                    $objResponsableV = new ResponsableV;
                    if ($objResponsableV->buscar($nroResponsable)) {
                        $viaje->setObjResponsableV($objResponsableV);
                    }
                }
                if (TestViajes::es_numerico($idEmpresa)) {
                    $objEmpresa = new Empresa;
                    if ($objEmpresa->buscar($nroResponsable)) {
                        $viaje->setObjEmpresa($objEmpresa);
                    }
                }
                $respuesta = $viaje->modificar();
            }else{
                echo "❌ el viaje no existe";
            }
        }else{
            echo "❌ el id de Viaje tiene que ser un numero mayor a cero";
        }
        return $respuesta;
    }

    public static function menuModificarViaje()
    {
        TestViajes::mostrarViajes();
        echo "\nModificar viaje \n";
        echo "Ingresa el id de viaje: ";
        $idViaje = trim(fgets(STDIN));
        echo "Ingresa el destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingresa la cantidad máxima de pasajeros: ";
        $cantidadMaxima = trim(fgets(STDIN));
        echo "Ingresa el número de empleado responsable: ";
        $nroResponsable = trim(fgets(STDIN));
        echo "Ingresa el costo del viaje: ";
        $costo = trim(fgets(STDIN));
        echo "Ingresa el id de la empresa: ";
        $idEmpresa = trim(fgets(STDIN));
        if (TestViajes::modificarViaje($idViaje, $destino, $cantidadMaxima, [], $nroResponsable, $costo, $idEmpresa)) {
            echo "✅ Viaje modificado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function eliminarViaje(int $idViaje)
    {
        $viaje = new Viaje;
        $respuesta = false ;
        if (TestViajes::es_numerico($idViaje)){
            if ($viaje->buscar($idViaje)) {
                $respuesta = $viaje->eliminar();
            }else{
                echo "❌ el viaje no existe";
            }
        }else{
            echo "❌ el id del viaje debe ser un numero mayor a cero";
        }
        return $respuesta;
    }

    public static function menuEliminarViaje()
    {
        TestViajes::mostrarViajes();
        echo "\nEliminar viaje \n";
        echo "Ingresa el id de viaje: ";
        $idViaje = trim(fgets(STDIN));
        if (TestViajes::eliminarViaje($idViaje)) {
            echo "✅ Viaje eliminado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function mostrarPasajeros(){
        $pasajero = new Pasajero;
        $pasajeros = $pasajero->listar();

        foreach ($pasajeros as $pasajero) {
            echo "\n$pasajero";
        }
    }

    public static function buscarPasajero($documento)
    {
        $rta = null;
        $pasajero = new Pasajero;
        if (TestViajes::es_numerico($documento)){
            if ($pasajero->buscar($documento)) {
                $rta = $pasajero;
            }
        }else{
            echo "❌ debe agregar el numero documento del Pasajero";
        }
        return $rta;
    }

    public static function menuBuscarPasajero()
    {
        TestViajes::mostrarPasajeros();
        echo "\nBuscar pasajero \n";
        echo "Ingresa el documento del pasajero: ";
        $documento = trim(fgets(STDIN));
        if ($pasajero = TestViajes::buscarPasajero($documento)) {
            echo $pasajero;
        } else {
            echo "❌ Pasajero no encontrado";
        }
    }

    public static function agregarPasajero(string $nombre, string $apellido, string $documento, int $telefono, int $idViaje)
    {   
        $respuesta = false;
        $viaje = new Viaje;
        if (TestViajes::es_numerico($idViaje)) {
            if ($viaje->buscar($idViaje)) {
                $pasajero = new Pasajero;
                if (TestViajes::es_numerico($documento)){
                    $pasajero->cargar($nombre, $apellido, $documento, $telefono, $idViaje);
                    $respuesta = $pasajero->insertar();
                }else{
                    echo "❌ el documento del Pasajero NO se agrego de forma correcta";
                }
            }else{
                echo "❌ Viaje no encontrado ";
            }
        }else{
            echo "❌ el id del Viaje debe ser un numero mayor a cero ";
        }
        return $respuesta;
    }

    public static function menuAgregarPasajero()
    {
        echo "\nAgregar pasajero \n";
        echo "Ingresa el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingresa el apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Ingresa el número de documento: ";
        $documento = trim(fgets(STDIN));
        echo "Ingresa el número de teléfono: ";
        $telefono = trim(fgets(STDIN));
        echo "Ingresa el id de viaje: ";
        $idViaje = trim(fgets(STDIN));
        if (TestViajes::agregarPasajero($nombre, $apellido, $documento, $telefono, $idViaje)) {
            echo "✅ Pasajero agregado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function modificarPasajero(string $documento, string $nombre, string $apellido, int $telefono, int $idViaje)
    {
        $pasajero = new Pasajero;
        $respuesta = false;
        if (TestViajes::es_numerico($documento)) {
            if ($pasajero->buscar($documento)) {
                if ($nombre !== "") {
                    $pasajero->setNombre($nombre);
                }
                if ($apellido !== "") {
                    $pasajero->setApellido($apellido);
                }
                if ($telefono !== "") {
                    $pasajero->setTelefono($telefono);
                }
                $viaje = new Viaje;
                if (TestViajes::es_numerico($idViaje)){
                    if ($viaje->buscar($idViaje)) {
                        $pasajero->setIdViaje($idViaje);
                    }
                }
                $respuesta = $pasajero->modificar();
            }else{
                echo "❌ el pasajero no existe";
            }
        }else{
            echo "❌ el documento del Pasajero NO se agrego de forma correcta";
        }
        return $respuesta;
    }

    public static function menuModificarPasajero()
    {
        TestViajes::mostrarPasajeros();
        echo "\nModificar pasajero \n";
        echo "Ingresa el documento: ";
        $doc = trim(fgets(STDIN));
        echo "Ingresa el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingresa apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Ingresa el  telefono: ";
        $telefono = trim(fgets(STDIN));
        echo "Ingresa el  idViaje: ";
        $idViaje = trim(fgets(STDIN));
        if (TestViajes::modificarPasajero($doc, $nombre, $apellido, $telefono, $idViaje)) {
            echo "✅ pasajero modificado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function eliminarPasajero($doc)
    {
        $pasajero = new Pasajero;
        $respuesta = false ;
        if (TestViajes::es_numerico($doc)){
            if ($pasajero->buscar($doc)) {
                $respuesta = $pasajero->eliminar();
            }else{
                echo "❌ el pasajero no existe";
            }
        }else{
            echo "❌ el documento del Pasajero NO se agrego de forma correcta";
        }
        return $respuesta;
    }

    public static function menuEliminarPasajero()
    {
        TestViajes::mostrarPasajeros();
        echo "\nEliminar pasajero \n";
        echo "Ingresa el doc del pasajero: ";
        $doc = trim(fgets(STDIN));
        if (TestViajes::eliminarPasajero($doc)) {
            echo "✅ pasajero eliminado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }
}

TestViajes::showMenu();