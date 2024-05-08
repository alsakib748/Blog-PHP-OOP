<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Category
{
    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function AddCategory($catName)
    {
        $catName = $this->fr->validation($catName);

        if (empty($catName)) {
            $msg = "Category Field Name Must Not Be Empty!";
            return $msg;
        } else {
            $select_query = "SELECT * FROM tbl_category WHERE catName = '{$catName}' ";
            $select_re = $this->db->select($select_query);
            if ($select_re !== false) {
                if (mysqli_num_rows($select_re) > 0) {
                    $msg = "This Category already exist";
                    return $msg;
                }
            } else if ($select_re !== true) {
                $insert_que = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $insert_result = $this->db->insert($insert_que);

                if ($insert_result) {
                    $msg = "Category Inserted Successfully";
                    return $msg;
                } else {
                    $msg = "Category Inserted Failed!";
                    return $msg;
                }
            }
        }
    }

    // Select All Category
    public function AllCategory(){
        $select_cat = "SELECT * FROM tbl_category";
        $all_cat = $this->db->select($select_cat);
        if($all_cat != false){
            return $all_cat;
        }else{
            return false;
        }
    }

    // Edit Category Data fetch
    public function getEditCat($id){
        $edit_data = "SELECT * FROM tbl_category WHERE catId = '{$id}' ";
        $edit_result = $this->db->select($edit_data);
        return $edit_result;
    }

    // Update Category Data
    public function UpdateCategory($catName,$id){
        $id = $this->fr->validation($id);
        $catName = $this->fr->validation($catName);

        if (empty($catName)) {
            $msg = "Category Field Name Must Not Be Empty!";
            return $msg;
        } else {
            $select_query = "SELECT * FROM tbl_category WHERE catName = '{$catName}' ";
            $select_re = $this->db->select($select_query);
            if ($select_re !== false) {
                if (mysqli_num_rows($select_re) > 0) {
                    $msg = "This Category already exist";
                    return $msg;
                }
            } else if ($select_re !== true) {
                $update_que = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '{$id}' ";
                $update_result = $this->db->update($update_que);

                if ($update_result) {
                    $msg = "Category Update Successfully";
                    // return $msg;
                    header("Location:categorylist.php");
                } else {
                    $msg = "Something Wrong! Category Is Not Updated";
                    return $msg;
                    // header("Location: categorylist.php");
                }
            }
        }
    }

    // Delete Category 
    public function DeleteCategory($id){
        $delete_query = "DELETE FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->delete($delete_query);
        if($result){
            $msg = "Category Delete Successfully";
            self::AllCategory();
            return $msg;
        }else{
            $msg = "Something Wrong! Category Is Not Delete";
            return $msg;
        }
    }

    // Category Name for select cat
    public function catName($id){
        $cat_id = "SELECT * FROM tbl_category WHERE catId = $id";
        $c_result = $this->db->select($cat_id);
        return $c_result;
    }

    // index page total category
    public function totalCategory(){
        $total_q = "SELECT * FROM tbl_category";
        $total_r = $this->db->select($total_q);
        return $total_r;
    }

}
