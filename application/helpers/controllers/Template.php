<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template extends MY_Controller {
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
       $data['template'] = $this->common_model->getAllrecord('ai_email_template');
       // print_r($data['template']);
       $this->get_header('Manage Category');
       $this->load->view('admin/template/manage_template',$data);
       $this->load->view('admin/include/footer_other');
    }
    
    public function add()
        {
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        if($_POST)
        {
        
         
           $tem_title = $this->input->post('title');
           $tem_content = $this->input->post('content');
           $tem_status =  $this->input->post('status');
            $date = date('Y-m-d H:i:s');
           $tem_value = array
                            (
                            'title'=>$tem_title,
                            'content'=>$tem_content,
                            'status'=>$tem_status,
                            'created_date'=>$date,
                               );
           //print_r($cat_value);exit;
          $insert_tem =  $this->common_model->insert_entry('ai_email_template',$tem_value);
          if($tem_value){
            $this->session->set_flashdata('succ', "Template has been added successfully. ");
          redirect('ManageTemplate');
          }
        }
            else{
        //print_r($data['parent']);exit;
       $this->get_header('Manage Category');
       $this->load->view('admin/template/add_template');
       $this->load->view('admin/include/footer_other');
    }
}
    public function edit(){
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        $tem_id = $this->uri->segment(2);
        $fetch_by = array('id'=>$tem_id);
        $get_field  = array('title','content','status');
        $data['template_details'] = $this->common_model->getsingle('ai_email_template',$fetch_by,$get_field);
    
         //$this->form_validation->set_rules('title', 'First Name', 'trim|required');
         //$this->form_validation->set_rules('content', 'Last Name', 'trim|required');
         $this->form_validation->set_rules('status', 'Email', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            
            $by = array('id'=>$tem_id);
            $fname = trim($this->input->post("title",TRUE));
            $lname = trim($this->input->post("content",TRUE));
            $email = trim($this->input->post("status",TRUE));
            $edit_details = array
                                (
                                  'title' => $fname,
                                  'content' => $lname,
                                  'status' => $email,
                                  'update_date' => date('Y-m-d H:i:s')
                                );
            //print_r($edit_details);
            $data['update_template'] = $this->common_model->update_entry('ai_email_template',$edit_details,$by);
            if($data['update_template']){
                $this->session->set_flashdata('succ', "Template has been update successfully.");
                redirect('ManageTemplate');
            }
            
           }
        else{
        $this->get_header('Manage Category'); 
        $this->load->view('admin/template/edit_template',$data);
        $this->load->view('admin/include/footer_other');  
    }
     }
     public function delete(){
            $user_id = $this->uri->segment(2);
            $where  = array('id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_email_template',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Template has been Delete successfully.");
           }
           redirect('ManageTemplate');
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