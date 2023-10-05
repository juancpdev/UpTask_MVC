<?php

namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController {

    public static function index(Router $router) {
        // Ingreso solo usuarios logeados
        session_start();
        isAuth();

        $router->render("dashboard/index", [
            "titulo" => "Proyectos"
        ]);
    }

    public static function crear(Router $router) {
        // Ingreso solo usuarios logeados
        session_start();
        isAuth();
        $alertas = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $proyecto = new Proyecto($_POST);
            
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)) {
                // Generar una URL unica
                $proyecto->url = md5(uniqid());

                // Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION["id"];

                // Guardar el proyecto
                $proyecto->guardar();

                header("Location: /proyecto?id=" . $proyecto->url);
            }
        }

        $router->render("dashboard/crear-proyecto", [ 
            "titulo" => "Crear Proyecto",
            "alertas" => $alertas
        ]);
    }

    public static function perfil(Router $router) {
        // Ingreso solo usuarios logeados
        session_start();
        isAuth();

        $router->render("dashboard/perfil", [ 
            "titulo" => "Mi Perfil"
        ]);
    }


    
}