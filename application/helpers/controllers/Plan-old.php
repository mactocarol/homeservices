<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Plan extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('page_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
    }

    //show list of all plans.
    public function index() {
//        //$this->check_admin_login();
        $data['plan_record'] = $this->common_model->getAllwherenew('ai_plan', array('plan_status' => 1), '*');
       // print_r($data['plan_record']);exit;
        $this->get_header('Manage Banner');
        $this->load->view('admin/plan/manage_plan',$data);
        $this->load->view('admin/include/footer_other');
    }
   function add_plan() {
       
        if($_POST){
     //print_r($_POST);exit;
//            // for THREE month
            $thired_hours = $_POST['per_hours_fst'];
            $thired_price = $_POST['per_price_fst'];
            $thired_orgpri = $_POST['original_price_fst'];
            $thired_dispri = $_POST['discount_price_fst'];
            $fst_array[] = array('per_hours'=>$thired_hours,
                            'per_price'=>$thired_price,
                            'original_price'=>$thired_orgpri,
                            'discount_price'=>$thired_dispri);
           
            // for THREE month(bathroom)
            $thired_bathhours = $_POST['bath_hours_fst'];
            $thired_bathprice = $_POST['price_bath_fst'];
            $thired_batoripri = $_POST['bath_org_price_fst'];
            $thired_batdisprice = $_POST['bath_dis_price_fst'];
            $fst_bath_arr[] = array('bath_hours'=>$thired_bathhours,
                            'price_bath'=>$thired_bathprice,
                            'bath_original_price'=>$thired_batoripri,
                            'bath_discount_price'=>$thired_batdisprice);
             // for SIX month
            $six_hours = $_POST['per_hours_six'];
            $six_price = $_POST['per_price_six'];
            $six_orgpri = $_POST['original_price_six'];
            $six_dispri = $_POST['discount_price_six'];
            $secnd_array[] = array('per_hours'=>$six_hours,
                            'per_price'=>$six_price,
                            'original_price'=>$six_orgpri,
                            'discount_price'=>$six_dispri);
           
            // for SIX month(bathroom)
            $six_bathhours = $_POST['bath_hours_six'];
            $six_bathprice = $_POST['price_bath_six'];
            $six_batoripri = $_POST['bath_ori_price_six'];
            $six_batdisprice = $_POST['bath_dis_price_six'];
            $six_bath_arr[] = array('bath_hours'=>$six_bathhours,
                            'price_bath'=>$six_bathprice,
                            'bath_original_price'=>$six_batoripri,
                            'bath_discount_price'=>$six_batdisprice);
      
              // for TWELEVE month
            $tweleve_hours = $_POST['per_hours_tweleve'];
            $tweleve_price = $_POST['per_price_tweleve'];
            $tweleve_orgpri = $_POST['original_price_tweleve'];
            $tweleve_dispri = $_POST['discount_price_tweleve'];
            $third_array[] = array('per_hours'=>$tweleve_hours,
                            'per_price'=>$tweleve_price,
                            'original_price'=>$tweleve_orgpri,
                            'discount_price'=>$tweleve_dispri);
           
            // for TWELEVE month(bathroom)
            $tweleve_bathhours = $_POST['bath_hours_tweleve'];
            $tweleve_bathprice = $_POST['price_bath_tweleve'];
            $tweleve_batoripri = $_POST['bath_ori_price_tweleve'];
            $tweleve_batdisprice = $_POST['bath_dis_price_tweleve'];
            $tweleve_bath_arr[] = array('bath_hours'=>$tweleve_bathhours,
                            'price_bath'=>$tweleve_bathprice,
                            'bath_original_price'=>$tweleve_batoripri,
                            'bath_discount_price'=>$tweleve_batdisprice);
          
            $plan_for = $this->input->post('plan_for');
            $fst_enc_plan = json_encode($fst_array);
            $fst_bath_enc = json_encode($fst_bath_arr);
            $secnd_enc_plan = json_encode($secnd_array);
            $secnd_bath_enc = json_encode($six_bath_arr);
            $thired_enc_plan = json_encode($third_array);
            $thired_bath_enc = json_encode($tweleve_bath_arr);
            if($plan_for == 1){
            $fir =   $fst_enc_plan;
            $plan_title = $this->input->post('plan_title');
            $plan_cat = $this->input->post('plan_cat');
            $plan_status = $this->input->post('plan_status');
            $plan_for = $this->input->post('plan_for');
            $data = array('plan_title' => $plan_title,
            'plan_cat' => $plan_cat,
            'plan_status'=>$plan_status,
            'plan_for'=>$plan_for,   
            'plan_three_month'=>$fir,
            'plan_six_month'=>$secnd_enc_plan,
            'plan_twevele_month'=>$thired_enc_plan,
            'Plan_date'=> date('Y-m-d'));
            $manage_plan = $this->common_model->insert_entry('ai_plan', $data);
            }else{
            $plan_title = $this->input->post('plan_title');
            $plan_cat = $this->input->post('plan_cat');
            $plan_status = $this->input->post('plan_status');
            $plan_for = $this->input->post('plan_for');
            $data = array('plan_title' => $plan_title,
            'plan_cat' => $plan_cat,
            'plan_status'=>$plan_status,
            'plan_for'=>$plan_for,   
            'plan_three_month'=>$fst_bath_enc,
            'plan_six_month'=>$secnd_bath_enc,
            'plan_twevele_month'=>$thired_bath_enc,
            'Plan_date'=> date('Y-m-d'));
            //print_r($data);exit;
             $manage_plan = $this->common_model->insert_entry('ai_plan', $data);
            }
            if ($manage_plan) {
            $this->session->set_flashdata('succ', "Plan has been Add successfully. ");
            redirect('ManagePlan');
            }         
        } else {
//            $where = array('cat_parent_id' => 0);
//            $field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id');
//            $data['main_cat'] = $this->common_model->getAllwherenew('ai_category', $where, $field);
            $this->get_header('Add Banner');
            $this->load->view('admin/plan/add_planing');
            $this->load->view('admin/include/footer_other');
        }
    }
    
    public function getsubcat() {
        $cat_id = $this->uri->segment(3);
        $sub_where = array('cat_parent_id'=>$cat_id);
        $sub_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id');
        $submain_cat = $this->common_model->getAllwherenew('ai_category', $sub_where, $sub_field);
        //print($submain_cat);exit;
        $html = '';
        foreach ($submain_cat as $row) {
            $catname = $row->cat_name;
           // print_r($catname);
            $catid = $row->cat_id;
            $html .= "<option value ='".$catname."'>$catname</option>";
        }
        echo $html;
    }
    function edit_plan(){
        if($_POST){
            
        }
        else{
            $plant_id = $this->uri->segment(2);
           $where_plan = array('plan_id'=>$plant_id);
           $field_plan = array('plan_id','plan_title','plan_cat','plan_for','plan_three_month','plan_six_month','plan_twevele_month','plan_date','plan_status');
           $data['get_plan'] = $this->common_model->getsingle('ai_plan',$where_plan,$field_plan);
             
            $this->get_header('Add Banner');
            $this->load->view('admin/plan/edit_plan',$data);
            $this->load->view('admin/include/footer_other');
        }
          }
    function delete_plan() {
        $b_id = $this->uri->segment(2);
        $where = array('plan_id' => $b_id);
        $delete_record = $this->common_model->DeleteRecordWhere('ai_plan', $where);
        if ($delete_record) {
            $this->session->set_flashdata('succ', "plan has been Delete successfully.");
            redirect('ManagePlan');
        }
    }
}
