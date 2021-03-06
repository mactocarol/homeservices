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
        //print_r($data['plan_record']);exit;
        $this->get_header('Manage Banner');
        $this->load->view('admin/plan/manage_plan',$data);
        $this->load->view('admin/include/footer_other');
    }
	
	public function sendplans()
	{
		 $cplan=$this->input->post("cplan");
		 $email="surajpandagre2012@gmail.com";
		    $contact_temp_header = "";
            $contact_temp_user = "";
            $contact_temp_admin = "";
            $contact_temp_footer = "";
            $contact_temp_header .= new_mail_header(); //define in global helper
            $contact_temp_user .= '<table width="743"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f1f1f1">
				  <tr>
                    <td style="font-size: 13px; color: #959595; font-weight: normal; text-align: left;  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; line-height: 24px; vertical-align: top; padding:10px 30px 0px; border-radius:12px; -moz-border-radius:12px; -webkit-border-radius:12px; position:relative;" bgcolor="#f1f1f1">
                        
                        <table>
                            <tr>
                                <td valign="middle" style="text-decoration: none; color: rgb(39, 39, 39); font-family: Arial,sans-serif; padding: 14px 10px 16px 3px; font-size: 24px; font-weight:bold;">Dear <span style="color:#44a694">' . ucfirst($name) . '</span></td>
                            </tr>
                        </table>
                        
<div class="we-welcome" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;color:#333; line-height:19px; padding-bottom:10px; padding-top:5px; clear:both; width:100%;">
<h4>Custom Plan Details</h4>
<p>'.$cplan.'</p>';
            $contact_temp_footer.= new_mail_footer(); //define in global helper

            $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'priority' => '1'
            );
            $user_message =  $contact_temp_user;
            //echo $content;die;

            $this->email->initialize($config);
            $this->email->from('meghanaik50@gmail.com', '88 HOME PROS');
            $this->email->to($email);
            $this->email->subject("88 HOME PROS Thank You");
            $this->email->message($user_message);
            $this->email->send();


	}
    
    function add_plan() {
       
            $this->form_validation->set_rules('plan_title', 'Plan Title', 'trim|required');
            if($this->form_validation->run() == TRUE) {
               //print_r($_POST);exit;
               $plan_title = $this->input->post('plan_title');
               $plan_cat = $this->input->post('plan_cat');
//               $place = (!empty($_POST['place'])) ? $_POST['place'] : '';
//               $three_month = (!empty($_POST['three_month'])) ? $_POST['three_month'] : '';
//               $three_price = (!empty($_POST['three_price'])) ? $_POST['three_price'] : '';
//               $six_month = (!empty($_POST['six_month'])) ? $_POST['six_month'] : '';
//               $six_price = (!empty($_POST['six_price'])) ? $_POST['six_price'] : '';
//               $twale_month = (!empty($_POST['twale_month'])) ? $_POST['twale_month'] : '';
//               $twale_price = (!empty($_POST['twale_price'])) ? $_POST['twale_price'] : '';
               $extra = $this->input->post('extra');
               $extra_price = $this->input->post('extra_price');
//               $weekly = (!empty($_POST['weekly'])) ? $_POST['weekly'] : '';
//               $weekly_price = (!empty($_POST['weekly_price'])) ? $_POST['weekly_price'] : '';
//               $biweekly = (!empty($_POST['biweekly'])) ? $_POST['biweekly'] : '';
//               $biweekly_price = (!empty($_POST['biweekly_price'])) ? $_POST['biweekly_price'] : '';
               
               //$tte = json_encode($place);
               //print_r($tte);exit;
//               $feedataset = '0';
//               if($place !=''){
//               for ($fs = 0; $fs < count($place); $fs++) {
//                $feedata[] = array(
//                                    'place'=>$place[$fs], 
//                                    'three_month'=>$three_month[$fs],
//                                    'three_price'=>$three_price[$fs],
//                                    'six_month'=>$six_month[$fs],
//                                    'six_price'=>$six_price[$fs],
//                                    'twale_month'=>$twale_month[$fs],
//                                    'twale_price'=>$twale_price[$fs],
//                                    'weekly' => $weekly[$fs],
//                                    'weekly_price' => $weekly_price[$fs],
//                                    'biweekly' => $biweekly[$fs],
//                                    'biweekly_price' => $biweekly_price[$fs]
//                                );
//            }
//            $feedataset = json_encode($feedata);
//               }
            for ($fs_new = 0; $fs_new < count($extra); $fs_new++) {
                $feedata_new[] = array(
                                    'extra'=>$extra[$fs_new], 
                                    'extra_price'=>$extra_price[$fs_new]
                                );
            }
            $feedataset_new = json_encode($feedata_new);            
                $data_insert = array
                                    (
                                      'plan_title' => $plan_title,
                                      'plan_cat' => $plan_cat,
                                      'plan' => '',
                                      'weekly_price' => (!empty($_POST['weekly_price'])) ? $_POST['weekly_price']:'',
                                      'biweekly_price' => (!empty($_POST['biweekly_price'])) ? $_POST['biweekly_price']:'',
                                      'one_monthly_per' => (!empty($_POST['one_price'])) ? $_POST['one_price']:'',
                                      'three_monthly_per' => (!empty($_POST['three_price'])) ? $_POST['three_price']:'',
                                      'six_monthly_per' => (!empty($_POST['six_price'])) ? $_POST['six_price']:'',
                                      'yearly_per' => (!empty($_POST['twale_price'])) ? $_POST['twale_price']:'',
                                      'extra'=> $feedataset_new,
                                      'plan_date' => date('Y-m-d'),
                                      'plan_status' => 1
                                    );
                
                
                $insert = $this->common_model->insert_entry('ai_plan', $data_insert);
                
                if($insert){
                    $this->session->set_flashdata('succ', "plan has been Add successfully.");
                    redirect('ManagePlan');
                }
                
            }
            $active = 'active';
            $where = array('is_active' => $active);
            $field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id');
            $data['main_cat'] = $this->common_model->getAllwherenew('ai_category', $where, $field);
            //print_r($data['main_cat']);
            //echo $this->db->last_query();exit;
            $this->get_header('Add Plan');
            $this->load->view('admin/plan/add_planing',$data);
            $this->load->view('admin/include/footer_other'); 
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
    
    public function get_all()
    {
        $cat_id = decode_category($this->uri->segment(3));
        $sub_where = array('cat_name'=>$cat_id);
        $sub_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id','cat_desc','cat_attribute','req_message','stuff');
        $submain_cat = $this->common_model->getsingle('ai_category', $sub_where, $sub_field);
        //print_r($submain_cat);exit;
        if($submain_cat != 'no record found'){
        //echo $this->db->last_query();
        //print_r($submain_cat);exit;
         if($submain_cat->cat_attribute != ''){
        $get_fetch =  json_decode($submain_cat->cat_attribute);
        //print_r($get_fetch);exit;
        //exit;
        foreach ($get_fetch as $field){
            if($field->professionals != ''){
            //echo $field->professionals;exit;
            $html ='<header class="panel-heading">Frequency</header><br/>
                    <div class="row">
                    <div class="col-sm-4">
                      <label class="control-label">Place</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="place[]" value="'.$field->professionals.'"/>
                      </div>
                    </div>
                    
                    <div class="col-sm-3">
                      <label class="control-label">Weekly</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="weekly[]" readonly="readonly" value="Weekly"/>
                      </div>
                    </div>
                    
                    <div class="col-sm-1">
                      <label class="control-label">Price</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="weekly_price[]"/>
                      </div>
                    </div>
                    
                    <div class="col-sm-3">
                      <label class="control-label">Biweekly</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="biweekly[]" readonly="readonly" value="Biweekly"/>
                      </div>
                    </div>
                    
                    <div class="col-sm-1">
                      <label class="control-label">Price</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="biweekly_price[]"/>
                      </div>
                    </div>
                    
                    </div>
               ';
            echo $html;
            }
        }
        
        //print_r($submain_cat);exit;
         }
        }
    }
    function edit_plan(){

      $iid =  $this->uri->segment(2);

        $this->form_validation->set_rules('plan_title', 'Plan Title', 'trim|required');
            if($this->form_validation->run() == TRUE) {
               //print_r($_POST);exit;
               $plan_title = $this->input->post('plan_title');
               $plan_cat = $this->input->post('plan_cat');
//               $place = (!empty($_POST['place'])) ? $_POST['place'] : '';
//               $one_price = (!empty($_POST['one_price'])) ? $_POST['one_price'] : '';
//               $three_price = (!empty($_POST['three_price'])) ? $_POST['three_price'] : '';
//               $six_price = (!empty($_POST['six_price'])) ? $_POST['six_price'] : '';
//               $twale_price = (!empty($_POST['twale_price'])) ? $_POST['twale_price'] : '';
               $extra = $this->input->post('extra');
               $extra_price = $this->input->post('extra_price');
//               $weekly_price = (!empty($_POST['weekly_price'])) ? $_POST['weekly_price'] : '';
//               $biweekly_price = (!empty($_POST['biweekly_price'])) ? $_POST['biweekly_price'] : '';
               
               //$tte = json_encode($place);
               //print_r($tte);exit;
               
            for ($fs_new = 0; $fs_new < count($extra); $fs_new++) {
                $feedata_new[] = array(
                                    'extra'=>$extra[$fs_new], 
                                    'extra_price'=>$extra_price[$fs_new]
                                );
            }
            $feedataset_new = json_encode($feedata_new);            
                $data_insert = array
                                    (
                                      'plan_title' => $plan_title,
                                      'plan_cat' => $plan_cat,
                                      'plan' => '',
                                      'weekly_price' => (!empty($_POST['weekly_price'])) ? $_POST['weekly_price']:'',
                                      'biweekly_price' => (!empty($_POST['biweekly_price'])) ? $_POST['biweekly_price']:'',
                                      'one_monthly_per' => (!empty($_POST['one_price'])) ? $_POST['one_price']:'',
                                      'three_monthly_per' => (!empty($_POST['three_price'])) ? $_POST['three_price']:'',
                                      'six_monthly_per' => (!empty($_POST['six_price'])) ? $_POST['six_price']:'',
                                      'yearly_per' => (!empty($_POST['twale_price'])) ? $_POST['twale_price']:'',
                                      'extra'=> $feedataset_new,
                                      'plan_date' => date('Y-m-d'),
                                      'plan_status' => 1
                                    );
                
                $where = array('plan_id'=>$iid);
                $update_data = $this->common_model->update_entry('ai_plan', $data_insert, $where);
                
                if($update_data){
                    $this->session->set_flashdata('succ', "Plan has been Update Successfully.");
                    redirect('ManagePlan');
                }
            }
        
        else{
            $plant_id = $this->uri->segment(2);
           $where_plan = array('plan_id'=>$plant_id);
           $field_plan = array('plan_id','plan_title','plan_cat','plan','weekly_price','biweekly_price','one_monthly_per','three_monthly_per','six_monthly_per','yearly_per','extra','plan_date','plan_status');
          $data['get_plan'] = $this->common_model->getsingle('ai_plan',$where_plan,$field_plan);

            $active = 'active';
            $where = array('is_active' => $active);
            $field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id');
            $data['main_cat'] = $this->common_model->getAllwherenew('ai_category', $where, $field);
      
            $this->get_header('Edit Plan');
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
