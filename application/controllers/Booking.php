<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
           }
    public function index() 
    {
        $data['booking'] = $this->common_model->getAllrecord('ai_appointment_booking');
        //print_r($data['booking']);exit;
        $data['plan_price'] = $this->common_model->getAllrecord('ai_plan');
        $this->get_header('Manage Banner'); 
        $this->load->view('admin/booking/manage_booking',$data);
        $this->load->view('admin/include/footer_other');  
    } 
} 
?>