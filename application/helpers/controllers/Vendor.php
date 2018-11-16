<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends MY_Controller {
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
       $data['vender'] = $this->common_model->getAllrecord('ai_vendors');
       // print_r($data['template']);
       $this->get_header('Manage Category');
       $this->load->view('admin/vendor/manage_vendor',$data);
       $this->load->view('admin/include/footer_other');
    }
    
    public function add_vendor()
    {
        if($_POST)
        {
           $fname = $this->input->post('vendor_firstname');
           $lname = $this->input->post('vendor_lastname'); 
           $email = $this->input->post('vendor_email');
           $type = $this->input->post('vendor_type'); 
           $exp = $this->input->post('vendor_experience');
           $status = $this->input->post('vendor_status');
           $vendor_joined_date = date('Y-m-d H:i:s');
           $vendor_value = array
                            (
                            'vendor_firstname'=>$fname,
                            'vendor_firstname'=>$lname,
                            'vendor_email'=>$email,
                            'vendor_type'=>$type,
                            'vendor_experience'=>$exp,
                            'vendor_status'=>$status,
                            'vendor_joined_date'=>$vendor_joined_date,
                                              );
           //print_r($cat_value);exit;
          $insert_vendor =  $this->common_model->insert_entry('ai_vendors',$vendor_value);
          if($insert_vendor){
            $this->session->set_flashdata('succ', "Vender has been added successfully. ");
          redirect('ManageVendor');
          }
        }
            else{
        //print_r($data['parent']);exit;
       $this->get_header('Manage Category');
       $this->load->view('admin/vendor/add_vendor');
       $this->load->view('admin/include/footer_other');
    }
}
    public function edit_vendor(){
        $ven_id = $this->uri->segment(2);
        $fetch_by = array('v_id'=>$ven_id);
        $get_field  = array('v_id','vendor_firstname','vendor_lastname','vendor_email','company','vendor_experience','vendor_status','date_updated','mobile');
        $data['vendor_details'] = $this->common_model->getsingle('ai_vendors',$fetch_by,$get_field);
    if($_POST){
            $by = array('v_id'=>$ven_id);
            $fname = trim($this->input->post("vendor_firstname", TRUE));
            $lname = trim($this->input->post("vendor_lastname", TRUE));
            $email = trim($this->input->post("vendor_email", TRUE));
            //$type = trim($this->input->post("vendor_type", TRUE));
            $exp = trim($this->input->post("vendor_experience", TRUE));
            $status = trim($this->input->post("vendor_status", TRUE));
            $edit_details = array
                                (
                                  'vendor_firstname' => $fname,
                                  'vendor_lastname' => $lname,
                                  'vendor_email' => $email,
                                  //'vendor_type' => $type,  
                                  'vendor_experience' =>$exp,
                                  'vendor_status' => $status,
                                 'date_updated' => date('Y-m-d H:i:s')
                                );
            //print_r($edit_details);
            $data['update_vendor'] = $this->common_model->update_entry('ai_vendors',$edit_details,$by);
            if($data['update_vendor']){
                $this->session->set_flashdata('succ', "Vender has been update successfully.");
                redirect('ManageVendor');
            }
            
           }
        else{
        $this->get_header('Manage Category'); 
        $this->load->view('admin/vendor/edit_vendor',$data);
        $this->load->view('admin/include/footer_other');  
    }
     }
     public function delete_vendor(){
            $user_id = $this->uri->segment(2);
            $where  = array('v_id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_vendors',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Vendor has been Delete successfully.");
           }
           redirect('ManageVendor');
    }
   }