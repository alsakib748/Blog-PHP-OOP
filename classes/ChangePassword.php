<?php
include_once "../lib/Database.php";
include_once "../helpers/Format.php";

class ChangePassword
{
    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function changePass($data)
    {
        $email = $this->fr->validation($data["email"]);
        $newPassword = $this->fr->validation($data["newpassword"]);
        $c_Password = $this->fr->validation($data["c_password"]);
        $token = $this->fr->validation($data["token"]);


        if (!empty($token)) {
            if (!empty($email) || !empty($newPassword) || !empty($c_Password)) {
                $token_q = "SELECT v_token FROM tbl_user WHERE v_token = '{$token}' ";
                $token_result = $this->db->select($token_q);

                if (!empty($token_result) && $token_result !== true) {

                    if (mysqli_num_rows($token_result) > 0) {
                        if ($newPassword == $c_Password) {
                            $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                            $c_Password = password_hash($c_Password, PASSWORD_BCRYPT);

                            $update_pass = "UPDATE tbl_user SET password = '{$newPassword}' WHERE v_token = '$token' ";
                            $up_result = $this->db->update($update_pass);

                            if ($up_result) {

                                $new_token = md5(rand());
                                $up_token = "UPDATE tbl_user SET v_token = '{$new_token}' WHERE v_token = '{$token}' ";

                                $result = $this->db->update($up_token);

                                $success = "Password Changed Successfully";
                                return $success;
                                // header("Location: login.php");
                            } else {
                                $err = "Password Changed Failed!";
                                return $err;
                            }
                        } else {
                            $err = "Password's are not match!";
                            return $err;
                        }
                    } else {
                        $err = "Invalid Token";
                        return $err;
                    }
                }else {
                    $err = "Invalid Token";
                    return $err;
                }
            } else {
                $err = "Fields Must not be empty!";
                return $err;
            }
        } else {
            $err = "Token is not available";
            return $err;
        }
        
    }
}
