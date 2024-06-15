<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('cuentas@pixelmarket.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';
         $host = $_ENV['HOST'];
        
         $contenido = "<!DOCTYPE html>
         <html lang=\"es\">
         <head>
         <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
         <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
         <link href=\"https://fonts.googleapis.com/css2?family=Tiny5&display=swap\" rel=\"stylesheet\">
             <style>
             body {
                 font-family: 'Lato', sans-serif;
                 background-color: #3f3f46;
             }
             h1 {
                 color: #e4e4e7;
                 font-family: \"Tiny5\", sans-serif;
                 text-align: center;
                 font-size: 2rem;
                 font-weight: 700;
                 margin-bottom: 1rem;
             }
             p {
                 color: #e4e4e7;
                 font-size: 1rem;
                 font-weight: 400;
                 margin-bottom: 1rem;
             }
             a,span {
                 color: #fafafa;
                 font-size: 1rem;
                 font-weight: 700;
                 text-decoration: none;
             }
             a:hover {
                 color: #e4e4e7;
             }
         </style>
         </head>
         <body class=\"text-zinc-600\">
             <h1>Pixel Market</h1>
             <p>¡Bienvenido <span>$this->nombre</span> a los mejores pixeles de internet!</p>
             <p>Te pedimos que confirmes tu cuenta con el siguiente enlace: <a href=\"$host/confirmar-cuenta?token=$this->token\">confirmar cuenta</a></p>
         </body>
         </html>";
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@pixelmarket.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $host = $_ENV['HOST'];
        
        $contenido = "<!DOCTYPE html>
        <html lang=\"es\">
        <head>
        <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
        <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
        <link href=\"https://fonts.googleapis.com/css2?family=Tiny5&display=swap\" rel=\"stylesheet\">
            <style>
            body {
                font-family: 'Lato', sans-serif;
                background-color: #3f3f46;
            }
            h1 {
                color: #e4e4e7;
                font-family: \"Tiny5\", sans-serif;
                text-align: center;
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }
            p {
                color: #e4e4e7;
                font-size: 1rem;
                font-weight: 400;
                margin-bottom: 1rem;
            }
            a,span {
                color: #fafafa;
                font-size: 1rem;
                font-weight: 700;
                text-decoration: none;
            }
            a:hover {
                color: #e4e4e7;
            }
        </style>
        </head>
        <body class=\"text-zinc-600\">
            <h1>Pixel Market</h1>
            <p>¿Quieres reestablecer tu contraseña <span>$this->nombre?</span></p>
            <p>Sí, da click aquí: <a href=\"$host/reestablecer?token=$this->token\">reestablecer contraseña</a></p>
            <p>No, entonces ignora este mensaje</p>
        </body>
        </html>";
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}