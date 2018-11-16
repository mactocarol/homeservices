<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
    }
    public function index() {
        $service_id = '';
        $cat_name = decode_category($this->uri->segment(2));
        //set where for fetch data of selected category 
        $where_category_selection = array(
            'cat_name' => $cat_name,
            'is_active' => 'active'
        );
        $select_category_column = 'cat_id,cat_name,cat_picture,cat_desc';
        $data['category_data'] = $this->common_model->get_entry_by_data("category", true, $where_category_selection, $select_category_column);
        $service_id = $data['category_data']['cat_id'];
        if (!empty($service_id)) {
            $active = 'active';
            $select_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id', 'cat_desc', 'meta_title', 'meta_desc');
            $where_field = array('cat_parent_id' => $service_id, 'is_active' => "'$active'");
            $data['child_record'] = $this->common_model->getAllwherenew('category', $where_field, $select_field);
        }
        $this->get_front_header('Service');
        $this->load->view('front/services/services', $data);
        $this->load->view('front/include/footer');
    }
    /* Single Service Controller  */
    public function single_service() {
        $this->form_validation->set_rules('code', 'Post Code', 'trim|required');
        $getname = decode_category($this->uri->segment(3));
        $active = 'active';
        $select_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id', 'cat_desc', 'meta_title', 'meta_desc');
        $where_field = array('cat_name' => "'$getname'", 'is_active' => "'$active'");
        $data['get_single_record'] = $this->common_model->getAllwherenew('category', $where_field, $select_field);
        if ($this->form_validation->run() == TRUE) {
            $post_code = $this->input->post('code');
            $gat_parent_cat = $this->uri->segment(2);
            $gat_cat = $this->uri->segment(3);
            $by = array('zip_code' => $post_code);
            $field = array('location_name', 'city', 'zip_code');
            $check_location = $this->common_model->getAllwherenew('locations', $by, $field);
            //print_r($check_location);exit;
            if ($check_location != 'no') {
                $fetch_zipcode = $check_location[0]->zip_code;
                if ($fetch_zipcode == $post_code) 
                {
                    $newdata = array(
                        'zipcode' => $fetch_zipcode,
                        'parant_cat' => $gat_parent_cat,
                        'child_cat' => $gat_cat
                    );
                    $this->session->set_userdata($newdata);
                    //redirect(SITEBASEURL . 'My-account');
                    redirect(base_url() . "CheckPrice/" . $gat_parent_cat . "/" . $gat_cat . "/" . ci_enc($post_code));
                }
            } else {
                $msg = 'Your Postcode is NOT Matched';
                $this->_set_msg($msg, 'red');
            }
        }
        $this->get_front_header('Single Service');
        $this->load->view('front/services/single_service', $data);
        $this->load->view('front/include/footer');
    }

    public function check_price() {
        $zipcode = $this->session->userdata('zipcode');
        $parent = $this->session->userdata('parant_cat');
        $child = $this->session->userdata('child_cat');
        if($zipcode != ''){
        $gotted_parent_cat = decode_category($this->uri->segment(2));
        $gotted_cat = decode_category($this->uri->segment(3));
        $got_post_code = ci_dec($this->uri->segment(4));
        $where = array('zip_code' => $got_post_code);
        $post_field = array('zip_code');
        $data['single_product_price'] = $this->common_model->getAllwherenew('locations', $where, $post_field);
        $where_cat = array('cat_name' => "'$gotted_cat'");
        $field_cate = array('cat_name', 'cat_desc');
        $data['single_cate'] = $this->common_model->getAllwherenew('ai_category', $where_cat, $field_cate);
        $where_parnt_cat = array('cat_name' => "'$gotted_parent_cat'");
        $field_parnt_cate = array('cat_picture');
        $data['single_parnt_img'] = $this->common_model->getAllwherenew('ai_category', $where_parnt_cat, $field_parnt_cate);
        $where_items = array('cat_name' => "'$gotted_cat'");
        $field_items = array('cat_attribute', 'req_message', 'stuff', 'cat_name', 'cat_id', 'cat_parent_id');
        $data['single_items_record'] = $this->common_model->getAllwherenew('ai_category', $where_items, $field_items);
        $this->get_front_header('Single Service');
        $this->load->view('front/services/get_price', $data);
        $this->load->view('front/include/footer');
        }else{
            redirect(base_url());
        }
    }

    public function check_price1() {
        echo "test";
        exit;
    }
    
    public function unit_price_new() {
        echo $this->uri->segment(2);
        echo "test";
        exit;
    }

    public function booking() {
        $this->get_front_header('Single Service');
        $this->load->view('front/services/booking_form');
        $this->load->view('front/include/footer');
    }

    public function booking_terms() {
        $this->get_front_header('Single Service');
        $this->load->view('front/services/booking_terms');
        $this->load->view('front/include/footer');
    }

    public function unit_price() {
        
        $method_uri = $this->uri->segment(1);
        $cat_name = decode_category($this->uri->segment(3));
        
        //$label_first_unit = $this->uri->segment(2);
        //$label_second_unit = $this->uri->segment(4);
        //$label_thired_unit = $this->uri->segment(6);
       
       
         $first_getcurr = $this->uri->segment(3);
         $second_getcurr = $this->uri->segment(4);
         $third_getcurr = $this->uri->segment(5);
        
        if($first_getcurr != ''){
            $first_get = $first_getcurr;
        }else{
            $first_get = 0;
        }
        
        if($second_getcurr != ''){
            $second_get = $second_getcurr;
        }else{
            $second_get = 0;
        }
        
        if($third_getcurr != ''){
            $third_get = $third_getcurr;
        }else{
            $third_get = 0;
        }
        
        $where_price = array('cat_name' => "'$cat_name'");
        $field_price = array('cat_attribute');
        $data['product_unit'] = $this->common_model->getAllwherenew('ai_category', $where_price, $field_price);
        //print_r($data['product_unit']);
        if ($data['product_unit'] != 'no') {
            $units = $data['product_unit'][0]->cat_attribute;
            $units_decode = json_decode($units);
            $first_unit_hours = $units_decode[0]->hours;
            $second_unit_hours = $units_decode[1]->hours;
            $thired_unit_hours = $units_decode[2]->hours;
            
            $tt =  $first_get + $second_get + $third_get;
            echo $tt;
        }
      
    }
    public function Get_a_price() {
        $this->get_front_header('Single Service');
        $this->load->view('front/services/pic_shel');
        $this->load->view('front/include/footer');
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
