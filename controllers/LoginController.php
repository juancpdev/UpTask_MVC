<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController {
    // LOGIN
    public static function login(Router $router){

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
        }

        $router->render("auth/login", [
            "titulo" => "Iniciar Sesión"
        ]);
    }

    // LOGOUT
    public static function logout(){
        echo "desde logout";

    }

    // CREAR
    public static function crear(Router $router){
        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)) {
                $existeUsuario = $usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El email ya está registrado');
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $router->render("auth/crear", [
            "titulo" => "Creá tu cuenta",
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    // OLVIDE
    public static function olvide(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
        }

        $router->render("auth/olvide", [
            "titulo" => "Olvidé Password"
        ]);
    }

    // REESTABLECER
    public static function reestablecer(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
        }

        $router->render("auth/reestablecer", [
            "titulo" => "Reestablecer Password"
        ]);
    }

    // MENSAJE
    public static function mensaje(Router $router){

        $router->render("auth/mensaje", [
            "titulo" => "Cuenta Creada Exitosamente"
        ]);
    }

    // CONFIRMAR
    public static function confirmar(Router $router){
        $router->render("auth/confirmar", [
            "titulo" => "Cuenta Confirmada Exitosamente" 
        ]);
    }
}