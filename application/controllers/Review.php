<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Review extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
    }
    
    public function index()
    {
       $data['review'] = $this->common_model->getAllrecord('ai_user_review');
       $this->get_header('Manage Category');
       $this->load->view('admin/review/manage_review',$data);
       $this->load->view('admin/include/footer_other');
    }
    
    public function add_review()
        {
       if($_POST)
        {
            $name = $this->input->post('full_name');
            $r_id = $this->input->post('user_id');
            $rating = $this->input->post('rating');
            print_r($rating);exit;
            $comment = $this->input->post('comment');
            $status = $this->input->post('status');
            $date = date('Y-m-d H:i:s');
            $review_value = array
                (
                            'full_name'=>$name,
                            'user_id'=>$r_id,
                            'rating'=>$rating,
                            'comment'=>$comment,
                             'status'=>$status,
                            'date_added'=>$date,
                               );
           
          $insert_review =  $this->common_model->insert_entry('ai_user_review',$review_value);
         if($insert_review){
            $this->session->set_flashdata('succ', "Review has been added successfully. ");
          redirect('ManageReview');
          }
        }
            else{
        //print_r($data['parent']);exit;
       $this->get_header('Manage Category');
       $this->load->view('admin/review/add_review');
       $this->load->view('admin/include/footer_other');
    }
}
    public function edit_review(){
       
        $review_id = $this->uri->segment(2);
        $fetch_by = array('id'=>$review_id);
        $get_field  = array('full_name','user_id','rating','comment','status');
        $data['review_details'] = $this->common_model->getsingle('ai_user_review',$fetch_by,$get_field);
        if ($_POST){
            $by = array('id' =>$review_id);
            $name = trim($this->input->post("full_name", TRUE));
            $id = trim($this->input->post("user_id", TRUE));
            $r_rating = trim($this->input->post("rating", TRUE));
            $r_comment = trim($this->input->post("comment", TRUE));
            $r_status = trim($this->input->post("status", TRUE));
            $edit_details = array
                                (
                                  'full_name' => $name,
                                  'user_id' => $id,
                                  'rating' => $r_rating,
                                  'comment' => $r_comment,
                                  'status' => $r_status,
                                  'date_updated' => date('Y-m-d H:i:s')
                                );
            //print_r($edit_details);
            $data['update_review'] = $this->common_model->update_entry('ai_user_review',$edit_details,$by);
            if($data['update_review']){
                $this->session->set_flashdata('succ', "Review has been update successfully.");
                redirect('ManageReview');
            }
            
           }
        else{
        $this->get_header('Manage Category'); 
        $this->load->view('admin/review/edit_review',$data);
        $this->load->view('admin/include/footer_other');  
    }
     }
     public function delete_review(){
            $user_id = $this->uri->segment(2);
            $where  = array('id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_user_review',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Review has been Delete successfully.");
           }
           redirect('ManageReview');
    }
  
            }