<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Home extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
    }
    public function index() {
        $where = array('is_active' => 1);
        $data['slider_data'] = $this->common_model->getAllwhere('banner', $where, '*');
        $by = array('status' => 1);
        $field = array('author_name', 'author_img', 'author_email', 'author_msg');
        $data['testimonial'] = $this->common_model->getAllwherenewwith_order('ai_testimonial', $by, $field, 'id', 'asc');
        $where = array('cat_parent_id!=' => 0);
        $cat_discription = array('cat_id', 'cat_parent_id', 'cat_name', 'cat_picture', 'cat_desc');
        $data['child_cat'] = $this->common_model->getAllwherenewwith_order('ai_category', $where, $cat_discription, '', 'asc');
        // echo $this->db->last_query();
        $this->get_front_header('Home');
        $this->load->view('front/home', $data);
        $this->load->view('front/include/footer');
    }
    function about_us() {
        $data['about_data'] = $this->common_model->getsingle('pages', array('pages.page_id' => 5), 'page_id,page_title,page_content,meta_title,meta_description,meta_keyword');
        //print_r($data['select_data']);
        $this->get_front_header('About us');
        $this->load->view('front/about_us', $data);
        $this->load->view('front/include/footer');
    }
    
    function terms() {
        $data['terms_data'] = $this->common_model->getsingle('pages', array('pages.page_id' => 4), 'page_id,page_title,page_content,meta_title,meta_description,meta_keyword');
        $this->get_front_header('Term & Condition');
        $this->load->view('front/terms', $data);
        $this->load->view('front/include/footer');
    }
    
    function privacy_policy() {
        $data['privacy'] = $this->common_model->getsingle('pages', array('pages.page_id' => 10), 'page_id,page_title,page_content,meta_title,meta_description,meta_keyword');
        //print_r($data['select_data']);
        $this->get_front_header('Privacy Policy');
        $this->load->view('front/privacy_policy', $data);
        $this->load->view('front/include/footer');
    }
    
    function cancellation_policy() {
        $data['cancellation_policy'] = $this->common_model->getsingle('pages', array('pages.page_id' => 11), 'page_id,page_title,page_content,meta_title,meta_description,meta_keyword');
        //print_r($data['select_data']);
        $this->get_front_header('Cancellation Policy');
        $this->load->view('front/cancellation_policy', $data);
        $this->load->view('front/include/footer');
    }
    
    function press() {
        $data['press'] = $this->common_model->getsingle('pages', array('pages.page_id' => 12), 'page_id,page_title,page_content,meta_title,meta_description,meta_keyword');
        //print_r($data['select_data']);
        $this->get_front_header('Press');
        $this->load->view('front/press', $data);
        $this->load->view('front/include/footer');
    }
    
        function search() {
        //print_r($_POST);exit;
        if ($_POST) {
            $cat_name = encode_category($this->input->post('cat'));
            
            redirect(SITEBASEURL . 'Services/' .$cat_name);
            exit;
            
            $where = array('cat_name' => $cat_name);
            $field = array('cat_id', 'cat_parent_id');
            $cat_details = $this->common_model->getsingle(' ai_category', $where, $field);
            $cat = $cat_details->cat_parent_id;
            if ($cat == 0) {
                
            } else {
                $sub_cat = encode_category($cat_name);
                $by = array('cat_id' => $cat);
                $field = array('cat_name');
                $cat_details = $this->common_model->getsingle('ai_category', $by, $field);
                $main_cat = $cat_details->cat_name;
                redirect(SITEBASEURL . 'Services/' . $main_cat . '/' . $sub_cat);
            }
        }
    }
    

}
