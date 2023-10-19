<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $password_actual;
    public $password_nuevo;
    public $token;
    public $confirmado;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre del Usuario es Obligatorio";
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }
        if((!($this->password) || !($this->password2))) {
            self::$alertas['error'][] = "El password es Obligatorio";
        }
        if(strlen($this->password) < 6 || strlen($this->password2) < 6 ) {
            self::$alertas['error'][] = "El password debe contener al menos 6 caracteres";
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = "Los passwords no coinciden";
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if((!($this->password) || !($this->password2))) {
            self::$alertas['error'][] = "El password es Obligatorio";
        }
        if(strlen($this->password) < 6 || strlen($this->password2) < 6 ) {
            self::$alertas['error'][] = "El password debe contener al menos 6 caracteres";
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = "Los passwords no coinciden";
        }
        
        return self::$alertas;
    }

    public function passwordHash() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    
    public function generarToken() {
        $this->token = uniqid();
    }

    public function validarEmail() {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }

        return self::$alertas;
    }

    public function validarLogin() {
        $this->validarEmail();
        if(!($this->password) ) {
            self::$alertas['error'][] = "El password es Obligatorio";
        }

        return self::$alertas;
    }

    public function validar_perfil() {
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre del Usuario es Obligatorio";
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }

        return self::$alertas;
    }

    public function verificar_cambioPass() {
        if((!($this->password_actual) || !($this->password_nuevo))) {
            self::$alertas['error'][] = "Los passwords son Obligatorio";
        }
        if(strlen($this->password_actual) < 6 || strlen($this->password_nuevo) < 6 ) {
            self::$alertas['error'][] = "El password debe contener al menos 6 caracteres";
        }
        
        return self::$alertas;
    }
}