<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "Database.php";
include_once "Persona.php";
include_once "ResponsableV.php";
// include_once "Empresa.php";
// include_once "Viaje.php";
// include_once "Pasajero.php";

// class TestViajes {

//     public static function showMenu(){
//         echo "\n Bienvenido al administrador de viajes \n " .
//         " ¿Qué quieres hacer hoy? \n " .
//         "   1) Agregar empresa \n " .
//         "   2) Modificar empresa \n " .
//         "   3) Eliminar empresa \n " .
//         "   4) Agregar responsable \n " .
//         "   5) Modificar responsable \n " .
//         "   6) Eliminar responsable \n " .
//         "   7) Agregar viaje \n " .
//         "   8) Modificar viaje \n " .
//         "   9) Eliminar viaje \n";
//         echo "Opción ingresada: ";
//         $opcion = trim(fgets(STDIN));
//         switch ($opcion){
//             case 1:
//                 TestViajes::menuAgregarEmpresa();
//                 break;
//             case 2:
//                 TestViajes::menuModificarEmpresa();
//                 break;
//             case 3:
//                 TestViajes::menuEliminarEmpresa();
//                 break;
//             case 4:
//                 TestViajes::menuAgregarResponsable();
//                 break;
//             case 5:
//                 TestViajes::menuModificarResponsable();
//                 break;
//             case 6:
//                 TestViajes::menuEliminarResponsable();
//                 break;
//             case 7:
//                 TestViajes::menuAgregarViaje();
//                 break;
//             case 8:
//                 TestViajes::menuModificarViaje();
//                 break;
//             case 9:
//                 TestViajes::menuEliminarViaje();
//                 break;
//             default:
//                 "\n❌ La opción ingresada no es válida";
//                 break;
//         }
//     }

//     public static function agregarEmpresa(string $nombre, string $direccion){
//         $empresa = new Empresa;
//         $empresa->cargar($nombre, $direccion);
//         return $empresa->insertar();
//     }

//     public static function menuAgregarEmpresa(){
//         echo "\nAgregar empresa \n";
//         echo "Ingresa el nombre de la empresa: ";
//         $nombre = trim(fgets(STDIN));
//         echo "Ingresa la dirección: ";
//         $direccion = trim(fgets(STDIN));
//         if (TestViajes::agregarEmpresa($nombre, $direccion)){
//             echo "✅ Empresa agregada";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function modificarEmpresa(int $id, string $nombre, string $direccion){
//         $empresa = new Empresa;
//         $empresa->buscar($id);
//         $empresa->setNombre($nombre);
//         $empresa->setDireccion($direccion);
//         return $empresa->modificar();
//     }

//     public static function menuModificarEmpresa(){
//         echo "\nModificar empresa \n";
//         echo "Ingresa el id de la empresa: ";
//         $id = trim(fgets(STDIN));
//         echo "Ingresa el nombre de la empresa: ";
//         $nombre = trim(fgets(STDIN));
//         echo "Ingresa la dirección: ";
//         $direccion = trim(fgets(STDIN));
//         if (TestViajes::modificarEmpresa($id, $nombre, $direccion)){
//             echo "✅ Empresa modificada";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function eliminarEmpresa(int $id){
//         $empresa = new Empresa;
//         $empresa->buscar($id);
//         return $empresa->eliminar();
//     }

//     public static function menuEliminarEmpresa(){
//         echo "\nEliminar empresa \n";
//         echo "Ingresa el id de la empresa: ";
//         $id = trim(fgets(STDIN));
//         if (TestViajes::eliminarEmpresa($id)){
//             echo "✅ Empresa eliminada";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function agregarResponsable(int $numeroLicencia, string $nombre, string $apellido){
//         $responsable = new ResponsableV;
//         $responsable->cargar($numeroLicencia, $nombre, $apellido);
//         return $responsable->insertar();
//     }

//     public static function menuAgregarResponsable(){
//         echo "\nAgregar responsable \n";
//         echo "Ingresa el número de licencia: ";
//         $numeroLicencia = trim(fgets(STDIN));
//         echo "Ingresa el nombre: ";
//         $nombre = trim(fgets(STDIN));
//         echo "Ingresa el apellido: ";
//         $apellido = trim(fgets(STDIN));
//         if (TestViajes::agregarResponsable($numeroLicencia, $nombre, $apellido)){
//             echo "✅ Responsable agregado";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function modificarResponsable(int $numeroEmpleado, int $numeroLicencia, string $nombre, string $apellido){
//         $responsable = new ResponsableV;
//         $responsable->buscar($numeroEmpleado);
//         $responsable->setNumeroDeLicencia($numeroLicencia);
//         $responsable->setNombre($nombre);
//         $responsable->setApellido($apellido);
//         return $responsable->modificar();
//     }

