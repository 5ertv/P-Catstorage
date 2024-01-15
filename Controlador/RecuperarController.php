<?php
include_once '../modelo/Usuario.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
$usuario = new Usuario();
if($_POST['funcion']=='verificar'){
    $email = $_POST['email'];
    $user = $_POST['user'];
    $usuario->verificar($email,$user);
}
if($_POST['funcion']=='recuperar'){
    $email = $_POST['email'];
    $user = $_POST['user'];
    $codigo = generar(20);
    $usuario->remplazar($codigo,$email,$user);
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'catstorage.2023@gmail.com';                     //SMTP username
    $mail->Password   = 'sdzbidgzqjzaxkik';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('catstorage.2023@gmail.com', 'CATSTORAGE');
    $mail->addAddress($email);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Tu nueva password.';
    $mail->Body    = 'Tu nueva contraseña es: <b>" '.$codigo.' "</b> PORFAVOR cambiala apenas entres a la pagina denuevo.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->SMTPDebug = false;
    $mail->do_debug= false;
    $mail->send();
    echo 'enviado';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
function generar($longitud){
    $key='';
    $patron='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $max=strlen($patron)-1;
    for($i=0;$i<$longitud;$i++){
        $key.=$patron[mt_rand(0,$max)];
    }
    return $key;
}
?>