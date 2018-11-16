<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $this->load->model('common_model');
    }

    public function index() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[10]|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|max_length[50]');

        $email = trim($this->input->post('email', TRUE));
        $password = trim($this->input->post('password', TRUE));
        if ($this->form_validation->run() == TRUE) {
            $loin_arr = array(
                'email' => $email,
                'password' => $password
            );
            $login_data = $this->common_model->get_entry_by_data('user', true, $loin_arr);
            $where = array('email' => $email, 'status' => '1', 'email_verified' => '1');
            $user_detials = $this->common_model->getsingle('user', $where, 'user_id,email,first_name,last_name,type,login_type,status,password');

            if ($user_detials != 'no record found') {
                $db_pass = $user_detials->password;
                $user_pass = md5($this->input->post('password', true));
                if ($user_pass == $db_pass) {
                    $newdata = array(
                        'id' => $user_detials->user_id,
                        'email' => $user_detials->email,
                        'fullname' => $user_detials->first_name . ' ' . $user_detials->last_name,
                        'type' => $user_detials->type
                    );
                    //$this->user_data_method($login_data);
                    $this->session->set_userdata($newdata);
                    redirect(SITEBASEURL . 'My-account');
                } else {
                    $nmsg = 'Your Password Invalid. Try again';
                    $this->_set_msg($nmsg, 'red');
                    redirect(SITEBASEURL . 'Login');
                }
            } else {
                $nmsg = 'Your Email Id/Password Invalid.Try again';
                $this->_set_msg($nmsg, 'red');
                redirect(SITEBASEURL . 'Login');
            }
        }
        $this->get_front_header('Login');
        $this->load->view('front/login');
        $this->load->view('front/include/footer');
    }

    /* USER REGISTRATION */

    function sign_up() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[255]|callback_check_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

        $fname = trim($this->input->post('first_name', TRUE));
        $lname = trim($this->input->post('last_name', TRUE));
        $email = trim($this->input->post('email', TRUE));
        $password = trim($this->input->post('password', TRUE));
        $ip_address = getipadd();

        if ($this->form_validation->run() == TRUE) {

            $insert_array = array
                (
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'email_verified' => 0,
                'password' => md5($password),
                'status' => 2,
                'ip_address' => $ip_address,
                'date_added' => date('Y-m-d H:i:s')
            );
            //print_r($insert_array);exit;
            $uid = $this->common_model->insert_entry('user', $insert_array);
            $activeURL = SITEBASEURL . 'active-account/' . ci_enc($uid);
            $messages = 'Thanks for Registration on 88 HOME PROS';
            $email_html = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to 88 HOME PROS</title>
                    </head>
                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"><a href="#">
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear ' . $fname . ' ' . ' ' . ' ' . $lname . '</td>
                      </tr>
                      
            <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:30px 10px 15px 10px;line-height:20px"><strong style="color:#000;float:left">' . $messages . '</td>
            </tr>
            <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email :</strong>' . $email . '</td>
          </tr>
                     
          <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Url :</strong><a href="' . $activeURL . '">' . $activeURL . '</a></td>
          </tr>
          
          <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Date :</strong>' . date('Y-m-d H:i:s') . '</td>
          </tr>          
                               
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards :<br />
                    The 88 HOME PROS <br />
                    <a href="#">info@88homepros.com</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>
                    </body>
                    </html>';
            $email = $email;
            $subject = '88 HOME PROS';
            $message = $email_html;
            $headers = 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
            $headers .= 'From: 88 HOME PROS<anand.caroldata@gmail.com>' . "\n";
            @mail($email, $subject, $message, $headers);
            $nmsg = 'your account has been register.Please To active your account please visit your register email id.';
            $this->_set_msg($nmsg, 'green');
            redirect(SITEBASEURL . 'Signup');
        }
        $this->get_front_header('Signup');
        $this->load->view('front/signup');
        $this->load->view('front/include/footer');
    }

    /* SET MSG FOR SUBMIT DATA */

    public function _set_msg($msg, $color = 'red') {
        $msg_arr = array(
            'errorm' => '<div>* ' . $msg . '</div>',
            'errorm_theme' => $color
        );
        //add the above data into temp session via flashdata.
        $this->session->set_flashdata($msg_arr);
        return true;
    }

    /* SET ACTIVATION URL FOR REGISTRATION */

    public function active_account($user_id = '') {
        $user_id;
        $base_url = SITEBASEURL;
        if ($user_id == '') {
            //define message for wrong url
            $message = 'You have access wrong URL. Please check it again and then try once.';
            $this->_set_msg($message, 'red');
            redirect($base_url . 'Login');
            exit;
        }
        $uid = ci_dec($user_id);
        $where = array('user_id' => $uid);
        $select = array('email_verified', 'status');
        $get_user_data = $this->common_model->getsingle("user", $where, $select);
        if ($get_user_data == 'no record found') {
            $message = 'The link you visited is wrong please check the activation URL and try again.';
            $this->_set_msg($message, 'red');
            redirect($base_url . 'Login');
            exit;
        } else {
            $db_email_veri = $get_user_data->email_verified;
            if ($db_email_veri == 0) {
                $upd_tbl = array(
                    'email_verified' => '1',
                    'status' => '1',
                );
                $this->common_model->update_entry('user', $upd_tbl, $where);
                $message = 'Thanks for activating your account. Now you can login and access your account.';
                $this->_set_msg($message, 'green');
                redirect($base_url . 'Login');
                exit;
            }
        }
    }

    /* CHECK EMAIL ALREADY EXISTS */

    public function check_email($email) {
        $emailcheck = $this->common_model->getsingle('user', array('email' => $email));
        if ($emailcheck != 'no record found') {
            $this->form_validation->set_message('check_email', 'Email ID already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    /* FORGOT PASSWORD FOR USER */
    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[10]|max_length[50]|valid_email');
        if($this->form_validation->run() == TRUE) 
           {
                $email = trim($this->input->post('email', TRUE));
		$where_forgot = array('email' => $email);
		$check_email = $this->common_model->get_entry_by_data('user',true,$where_forgot);
		 if(!empty($check_email)){
		/******* Email template start    **********/
            
            $password = random_string('numeric', rand(6, 6));
            $this->common_model->update_entry('user',  array('password' => md5($password),'update_password_date' =>date('Y-m-d H:i:s')),  array('email' => $email));
            $email_html = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to 88 HOME PROS</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"><a href="#">
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear ' . $check_email['first_name'] . '</td>
                      </tr>
                      <tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          As per your request for the Forgot Password, please find below the details available in our records.
                        </td>
                      </tr>

                              <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email :</strong>' .$email . '</td>
          </tr>

    
            <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password :</strong>' .$password. '</td>
          </tr>

             
          <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Date :</strong>'.date('Y-m-d H:i:s').'</td>
          </tr>
                               
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    The 88 HOME PROS<br />
                    <a href="#">info@88homepros.com</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>

                    </body>
                    </html>';
            $email = $email;
            $subject = '88 HOME PROS';
            $message = $email_html;
            $headers = 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
            $headers .= 'From: 88 HOME PROS<anand.caroldata@gmail.com>' . "\n";
            @mail($email, $subject, $message, $headers);
            $nmsg = 'Send request your mail id';
            $this->_set_msg($nmsg,'green');
            redirect(SITEBASEURL.'Forgot-password');
		 }
                 else{
			 $nmsg = 'Your Email Id does not match. Try again';
                        $this->_set_msg($nmsg,'red');
                        redirect(base_url().'Forgot-password');
			 }
           }
        $this->get_front_header('Forgot Password');
        $this->load->view('front/forgot');
        $this->load->view('front/include/footer');
    }
    
    //*****************  manage user session ******** ///
	public function user_data_method($user_data)
        {
		//get fb data
			$sess_array = array
                            (
                                 'id'      => $user_data['user_id'],
				 'fullname'    => $user_data['first_name'],
				 'email'   => $user_data['email']
                            );
                        $this->session->set_userdata($sess_array);
                        $this->session->set_userdata('les_user_data', $sess_array);	
	}//end session method
    
    //***********  get data from facebook  ***********
	public function social_user_data()
        {
            
            $profile = $this->facebook->api('/me?fields=id,name,link,email');
            print_r($profile);exit;
		if($this->user){					
			$profile = $this->facebook->api('/me?fields=id,name,link,email');			
                        $string = random_string('numeric', rand(6, 10));
			$password =  $string;//random password generate for user			
			$arr_social = array(
					'email' => $profile['email'],
					'first_name' => $profile['name'],
					'login_type' => 'facebook',
					'user_fb_id'  => $profile['id'],
					'password'   => md5($password),
					'date_added' => date('Y-m-d h:i:s'),
                                        'status' => 1,
                                        'email_verified' => 1
					);	
			$check_email = array('email' => $profile['email']);
			if(!empty($profile['email']))
                        {
				//check email is already available
				 $check_email = $this->common_model->get_entry_by_data('user',true,$check_email);
				 if($check_email==''){				
				 //  get all data from existing email
					 $reg_data = $this->common_model->save_entry('user',$arr_social,'user_id');
					 if($reg_data!='')
                                             {
						 		 /*
			 |------------------------------------------|
				 |  Registration mail for user		|
			 |------------------------------------------|
				 */
                           $url = SITEBASEURL;
			  $email_html = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to Creative Packaging World</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"><a href="#">
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear ' . $reg_data['first_name'] . '</td>
                      </tr>
                      <tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          <p>We welcome you to the 88 HOME PROS family, a well Home services with 
			widest range of service and best prices.</p>
                        <p>Please save this e-mail message for future reference. To access your ' .$url. '
			account, use the following login information:</p>
                        </td>
                      </tr>
                              <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email :</strong>' .$reg_data['email'] . '</td>
          </tr>
    
            <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password :</strong>' .$password. '</td>
          </tr>
             
          <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Date :</strong>'.date('Y-m-d H:i:s').'</td>
          </tr>
                               
                  <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    The 88 HOME PROS<br />
                    <a href="#">info@88homepros.com</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>
                    </body>
                    </html>';
            $email = $reg_data['email'];
            $subject = '88 HOME PROS';
            $message = $email_html;
            $headers = 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
            $headers .= 'From: 88 HOME PROS<anand.caroldata@gmail.com>' . "\n";
            @mail($email, $subject, $message, $headers);
			/*
			|-------------------------------
			|  Email template end for user
			|---------------------------------
			*/	
                         //send data to set session						
				$this->user_data_method($reg_data);
					 }
				}else{
					//if alraedy exist set session for existing email
					$this->user_data_method($check_email);
                                     }//echeck alredy registerd	
			}else{
				  //if email is not found then go back to user profile page for update email
//				  		$this->get_front_header(); 
//						$this->load->views('front/user/edit_profile',$arr_social) ;
//						$this->load->view('front/include/footer');
                                                
                                                $this->get_front_header('My Account');
                                                $this->load->view('front/myaccount/profile',$arr_social);
                                                $this->load->view('front/include/footer'); 
					 
			}
		}
		$url = $this->session->userdata('socail_curnt_url');
		if($this->session->userdata('egift_email')){ 
		$this->session->set_userdata('social_login','facebook');
		redirect($url);	
		}else{
                redirect(SITEBASEURL);
		}
	}//End login with facebook
    
    /*User Logout section*/
    
    public function logout()
    {
        $array_items = array
                            (
                              'id' => '',
                              'email' => '',
                              'fullname' => ''
                            );
        $this->session->set_userdata($array_items);
        redirect(SITEBASEURL.'Login');
    }    

}
