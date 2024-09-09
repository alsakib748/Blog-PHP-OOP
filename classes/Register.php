<?php

include_once "../lib/Database.php";
include_once "../helpers/Format.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Register
{
    public $db;
    public $fr;
    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }


    public function AddUser($data)
    {

        function sendEmail_verify($name, $email, $v_token)
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
                $mail->Subject = 'Email Verification From ASA Blog';

                $email_template = "
                    <h2>You have register with ASA blog</h2>
                    <h5>Verify your email address to login please click the link below</h5>
                    <a href='http://localhost/oopblog/admin/verifi_email.php?token={$v_token}'>Click Here</a>
                ";

                $mail->Body = $email_template;

                $mail->send();
                return true;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        $name = isset($data["name"]) ? $this->fr->validation($data['name']) : " ";
        $phone = isset($data["phone"]) ? $this->fr->validation($data['phone']) : " ";
        $email = isset($data["email"]) ? $this->fr->validation($data["email"]) : " ";
        $password = isset($data["password"]) ? $this->fr->validation($data["password"]) : " ";
        $v_token = md5(rand());
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        if (empty($name) || empty($phone) || empty($email) || empty($password)) {
            $error = "Field Must Not Be Empty";
            return $error;
        } else {
            $e_query = "SELECT * FROM tbl_user WHERE email = '{$email}' ";
            $check_email = $this->db->select($e_query);

            if ($check_email && mysqli_num_rows($check_email) > 0) {
                $error = "This Email Is Already Exist";
                return $error;
                // header("Location:register.php");
            } else {
                $insert_query = "INSERT INTO tbl_user(username,email,phone,password,v_token) VALUES('{$name}','{$email}','{$phone}','{$password_hash}','{$v_token}')";

                $insert_row = $this->db->insert($insert_query);

                if ($insert_row) {
                    if (sendEmail_verify($name, $email, $v_token)) {
                        $success = "Registration Successful. Please check your email inbox for verify email";
                        return $success;
                    }
                } else {
                    $error = "Registration Failed !";
                    return $error;
                }
            }
        }
    }
}