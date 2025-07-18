<?php
    require_once ('datos_object.class.php');

    class Refran extends DataObject {

        /****************************************************************************************/
        /****************************************************************************************/
        /* Constructor */
        protected $datos = array(
            "id" => "",
            "primera_parte" => ""
        );
        /****************************************************************************************/


        /****************************************************************************************/
        /****************************************************************************************/
        /* Función que obtiene un refrán aleatorio con sus respectivas variantes */
        public static function obtenerAleatorioConVariantes() {
            $conexion = self::conectar();

            $sql = "SELECT r.id, r.primera_parte, v.variante 
                    FROM " . DB_TABLA_REFRANES . " r
                    JOIN " . DB_TABLA_VARIANTES_REFRAN . " v ON r.id = v.refran_id
                    WHERE r.id = (
                        SELECT refran_id 
                        FROM (
                            SELECT refran_id 
                            FROM " . DB_TABLA_VARIANTES_REFRAN . " 
                            ORDER BY RAND() 
                            LIMIT 1
                        ) AS temp
                    )";

            try {
                $stmt = $conexion->query($sql);
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($resultados) > 0) {
                    $refran = [
                        "primera_parte" => $resultados[0]["primera_parte"],
                        "variantes" => []
                    ];

                    foreach ($resultados as $fila) {
                        $refran["variantes"][] = $fila["variante"];
                    }

                    return $refran;
                } else {
                    return ["error" => "No se encontraron refranes"];
                }

            } catch (PDOException $e) {
                error_log("Error al obtener el refrán: " . $e->getMessage());
                return ["error" => "Error interno del servidor"];
            }
        }
        /****************************************************************************************/

        
        /****************************************************************************************/
        /****************************************************************************************/
        /* Función que obtiene todos los refranes de la BD con su primera variante */
        public static function obtenerTodos() {
            $conexion = self::conectar();

            $sql = "SELECT CONCAT(r.primera_parte, ' ', v.variante) AS refran 
                    FROM " . DB_TABLA_REFRANES . " r 
                    JOIN " . DB_TABLA_VARIANTES_REFRAN . " v ON r.id = v.refran_id";

            try {
                $stmt = $conexion->query($sql);
                $refranes = $stmt->fetchAll(PDO::FETCH_COLUMN);

                return $refranes ?: ["error" => "No se encontraron refranes"];

            } catch (PDOException $e) {
                error_log("Error al obtener todos los refranes: " . $e->getMessage());
                return ["error" => "Error interno del servidor"];
            }
        }
        /****************************************************************************************/
    }
?>