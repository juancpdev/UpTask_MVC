<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController {

    public static function index(Router $router) {
        // Ingreso solo usuarios logeados
        session_start();
        isAuth();
        
        $proyectos = Proyecto::belongUs('propietarioId', $_SESSION['id']);


        $router->render("dashboard/index", [
            "titulo" => "Proyectos",
            "proyectos" => $proyectos
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

                $proyectoCreado = true;
            }
        }

        $router->render("dashboard/crear-proyecto", [ 
            "titulo" => "Crear Proyecto",
            "alertas" => $alertas,
            "proyectoCreado" => $proyectoCreado ?? false,
            "urlProyecto" => $proyecto->url ?? null
        ]);
    }

    public static function proyecto(Router $router) {
        // Ingreso solo usuarios logeados
        session_start();
        isAuth();

        $token = $_GET['id'];
        
        $proyecto = Proyecto::where('url', $token);

        if($proyecto->propietarioId !== $_SESSION['id']) {
            header("Location: /dashboard");
        }

        $router->render("dashboard/proyecto", [ 
            "proyecto" => $proyecto,
            "titulo" => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router) {
        // Ingreso solo usuarios logeados
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);


        if($_SERVER["REQUEST_METHOD"] === "POST") { 
            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validar_perfil();

            if(empty($alertas)) {

                $existeUsuario = Usuario::where('email', $usuario->email);
                if($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    Usuario::setAlerta('error', 'Email no válido, ya pertenece a otra cuenta');
                    $alertas = $usuario->getAlertas();
                } else {    
                    $usuario->guardar();
                    $_SESSION["nombre"] = $usuario->nombre;
                    $perfilActualizado = true;
                }
            }
        }

        $router->render("dashboard/perfil", [ 
            "titulo" => "Mi Perfil",
            "alertas" => $alertas,
            "nombre" => $usuario->nombre,
            "email" => $usuario->email,
            "perfilActualizado" => $perfilActualizado ?? false
        ]);
    }


    public static function cambiar_password(Router $router) { 
        // Ingreso solo usuarios logeados
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") { 
            $usuario = Usuario::find($_SESSION["id"]);

            debuguear($usuario);
        }

        $router->render("dashboard/cambiar-password", [ 
            "titulo" => "Cambiar Password"
        ]);
    }
}