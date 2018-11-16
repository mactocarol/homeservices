<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
    }

    public function index() {
        $data['cat_record'] = $this->category_model->run_query_arr('SELECT `ai_category`.*, `b`.`cat_name` as `parent_level` FROM `ai_category` LEFT JOIN `ai_category` as `b` ON `ai_category`.`cat_parent_id` = `b`.`cat_id` ORDER BY `ai_category`.`cat_id` DESC');
       //echo $this->db->last_query();exit;
        $this->get_header('Manage Category');
        $this->load->view('admin/categories/manage_categories', $data);
        $this->load->view('admin/include/footer_other');
    }

    public function add_category() {
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
         $this->form_validation->set_rules('cat', 'Category', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            //print_r($_POST);exit;
            //$stuff_field = $_POST['stuff'];
            $professionals = $_POST['professionals'];
            $hours = $_POST['hours'];            
            $weekly_price = (!empty($_POST['weekly_price'])) ? $_POST['weekly_price'] : '';
            $biweekly_price = (!empty($_POST['biweekly_price'])) ? $_POST['biweekly_price'] : '';
            $monthly_price = (!empty($_POST['monthly_price'])) ? $_POST['monthly_price'] : '';

            $unit = $_POST['unit'];
            
            $hourly = $_POST['hourly'];
            $hourly_price = $_POST['hourly_price'];
            
            $required_field_1 = $_POST['required_field_1'];
            $required_field_2 = $_POST['required_field_2'];
            //$required_field_3 = $_POST['required_field_3'];
            
            $stuff_1 = $_POST['first_staff'];
            $staff_2 = $_POST['second_staff'];
            //$staff_3 = json_encode($_POST['staff_3']);
            
            
            for ($ss = 0; $ss < count($stuff_1); $ss++) {
                $stuffdata[] = array('stuff_1' => $stuff_1[$ss]);
            }
            $stu_data = json_encode($stuffdata);
            
            for ($sa = 0; $sa < count($staff_2); $sa++) {
                $stuffdata_1[] = array('stuff_2' => $staff_2[$sa]);
            }
            $stu_data_1 = json_encode($stuffdata_1);
            
            
            for ($fs = 0; $fs < count($professionals); $fs++) {
                $feedata[] = array('professionals' => $professionals[$fs], 'unit' => $unit[$fs], 'hours' => $hours[$fs], 'weekly_price' => $weekly_price[$fs],'biweekly_price' => $biweekly_price[$fs],'monthly_price' => $monthly_price[$fs]);
            }
            $feedataset = json_encode($feedata);
//            for ($aa = 0; $aa < count($stuff_field); $aa++) {
//                $feedata1[] = array('stuff' => $stuff_field[$aa]);
//            }
//            $final_stuff = json_encode($feedata1);
            
            for ($aa = 0; $aa < count($hourly); $aa++) {
                $hours_data[] = array('hourly' => $hourly[$aa], 'hourly_price' => $hourly_price[$aa]);
            }
            $hours_data = json_encode($hours_data);
            
            //print_r($final_stuff);exit;
            //$path =$_FILES['cat_picture']['name'];
            //$image = $this->myclass->uploadImage($path,'cat_picture','/services/assets/Banner','/services/assets/Banner/thumb','150','150');
            $category_img = $this->myclass->upload_picture_thumb('cat_picture', '/assets/category/', '/assets/category/thumb/', '200', '200');
            $cat_name = trim($this->input->post('cat', TRUE));
            $cat_desc = $this->input->post('category_desc');
            $cat_mtitle = $this->input->post('meta_title');
            $cat_mdesc = $this->input->post('meta_desc');
            $cat_mtag = $this->input->post('meta_tag');
            $cat_order = $this->input->post('cat_order');
            $cat_status = $this->input->post('is_active');
            $cat_parent = $this->input->post('event_category');
            $cat_attribute = $feedataset;
            //$required_field = $this->input->post('required_field');
            $date = date('Y-m-d H:i:s');
            $cat_value = array
                (
                'cat_name' => $cat_name,
                'cat_desc' => $cat_desc,
                'cat_parent_id' => $cat_parent,
                'meta_title' => $cat_mtitle,
                'meta_desc' => $cat_mdesc,
                'meta_tag' => $cat_mtag,
                'cat_order' => $cat_order,
                'cat_create_date' => $date,
                'cat_picture' => $category_img,
                'is_active' => $cat_status,
                'cat_attribute' => $cat_attribute,
                'req_message' => '-',
                'stuff' => '',
                'hourly_rate' => $hours_data,
                'required_field_1' => $required_field_1,
                'required_field_2' => $required_field_2,
                'required_field_3' => '',
                'stuff_1' => $stu_data,
                'staff_2' => $stu_data_1,
                'staff_3' => ''
            );

            print_r($cat_value);exit;
            $insert_cat = $this->common_model->insert_entry('category', $cat_value);
            if ($insert_cat) {
                $this->session->set_flashdata('succ', "Category has been added successfully. ");
                redirect('ManageCategories');
            }
        } else {
            $data['parent'] = $this->common_model->getAllrecord('ai_category');
            //print_r($data['parent']);exit;
            $this->get_header('Manage Category');
            $this->load->view('admin/categories/add_categories', $data);
            $this->load->view('admin/include/footer_other');
        }
    }

    public function edit_cat() {        
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        $editid = $this->uri->segment(2);
        $fetch_by = array('cat_id' => $editid);
        $get_field = array('cat_parent_id', 'cat_name', 'is_active', 'cat_picture', 'cat_id', 'cat_desc', 'meta_title', 'meta_desc', 'meta_tag', 'cat_order', 'cat_attribute', 'req_message', 'stuff','hourly_rate','required_field_1','stuff_1','required_field_2','staff_2','required_field_3','staff_3');
        $data['fetch_details'] = $this->common_model->getsingle('ai_category', $fetch_by, $get_field);
        $data['parent'] = $this->common_model->getAllrecord('ai_category');
        if ($_POST) {
            $required_field = $this->input->post('required_field');
            $professionals = (!empty($_POST['professionals'])) ? $_POST['professionals'] : '';
            $hours = (!empty($_POST['hours'])) ? $_POST['hours'] : '';
            $weekly_price = (!empty($_POST['weekly_price'])) ? $_POST['weekly_price'] : '';
            $biweekly_price = (!empty($_POST['biweekly_price'])) ? $_POST['biweekly_price'] : '';
            $monthly_price = (!empty($_POST['monthly_price'])) ? $_POST['monthly_price'] : '';
            //$stuff_field = $_POST['stuff'];
            $unit = (!empty($_POST['unit'])) ? $_POST['unit'] : '';
            
            $hourly = (!empty($_POST['hourly'])) ? $_POST['hourly'] : '';
            $hourly_price = (!empty($_POST['hourly_price'])) ?  $_POST['hourly_price'] : '';
            
            $required_field_1 = (!empty($_POST['required_field_1'])) ? $_POST['required_field_1'] : '';
            $required_field_2 = (!empty($_POST['required_field_2'])) ? $_POST['required_field_2'] : '';
            //$required_field_3 = $_POST['required_field_3'];
            
            $stuff_1 = (!empty($_POST['first_staff'])) ? $_POST['first_staff'] : '';
            $staff_2 = (!empty($_POST['second_staff'])) ? $_POST['second_staff'] : '';
            //$staff_3 = json_encode($_POST['staff_3']);
            
            if(!empty($stuff_1))
            {
            for ($ss = 0; $ss < count($stuff_1); $ss++) {
                $stuffdata[] = array('stuff_1' => $stuff_1[$ss]);
            }
                        
            
            }
            else
            {
            $stuffdata[]=array('stuff_1' =>'');
            }
            $stu_data = json_encode($stuffdata);
            
            if(!empty($stuff_2))
            {
            
            for ($sa = 0; $sa < count($staff_2); $sa++) {
                $stuffdata_1[] = array('stuff_2' => $staff_2[$sa]);
            }
            }
            else
            {
            $stuffdata_1[] = array('stuff_2' => '');
            }
            $stu_data_1 = json_encode($stuffdata_1);

            for ($fs = 0; $fs < count($professionals); $fs++) {
                $feedata[] = array('professionals' => $professionals[$fs], 'unit' => $unit[$fs], 'hours' => $hours[$fs], 'weekly_price' => $weekly_price[$fs],'biweekly_price' => $biweekly_price[$fs],'monthly_price' => $monthly_price[$fs]);
            }

             for ($aa = 0; $aa < count($hourly); $aa++) {
                $hours_data[] = array('hourly' => $hourly[$aa], 'hourly_price' => $hourly_price[$aa]);
            }
            $hours_data = json_encode($hours_data);
            $feedataset = json_encode($feedata);
            $cat_attribute = $feedataset;
            $user_id = $this->uri->segment(2);
            $by = array('cat_id' => $user_id);
            $category_img = $this->myclass->upload_picture_thumb('cat_picture', '/assets/category/', '/assets/category/thumb/', '200', '200');
            if ($category_img == "") {
                $cat_img = $this->input->post('categ_img');
            } else {
                $cat_img = $category_img;
            }
            //$image = $this->myclass->uploadImage($path,'cat_picture','/services/assets/Banner','/services/assets/Banner/thumb','150','150');
            $cat_status = $this->input->post('is_active');
            $cat_edit = array
                            (
                            'cat_parent_id' => trim($this->input->post('event_category', TRUE)),
                            'cat_name' => trim($this->input->post('cat', TRUE)),
                            'cat_desc' => trim($this->input->post('category_desc', TRUE)),
                            'cat_picture' => $cat_img,
                            'meta_title' => trim($this->input->post('meta_title', TRUE)),
                            'meta_desc' => trim($this->input->post('meta_desc', TRUE)),
                            'meta_tag' => trim($this->input->post('meta_tag', TRUE)),
                            'cat_order' => trim($this->input->post('cat_order', TRUE)),
                            'is_active' => $cat_status,
                            'cat_update_date' => date('Y-m-d H:i:s'),
                            'cat_attribute' => $cat_attribute,
                            'req_message' => '-',
                            'stuff' => '',
                            'hourly_rate' => (!empty($hours_data)) ? $hours_data : '',
                            'required_field_1' => (!empty($required_field_1)) ? $required_field_1 : '',
                            'required_field_2' => (!empty($required_field_2)) ? $required_field_2 : '',
                            'required_field_3' => '',
                            'stuff_1' => (!empty($stu_data)) ? $stu_data : '',
                            'staff_2' => (!empty($stu_data_1)) ? $stu_data_1 : '',
                            'staff_3' => ''
            );
            $data['cat_update'] = $this->common_model->update_entry('ai_category', $cat_edit, $by);
            if ($data['cat_update']) {
                $this->session->set_flashdata('succ', "Category has been Edit successfully.");
               redirect('ManageCategories');
            }
        } else {
            // echo "<pre>";
            // print_r($data);
            // die;
            $this->get_header('Manage Category');
            $this->load->view('admin/categories/edit_categories', $data);
            $this->load->view('admin/include/footer_other');
        }
    }
    public function delete_cat() {
        $user_id = $this->uri->segment(2);
        $where = array('cat_id' => $user_id);
        $delete_record = $this->common_model->DeleteRecordWhere('ai_category', $where);
        if ($delete_record) {
            $this->session->set_flashdata('succ', "Category has been delete successfully.");
            redirect('ManageCategories');
        }
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
