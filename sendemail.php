<?php 
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

//echo json_encode("Başarılı");

if($_POST){

    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug  = 0;
        $mail->isSMTP();
        $mail->Host       = 'host.com';
        $mail->SMTPAuth   = true;
        $mail->SMTPAutoTLS = false;
        $mail->Username   = 'admin@admin.com';
        $mail->Password   = '12345';
        $mail->SMTPSecure = false;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        //Recipients
        $mail->setFrom('admin@admin.com', 'Admin');
        $mail->addAddress('admin@admin.com', $name);     // Add a recipient
        $mail->addReplyTo($email,$name);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Example sitesi üzerinden gönderilen yeni iletiniz var.';
        $mail->Body    = '<b>Gönderen Ad Soyad: </b>'.$name.'</br></br> <b>Konu: </b>'.$subject.'</br></br> <b>Mesaj: </b><br>'.$message;
        $mail->AltBody = '';

        $mail->send();

        echo json_encode(['status' => 'success','msg' => 'Başarıyla mesajınız gönderilmiştir.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error','msg' => 'Mesajınız gönderilememiştir.']);
    }

}