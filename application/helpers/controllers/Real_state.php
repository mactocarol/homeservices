<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Real_state extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('page_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
    }

    //show list of all real state
 
    public function real() {
        //$this->check_admin_login();
        $data['realstate_info'] = $this->common_model->allgetrecord('ai_real_state_info');
        $this->get_header('Manage Banner');
        $this->load->view('admin/realstate_info/manage_realstate',$data);
        $this->load->view('admin/include/footer_other');
    }
     function delete_realstate() {
        $id = $this->uri->segment(2);
        $where = array('id' => $id);
        $delete_record = $this->common_model->DeleteRecordWhere('ai_real_state_info', $where);
        if ($delete_record) {
            $this->session->set_flashdata('succ', "Info has been Delete successfully.");
            redirect('ManageRealState');
        }
} 
}
?>