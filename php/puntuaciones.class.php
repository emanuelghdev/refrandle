<?php
    require_once ('datos_object.class.php');

    class Puntuacion extends DataObject {

        /****************************************************************************************/
        /****************************************************************************************/
        /* Constructor */
        protected $datos = array(
            "id" => "",
            "modo" => "",
            "puntuacion" => "",
            "fecha" => ""
        );
        /****************************************************************************************/


        /****************************************************************************************/
        /****************************************************************************************/
        /* Función que guarda en la BD una nueva puntuación */
        public static function guardar($modo, $puntuacion) {
            $conexion = self::conectar();
            
            $sql = "INSERT INTO " . DB_TABLA_PUNTUACIONES . " 
                    (modo, puntuacion) 
                    VALUES (:modo, :puntuacion)";
            
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':modo', $modo, PDO::PARAM_INT);
                $stmt->bindParam(':puntuacion', $puntuacion, PDO::PARAM_INT);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                error_log("Error al guardar puntuación: " . $e->getMessage());
                return false;
            }
        }
        /****************************************************************************************/


        /****************************************************************************************/
        /****************************************************************************************/
        /* Función que obtiene la distribución de puntuaciones para un modo específico */
        public static function obtenerDistribucion($modo) {
            $conexion = self::conectar();
            $sql = "SELECT puntuacion FROM " . DB_TABLA_PUNTUACIONES . " WHERE modo = :modo";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':modo', $modo, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
                // Asegurar que son enteros
                $result = array_map('intval', $result);
                return $result;
            } catch (PDOException $e) {
                error_log("Error al obtener distribución de puntuaciones: " . $e->getMessage());
                return [];
            }
        }
        /****************************************************************************************/
    }
?>