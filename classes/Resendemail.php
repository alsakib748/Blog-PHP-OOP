<?php

include_once "../lib/Database.php";
include_once "../helpers/Format.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Resendemail
{

    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function resendEmail($email)
    {

        function resend_email_verified($name, $email, $v_token)
        {
            require '../PHPMailer/Exception.php';
            require '../PHPMailer/PHPMailer.php';
            require '../PHPMailer/SMTP.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'alsakib748@gmail.com';                     //SMTP username
                $mail->Password   = 'xkuwltzdnoucqtmr';   //xkuw ltzd nouc qtmr                            //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('alsakib748@gmail.com', $name);
                $mail->addAddress($email);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Email Verification From ASA Blog';

                $email_template = "
                    <h2>You have register with ASA blog</h2>
                    <h5>Verify your email address to login please click the link below</h5>
                    <a href='http://localhost/oopblog/admin/verifi_email.php?token={$v_token}'>Click Here</a>
                ";

                $mail->Body  =  $email_template;

                $mail->send();
                return true;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        $email = $this->fr->validation($email);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if (empty($email)) {
            $error = "Email field must not be empty !";
            return $error;
        } else {
            $checkEmail = "SELECT * FROM tbl_user WHERE email = '$email' ";
            $emailResult = $this->db->select($checkEmail);

            if (mysqli_num_rows($emailResult) > 0) {

                $row = mysqli_fetch_assoc($emailResult);
                if ($row['v_status'] == 0) {
                    $name = $row['username'];
                    $email = $row['email'];
                    $v_token = $row["v_token"];

                    if (resend_email_verified($name, $email, $v_token)) {
                        $success = "Verification Email link has been sent in your email";
                        return $success;
                    }
                } else {
                    $error = "Email already verified Please login";
                    return $error;
                }
            } else {
                $error = "Email is not register Please register first";
                return $error;
            }
        }
    }
}
