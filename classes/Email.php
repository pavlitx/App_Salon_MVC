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
    public function enviarConfirmacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '384be5471c63e5';
        $mail->Password = '00ba0f16be5c6b';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'appsalon.com');
        $mail->Subject = 'Confirma tu cuenta';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola, " .$this->nombre . "</p><strong>";
        $contenido .= "<p>Has creado tu cuenta en AppSalon, solamente te queda confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona aquí <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si tú no solicitaste esta cuenta, ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        
        $mail->send();
        

    }
    public function enviarInstrucciones()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '384be5471c63e5';
        $mail->Password = '00ba0f16be5c6b';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'appsalon.com');
        $mail->Subject = 'Reestablece tu password';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola,<strong> " .$this->nombre . ".<strong></p>";
        $contenido.= "<p>Has solicitado reestablecer el password de tu cuenta en AppSalon, pulsa el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p> Presiona aquí <a href='http://localhost:3000/recovery?token=" . $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tú no solicitaste esta cuenta, ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        
        $mail->send();
    }
}