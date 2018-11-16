<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promocode extends MY_Controller {
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
       $data['promocode'] = $this->common_model->getAllrecord('ai_promo_code');
       $this->get_header('Manage Category');
       $this->load->view('admin/promocode/manage_promocode',$data);
       $this->load->view('admin/include/footer_other');
    }
    public function promocode_gen(){
     
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $res = "";
     for ($i = 0; $i < 6; $i++) {
   $res .= $chars[mt_rand(0, strlen($chars)-1)]; 
     $html = '';
    $html .= $res;
     }
  echo $html;
    }
       function add_promocode()
    {
        if($_POST){
         $p_title = $this->input->post('promo_title');
         $p_for = $this->input->post('promo_for');
         $p_code = $this->input->post('promo_code');
         $p_member = $this->input->post('max_no_uses');
         $p_discount = $this->input->post('promo_discount_val');
         $p_date = $this->input->post('created_date');
         $p_expdate = $this->input->post('expiry_date');
         $b_status = $this->input->post('status');
        $data = array('promo_title'=>$p_title,
                      'promo_for'=>$p_for,
                      'promo_code'=>$p_code,
                      'max_no_uses'=>$p_member,
                     'promo_discount_val'=>$p_discount,
                     'created_date'=>date('Y-m-d', strtotime($p_date)),
                     'expiry_date'=>date('Y-m-d', strtotime($p_expdate)),
                     'status'=>$b_status,
                    );
        $manage_promocode = $this->common_model->insert_entry('ai_promo_code',$data);
          if($manage_promocode){
            $this->session->set_flashdata('succ', "Promocode has been added successfully. ");
        redirect('ManagePromocode');
        }
        }
        else {
        $data['cat_details'] = $this->common_model->getAllrecord('ai_category');
       // print_r($data['cat_details']);exit;
        $this->get_header('Manage Banner');
        $this->load->view('admin/promocode/add_promocode',$data);
        $this->load->view('admin/include/footer_other');
        }
          }
        public function edit_promocode(){
       
        $promocode_id = $this->uri->segment(2);
        $fetch_by = array('id'=>$promocode_id);
        $get_field  = array('id','promo_title','promo_for','max_no_uses','promo_discount_val','created_date','expiry_date','status');
        $data['promocode_details'] = $this->common_model->getsingle('ai_promo_code',$fetch_by,$get_field);
        if ($_POST){
            $by = array('id' =>$promocode_id);
            $title = trim($this->input->post("promo_title", TRUE));
            $promo_for = trim($this->input->post("promo_for", TRUE));
            $user = trim($this->input->post("max_no_uses", TRUE));
            $val = trim($this->input->post("promo_discount_val", TRUE));
            $p_date = $this->input->post('created_date');
           $p_expdate = $this->input->post('expiry_date');
            $status = trim($this->input->post("status", TRUE));
            $edit_details = array
                                (
                                  'promo_title' => $title,
                                  'promo_for' => $promo_for,
                                  'max_no_uses' => $user,
                                  'promo_discount_val' => $val,
                                  'created_date' =>date('Y-m-d', strtotime($p_date)),
                                  'expiry_date' =>date('Y-m-d', strtotime($p_expdate)),
                                  'status' => $status,
                                 
                                );
            //print_r($edit_details);
            $data['update_promocode'] = $this->common_model->update_entry('ai_promo_code',$edit_details,$by);
            if($data['update_promocode']){
                $this->session->set_flashdata('succ', "Promocode has been update successfully.");
                redirect('ManagePromocode');
            }
            
           }
        else{
        $data['cat_details'] = $this->common_model->getAllrecord('ai_category');
        $this->get_header('Manage Category'); 
        $this->load->view('admin/promocode/edit_promocode',$data);
        $this->load->view('admin/include/footer_other');  
    }
     }
     public function delete_promocode(){
            $user_id = $this->uri->segment(2);
            $where  = array('id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_promo_code',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Promocode has been Delete successfully.");
           }
           redirect('ManagePromocode');
    }
  
    
}