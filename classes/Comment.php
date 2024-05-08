<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/Database.php");
    include_once ($filepath."/../helpers/Format.php");

    class Comment{
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function addComment($data){
            $userId = $this->fr->validation($data["userId"]);
            $postId = $this->fr->validation($data["postId"]);
            $name = $this->fr->validation($data["name"]);
            $email = $this->fr->validation($data["email"]);
            $website = $this->fr->validation($data["website"]);
            $message = $this->fr->validation($data["message"]);

            if($name == " " || $email == " " || $message == " "){
                $msg = "Fields Must Not Be Empty!";
                return $msg;
            }else{
                $insert_cmt = "INSERT INTO `tbl_comment`(`userId`,`postId`,`name`, `email`, `website`, `message`) VALUES ('$userId','$postId','$name','$email','$website','$message')";

                $result = $this->db->insert($insert_cmt);

                if($result){
                    $msg = "Comment Send Successfully";
                    return $msg;
                }else{
                    $msg = "Comment Send Failed!";
                    return $msg;
                }
            }
        }

        public function allComment($id){
            $select_cmt = "SELECT tbl_comment.*,tbl_post.postId,tbl_user.username,tbl_user.image FROM tbl_comment INNER JOIN tbl_post ON tbl_comment.postId = tbl_post.postId INNER JOIN tbl_user ON tbl_post.userId = tbl_user.userId WHERE tbl_comment.postId = $id AND tbl_comment.status = 1 ";
            $select_result = $this->db->select($select_cmt);
            return $select_result;
        }

        public function adminComment($id){
            $admin_cmt = "SELECT tbl_comment.*,tbl_user.userId FROM tbl_comment INNER JOIN tbl_user ON tbl_comment.userId = tbl_user.userId WHERE tbl_comment.userId = $id ";
            $result = $this->db->select($admin_cmt);
            return $result;
        }

        // active comment
        public function activePost($aid){
            $dq = "UPDATE tbl_comment SET status = '0' WHERE cmtId = $aid";
            $d_result = $this->db->update($dq);
            if($d_result){
                $msg = "Comment Deactivate Successfully";
                return $msg;
            }
        }

        // deactive comment
        public function deactivePost($did){
            $dq = "UPDATE tbl_comment SET status = '1' WHERE cmtId = $did";
            $d_result = $this->db->update($dq);
            if($d_result){
                $msg = "Comment Activate Successfully";
                return $msg;
            }
        }

        // select comment for update and reply
        public function commentSelect($id){
            $select_cmt = "SELECT * FROM tbl_comment WHERE cmtId = $id ";
            $select_res = $this->db->select($select_cmt);
            return $select_res;
        }

        // Admin Send Reply

        public function AddReply($reply,$id){
            $reply = $this->fr->validation($reply);
            $update_date = date("M d, Y");

            if(empty($reply)){
                $msg = "Reply Field Must Be Required";
                return $msg;
            }else{
                $update = "UPDATE tbl_comment SET admin_reply = '$reply',update_date = '$update_date' WHERE cmtId = $id ";
                $up_res = $this->db->update($update);
                if($up_res){
                    $msg = "Reply Send Successfully";
                    return $msg;
                }else{
                    $msg = "Reply Send Failed!";
                    return $msg;
                }
            }
        }

        // Delete Comment 
        public function deleteCmt($id){
            $delete = "DELETE FROM tbl_comment WHERE cmtId = $id";
            $del = $this->db->delete($delete);
            if($del){
                $msg = "Comment Delete Successfully!";
                return $msg;
            }else{
                $msg = "Comment Delete Failed!";
                return $msg;
            }
        }
    }

?>