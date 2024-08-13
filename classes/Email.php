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
     
         $mail->setFrom('cuentas@devwebcamp.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

        //  $contenido = '<html>';
        //  $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en DevWebCamp; pero es necesario confirmarla</p>";
        //  $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
        //  $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
        //  $contenido .= '</html>';
        //  $mail->Body = $contenido;

         $contenido = "
                            <html>
                                <head>
                                    <style>
                                        .container {
                                            padding: 20px;
                                            background-color: #f9f9f9;
                                            font-family: Arial, sans-serif;
                                        }
                                        .content {
                                            padding: 20px;
                                        }
                                        .content p {
                                            margin-bottom: 15px;
                                        }
                                        .content strong {
                                            color: #0da6f3;
                                        }
                                        .btn {
                                            display: inline-block;
                                            padding: 8px 16px;
                                            background-color: #0da6f3;
                                            color: #fff;
                                            text-decoration: none;
                                            border-radius: 4px;
                                        }
                                        .btn:hover {
                                            background-color: #0c95db;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class='container'>
                                        <div class='content'>
                                            <p><strong>Hola:</strong> " . htmlspecialchars($this->nombre) . "</p>
                                            <p>Has creado tu cuenta en DevWebCamp. Por favor, confírmala haciendo clic en el siguiente enlace:</p>
                                            <p><a class='btn' href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=".urlencode($this->token)."'>Confirmar cuenta</a></p>
                                            <p>Si no creaste esta cuenta, puedes ignorar este mensaje.</p>
                                        </div>
                                    </div>
                                </body>
                            </html>
                            ";
            
            $mail->Body    = $contenido;

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
    
        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        // $contenido = '<html>';
        // $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        // $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/recuperar?token=" . $this->token . "'>Reestablecer Password</a>";        
        // $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        // $contenido .= '</html>';
        // $mail->Body = $contenido;

        $contenido = "
                            <html>
                                <head>
                                    <style>
                                        .container {
                                            padding: 20px;
                                            background-color: #f9f9f9;
                                            font-family: Arial, sans-serif;
                                        }
                                        .content {
                                            padding: 20px;
                                        }
                                        .content p {
                                            margin-bottom: 15px;
                                        }
                                        .content strong {
                                            color: #0da6f3;
                                        }
                                        .btn {
                                            display: inline-block;
                                            padding: 8px 16px;
                                            background-color: #0da6f3;
                                            color: #fff;
                                            text-decoration: none;
                                            border-radius: 4px;
                                        }
                                        .btn:hover {
                                            background-color: #0c95db;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class='container'>
                                        <div class='content'>
                                        <p><strong>Hola:</strong> " . htmlspecialchars($this->nombre) . "</p>
                                        <p>Has solicitado restablecer tu contraseña. Por favor, haz clic en el siguiente enlace para proceder:</p>
                                        <p><a class='btn' href='" . $_ENV['HOST'] . "/restablecer?token=" . $this->token . "'>Restablecer contraseña</a></p>
                                        <p>Si no realizaste esta solicitud, puedes ignorar este mensaje.</p>
                                    </div>
                                </body>
                            </html>
                            ";
            
            $mail->Body    = $contenido;

        //Enviar el mail
        $mail->send();
    }
}