<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController {
    // INDEX
    public static function index() {
        $proyectoId = $_GET['id'];

        
        $proyecto = Proyecto::where('url', $proyectoId);

        session_start();
        if(!$proyecto || $_SESSION["id"] !== $proyecto->propietarioId) header("Location: /404"); 

        $tareas = Tarea::belongUs('proyectoId', $proyecto->id);

        echo json_encode(['tareas' => $tareas]);

        
    }

    // CREAR
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
                'mensaje' => 'Tarea creada Correctamente',
                'proyectoId' => $proyecto->id
            ];
            echo json_encode($respuesta);
        }
    }

    // ACTUALIZAR
    public static function actualizar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            if(!$proyecto || ($_SESSION["id"] !== $proyecto->propietarioId)) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            // OK, instanciar y actualizar la tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    'proyectoId' => $proyecto->id,
                    'mensaje' => 'Actualizado Correctamente'
                ];
                echo json_encode(["respuesta" => $respuesta]);
            }
        }
    }

    // ELIMINAR
    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {

            session_start();
            
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            if(!$proyecto || ($_SESSION["id"] !== $proyecto->propietarioId)) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            // OK, instanciar y eliminar la tarea
            $tarea = new Tarea($_POST);
            $resultado = $tarea->eliminar();

            $resultado = [
                'resultado' => $resultado,
                'mensaje' => 'Eliminado Correctamente'
            ];

            echo json_encode($resultado);
        }
    }
}
