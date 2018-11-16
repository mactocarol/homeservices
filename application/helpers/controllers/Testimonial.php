<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial extends MY_Controller {
    
    
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
       $data['testimonial'] = $this->common_model->getAllrecord('ai_testimonial');
       // print_r($data['template']);
       $this->get_header('Manage Category');
       $this->load->view('admin/testimonial/manage_testimonial',$data);
       $this->load->view('admin/include/footer_other');
    }
    
    public function add_testimonial()
        {
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        if($_POST)
        {
            $path =$_FILES['author_img']['name'];
            //$image = $this->myclass->uploadImage($path,'author_img','/services/assets/Banner','/services/assets/Banner/thumb','150','150');
            $testimonial_img = $this->myclass->upload_picture_thumb('author_img','/assets/testimonial/','/assets/testimonial/thumb/','200','200');
            $name = $this->input->post('author_name');
            $email = $this->input->post('author_email');
            $msg = $this->input->post('author_msg');
            $status = $this->input->post('status');
            $date = date('Y-m-d H:i:s');
            $testimonial_value = array
                            (
                            'author_name'=>$name,
                            'author_email'=>$email,
                            'author_msg'=>$msg,
                            'author_img'=>$testimonial_img,
                            'status'=>$status,
                            'msg_added_date'=>$date,
                               );
           //print_r($cat_value);exit;
          $insert_testimonial =  $this->common_model->insert_entry('ai_testimonial',$testimonial_value);
          if($insert_testimonial){
            $this->session->set_flashdata('succ', "Testimonial has been added successfully. ");
          redirect('ManageTestimonial');
          }
        }
            else{
        //print_r($data['parent']);exit;
       $this->get_header('Manage Category');
       $this->load->view('admin/testimonial/add_testimonial');
       $this->load->view('admin/include/footer_other');
    }
}
    public function edit_testimonial(){
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        $testimonial_id = $this->uri->segment(2);
        $fetch_by = array('id'=>$testimonial_id);
        $get_field  = array('id','author_name','author_msg','author_email','author_img','status');
        $data['testimonial_details'] = $this->common_model->getsingle('ai_testimonial',$fetch_by,$get_field);
         if ($_POST) {
            $by = array('id'=>$testimonial_id);
            //$path =$_FILES['author_img']['name'];
            //$image = $this->myclass->uploadImage($path,'author_img','/services/assets/Banner','/services/assets/Banner/thumb','150','150');
            $testimonial_img = $this->myclass->upload_picture_thumb('author_img','/assets/testimonial/','/assets/testimonial/thumb/','200','200');
            if ($testimonial_img == "") {
                $testimg = $this->input->post('testi_img');
            } else {
                $testimg = $testimonial_img;
            }
            $name = trim($this->input->post("author_name",TRUE));
            $email = trim($this->input->post("author_email",TRUE)); 
            $msg = trim($this->input->post("author_msg",TRUE));
            $status = trim($this->input->post("status",TRUE));
             $edit_details = array
                                (
                                  'author_name' => $name,
                                  'author_email' => $email,
                                  'author_msg' => $msg,
                                  'author_img' => $testimg,
                                  'msg_update_date' =>date('Y-m-d H:i:s')
                                );
            //print_r($edit_details);
            $data['update_testimonial'] = $this->common_model->update_entry('ai_testimonial',$edit_details,$by);
            if($data['update_testimonial']){
                $this->session->set_flashdata('succ', "Testimonial has been update successfully.");
                redirect('ManageTestimonial');
            }
            
           }
        else{
        $this->get_header('Manage Category'); 
        $this->load->view('admin/testimonial/edit_testimonial',$data);
        $this->load->view('admin/include/footer_other');  
    }
     }
     public function delete_testimonial(){
            $user_id = $this->uri->segment(2);
            $where  = array('id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_testimonial',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Testimonial has been Delete successfully.");
           }
           redirect('ManageTestimonial');
    }
       function editor($path, $width) {
        //Loading Library For Ckeditor
        $this->load->library('ckeditor');
        $this->load->library('ckFinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = $width;
        //configure ckfinder with ckeditor config 
        $this->ckfinder->SetupCKEditor($this->ckeditor, $path);
    }


            }