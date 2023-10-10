<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController {

    public static function index() {
        echo "desde index";
    }

    public static function crear() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {

            session_start();
            
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            if(!$proyecto || ($_SESSION["id"] !== $proyecto->propietarioId)) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                
                echo json_encode($respuesta);
            }

            // OK, instanciar y crear la tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Tarea creada Correctamente'
            ];
            echo json_encode($respuesta);
            
        }
    }

    public static function actualizar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
                    
        }
    }

    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
                    
        }
    }
}
