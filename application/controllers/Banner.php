<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('page_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
    }

    //show list of all users.
    public function index() {
        //$this->check_admin_login();
        $data['banner_record'] = $this->common_model->getAllwherenew('ai_banner', array('is_active' => 1), '*');
        $this->get_header('Manage Banner');
        $this->load->view('admin/banner/manage_banner', $data);
        $this->load->view('admin/include/footer_other');
    }

    function add_banner() {
        if (!empty($_FILES['banner_img']['name'])) {
            //$path =$_FILES['banner_img']['name'];
            //$banner_img = $this->myclass->upload_pic('banner_img');

            $banner_img = $this->myclass->upload_picture_thumb('banner_img', '/assets/baner/', '/assets/baner/thumb/', '200', '200');
            //print_r($banner_img);exit;
            $b_title = $this->input->post('banner_title');
            $b_status = $this->input->post('is_active');
            $data = array('banner_image' => $banner_img,
                'banner_title' => $b_title,
                'is_active' => $b_status);
            $manage_banner = $this->common_model->insert_entry('ai_banner', $data);
            if ($manage_banner) {
                $this->session->set_flashdata('succ', "Banner has been Add successfully. ");
                redirect('ManageBanner');
            }
        } else {
            $this->get_header('Add Banner');
            $this->load->view('admin/banner/add_banner');
            $this->load->view('admin/include/footer_other');
        }
    }

    function edit_banner() {
        $b_id = $this->uri->segment(2);
        $fetch_by = array('banner_id' => $b_id);
        $get_field = array('banner_title', 'is_active', 'banner_image');
        $data['fetch_recored'] = $this->common_model->getsingle('ai_banner', $fetch_by, $get_field);
        $this->form_validation->set_rules('banner_title', 'Banner', 'trim|required');
        $this->form_validation->set_rules('is_active', 'Status', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            //$path =$_FILES['banner_img']['name'];
            $banner_img = $this->myclass->upload_picture_thumb('banner_img', '/assets/baner/', '/assets/baner/thumb/', '200', '200');
            if ($banner_img == "") {
                $img = $this->input->post('pre_img');
            } else {
                $img = $banner_img;
            }

            $where = array('banner_id' => $b_id);
            $title = $this->input->post('banner_title');
            $status = $this->input->post('is_active');
            $b_field = array('banner_title' => $title,
                'is_active' => $status,
                'banner_image' => $img);
            $data['update_banner'] = $this->common_model->update_entry('ai_banner', $b_field, $where);
            if ($data['update_banner']) {
                $this->session->set_flashdata('succ', "Banner has been update successfully. ");
                redirect('ManageBanner');
            }
        } else {
            $this->get_header('Add Banner');
            $this->load->view('admin/banner/edit_banner', $data);
            $this->load->view('admin/include/footer_other');
        }
    }

    function delete_banner() {
        $b_id = $this->uri->segment(2);
        $where = array('banner_id' => $b_id);
        $delete_record = $this->common_model->DeleteRecordWhere('ai_banner', $where);
        if ($delete_record) {
            $this->session->set_flashdata('succ', "Banner has been Delete successfully.");
            redirect('ManageBanner');
        }
    }

//       public function get_header($title = '') 
//    {
//        $this->load->model('page_model');
//        $data['title'] = $title;
//        $this->load->view('admin/include/header_other', $data);
//        $this->load->view('admin/include/left_nav');
//        $this->load->view('admin/include/user_header');
//        $admin_login = $this->session->userdata('admin_id');
//        if ($admin_login) {
//            return true;
//        } else {
//            redirect('admin/index');
//        }
//    }
}

/* End of file user.php */

/* Location: ./application/controllers/api/user.php */


//                                           $booked_hr =  $get_booking->plan_hr_badroom;
//                                           $booked_bathhr =  $get_booking->plan_hr_bathroom;
//                                           $total_bookedhr = $booked_hr + $booked_bathhr;
//                                           $price_three = $discunt_three * $booked_hr;
//                                           print_r($price_three);exit;
//                                           // for bath
//                                            $bath_three = $bath_plan->plan_three_month;
//                                            $bath_three_decode = json_decode($bath_three);
//                                           $discunt_baththree =  $bath_three_decode[0]->discount_price;
//                                           $price_baththree = $discunt_baththree * $booked_bathhr;