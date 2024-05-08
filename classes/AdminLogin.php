<?php 

    include_once "../lib/Session.php";
    Session::loginCheck();

    include_once "../lib/Database.php";
    include_once "../helpers/Format.php";


    class AdminLogin{
        
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function LoginUser($email,$password){
            $email = $this->fr->validation($email);
            $password = $this->fr->validation($password);

            if(empty($email) || empty($password)){
                $error = "Fields Must not be empty!";
                return $error;
            }else{
                $query = "SELECT * FROM `tbl_user` WHERE `email` = '{$email}' ";
                $result = $this->db->select($query);

                if($result === false) {
                    $error = "Database query error occurred";
                    return $error;
                }

                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    if(!password_verify($password,$row["password"])){
                        $error = "Your password didn't match";
                        return $error;
                    }else{
                        if($row["v_status"] == 1){
                            Session::set('login',true);
                            Session::set('username',$row['username']);
                            Session::set('userId',$row['userId']);
                            Session::set('userImage',$row['image']);
                            header("Location: index.php");
                        }else{
                            $error = "Please first verify your email";
                            return $error;
                        }
                    }
                    
                }else{
                    $error = "Invalid Email Address";
                    return $error;
                }
            }
        }

    }


?>