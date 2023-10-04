<?php

namespace Controllers;

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

        $router->render("dashboard/crear-proyecto", [ 
            "titulo" => "Crear Proyecto"
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