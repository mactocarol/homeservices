<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contact extends MY_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('common_model');
    }
    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('message', 'Write message', 'trim|required');
         if ($this->form_validation->run() == true) {
       $name = $this->input->post('name');
       $email = $this->input->post('email');
       $contact_number = $this->input->post('contact_number');
       $requirement = $this->input->post('message');
       $insert_array = array(
            'contact_name' => $name,
            'contact_email' => $email,
            'contact_phone' => $contact_number,
            'contact_message' => $requirement,
            'date' => date('Y-m-d H:i:s'),
            'contact_type' => 0
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
<p>Your Contact Info <b>submit successfully</p>
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
            $this->email->from('meghanaik50@gmail.com', '88 HOME PROS');
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
                    $list = 'meghanaik50@gmail.com';
                    $list_bcc = 'meghanaik50@gmail.com';
                  
                }
            } else {
                $list = 'meghanaik50@gmail.com';
                $list_bcc ='meghanaik50@gmail.com';
            }
            $this->email->to($list);
            $this->email->bcc($list_bcc);
            $this->email->subject("Contact Info");
            $this->email->message($admin_message);
            $this->email->send();

            /*
                         * *************** Contact template end ***************** */
            $nmsg = 'Your Message send successfully!!!!!';
               $this->_set_msg($nmsg, 'green');
                 redirect(base_url().'Contact-us');
        }
        }
        else{
        $this->get_front_header('Contact us');
        $this->load->view('front/contact_us');
        $this->load->view('front/include/footer'); 
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
   