<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
    }
    public function index(){
        $data['user_details'] = $this->common_model->getAllrecord('ai_user');
        $this->get_header('Manage Banner'); 
        $this->load->view('admin/user/manage_user',$data);
        $this->load->view('admin/include/footer_other');  
    }
    
     public function edit_user(){
        $userid = ci_dec($this->uri->segment(2));
        $fetch_by = array('user_id'=>$userid);
        $get_field  = array('first_name','last_name','email','phone','address','status','type');
        $data['fetch_details'] = $this->common_model->getsingle('ai_user',$fetch_by,$get_field);
       // print_r($data['fetch_details'] );exit;
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
         $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
         $this->form_validation->set_rules('email', 'Email', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            
            $by = array('user_id'=>$userid);
            $fname = trim($this->input->post("fname",TRUE));
            $lname = trim($this->input->post("lname",TRUE));
            $email = trim($this->input->post("email",TRUE));
            $pnumber = trim($this->input->post("pnumber",TRUE));
            $address = $this->input->post("address");
            $type = $this->input->post("type");
            $status = $this->input->post("status");
            $edit_details = array
                                (
                                  'first_name' => $fname,
                                  'last_name' => $lname,
                                  'email' => $email,
                                  'phone' => $pnumber,
                                  'address' => $address,
                                  'status' => $type,
                                  'type' => $status,
                                  'date_updated' => date('Y-m-d H:i:s')
                                );
            //print_r($edit_details);
            $data['update_banner'] = $this->common_model->update_entry('user',$edit_details,$by);
            if($data['update_banner']){
                $this->session->set_flashdata('succ', "User has been update successfully.");
                redirect('ManageUser');
            }
        }
        else{
        $this->get_header('Manage Banner'); 
        $this->load->view('admin/user/edit_user',$data);
        $this->load->view('admin/include/footer_other');  
    }
     }
      public function delete_user(){
            $user_id = ci_dec($this->uri->segment(2));
            $where  = array('user_id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_user',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "User has been Delete successfully.");
           }
           redirect('ManageUser');
    }
}
   