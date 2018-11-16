<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Myaccount extends MY_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
    }
    public function index()
    {
         $check_login = $this->check_login();
        if($check_login == true){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email-id', 'trim|required');
            $this->form_validation->set_rules('mobile', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
            if ($this->form_validation->run() == true){
            $Id = $this->session->userdata('id'); 
            $where = array('user_id'=>$Id);
            $fname = $this->input->post('first_name');
            $lname = $this->input->post('last_name');
            $email = $this->input->post('email');
            $number = $this->input->post('mobile');
            $profile = array('first_name'=>$fname,
                    'last_name'=>$lname,
                    'email' => $email,
                    'phone' => $number,
                    );
            $profile_data = $this->common_model->update_entry('ai_user',$profile,$where);
             $nmsg = 'Your Profile has been updatted succesfully!!!!!';
               $this->_set_msg($nmsg, 'green');
                 redirect(base_url().'My-account');
         }
        else{
        $Id = $this->session->userdata('id');
        $where = array('user_id' => $Id);
        $field = array('first_name', 'last_name', 'email','country','phone','landmark','house_number','zipcode','geo_location');
        $data['profile_details'] = $this->common_model->getsingle('ai_user', $where, $field);
        $data['country'] = $this->common_model->getAllrecord('ai_country');
        
        //order history
        $userid = $this->session->userdata('id');
        $where = array('user_id'=>$userid);
        $data['order_history'] = $this->common_model->getAllwherenewwith_order('ai_appointment_booking',$where,'','booking_date','DESC');
        //print_r($data['order_history']); die;
        $this->get_front_header('My Account');
        $this->load->view('front/myaccount/profile',$data);
        $this->load->view('front/include/footer'); 
 
        }
    }
    }
    
    function my_address(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mobile', 'Phone Number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('landmark', 'Landmark', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required');
        if ($this->form_validation->run() == true){
            $Id = $this->session->userdata('id'); 
            $where = array('user_id'=>$Id);
            $phone = $this->input->post('mobile');
            $add_numner = $this->input->post('address');
            $landmark = $this->input->post('landmark');
            $location = $this->input->post('location');
            $country = $this->input->post('country');
            $zipcode = $this->input->post('zipcode');
                    $profile = array(
                    'phone' => $phone,
                    'house_number' => $add_numner,  
                    'landmark' => $landmark,
                    'geo_location' => $location,
                    'country' => $country,
                    'zipcode' => $zipcode);
            $profile_data = $this->common_model->update_entry('ai_user',$profile,$where);  
            echo 2;
            exit;
        }
        else{  
        $data = array(
                'phone' => form_error('mobile'),
                'address' => form_error('address'),
                'landmark' => form_error('landmark'),
                'location' => form_error('location'),
                'zipcode' => form_error('zipcode'),
            );                       
                echo json_encode($data);  
    }
    }
    
    function my_orders(){
        $userid = $this->session->userdata('id');
        $where = array('user_id'=>$userid);
        $res = $this->common_model->getAllwherenew('ai_appointment_booking',$where,'*');
        
        print_r($res);
    }
       function changePassword()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Old password', 'trim|required');
        $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required');
        $this->form_validation->set_rules('reppassword', 'Confirm Password', 'trim|required|matches[newpassword]');
        if ($this->form_validation->run() == true) {
        $id = $this->session->userdata('id');
        $where = array('user_id' => $id,'password' => md5($this->input->post('password')));
        $user_detials = $this->common_model->getsingle('ai_user', $where, 'password');
        
        if ($user_detials != 'no record found') {
                    
                    $where_new = array('user_id' => $this->session->userdata('id'),'password' => md5($this->input->post('password')));
                    $new_pass = array(
                        'password' => md5($this->input->post('newpassword'))
                    );
                    $this->common_model->update_entry('ai_user', $new_pass, $where_new);
                    echo 1;
                }else{
                    echo 2;
                }
       }
        else {
          $data = array(
                        'opass'   =>form_error('password'),
                        'newpass' =>form_error('newpassword'),
                        'reppass' =>form_error('reppassword'),
                       );                       
                       echo json_encode($data);   
            }
   }
   function feedback(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email-Id', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
       if ($this->form_validation->run() == true) {
       $name = $this->input->post('name');
       $email = $this->input->post('email');
       $requirement = $this->input->post('message');
       $insert_array = array(
            'contact_name' => $name,
            'contact_email' => $email,
            'contact_message' => $requirement,
            'date' => date('Y-m-d H:i:s'),
            'contact_type' => 1
        );
        $contact_id = $this->common_model->insert_entry("ai_contact", $insert_array);
              if ($contact_id) {
            /*             * ********* Contact email Template start *************** */
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
<p>Your feedback form is <b>submit successfully</p>
<p>We will <b>Contact you soon</b></p>';
            $contact_temp_footer.= new_mail_footer(); //define in global helper
            $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'priority' => '1'
            );
            $user_message =  $contact_temp_user;
            //echo $content;die;
            $this->email->initialize($config);
            $this->email->from('anand.caroldata@gmail.com', '88 HOME PROS');
            $this->email->to($email);
            $this->email->subject("88 HOME PROS Thank You");
            $this->email->message($user_message);
            $this->email->send();
            /*             * ****** message for admin******** */
            $contact_temp_admin .= '<table width="743"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f1f1f1">
				  <tr>
                    <td style="font-size: 13px; color: #959595; font-weight: normal; text-align: left;  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; line-height: 24px; vertical-align: top; padding:10px 30px 0px; border-radius:12px; -moz-border-radius:12px; -webkit-border-radius:12px; position:relative;" bgcolor="#f1f1f1">
                        
                        <table>
                           <tr>
                                <td valign="middle" style="text-decoration: none; color: rgb(39, 39, 39); font-family: Arial,sans-serif; padding: 14px 10px 16px 3px; font-size: 24px; font-weight:bold;">Dear <span style="color:#44a694">Admin</span></td>
                           </tr>
                        </table>
                        
<div class="we-welcome" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;color:#333; line-height:19px; padding-bottom:10px; padding-top:5px; clear:both; width:100%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" class="my-tabl">
<tr>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="6" align="left">
<tr>
<td valign="top" style="border-bottom:1px solid #000; font-weight:bold;  color: #44a694; font-size:16px; padding-bottom:5px;">Feedback Details :-</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="100%">
<tr>
<td valign="top" width="15%"><b>Name :</b> </td>
<td valign="top" width="35%" style="padding-right:22px;">' . $name . '</td>
<td valign="top" width="15%"><b>Email :</b> </td>
<td valign="top" width="35%" style="padding-right:22px;" >' . $email . '</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="100%">
<tr>
<td valign="top" width="15%"><b>Requirement. :</b> </td>
<td valign="top" width="35%" style="padding-right:10px;">' . $requirement . '</td>
</tr>
</table>
</td>
</tr>';
           $admin_message =  $contact_temp_admin ;
            $this->email->from($email, $name);
            if (ENVIRONMENT == 'production') {
                $admin_emails = $this->config->item('common_admin_mail_list');
                $admin_bcc = $this->config->item('common_admin_bcc_list');
                if (!empty($admin_emails)) {
                    $list = $admin_emails;
                    $list_bcc = $admin_bcc;
                } else {
                    $list = 'anand.caroldata@gmail.com';
                   $list_bcc ='anand.caroldata@gmail.com';
                  
                }
            } else {
                $list = 'anand.caroldata@gmail.com';
                $list_bcc ='anand.caroldata@gmail.com';
            }
            $this->email->to($list);
            $this->email->bcc($list_bcc);
            $this->email->subject("Feedback Form");
            $this->email->message($admin_message);
            $this->email->send();
            /*             * *************** Contact template end ***************** */
           echo 4;
           exit; 
        }
           }
     else {
          $data = array(
                        'fname'   =>form_error('name'),
                        'emailid' =>form_error('email'),
                        'messsage' =>form_error('message'),
                       );                       
                       echo json_encode($data);   
            }
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
   