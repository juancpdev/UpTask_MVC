<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->SMTPSecure = 'tls'; // establecer 'tls'

        $mail->setFrom('UpTask@uptask.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p>Hola <strong>' . $this->nombre . '</strong> has creado tu cuenta en UpTask, solo debes confirmarla presionando el siguiente enlace</p>';
        $contenido .= '<p> Presiona aquí: <a href="' . $_ENV["APP_URL"] . '/confirmar?token=' . $this->token . '"> Confirmar cuenta</a></p>';
        $contenido .= '<p>Si tu no solicitaste esto, puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones() { 
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('UpTask@uptask.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p>Hola <strong>' . $this->nombre . '</strong> has solicitado cambiar de contraseña</p>';
        $contenido .= '<p> Presiona aquí: <a href="' . $_ENV["APP_URL"] . '/reestablecer?token=' . $this->token . '"> Cambiar de contraseña</a></p>';
        $contenido .= '<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }
}