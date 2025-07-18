<?php
    require_once __DIR__ . '/../../private/config.php';
    abstract class DataObject {
        protected $datos = array();

        /****************************************************************************************/
        /****************************************************************************************/
        protected static function conectar() {
            try {
                $conexion = new PDO( DB_DSN, DB_USUARIO,  DB_PASS);
                // Permitimos a PHP que mantenga la conexión MySQL abierta para
                // que se emplee en otras partes de la aplicación.
                $conexion->setAttribute( PDO::ATTR_PERSISTENT, true );
                $conexion->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION );
            } catch ( PDOException $e ) { 
                die( "Conexión fallida: " . $e->getMessage() );
            }
            return $conexion;
        }
        /****************************************************************************************/


        /****************************************************************************************/
        /****************************************************************************************/
        protected static function desconectar( $conexion ) {
            $conexion = "";
        }
        /****************************************************************************************/
    }
?>