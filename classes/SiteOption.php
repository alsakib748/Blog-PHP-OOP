<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class SiteOption
{
    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function allSocial(){
        $select_que = "SELECT * FROM tbl_social WHERE sId = '1' ";
        $select_res = $this->db->select($select_que);
        return $select_res;
    }

    public function updateLinks($data){
        $twitter = $this->fr->validation($data["twitter"]);
        $facebook = $this->fr->validation($data["facebook"]);
        $instagram = $this->fr->validation($data["instagram"]);
        $youtube = $this->fr->validation($data["youtube"]);

        $update_que = "UPDATE tbl_social SET twitter = '{$twitter}',facebook='{$facebook}',instagram = '{$instagram}',youtube='{$youtube}' WHERE sId = 1 ";

        $update_res = $this->db->update($update_que);
        if($update_res){
            $msg = "Link Update Successfully";
            return $msg;
        }else{
            $msg = "Link Update Failed!";
            return $msg;
        }
    }

    // Site Logo
    public function siteLogo(){
        $select_query = "SELECT * FROM tbl_logo WHERE logoId = 1";
        $logo = $this->db->select($select_query);
        return $logo; 
    }

    public function updateLogo($data){
        $logo = $this->fr->validation($data["logo"]);

        $update_logo = "UPDATE tbl_logo SET logoName = '{$logo}' WHERE logoId = 1 ";
        $logo_result = $this->db->update($update_logo);
        if($logo_result){
            $msg = "Logo Update Successfully";
            return $msg;
        }else{
            $msg = "Logo Update Failed";
            return $msg;
        }
    }

    // About Us Option
    public function aboutInfo(){
        $about_que = "SELECT * FROM tbl_about WHERE aboutId = 1";
        $about_result = $this->db->select($about_que);
        return $about_result;
    }

    public function aboutUpdate($data, $file){
        $username = $this->fr->validation($data['username']);
        $user_details = $this->fr->validation($data["user_details"]);

        $permited = array('jpg','jpeg','png','gif','webp');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.',$file_name);
        // $div = pathinfo($file_name,PATHINFO_EXTENSION);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $upload_image = "upload/".$unique_image;


        if(empty($username) || empty($user_details)){
            $msg = "User Name and User Bio Fields Must Not Be Empty";
            return $msg;
        }else{
            if(!empty($file_name)){
                if($file_size > 1048567){
                    $msg = "File Size Must Be Less Than 1 MB";
                    return $msg;
                }else if(in_array($file_ext,$permited) == false){
                    $msg = "You Can Upload Only:-".implode(',',$permited);
                    return $msg;
                }else{
                    move_uploaded_file($file_temp,$upload_image);

                    $query = "UPDATE tbl_about SET username = '$username', image = '$upload_image', userDetails = '{$user_details}' WHERE tbl_about.aboutId = 1 ";

                    $result = $this->db->update($query);
                    if($result){
                        $msg = "About Updated Successfully";
                        return $msg;
                    }else{
                        $msg = "Something Went Wrong! About is not Updated";
                        return $msg;
                    }
                }
            }else{
                    $query = "UPDATE tbl_about SET username = '$username',userDetails = '{$user_details}' WHERE tbl_about.aboutId = 1 ";

                    $result = $this->db->update($query);
                    if($result){
                        $msg = "About Updated Successfully";
                        return $msg;
                    }else{
                        $msg = "Something Went Wrong! About is not Updated";
                        return $msg;
                    }
            }
        }
    }

    // About us latest post
    public function latestPost($offset, $limit){
        $post_query = "SELECT tbl_post.*, tbl_user.username, tbl_user.image FROM tbl_post INNER JOIN tbl_user ON tbl_user.userId = tbl_post.userId WHERE tbl_post.status = 1 ORDER BY tbl_post.postId DESC LIMIT $offset, $limit";
        $post_result = $this->db->select($post_query);
        return $post_result;
    }

    // ----------- Add Contact Page
    public function addContact($data){
        $name = $this->fr->validation($data['username']);
        $email = $this->fr->validation($data['email']);
        $phone = $this->fr->validation($data['phone']);
        $message = $this->fr->validation($data['message']);
        
        if($name = "" || $email == "" || $phone == "" || $message == ""){
            $msg = "Fields Must Not Be Empty!";
            return $msg;
        }else{
            $contact_insert = "INSERT INTO tbl_contact(`name`,`email`,`phone`,`message`) VALUES( '{$name}','{$email}','{$phone}','{$message}' ) ";
            $contact = $this->db->insert($contact_insert);
            if($contact){
                $msg = "Message Send Successfully";
                return $msg;
            }else{
                $msg = "Message Send Failed!";
                return $msg;
            }
        }
    }

    // All Contact Msg
    public function allContact(){
        $select = "SELECT * FROM tbl_contact ORDER BY contactId DESC";
        $result = $this->db->select($select);
        return $result;
    }

    // Delete Contact
    public function deleteContact($id){
        $delete = "DELETE FROM tbl_contact WHERE contactId = '$id' ";
        $result = $this->db->delete($delete);
        if($result){
            $msg = "Message Delete Successfully";
            return $msg;
        }else{
            $msg = "Message Delete Failed!";
            return $msg;
        }
    }

}


?>