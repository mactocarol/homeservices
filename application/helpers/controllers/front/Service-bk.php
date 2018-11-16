<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Service extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
        $this->load->library('myclass');
    }
    public function index() {
        $service_id = '';
        $cat_name = decode_category($this->uri->segment(2));
        //print_r($cat_name);exit;
        //set where for fetch data of selected category 
        $where_category_selection = array(
            'cat_name' => $cat_name,
            'is_active' => 'active'
        );
        $select_category_column = 'cat_id,cat_name,cat_picture,cat_desc';
        $data['category_data'] = $this->common_model->get_entry_by_data("category", true, $where_category_selection, $select_category_column);
        //print_r($data['category_data']);exit;
        $service_id = $data['category_data']['cat_id'];
        if (!empty($service_id)) {
            $active = 'active';
            $select_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id', 'cat_desc', 'meta_title', 'meta_desc');
            $where_field = array('cat_parent_id' => $service_id, 'is_active' => $active);
            $data['child_record'] = $this->common_model->getAllwherenew('category', $where_field, $select_field);
        }
        $this->get_front_header('Service');
        $this->load->view('front/services/services',$data);
        $this->load->view('front/include/footer');
    }
    /* Single Service Controller  */
    public function single_service() {
        $this->form_validation->set_rules('code', 'Post Code', 'trim|required');
        $getname = decode_category($this->uri->segment(3));
          $catname = encode_category($this->uri->segment(3));
        $cat_name = $this->uri->segment(2);
       if($cat_name == 'Real-Estate'){
           redirect(base_url() . 'RealState'.'/' .$catname);
       }
       elseif($cat_name == 'Home-Improvement'){
           redirect(base_url() . 'Improvment'.'/' .$catname);
       }
        $active = 'active';
        $select_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id', 'cat_desc', 'meta_title', 'meta_desc');
        $where_field = array('cat_name' =>$getname, 'is_active' =>$active);
        $data['get_single_record'] = $this->common_model->getAllwherenew('category', $where_field, $select_field);
        if ($this->form_validation->run() == TRUE) {
            $post_code = $this->input->post('code');
            $gat_parent_cat = $this->uri->segment(2);
            $gat_cat = $this->uri->segment(3);
            $by = array('zip_code' =>$post_code);
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
            }
       else {
                $msg = 'Your Postcode is NOT Matched';
                $this->_set_msg($msg, 'red');
            }
        }
        $this->get_front_header('Single Service');
        $this->load->view('front/services/single_service', $data);
        $this->load->view('front/include/footer');
        }
    // for home improvment
    public function home_improvement(){
        $getname = decode_category($this->uri->segment(2));
        if($_POST){
           
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $cntact_number = $this->input->post('mnumber');
            $replacement = $this->input->post('company');
            $discrption = $this->input->post('comment');
            $date = date('Y-m-d');
            $post_data = array(
                'cat_name'=>$getname,
                'name' => $name,
                'email' => $email,
                'phone_number' => $cntact_number,
                'replacement' => $replacement,
                'project_disc' => $discrption,
                'date' => $date
            );
           $get_service = $this->common_model->insert_entry('ai_homeimprovment', $post_data);
           if($get_service){
               $msg = 'Your Information Submit Successfully..';
               $this->_set_msg($msg, 'green');
               redirect(base_url().'Improvment/'.$this->uri->segment(2));
        }
        }
        else{
        $active = 'active';
        $select_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id', 'cat_desc', 'meta_title', 'meta_desc');
        $where_field = array('cat_name' =>$getname, 'is_active' =>$active);
        //$data['get_record'] = $this->common_model->getAllwherenew('category', $where_field, $select_field);
        $data['get_record'] = $this->common_model->getsingle('category',$where_field,$select_field);
        //print_r($data['get_record']);exit;
        $this->get_front_header('Single Service');
        $this->load->view('front/services/home_improment',$data);
        $this->load->view('front/include/footer');
    }
    }
    public function check_price() {
        $cat_name_new = decode_category($this->uri->segment(3));
        //$catzip = $this->uri->segment(4);
        $sub_cat = encode_category($cat_name_new);
        $parent_cat = $this->uri->segment(2);
        if($cat_name_new == 'Pressure Washing'){
            redirect(base_url() . 'Quotes/' . $parent_cat . "/" . $sub_cat);
        }
		
		if($cat_name_new == 'Sofa Drapery Cleaning'){
            redirect(base_url() . 'Quote/' . $parent_cat . "/" . $sub_cat);
        }
         if($parent_cat != 'Cleaning'){
            redirect(base_url() . 'Plan/' . $parent_cat . "/" . $sub_cat);
        }
        
        $this->form_validation->set_rules('zipcode', 'Post Code', 'trim|required');
        $this->form_validation->set_rules('emailid', 'Email', 'trim|required');
        $this->form_validation->set_rules('on_date', 'Date', 'trim|required');
        //$this->form_validation->set_rules('qty', 'Qty', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            //print_r($_POST);exit;
            $cat = trim($this->input->post('cat'));
            $zipcode = trim($this->input->post('zipcode'));
            $helpers = trim($this->input->post('helpers'));
            $job_desc = trim($this->input->post('job_desc'));
            $on_date = trim($this->input->post('on_date'));
            $on_time = trim($this->input->post('on_time'));
            $emailid = trim($this->input->post('emailid'));
            
            $plans_first = trim($this->input->post('plans_first'));
            $plans_second = trim($this->input->post('plans_second'));
            $plans_third = trim($this->input->post('plans_third'));
            
            $first_qty = trim($this->input->post('qty'));
            $mediumqty = trim($this->input->post('mediumqty'));
            $largeqty = trim($this->input->post('largeqty'));
            if(!empty($first_qty)){
                $qty_1 = $first_qty;
            }else{
                $qty_1 = '-';
            }
            if(!empty($mediumqty)){
                $qty_2 = $mediumqty;
            }else{
                $qty_2 = '-';
            }
            
            if(!empty($largeqty)){
                $qty_3 = $largeqty;
            }else{
                $qty_3 = '-';
            }
            
            if(!empty($plans_first)){
                $plan_1 = $plans_first;
            }else{
                $plan_1 = '-';
            }
            
            if(!empty($plans_second)){
                $plan_2 = $plans_second;
            }else{
                $plan_2 = '-';
            }
            
            if(!empty($plans_third)){
                $plan_3 = $plans_third;
            }else{
                $plan_3 = '-';
            }
            
            $where_field = array('emailid' => $emailid,'cat_id' => $cat);
            $data['getalreayexit'] = $this->common_model->getsingle('ai_appointment_booking', $where_field,  array('cat_id','emailid'));
            //print_r($data['getalreayexit']);exit;
            
            $insert_data = array(
                                'cat_id' => $cat,
                                'zipcode' => $zipcode,
                                'plan_hr_badroom' => $plan_1,
                                'plan_hr_bathroom' => $plan_2,
                                'livingroom' => $plan_3,
                                'plan_book' => '',
                                'plan_book_mnth' => '',
                                'helper' => $helpers,
                                'hour_prc' => (!empty($_POST['hour_prc'])) ? $_POST['hour_prc'] : '00',
                                'job_desc' => $job_desc,
                                'first_item' => $qty_1,
                                'second_item' => $qty_2,
                                'thired_item' => $qty_3,
                                'select_date' => date('Y-m-d',strtotime($on_date)),
                                'select_time' => $on_time,
                                'emailid' => $emailid,
                                'first_name' => '',
                                'last_name' => '',
                                'address' => '',
                                'flat' => '',
                                'city' => '',
                                'country' => '',
                                'phone_code' => '',
                                'phone_no' => '',
                                'promo_code' => '',
                                'booking_date' => date('Y-m-d'),
                                'status' => '0'
                                ); 
                        $newdata = array(
                            'emailid' => $emailid
                            );
           $this->session->set_userdata($newdata);
            
           if($data['getalreayexit'] != 'no record found'){
               $updated_data = $this->common_model->UpdateRecords('ai_appointment_booking',$insert_data, $where_field);
               if($updated_data){
               redirect(base_url().'finalize/'.$cat);
           }
           }else{
           $inserted_data =  $this->common_model->insert_entry('ai_appointment_booking', $insert_data);
           if($inserted_data){
               redirect(base_url().'finalize/'.$cat);
           }
           }
        }
        
        $zipcode = $this->session->userdata('zipcode');
        if($zipcode != ''){
        $gotted_parent_cat = decode_category($this->uri->segment(2));
        $gotted_cat = decode_category($this->uri->segment(3));
        $got_post_code = ci_dec($this->uri->segment(4));
        $where = array('zip_code' => $got_post_code);
        $post_field = array('zip_code');
        $data['single_product_price'] = $this->common_model->getAllwherenew('locations', $where, $post_field);
        $where_cat = array('cat_name' => $gotted_cat);
        $field_cate = array('cat_name', 'cat_desc','cat_parent_id','cat_attribute','req_message','stuff','hourly_rate','required_field_1','stuff_1','required_field_2','staff_2');
        $data['single_cate'] = $this->common_model->getAllwherenew('ai_category', $where_cat, $field_cate);
        $where_parnt_cat = array('cat_name' =>$gotted_parent_cat);
        $field_parnt_cate = array('cat_picture');
        $data['single_parnt_img'] = $this->common_model->getAllwherenew('ai_category', $where_parnt_cat, $field_parnt_cate);
       // echo $this->db->last_query();
        $where_items = array('cat_name' => $gotted_cat);
        $field_items = array('cat_attribute', 'req_message', 'stuff', 'cat_name', 'cat_id', 'cat_parent_id','hourly_rate','required_field_1','stuff_1','required_field_2','staff_2');
        $data['single_items_record'] = $this->common_model->getAllwherenew('ai_category', $where_items, $field_items);
        
        $this->get_front_header('Single Service');
        $this->load->view('front/services/get_price_bk', $data);
        $this->load->view('front/include/footer');  
        }
        else{
        }
     }
     
     public function pressure_washing()
     {
        $cat_name_new = decode_category($this->uri->segment(3));
        
        if($_POST){
        $arr_pressure_washing = array(
                                   'user_id' => '',
                                   'cat_name'=>$cat_name_new,
                                   'fullname'=>$this->input->post('fname'),
                                   'email'=>$this->input->post('email'),
                                   'phone'=>$this->input->post('mnumber'),
                                   'desc'=>$this->input->post('comment'),
								   'address' => '-',
                                   'status'=>'0',
                                   'date_added'=>date('Y-m-d')
                            );
           $insert_info = $this->common_model->insert_entry('ai_pressure_washing', $arr_pressure_washing);
           if($insert_info){
           $msg = 'Your Record Submit Successfully..';
           $this->_set_msg($msg, 'green');
           redirect(base_url().'Quotes/Cleaning/Pressure-Washing');
           }
           }
        $where_cat = array('cat_name' => $cat_name_new);
        $field_cate = array('cat_name', 'cat_desc','cat_parent_id','cat_picture','cat_attribute','req_message','stuff','hourly_rate','required_field_1','stuff_1','required_field_2','staff_2');
        $data['single_cate'] = $this->common_model->getAllwherenew('ai_category', $where_cat, $field_cate);
        
        $this->get_front_header('Pressure Washing');
        $this->load->view('front/services/pressure_washing',$data);
        $this->load->view('front/include/footer'); 
         
     }
	 
	 public function sofa_cleaning()
     {
        $cat_name_new = decode_category($this->uri->segment(3));
        
        if($_POST){
        $arr_pressure_washing = array(
                                   'user_id' => '',
                                   'cat_name'=>$cat_name_new,
                                   'fullname'=>$this->input->post('fname'),
                                   'email'=>$this->input->post('email'),
                                   'phone'=>$this->input->post('mnumber'),
                                   'desc'=>$this->input->post('comment'),
								   'address' => $this->input->post('address'),
                                   'status'=>'0',
                                   'date_added'=>date('Y-m-d')
                            );
           $insert_info = $this->common_model->insert_entry('ai_pressure_washing', $arr_pressure_washing);
           if($insert_info){
           $msg = 'Your Record Submit Successfully..';
           $this->_set_msg($msg, 'green');
           redirect(base_url().'Quote/Cleaning/Sofa-Drapery-Cleaning');
           }
           }
        $where_cat = array('cat_name' => $cat_name_new);
        $field_cate = array('cat_name', 'cat_desc','cat_parent_id','cat_picture','cat_attribute','req_message','stuff','hourly_rate','required_field_1','stuff_1','required_field_2','staff_2');
        $data['single_cate'] = $this->common_model->getAllwherenew('ai_category', $where_cat, $field_cate);
        
        $this->get_front_header('Sofa Drapery Cleaning');
        $this->load->view('front/services/sofa_cleaning',$data);
        $this->load->view('front/include/footer'); 
         
     }


     public function real_state(){
        if($_POST){
            $sub_catname = decode_category($this->uri->segment(2));
            $currntdate = date('Y-m-d');
            $f_name = $this->input->post('fname');
            $l_name= $this->input->post('lname');
            $emailid = $this->input->post('email');
            $cnumber = $this->input->post('mnumber');
            $comment = $this->input->post('comment');
            $compny = $this->input->post('company');
            $arr_realstate = array('cat_name'=>$sub_catname,
                                   'fname'=>$f_name,
                                   'lname'=>$l_name,
                                   'email'=>$emailid,
                                   'mnumber'=>$cnumber,
                                   'comment'=>$comment,
                                   'company'=>$compny,
                                   'date'=>$currntdate);
           $insert_info = $this->common_model->insert_entry('ai_real_state_info', $arr_realstate);
           if($insert_info){
           $msg = 'Your Information Submit Successfully..';
           $this->_set_msg($msg, 'green');
           redirect(base_url().'RealState/'.$this->uri->segment(2));
           }
           
        }
        else{
        $par_cat = decode_category($this->uri->segment(2));
//        $sub_cat = decode_category($this->uri->segment(3));
        $where_cat = array('cat_name' =>$par_cat);
        $field_parnt_cate = array('cat_picture');
        $data['single_parnt_img'] = $this->common_model->getAllwherenew('ai_category', $where_cat, $field_parnt_cate); 
        // for sub cat........
        $where_cat = array('cat_name' => $par_cat);
        $field_cate = array('cat_name', 'cat_desc');
        $data['single_cate'] = $this->common_model->getAllwherenew('ai_category', $where_cat, $field_cate);
        $this->get_front_header('Single Service');
        $this->load->view('front/services/real_state_contact', $data);
        $this->load->view('front/include/footer');     
        }
       
    }
    public function booking(){
        $subcate_name = $this->uri->segment(2);
      if ($subcate_name == 'Cleaning'){
          redirect(base_url(). 'GeneralBooking');
      }
        if($_POST){
             $id = $this->session->userdata('id'); 
            $biweekly_plan = $this->input->post('weekly');
            $weekly_plan = $this->input->post('Biweekly');
            $plan_three = $this->input->post('three_mnth');
            $plan_six = $this->input->post('six_mnth');
            $plan_tweleve = $this->input->post('tweleve_mnth');
            $f_name = $this->input->post('fname');
            $l_name = $this->input->post('lname');
            $address = $this->input->post('address');
            $flat_add = $this->input->post('flat_add');
            $city = $this->input->post('city');
            $country = $this->input->post('country');
            $phnnumber = $this->input->post('phonenumber');
            $code = $this->input->post('code');
            $where_book = array('id'=>$id);
            $book_fields = array('first_name'=>$f_name,
                                 'last_name'=>$l_name,
                                 'address'=>$address,
                                 'flat'=>$flat_add,
                                 'city'=>$city,
                                 'country'=>$country,
                                 'phone_no'=>$phnnumber,
                                 'promo_code'=>$code);
         
           $booking_plan = $this->common_model->UpdateRecords('ai_appointment_booking',$book_fields, $where_book);
      
         }
        else
        {
        $iiid = $this->session->userdata('id'); 
        $cat_name =$this->session->userdata('child_cat');
        $catname = decode_category($this->session->userdata('child_cat'));
             /************** for badroom **************/
        $where_plan = array('plan_cat'=>$catname ,'plan_for'=>1);
       $field_plan = array('plan_id','plan_title','plan_cat','plan_three_month','plan_six_month','plan_twevele_month','plan_date','plan_status');
        $data['get_plan'] = $this->common_model->getsingle('ai_plan',$where_plan,$field_plan);
        /*********** for bathroom**************/
       $where_bathplan = array('plan_cat'=>$catname ,'plan_for'=>2);
        $field_bathplan = array('plan_id','plan_title','plan_cat','plan_three_month','plan_six_month','plan_twevele_month','plan_date','plan_status');
        $data['bath_plan'] = $this->common_model->getsingle('ai_plan',$where_bathplan,$field_bathplan);
        $where_booking = array('cat_id'=>$cat_name ,'id'=>$iiid);
        $field_booking = array('plan_hr_badroom','plan_hr_bathroom','cat_id','plan_hr_badroom','plan_hr_bathroom','plan_book','plan_book_mnth','select_date',
                                'select_time','emailid');
        $data['get_booking'] = $this->common_model->getsingle('ai_appointment_booking',$where_booking,$field_booking);
        // for fetching country and city
        $zipcode = $this->session->userdata('zipcode');
        $where = array('zip_code' =>$zipcode);
        $city_country = array('country','city');
        $data['country_city'] = $this->common_model->getsingle('ai_locations', $where, $city_country); 
        $this->get_front_header('Single Service');
        $this->load->view('front/services/booking_form',$data);
        $this->load->view('front/include/footer');
    }
}
    public function booking_terms(){
        $this->get_front_header('Single Service');
        $this->load->view('front/services/booking_terms');
        $this->load->view('front/include/footer');
    }
    public function booking_plan(){
        $id = $this->session->userdata('id');
        $weekly_plan = $this->uri->segment(2);
        $biweekly_plan = $this->uri->segment(3);
        $three_mnth = $this->uri->segment(4);
        $six_mnth = $this->uri->segment(5);
        $tweleve_mnth = $this->uri->segment(6);
        if($weekly_plan !='' && $biweekly_plan == '-'){
        $where_plan = array('id'=>$id);
        $weekly_field = array('plan_book'=>$weekly_plan);
        $weekly = $this->common_model->UpdateRecords('ai_appointment_booking',$weekly_field, $where_plan); 
        echo 1;
        }
        // for biweekly
            if($weekly_plan =='-' && $biweekly_plan != ''){
        $where_plan_bi = array('id'=>$id);
        $weekly_field_bi = array('plan_book'=>$biweekly_plan);
        $biweekly = $this->common_model->UpdateRecords('ai_appointment_booking',$weekly_field_bi, $where_plan_bi); 
        echo 2;
        }
        if($three_mnth !=''){
           $where_mnth_plan = array('id'=>$id);
            $field_mnth_plan = array('plan_book_mnth'=>$three_mnth);
            $biweekly = $this->common_model->UpdateRecords('ai_appointment_booking',$field_mnth_plan, $where_mnth_plan); 
        }
      }
    public function book_plan_mnth(){
       $id = $this->session->userdata('id');
        $three_mnth = $this->uri->segment(2);
        $six_mnth = $this->uri->segment(3);
        $tweleve_mnth = $this->uri->segment(4);
        if ($three_mnth != '' && $six_mnth == '-' && $tweleve_mnth == '-') {
            $where_three_plan = array('id' => $id);
            $field_three_plan = array('plan_book_mnth' => $three_mnth);
            $this->common_model->UpdateRecords('ai_appointment_booking', $field_three_plan, $where_three_plan);
            echo 4;
        }
        if ($three_mnth == '-' && $six_mnth != '' && $tweleve_mnth == '-') {
            $where_six_plan = array('id' => $id);
            $field_six_plan = array('plan_book_mnth' => $six_mnth);
            $this->common_model->UpdateRecords('ai_appointment_booking', $field_six_plan, $where_six_plan);
            echo 5;
        }
        if ($three_mnth == '-' && $six_mnth == '-' && $tweleve_mnth != '') {
            $where_tweleve_plan = array('id' => $id);
            $field_tweleve_plan = array('plan_book_mnth' => $tweleve_mnth);
            $this->common_model->UpdateRecords('ai_appointment_booking', $field_tweleve_plan, $where_tweleve_plan);
            echo 6;
        }
    }
    public function unit_price() {
        $method_uri = $this->uri->segment(1);
        $cat_name = decode_category($this->uri->segment(2));
        $where_price = array('cat_name' =>$cat_name);
        $field_price = array('cat_attribute');
        $data['product_unit'] = $this->common_model->getAllwherenew('ai_category', $where_price, $field_price);
        // get fixed unit price...
         if ($data['product_unit'] != 'no') {
            $units = $data['product_unit'][0]->cat_attribute;
            $units_decode = json_decode($units);
//            print_r($units_decode);exit;
            $first_unit_hours = $units_decode[0]->hours;
            $second_unit_hours = $units_decode[1]->hours;
            $thired_unit_hours = $units_decode[2]->hours;
            $first_unit_price = $units_decode[0]->price;
            $second_unit_price = $units_decode[1]->price;
            $thired_unit_price = $units_decode[2]->price;
            // get input value
        $first_inputval = $this->uri->segment(3);
        $second_inputval = $this->uri->segment(5);
        $third_inputval = $this->uri->segment(4);
        // multiplication of unit & input value  for hours...
       $first_result = $first_inputval * $first_unit_hours;
       $second_result = $second_inputval * $second_unit_hours;
       $thired_result = $third_inputval * $thired_unit_hours;
        // multiplication of unit & input value  for price...
        $first_result_p = $first_inputval * $first_unit_price;
        $second_result_p = $second_inputval * $second_unit_price;
        $thired_result_p = $third_inputval * $thired_unit_price;
            if($first_result !=''){
           echo $first_result.'Hours'.'/'.$first_result_p.'Price';
       }
         if($second_result !=''){
           echo $second_result.'Hours'.'-'.$second_result_p.'Price';
       }
        if($thired_result !=''){
           echo $thired_result.'Hours'.'-'.$thired_result_p.'Price';
       }
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
    
    public function without_plan(){
        
        $this->form_validation->set_rules('zipcode', 'Post Code', 'trim|required');
        $this->form_validation->set_rules('emailid', 'Email', 'trim|required');
        $this->form_validation->set_rules('on_date', 'Date', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            
            //print_r($_POST);exit;
            
            $cat = trim($this->input->post('cat'));
            $zipcode = (!empty($_POST['zipcode'])) ? $_POST['zipcode'] : '';
            $helpers = (!empty($_POST['helpers'])) ? $_POST['helpers'] : '';
            $job_desc = (!empty($_POST['job_desc'])) ? $_POST['job_desc'] : '';
            $on_date = (!empty($_POST['on_date'])) ? $_POST['on_date'] : date('Y-m-d');
            $on_time = (!empty($_POST['on_time'])) ? $_POST['on_time'] : '00:00';
            $emailid = (!empty($_POST['emailid'])) ? $_POST['emailid'] : '';
            
            $plans_first = (!empty($_POST['plans_first'])) ? $_POST['plans_first'] : '';
            $plans_second = (!empty($_POST['plans_second'])) ? $_POST['plans_second'] : '';
            $plans_third = (!empty($_POST['plans_third'])) ? $_POST['plans_third'] : '';
            
            $first_qty = (!empty($_POST['qty'])) ? $_POST['qty'] : '0';
            $mediumqty = (!empty($_POST['mediumqty'])) ? $_POST['mediumqty'] : '0';
            $largeqty = (!empty($_POST['largeqty'])) ? $_POST['largeqty'] : '0';
            
            $hourly = (!empty($_POST['hourly'])) ? $_POST['hourly'] : '';
            
            $first_stuff = (!empty($_POST['first_stuff'])) ? $_POST['first_stuff'] : '';
            
            $second_stuff = (!empty($_POST['second_stuff'])) ? $_POST['second_stuff'] : '';
            
            if(!empty($first_qty)){
                $qty_1 = $first_qty;
            }else{
                $qty_1 = '-';
            }
            if(!empty($mediumqty)){
                $qty_2 = $mediumqty;
            }else{
                $qty_2 = '-';
            }
            
            if(!empty($largeqty)){
                $qty_3 = $largeqty;
            }else{
                $qty_3 = '-';
            }
            
            if(!empty($plans_first)){
                $plan_1 = $plans_first;
            }else{
                $plan_1 = '-';
            }
            
            if(!empty($plans_second)){
                $plan_2 = $plans_second;
            }else{
                $plan_2 = '-';
            }
            
            if(!empty($plans_third)){
                $plan_3 = $plans_third;
            }else{
                $plan_3 = '-';
            }
            
            $where_field = array('emailid' => $emailid,'cat_id' => $cat);
            $data['getalreayexit'] = $this->common_model->getsingle('ai_appointment_booking', $where_field,  array('cat_id','emailid'));
            
            $insert_data = array(
                                'cat_id' => $cat,
                                'zipcode' => $zipcode,
                                'plan_hr_badroom' => $plan_1,
                                'plan_hr_bathroom' => $plan_2,
                                'livingroom' => $plan_3,
                                'plan_book' => '',
                                'plan_book_mnth' => '',
                                'helper' => $helpers,
                                'hourly' => $hourly,
                                'hour_prc' => (!empty($_POST['hour_prc'])) ? $_POST['hour_prc'] : '00',
                                'first_stuff' => $first_stuff,
                                'second_stuff' => $second_stuff,
                                'job_desc' => $job_desc,
                                'first_item' => $qty_1,
                                'second_item' => $qty_2,
                                'thired_item' => $qty_3,
                                'select_date' => date('Y-m-d',strtotime($on_date)),
                                'select_time' => $on_time,
                                'emailid' => $emailid,
                                'first_name' => '',
                                'last_name' => '',
                                'address' => '',
                                'flat' => '',
                                'city' => '',
                                'country' => '',
                                'phone_code' => '',
                                'phone_no' => '',
                                'promo_code' => '',
                                'booking_date' => date('Y-m-d'),
                                'status' => '0'
                                );
            
            $newdata = array(
                            'emailid' => $emailid
                            );
           $this->session->set_userdata($newdata);
            
            
           if($data['getalreayexit'] != 'no record found'){
               $updated_data = $this->common_model->UpdateRecords('ai_appointment_booking',$insert_data, $where_field);
               if($updated_data){
               redirect(base_url().'finalize/'.$cat);
           }
           }else{
           $inserted_data =  $this->common_model->insert_entry('ai_appointment_booking', $insert_data);
           if($inserted_data){
               redirect(base_url().'finalize/'.$cat);
           }
           }
            
        }
    
        $par_cat = decode_category($this->uri->segment(2));
        $sub_cat = decode_category($this->uri->segment(3));
        $where_cat = array('cat_name' =>$sub_cat);
        $field_parnt_cate = array('cat_picture');
        $data['single_parnt_img'] = $this->common_model->getAllwherenew('ai_category', $where_cat, $field_parnt_cate);
        //echo $this->db->last_query();exit;
        //print_r($data['single_parnt_img']);exit;
        
        $where_cat_new = array('cat_name' => $sub_cat);
        $field_cate = array('cat_name', 'cat_desc','cat_parent_id','cat_attribute','req_message','stuff','hourly_rate','required_field_1','stuff_1','required_field_2','staff_2');
        $data['single_cate'] = $this->common_model->getAllwherenew('ai_category', $where_cat_new, $field_cate);
      
        $where_items = array('cat_name' => $sub_cat);
        $field_items = array('cat_attribute', 'req_message', 'stuff', 'cat_name', 'cat_id', 'cat_parent_id','hourly_rate','required_field_1','stuff_1','required_field_2','staff_2');
        $data['single_items_record'] = $this->common_model->getAllwherenew('ai_category', $where_items, $field_items);
        
        $this->get_front_header('Single Service');
        $this->load->view('front/services/without_plan_service',$data);
        $this->load->view('front/include/footer'); 
    }
    public function general_booking(){
    if($_POST){
             $id = $this->session->userdata('id');
            $f_name = $this->input->post('fname');
            $l_name = $this->input->post('lname');
            $address = $this->input->post('address');
            $flat_add = $this->input->post('flat_add');
            $city = $this->input->post('city');
            $country = $this->input->post('country');
            $phnnumber = $this->input->post('phonenumber');
//            $code = $this->input->post('code');
            $where_gen_book = array('id'=>$id);
            $gen_book_fields = array('first_name'=>$f_name,
                                 'last_name'=>$l_name,
                                 'address'=>$address,
                                 'flat'=>$flat_add,
                                 'city'=>$city,
                                 'country'=>$country,
                                 'phone_no'=>$phnnumber
//                                 'promo_code'=>$code
                    );
       $booking_gen_plan = $this->common_model->UpdateRecords('ai_appointment_booking',$gen_book_fields, $where_gen_book); 
        }
        else
        {
        // for fetching country and city
        $zipcode = $this->session->userdata('zipcode');
        $where = array('zip_code' =>$zipcode);
        $city_country = array('country','city');
        $data['country_city'] = $this->common_model->getsingle('ai_locations', $where, $city_country); 
        // for get price....
        $id = $this->session->userdata('id');
        $wehere_record = array('id'=>$id);
        $field_record = array('first_item','second_item','thired_item','job_desc','select_date','select_time');
        $data['record'] = $this->common_model->getsingle('ai_appointment_booking', $wehere_record, $field_record);
      // get record form category..
         $prnt_catname = decode_category($this->uri->segment(2));
         $where_cat = array('cat_name' => $prnt_catname);
         $field = array('cat_attribute');
         $data['cat_record'] = $this->common_model->getsingle('ai_category', $where_cat, $field);
         $this->get_front_header('Single Service');
         $this->load->view('front/services/without_plan_booking',$data);
         $this->load->view('front/include/footer');
        }
    }
    
    
    public function finalize(){
        
        $zipcode = $this->session->userdata('zipcode');
        $email_id =  $this->session->userdata('emailid');
        $data['get_category'] = decode_category($this->uri->segment(2));
        $field_array = array('user_id','cat_id','zipcode','plan_book','helper','job_desc','first_item','second_item','thired_item','select_date','select_time','emailid','booking_status','booking_date','status','plan_hr_bathroom','plan_hr_badroom','livingroom','hour_prc');
        $data['get_booking'] = $this->common_model->getsingle('ai_appointment_booking',  array('cat_id' => encode_category($data['get_category']),'emailid'=> $email_id),$field_array);
        $selected_field = array('cat_id','cat_name','cat_picture','cat_parent_id','cat_desc','is_active','cat_attribute','req_message','stuff');
        $data['get_fetch_data'] = $this->common_model->getsingle('ai_category',  array('cat_name' => decode_category($data['get_category'])),$selected_field);
       
        $data['get_country'] = $this->common_model->getAllrecord('ai_countries');
        //print_r($data['get_country']);exit;
        //print_r($data['get_country']);exit;
        //print_r($data['get_fetch_data']);exit;
        //echo $this->db->last_query();
        //print_r($data['get_fetch_data']);exit;
        
        //Get Plan
        
        $data['get_fetch_plan'] = $this->common_model->getsingle('ai_plan',  array('plan_cat' => encode_category($data['get_category'])),array('plan_title','plan_cat','plan','extra','plan_date'));
        //echo $this->db->last_query();
        //print_r($data['get_fetch_plan']);exit;
        
        $selected_location_field = array('location_name','street','city','state','zip_code','country','geo_lat_location','geo_lng_location');
        $data['get_location'] = $this->common_model->getsingle('ai_locations',  array('zip_code' => $zipcode),$selected_location_field);
        //echo $this->db->last_query();
        
        //print_r($data['get_location']);exit;
       
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('phonenumber', 'Phone', 'trim|required');
        if ($this->form_validation->run() == TRUE) 
            {
            //print_r($_POST);exit;
            $category = $this->input->post('category');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $address = $this->input->post('address');
            $flat_add = $this->input->post('flat_add');
            $city = $this->input->post('city');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $phonenumber = $this->input->post('phonenumber');
            $total_amt = (!empty($_POST['total_amt'])) ? $_POST['total_amt'] : '';
            $plans = (!empty($_POST['chang_plans'])) ? $_POST['chang_plans'] : '';
            
            $update_record = array
                                   (
                                   'first_name' => $fname,
                                   'last_name' => $lname,
                                   'email' => $email_id,
                                   'address' => $address,
                                   'flat' => $flat_add,
                                   'city' => $city,
                                   'state' => $state,
                                   'country' => $country,
                                   'phone_no' => $phonenumber,
                                   'amount' => $total_amt,
                                   'fullprice' => (!empty($_POST['fullprice'])) ? $_POST['fullprice'] : '',
                                   'monthly_plan' => (!empty($_POST['monthlyplans'])) ? $_POST['monthlyplans'] : '',
                                   'plans' => $plans
                                   );
           $update =  $this->common_model->UpdateRecords('ai_appointment_booking',$update_record, array('emailid' => $email_id,'cat_id'=>$this->uri->segment(2)));
            if($update){
                 redirect(base_url().'payment');
            }
            
        }        
        $this->get_front_header('Single Service');
        $this->load->view('front/services/booking_form',$data);
        $this->load->view('front/include/footer');
    }
    
    
    function payment(){
        
        $email_id =  $this->session->userdata('emailid');
        $select_field = array('user_id','cat_id','zipcode','plan_hr_badroom','plan_hr_bathroom','livingroom','first_item',
                            'second_item','thired_item','select_date','select_time','emailid','first_name','last_name','address','amount','plans','fullprice','monthly_plan');
        $data['getFetch'] = $this->common_model->getsingle('ai_appointment_booking',  array('emailid' => $email_id),$select_field);
        
        //print_r($data['getFetch']);exit;
        
        $this->get_front_header('Payment');
        $this->load->view('front/services/payment',$data);
        $this->load->view('front/include/footer');
        
    }

    public function checkout()
	{
           
		$this->load->helper('url');
                
		try {
                    
                    //$this->load->library('Stripe');
			require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you
                        Stripe::setApiKey("sk_test_xDQkMmdedbWXjlWi3CeRGMDc"); //Replace with your Secret Key
//                        print_r($_POST);exit;
//                        $email = $_POST['email'];
                      $plan = $_POST['plan'];
//                        $amount = $_POST['amount'];
//                        $stripeEmail =  $_POST['stripeEmail'];
                            $amt = $_POST['amt'];
			$charge = Stripe_Charge::create(array
                                    (
                                    "amount" => $amt,
                                    "currency" => "USD",
                                    "card" => $_POST['stripeToken'],
                                    "description" => "Transaction"
                                    ));
                        //print_r($charge);exit;
                       //print_r($_POST);exit;
//                       $mail = $this->session->userdata('email');
//                       $iid = $this->session->userdata('id');
                       //$total_amt = substr($amount, 0, -2);
                       $form_date = date('Y-m-d H:i:s');
//                       $endTime = strtotime("+".$limit."months", strtotime($form_date));
//                       $end_date = date('Y-m-d H:i:s', $endTime);
                      
                    $rest = Stripe_Charge::retrieve($charge->id);
                    //print_r($rest);exit;
                    

                    
                    $insert_array = array(
                                            'member_id' => '',
                                            'email' => $_POST['email'],
                                            'transaction_id' => $charge->balance_transaction,
                                            'amount' => $amt,
                                            'package' => $plan,
                                            'payment_from' => $form_date,
                                            'payment_to' => '',
                                            'status' => 1,
                                            'date_added' => date('Y-m-d H:i:s')
                                        );
                       //print_r($rest);exit;
                    //print_r($insert_array);exit;
                    $this->common_model->insert_entry('ai_payment_info', $insert_array);
                    //$this->common_model->insert_entry('ai_appointment_booking', $insert_data);
                    //$where_email = array('email'=>$email);
                    
                    //Clinic 
                    //$this->common_model->updateFields('sys_clinic',array('amount'=>$cost,'package'=>$package,'payment_status'=>2,'payment_from'=>$form_date,'payment_to'=>$end_date,'transaction_id'=>$charge->balance_transaction),$where_email);
                    //Employee
                    //$this->common_model->updateFields('sys_com_emp',array('payment_from'=>$form_date,'payment_to'=>$end_date,'transaction_id'=>$charge->balance_transaction),array('clinic_id' => $iid));
                    
                    //$record_new = $this->common_model->getsingle('sys_email_setting', array('type' => 2), 'id,title,message');
                    
                    //$email_html = '<p>Dear '.$this->session->userdata('owner').','.$record_new->message.'.<br>Your Transation id :'.$charge->balance_transaction.'.'.'</p><p>Thanks,<br>Team Clinic,<br>Date: '.date('Y-m-d H:i:s');
                    
//                    $email_html = '<html xmlns="http://www.w3.org/1999/xhtml">
//                    <head>
//                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
//                    <title>Welcome to Clinic</title>
//                    </head>
//
//                    <body>
//                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
//                      <tr>
//                        <td valign="top" style="background-color:#474747; width:550px;"><a href="#">
//                        <img style="height:70px;" src="' . IMGURL . 'Logo.png" /></a></td>
//                      </tr>
//                      <tr>
//                        <td>
//                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
//                      <tr>
//                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear ' . $this->session->userdata('owner') . '</td>
//                      </tr>
//                      <tr>
//                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
//                          '.$record_new->message.'
//                        </td>
//                      </tr>
//
//                              <tr>
//            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email :</strong>' .$mail . '</td>
//          </tr>
//          
//          <tr>
//            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Your Transation id :</strong>'.$charge->balance_transaction.'</td>
//          </tr>
//          
//          <tr>
//            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Date :</strong>'.date('Y-m-d H:i:s').'</td>
//          </tr>
//                               
//                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
//                    The Clinic Team<br />
//                    <a href="#">info@clinicq.com</a></td>
//                      </tr>
//                    </table>
//                    </td>
//                    </table>
//
//                    </body>
//                    </html>';
//                    
//                    $this->load->library('email');
//                    $config['charset'] = 'iso-8859-1';
//                    $config['mailtype'] = 'html';
//                    $this->email->initialize($config);
//                    $this->email->from('info@clinicq.com', 'Clinic Administrator');
//                    $this->email->to($mail);
//                    $this->email->cc('anand.caroldata@gmail.com');
//                    $this->email->subject($record_new->title);
//                    $this->email->message($email_html);
//                    $this->email->send();
                    
                    redirect(base_url().'Thankyou');
                       
		}
 
		catch(Stripe_CardError $e) {
 
		}
		catch (Stripe_InvalidRequestError $e) {
 
		} catch (Stripe_AuthenticationError $e) {
		} catch (Stripe_ApiConnectionError $e) {
		} catch (Stripe_Error $e) {
		} catch (Exception $e) {
		}
	}
        
    function change_state()
	{
		$country = $this->input->post('Country');
		$rec = $this->myclass->ChangeStateByCountry($country);
                //print_r($rec);exit;
		echo $rec;
	}
    
   }