//     public static function menuModificarResponsable(){
//         echo "\nModificar responsable \n";
//         echo "Ingresa el número de empleado: ";
//         $numeroEmpleado = trim(fgets(STDIN));
//         echo "Ingresa el número de licencia: ";
//         $numeroLicencia = trim(fgets(STDIN));
//         echo "Ingresa el nombre: ";
//         $nombre = trim(fgets(STDIN));
//         echo "Ingresa el apellido: ";
//         $apellido = trim(fgets(STDIN));
//         if (TestViajes::modificarResponsable($numeroEmpleado, $numeroLicencia, $nombre, $apellido)){
//             echo "✅ Responsable modificado";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function eliminarResponsable(int $numeroEmpleado){
//         $responsable = new ResponsableV;
//         $responsable->buscar($numeroEmpleado);
//         return $responsable->eliminar();
//     }

//     public static function menuEliminarResponsable(){
//         echo "\nEliminar responsable \n";
//         echo "Ingresa el número de empleado: ";
//         $numeroEmpleado = trim(fgets(STDIN));
//         if (TestViajes::eliminarResponsable($numeroEmpleado)){
//             echo "✅ Responsable eliminado";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function agregarViaje(string $destino, int $cantidadMaximaDePasajeros, array $colObjPasajeros, ResponsableV $objResponsableV, float $costoViaje, Empresa $objEmpresa){
//         $viaje = new Viaje;
//         $viaje->cargar($destino, $cantidadMaximaDePasajeros, $colObjPasajeros, $objResponsableV, $costoViaje, $objEmpresa);
//         return $viaje->insertar();
//     }

//     public static function menuAgregarViaje(){
//         echo "\nAgregar viaje \n";
//         echo "Ingresa el destino: ";
//         $destino = trim(fgets(STDIN));
//         echo "Ingresa la cantidad máxima de pasajeros: ";
//         $cantidadMaxima = trim(fgets(STDIN));
//         echo "Ingresa el número de empleado responsable: ";
//         $idResponsable = trim(fgets(STDIN));
//         $objResponsableV = new ResponsableV;
//         $objResponsableV->buscar($idResponsable);
//         echo "Ingresa el costo del viaje: ";
//         $costo = trim(fgets(STDIN));
//         echo "Ingresa el id de la empresa: ";
//         $idEmpresa = trim(fgets(STDIN));
//         $objEmpresa = new Empresa;
//         $objEmpresa->buscar($idEmpresa);
//         if (TestViajes::agregarViaje($destino, $cantidadMaxima, [], $objResponsableV, $costo, $objEmpresa)){
//             echo "✅ Viaje agregado";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function modificarViaje(int $idViaje, string $destino, int $cantidadMaximaDePasajeros, array $colObjPasajeros, ResponsableV $objResponsableV, float $costoViaje, Empresa $objEmpresa){
//         $viaje = new Viaje;
//         $viaje->buscar($idViaje);
//         $viaje->setDestino($destino);
//         $viaje->setCantidadMaximaDePasajeros($cantidadMaximaDePasajeros);
//         $viaje->setColObjPasajeros($colObjPasajeros);
//         $viaje->setObjResponsableV($objResponsableV);
//         $viaje->setCostoDelViaje($costoViaje);
//         $viaje->setObjEmpresa($objEmpresa);
//         return $viaje->modificar();
//     }
    
//     public static function menuModificarViaje(){
//         echo "\nModificar viaje \n";
//         echo "Ingresa el id de viaje: ";
//         $idViaje = trim(fgets(STDIN));
//         echo "Ingresa el destino: ";
//         $destino = trim(fgets(STDIN));
//         echo "Ingresa la cantidad máxima de pasajeros: ";
//         $cantidadMaxima = trim(fgets(STDIN));
//         echo "Ingresa el número de empleado responsable: ";
//         $idResponsable = trim(fgets(STDIN));
//         $objResponsableV = new ResponsableV;
//         $objResponsableV->buscar($idResponsable);
//         echo "Ingresa el costo del viaje: ";
//         $costo = trim(fgets(STDIN));
//         echo "Ingresa el id de la empresa: ";
//         $idEmpresa = trim(fgets(STDIN));
//         $objEmpresa = new Empresa;
//         $objEmpresa->buscar($idEmpresa);
//         if (TestViajes::modificarViaje($idViaje, $destino, $cantidadMaxima, [], $objResponsableV, $costo, $objEmpresa)){
//             echo "✅ Viaje modificado";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function eliminarViaje(int $idViaje){
//         $viaje = new Viaje;
//         $viaje->buscar($idViaje);
//         return $viaje->eliminar();
//     }

//     public static function menuEliminarViaje(){
//         echo "\nEliminar viaje \n";
//         echo "Ingresa el id de viaje: ";
//         $idViaje = trim(fgets(STDIN));
//         if (TestViajes::eliminarViaje($idViaje)){
//             echo "✅ Viaje eliminado";
//         } else {
//             echo "❌ Ha ocurrido un error";
//         }
//     }

//     public static function agregarPasajero(string $nombre, string $apellido, string $dni, int $telefono, int $numeroAsiento, int $numeroTicket, int $idViaje){
//         $pasajero = new Pasajero;
//         $pasajero->cargar($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket, $idViaje);
//         return $pasajero->insertar();
//     }
// }



$responsable = new ResponsableV;
$responsable->buscar(1);
$responsable->eliminar();
