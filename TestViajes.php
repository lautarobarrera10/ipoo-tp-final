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
            "   2) Agregar empresa \n " .
            "   3) Modificar empresa \n " .
            "   4) Eliminar empresa \n " .
            "   5) Ver responsables \n " .
            "   6) Agregar responsable \n " .
            "   7) Modificar responsable \n " .
            "   8) Eliminar responsable \n " .
            "   9) Ver viajes \n " .
            "   10) Agregar viaje \n " .
            "   11) Modificar viaje \n " .
            "   12) Eliminar viaje \n " .
            "   13) Ver pasajeros \n " .
            "   14) Agregar pasajero \n " .
            "   15) Modificar pasajero \n " .
            "   16) Eliminar pasajero \n";

        echo "Opción ingresada: ";
        $opcion = trim(fgets(STDIN));
        switch ($opcion) {
            case 1:
                TestViajes::mostrarEmpresas();
                break;
            case 2:
                TestViajes::menuAgregarEmpresa();
                break;
            case 3:
                TestViajes::menuModificarEmpresa();
                break;
            case 4:
                TestViajes::menuEliminarEmpresa();
                break;
            case 5:
                TestViajes::mostrarResponsables();
                break;
            case 6:
                TestViajes::menuAgregarResponsable();
                break;
            case 7:
                TestViajes::menuModificarResponsable();
                break;
            case 8:
                TestViajes::menuEliminarResponsable();
                break;
            case 9:
                TestViajes::mostrarViajes();
                break;
            case 10:
                TestViajes::menuAgregarViaje();
                break;
            case 11:
                TestViajes::menuModificarViaje();
                break;
            case 12:
                TestViajes::menuEliminarViaje();
                break;
            case 13:
                TestViajes::mostrarPasajeros();
                break;
            case 14:
                TestViajes::menuAgregarPasajero();
                break;
            case 15:
                TestViajes::menuModificarPasajero();
                break;
            case 16:
                TestViajes::menuEliminarPasajero();
                break;
            default:
                "\n❌ La opción ingresada no es válida";
                break;
        }
    }

    public static function mostrarEmpresas(){
        $empresa = new Empresa;
        $empresas = $empresa->listar();

        foreach ($empresas as $empresa) {
            echo "\n$empresa";
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
        $empresa->buscar($id);
        $empresa->setNombre($nombre);
        $empresa->setDireccion($direccion);
        return $empresa->modificar();
    }

    public static function menuModificarEmpresa()
    {
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
        $empresa->buscar($id);
        return $empresa->eliminar();
    }

    public static function menuEliminarEmpresa()
    {
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
        $responsable->buscar($numeroEmpleado);
        $responsable->setNumeroDeLicencia($numeroLicencia);
        $responsable->setNombre($nombre);
        $responsable->setApellido($apellido);
        return $responsable->modificar();
    }

    public static function menuModificarResponsable()
    {
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
        $responsable->buscar($numeroEmpleado);
        return $responsable->eliminar();
    }

    public static function menuEliminarResponsable()
    {
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

    public static function agregarViaje(string $destino, int $cantidadMaximaDePasajeros, array $colObjPasajeros, ResponsableV $objResponsableV, float $costoViaje, Empresa $objEmpresa)
    {
        $viaje = new Viaje;
        $viaje->cargar($destino, $cantidadMaximaDePasajeros, $colObjPasajeros, $objResponsableV, $costoViaje, $objEmpresa);
        return $viaje->insertar();
    }

    public static function menuAgregarViaje()
    {
        echo "\nAgregar viaje \n";
        echo "Ingresa el destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingresa la cantidad máxima de pasajeros: ";
        $cantidadMaxima = trim(fgets(STDIN));
        echo "Ingresa el número de empleado responsable: ";
        $idResponsable = trim(fgets(STDIN));
        $objResponsableV = new ResponsableV;
        $objResponsableV->buscar($idResponsable);
        echo "Ingresa el costo del viaje: ";
        $costo = trim(fgets(STDIN));
        echo "Ingresa el id de la empresa: ";
        $idEmpresa = trim(fgets(STDIN));
        $objEmpresa = new Empresa;
        $objEmpresa->buscar($idEmpresa);
        if (TestViajes::agregarViaje($destino, $cantidadMaxima, [], $objResponsableV, $costo, $objEmpresa)) {
            echo "✅ Viaje agregado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function modificarViaje(int $idViaje, string $destino, int $cantidadMaximaDePasajeros, array $colObjPasajeros, ResponsableV $objResponsableV, float $costoViaje, Empresa $objEmpresa)
    {
        $viaje = new Viaje;
        $viaje->buscar($idViaje);
        $viaje->setDestino($destino);
        $viaje->setCantidadMaximaDePasajeros($cantidadMaximaDePasajeros);
        $viaje->setColObjPasajeros($colObjPasajeros);
        $viaje->setObjResponsableV($objResponsableV);
        $viaje->setCostoDelViaje($costoViaje);
        $viaje->setObjEmpresa($objEmpresa);
        return $viaje->modificar();
    }

    public static function menuModificarViaje()
    {
        echo "\nModificar viaje \n";
        echo "Ingresa el id de viaje: ";
        $idViaje = trim(fgets(STDIN));
        echo "Ingresa el destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingresa la cantidad máxima de pasajeros: ";
        $cantidadMaxima = trim(fgets(STDIN));
        echo "Ingresa el número de empleado responsable: ";
        $idResponsable = trim(fgets(STDIN));
        $objResponsableV = new ResponsableV;
        $objResponsableV->buscar($idResponsable);
        echo "Ingresa el costo del viaje: ";
        $costo = trim(fgets(STDIN));
        echo "Ingresa el id de la empresa: ";
        $idEmpresa = trim(fgets(STDIN));
        $objEmpresa = new Empresa;
        $objEmpresa->buscar($idEmpresa);
        if (TestViajes::modificarViaje($idViaje, $destino, $cantidadMaxima, [], $objResponsableV, $costo, $objEmpresa)) {
            echo "✅ Viaje modificado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function eliminarViaje(int $idViaje)
    {
        $viaje = new Viaje;
        $viaje->buscar($idViaje);
        return $viaje->eliminar();
    }

    public static function menuEliminarViaje()
    {
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

    public static function agregarPasajero(string $nombre, string $apellido, string $dni, int $telefono, int $idViaje)
    {
        $pasajero = new Pasajero;
        $pasajero->cargar($nombre, $apellido, $dni, $telefono, $idViaje);
        return $pasajero->insertar();
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
        $pasajero->buscar($documento);
        $pasajero->setNombre($nombre);
        $pasajero->setApellido($apellido);
        $pasajero->setTelefono($telefono);
        $pasajero->setIdViaje($idViaje);
        return $pasajero->modificar();
    }

    public static function menuModificarPasajero()
    {
        echo "\nModificar pasajero \n";
        echo "Ingresa el documento : ";
        $doc = trim(fgets(STDIN));
        echo "Ingresa el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingresa apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Ingresa el  telefono : ";
        $telefono = trim(fgets(STDIN));
        echo "Ingresa el  idViaje : ";
        $idViaje = trim(fgets(STDIN));
        $objPasajero = new Pasajero;
        $objPasajero->buscar($doc);
        if (TestViajes::modificarPasajero($doc, $nombre, $apellido, $telefono, $idViaje)) {
            echo "✅ pasajero modificado";
        } else {
            echo "❌ Ha ocurrido un error";
        }
    }

    public static function eliminarPasajero($doc)
    {
        $pasajero = new Pasajero;
        $pasajero->buscar($doc);
        return $pasajero->eliminar();
    }

    public static function menuEliminarPasajero()
    {
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

// TestViajes::showMenu();

$responsable = new ResponsableV;
$responsable->buscar(2);

echo $responsable;

