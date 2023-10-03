<?php

namespace Controllers;

use Classes\Email;
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
                } else {
                    // Hashear Password
                    $usuario->passwordHash();

                    // Eliminar password 2
                    unset($usuario->password2);

                    // Creamos el Token
                    $usuario->generarToken();

                    // Enviar el mail
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    // Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header('Location: /mensaje');
                    }
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
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario = new Usuario($_POST);
            $usuario->validarEmail();
            
            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {
                    // Generamos token y lo guardamos en la bd
                    $usuario->generarToken();

                    // Actualizar el usuario
                    $usuario->guardar();
                    
                    // Enviar Mail con link para cambio de contraseña
                    $email = new Email($usuario->email, $usuario->nombre ,$usuario->token );
                    $email->enviarInstrucciones();

                    // Mostrar alerta
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                    
                } else {
                    // Usuario no encontrado
                    Usuario::setAlerta('error', 'Usuario no existe o no está confirmado');
                }
            } 
        }
        $alertas = Usuario::getAlertas();
        
        $router->render("auth/olvide", [
            "titulo" => "Olvidé Password",
            "alertas" => $alertas
        ]);
    }

    // REESTABLECER
    public static function reestablecer(Router $router){
        $mostrar = true;
        $alertas = [];
        $token = s($_GET['token']);
        
        if(!$token) header("Location: /");

        // Buscar usuario por token
        $usuario = Usuario::where('token', $token);

        // Si no existe el token
        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no Válido');
            $mostrar = false;
        } 

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                $usuario->passwordHash();
                unset($usuario->password2);
                $usuario->token = null;
                $usuario->confirmado = '1';

                $resultado = $usuario->guardar();
                if($resultado) {
                    header("Location: /");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/reestablecer", [
            "titulo" => "Reestablecer Password",
            "alertas" => $alertas,
            "mostrar" => $mostrar
        ]);
    }

    
    // CONFIRMAR
    public static function confirmar(Router $router){
        $token = s($_GET['token']);
        if(!$token) header('Location: /');
        
        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);
        
        if(empty($usuario)) {
            // No se encontró un usuario con este token
            Usuario::setAlerta('error', 'Token no Válido');
        } else {
            // Cuenta Confirmada
            unset($usuario->password2);
            $usuario->token = null;
            $usuario->confirmado = '1';
            
            // Guardar en la bD
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        
        $alertas = Usuario::getAlertas();
        
        $router->render("auth/confirmar", [
            "titulo" => "Cuenta Confirmada Exitosamente",
            "alertas" => $alertas
        ]);
    }

    // MENSAJE
    public static function mensaje(Router $router){
        
        $router->render("auth/mensaje", [
            "titulo" => "Cuenta Creada Exitosamente"
        ]);
    }
}