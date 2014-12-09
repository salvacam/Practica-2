<?php

class Correo {

    static function enviarServidor($origen, $destino, $asunto, $mensaje, $clave= null) {
        $headers = "From:" . $origen;
        return mail($destino, $asunto, $mesanje, $headers);
    }

    static function enviarGmail($origen, $destino, $asunto, $mensaje, $clave) {
        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Username = Configuracion::ORIGENGMAIL; //$origen
        $mail->Password = Configuracion::CLAVEGMAIL; //$clave
        $mail->Subject = $asunto;
        $mail->MsgHTML($mensaje);
        $mail->IsHTML(true);
        $mail->AddAddress($destino);
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        }
        return true;
    }

    static function enviarHotmail($origen, $destino, $asunto, $mensaje, $clave) {
        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->Host = "smtp.live.com";
        $mail->Port = 25;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Mailer = "smtp";
        $mail->Username = Configuracion::ORIGENHOTMAIL; //$origen
        $mail->Password = Configuracion::CLAVEHOTMAIL; //$clave
        $mail->Subject = $asunto;
        $mail->MsgHTML($mensaje);
        $mail->IsHTML(true);
        $mail->AddAddress($destino);
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        }
        return true;
    }

}
