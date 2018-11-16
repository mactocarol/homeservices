<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
         $this->load->library('ckeditor');
        $this->load->library('ckfinder');
    }
    public function index(){
        $data['blog_details'] = $this->common_model->getAllrecord('ai_blog');
        $this->get_header('Manage Banner'); 
        $this->load->view('admin/blog/manage_blog',$data);
        $this->load->view('admin/include/footer_other');  
    }
       function add_blog()
    {
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        if(!empty($_FILES['post_img']['name'])){
        //$path =$_FILES['post_img']['name'];
        $blog_img = $this->myclass->upload_picture_thumb('post_img','/assets/blog/','/assets/blog/thumb/','250','250');
       // $image = $this->myclass->uploadImage($path,'post_img','/services/assets/Banner','/services/assets/Banner/thumb','150','150');
         $b_title = $this->input->post('post_title');
         $b_discription = $this->input->post('post_description');
         $b_status = $this->input->post('status');
        $data = array('post_img'=>$blog_img,
                      'post_title'=>$b_title,
                      'post_description'=>$b_discription,
                      'status'=>$b_status);
        $manage_blog = $this->common_model->insert_entry('ai_blog',$data);
        if($manage_blog){
            $this->session->set_flashdata('succ', "Banner has been Add successfully.");
            redirect('ManageBlog');
        }
        }
        else {
        $this->get_header('Manage Banner');
        $this->load->view('admin/blog/add_blog');
        $this->load->view('admin/include/footer_other');
        }
          }
    
     public function edit_blog(){
        $userid = ci_dec($this->uri->segment(2));
        $fetch_by = array('post_id'=>$userid);
        $get_field  = array('post_id','post_title','post_description','post_img','status');
        $data['fetch_details'] = $this->common_model->getsingle('ai_blog',$fetch_by,$get_field);
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
           if($_POST){
            $by = array('post_id'=>$userid);
             //$path =$_FILES['post_img']['name'];
             $blog_img = $this->myclass->upload_picture_thumb('post_img','/assets/blog/','/assets/blog/thumb/','250','250');
             //$image = $this->myclass->uploadImage($path,'post_img','/services/assets/Banner','/services/assets/Banner/thumb','150','150');
             if ($blog_img == "") {
                $img = $this->input->post('blog_img');
            } else {
                $img = $blog_img;
            }
            $title = trim($this->input->post("post_title",TRUE));
            $discription = trim($this->input->post("post_description",TRUE));
            $status = $this->input->post("status");
            $edit_details = array
                                (
                                  'post_title' => $title,
                                  'post_description' => $discription,
                                  'post_img' => $img,
                                  'status' => $status,
                                  'update_date'=>date('Y-m-d H:i:s')
                                );
            //print_r($edit_details);
            $data['update_banner'] = $this->common_model->update_entry('ai_blog',$edit_details,$by);
            if($data['update_banner']){
                $this->session->set_flashdata('succ', "Blog has been update successfully.");
                redirect('ManageBlog');
            }
        }
        else{
        $this->get_header('Manage Banner'); 
        $this->load->view('admin/blog/edit_blog',$data);
        $this->load->view('admin/include/footer_other');  
    }
    
     }
      public function delete_blog(){
            $user_id = ci_dec($this->uri->segment(2));
            $where  = array('post_id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_blog',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Blog has been Delete successfully.");
           }
           redirect('ManageBlog');
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
   