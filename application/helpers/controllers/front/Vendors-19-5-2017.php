<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendors extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
    }
    public function vendors_info() {
        $this->form_validation->set_rules('vendor_firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('vendor_lastname', 'Last Name', 'trim|required');
        //$this->form_validation->set_rules('email', 'Email Id', 'trim|required|min_length[15]|max_length[255]|is_unique[ai_vendors.vendor_email]');
        
        if ($this->form_validation->run() == TRUE) 
            {
            //print_r($_POST);exit;
            $fname = $this->input->post('vendor_firstname');
            $lname = $this->input->post('vendor_lastname');
            $email = $this->input->post('vendor_email');
            $company = $this->input->post('company');
            
            $vendors_choose_cat = implode(',',$_POST['vendors_choose_cat']);
            //print_r($vendors_choose_cat);exit;
            
            $vandors_info = array
                (
                'company' => $company,
                'vendor_firstname' => $fname,
                'vendor_lastname' => $lname,
                'vendor_email' => $email,
                'vendors_choose_cat' => $vendors_choose_cat,
                'vendor_status' => 'inactive'
            );
            
            $newdata = array(
                        'vendor_email' => $email
                    );
            $this->session->set_userdata($newdata);
           //print_r($vandors_info);exit;
            $vendous_info = $this->common_model->insert_entry('ai_vendors', $vandors_info);
            if($vendous_info){
                redirect(base_url().'front/vendors/vendors_fill_details');
            }
        }
        else
            {
            $where = array('is_active' => 1);
            $field = array('cat_name', 'cat_parent_id', 'cat_id');
            $data['get_catname'] = $this->common_model->getAllwherenew('ai_category', $where, $field);
            //for country
            $data['get_country'] = $this->common_model->getAllrecord('ai_country');
            $this->get_front_header('Home');
            $this->load->view('front/vendors/get_vendors', $data);
            $this->load->view('front/include/footer');
        }
    }
    public function vendors_fill_details()
    {
        $email = $this->session->userdata('vendor_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('confirmnumber', 'Confirm Mobile', 'trim|required|matches[mobile]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        if($this->form_validation->run() == TRUE){
            
            //print_r($_POST);exit;
            $update_arr = array
                               (
                                'mobile' => trim($_POST['mobile']),
                                'address' => trim($_POST['address']),
                                'apt' => trim($_POST['apt']),
                                'country' => trim($_POST['country']),
                                'city' => trim($_POST['city']),
                                'state' => trim($_POST['state']),
                                'zipcode' => trim($_POST['zipcode']),
                                'vendor_experience' => trim($_POST['candidate_provider']),
                                'vendor_gender' => trim($_POST['gender'])
                                );
            
            $success_vendor = $this->common_model->UpdateRecords('ai_vendors',$update_arr, array('vendor_email' => $email));
            if($success_vendor){
                $this->session->unset_userdata('vendor_email');
                $nmsg = 'your account has been register.Your Account active by Admin...';
                $this->_set_msg($nmsg, 'green');
                redirect(base_url().'Vendors');
            }
        }
        $data['get_country'] = $this->common_model->getAllrecord('ai_countries');
        
        $this->get_front_header('Home');
        $this->load->view('front/vendors/vendors_details',$data);
        $this->load->view('front/include/footer');
    }
    
    function change_state()
	{
		$country = $this->input->post('Country');
		$rec = $this->myclass->ChangeStateByCountry($country);
                //print_r($rec);exit;
		echo $rec;
	}
        
        public function _set_msg($msg, $color = 'red') {
        $msg_arr = array(
            'errorm' => '<div>* ' . $msg . '</div>',
            'errorm_theme' => $color
        );
        //add the above data into temp session via flashdata.
        $this->session->set_flashdata($msg_arr);
        return true;
    }
}
