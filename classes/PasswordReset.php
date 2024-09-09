<?php
include_once "../lib/Database.php";
include_once "../helpers/Format.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PasswordReset
{
    private $db;
    private $fr;
    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function PasswordReset($email)
    {

        function send_password_reset($name, $email, $v_token)
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
                $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->Username = 'alsakib748@gmail.com';                     //SMTP username
                $mail->Password = 'tforsdttgaadnbaf';   //xkuw ltzd nouc qtmr                            //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('alsakib748@gmail.com', $name);
                $mail->addAddress($email);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Reset From ASA Blog';

                $email_template = "
                    <h2>You have register with ASA blog</h2>
                    <h5>Reset your old password please click the link below</h5>
                    <a href='http://localhost/oopblog/admin/password-change.php?token={$v_token}&email={$email}'>Click Here</a>
                ";

                $mail->Body = $email_template;

                $mail->send();
                return true;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        $email = $this->fr->validation($email);
        $v_token = md5(rand());

        if (empty($email)) {
            $error = "Email field must not be empty!";
            return $error;
        } else {
            $check_email = "SELECT * FROM tbl_user WHERE email = '{$email}' ";
            $email_result = $this->db->select($check_email);
            if (mysqli_num_rows($email_result) > 0) {
                $row = mysqli_fetch_assoc($email_result);
                $name = $row['username'];
                $email = $row['email'];
                $query = "UPDATE tbl_user SET v_token='$v_token' WHERE email = '{$email}' LIMIT 1";

                $update_token = $this->db->update($query);

                if ($update_token) {

                    send_password_reset($name, $email, $v_token);
                    $success = "Password reset link send in your email";
                    return $success;
                } else {
                    $error = "Something Wrong Token Is Not Update";
                    return $error;
                }
            } else {
                $error = "Email Not Found!";
                return $error;
            }
        }

    }
}