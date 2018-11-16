<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendors extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
    }
    public function vendors_info() {
		
        $this->form_validation->set_rules('vendor_firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('vendor_lastname', 'Last Name', 'trim|required');
        //$this->form_validation->set_rules('email', 'Email Id', 'trim|required|min_length[15]|max_length[255]|is_unique[ai_vendors.vendor_email]');
        
        if ($this->form_validation->run() == TRUE) 
            {
            //print_r($_POST);exit;
            $fname = $this->input->post('vendor_firstname');
            $lname = $this->input->post('vendor_lastname');
            $email = $this->input->post('vendor_email');
            $company = $this->input->post('company');
            
            $vendors_choose_cat = implode(',',$_POST['vendors_choose_cat']);
            //print_r($vendors_choose_cat);exit;
            
            $vandors_info = array
                (
                'company' => $company,
                'vendor_firstname' => $fname,
                'vendor_lastname' => $lname,
                'vendor_email' => $email,
                'vendors_choose_cat' => $vendors_choose_cat,
                'vendor_status' => 'inactive'
            );
            
            $newdata = array(
                        'vendor_email' => $email,
						'vendors_choose_cat' => $vendors_choose_cat
                    );
            $this->session->set_userdata($newdata);
           //print_r($vandors_info);exit;
            $vendous_info = $this->common_model->insert_entry('ai_vendors', $vandors_info);
            if($vendous_info){
                redirect(base_url().'front/vendors/vendors_fill_details');
            }
        }
        else
            {
            $where = array('is_active' => 1);
            $field = array('cat_name', 'cat_parent_id', 'cat_id');
            $data['get_catname'] = $this->common_model->getAllwherenew('ai_category', $where, $field);
            //for country
            $data['get_country'] = $this->common_model->getAllrecord('ai_country');
            $this->get_front_header('Home');
            $this->load->view('front/vendors/get_vendors', $data);
            $this->load->view('front/include/footer');
        }
    }
    public function vendors_fill_details()
    {
        $email = $this->session->userdata('vendor_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('confirmnumber', 'Confirm Mobile', 'trim|required|matches[mobile]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        if($this->form_validation->run() == TRUE){
            
            //print_r($_POST);exit;
            $update_arr = array
                               (
                                'mobile' => trim($_POST['mobile']),
                                'address' => trim($_POST['address']),
                                'apt' => trim($_POST['apt']),
                                'country' => trim($_POST['country']),
                                'city' => trim($_POST['city']),
                                'state' => trim($_POST['state']),
                                'zipcode' => trim($_POST['zipcode']),
                                'vendor_experience' => trim($_POST['candidate_provider']),
                                'vendor_gender' => trim($_POST['gender'])
                                );
            
            $success_vendor = $this->common_model->UpdateRecords('ai_vendors',$update_arr, array('vendor_email' => $email));
            if($success_vendor){
				//send mail to admin
				$admin = $this->common_model->get_admin_detail();
				$to = $admin->email;
				$subject = "New Vendor Registration Request";								
				$message = '
							<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<title>New Vendor Request</title>
									<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
									<style type="text/css">
										body {
										 padding-top: 0 !important;
										 padding-bottom: 0 !important;
										 padding-top: 0 !important;
										 padding-bottom: 0 !important;
										 margin:0 !important;
										 width: 100% !important;
										 -webkit-text-size-adjust: 100% !important;
										 -ms-text-size-adjust: 100% !important;
										 -webkit-font-smoothing: antialiased !important;
									 }
									 .tableContent img {
										 border: 0 !important;
										 display: block !important;
										 outline: none !important;
									 }
									 
									.main_table td{ border:1px solid #eee; padding:8px;}			
									</style>
								</head>
								
								<body class="fullwidth" style="padding: 10px 0 0 0; margin: 0 0 12px 0; font-family: Verdana, helvetica, arial, sans-serif; background-color: #eeeeee; font-size: 11px; color: #222; line-height: 16px;" bgcolor="#eeeeee">
									<div style="width:100%; background:#43474A; text-align:center; padding: 30px 0 60px;"><img alt="logo" src="'.base_url().'/images/logo.png" style="padding-right: 8px;" border="0" width="180"></div>
									<table width="100%">
									<tr><td align="center"><div style="width: 600px; margin-top: -35px; border-top: 5px solid #69C374;">
											<table border="0" cellpadding="15" cellspacing="0" width="100%" bgcolor="#fff"  class="info_table">
													<tr>
														<td align="center" valign="middle" colspan="3" align="center" >
																<img src="'.base_url().'/images/hand-icon-17864.png" width="180" height="" style="margin: 0 auto;">
														</td>
													</tr>
												  <tr>
														<td colspan="2" align="center"><h2 style="font-size:32px; line-height: 36px; color:#555555; margin:10px 0">New Vendor Request</h2>
														<p style=" margin:20px 0; color:#99A1A6; line-height:24px; font-size:13px;">This Vendor wants to register on your site!</p>
														</td>
													</tr>
												 
													<tr>																
														 <td width="530" colspan="3" style="padding:15px; font-size:14px; color:#888; line-height:24px;">							 
																	<table width="100%"  cellspacing="10">
																		 <tr>
																				<td>														 
																						<table class="main_table" width="100%" cellspacing="0"  cellpadding="0">
																								<tr><td>Email</td><td>'.$email.'</td></tr>
																								<tr><td>Mobile no.</td><td>'.$_POST['mobile'].'</td></tr>
																								<tr><td>Category</td><td>'.$this->session->userdata('vendors_choose_cat').'</td></tr>
																								<tr><td>City</td><td>'.$_POST['city'].'</td></tr>
																								<tr><td>Country</td><td>'.$_POST['country'].'</td></tr>
																								<tr><td>Experience</td><td>'.$_POST['candidate_provider'].'</td></tr>
																						</table>												
																				</td>
																				
																		 </tr>
																 </table>							 								 								 
														 </td>																
													</tr>
													<tr>
														<td colspan="3" style="padding:10px;" align="center" height="45"> 
																<a target="_blank" href="http://democarol.com/homeservices/admin" class="link3" href="#" style="background:#EFB650; color:#000; padding:15px 40px;text-decoration:none;font-size:16px;">Accept</a>
																<a target="_blank" href="http://democarol.com/homeservices/admin" class="link3" href="#" style="background:#EFB650; color:#000; padding:15px 40px;text-decoration:none;font-size:16px;">Cancle</a>
														</td>
													</tr>					
													<tr bgcolor="69C374">
															<td align="left"><p style="font-family:Georgia;font-style:italic;color:#0F4666;font-size:15px;line-height:19px; ">Stay in Touch!</p></td>
															<td align="right"><img src="'.base_url().'/images/facebook.png" alt="facebook"  width="45" height="45"><img src="'.base_url().'/images/twitter.png" alt="Twitter" width="45" height="45"></td>					
													</tr>    
													<tr bgcolor="#3C3C3C"><td align="center" style="padding:10px; color:#fff" colspan="2">© 2017 88HomePros. All Rights Reserved</td></tr>
											</table>
									</div></td></tr></table>
								</body>
								</html>
							';							
				$this->sendmail($to,$subject,$message);
				// end mail
				//send mail to vendor
				$to = $email;
				$subject = "Vendor Registration Request has been submitted";							
				$message = '
							<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<title>Vendor Registration Request has been submitted</title>
									<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
									<style type="text/css">
										body {
										 padding-top: 0 !important;
										 padding-bottom: 0 !important;
										 padding-top: 0 !important;
										 padding-bottom: 0 !important;
										 margin:0 !important;
										 width: 100% !important;
										 -webkit-text-size-adjust: 100% !important;
										 -ms-text-size-adjust: 100% !important;
										 -webkit-font-smoothing: antialiased !important;
									 }
									 .tableContent img {
										 border: 0 !important;
										 display: block !important;
										 outline: none !important;
									 }
									 
									.main_table td{ border:1px solid #eee; padding:8px;}			
									</style>
								</head>
								
								<body class="fullwidth" style="padding: 10px 0 0 0; margin: 0 0 12px 0; font-family: Verdana, helvetica, arial, sans-serif; background-color: #eeeeee; font-size: 11px; color: #222; line-height: 16px;" bgcolor="#eeeeee">
									<div style="width:100%; background:#43474A; text-align:center; padding: 30px 0 60px;"><img alt="logo" src="'.base_url().'/images/logo.png" style="padding-right: 8px;" border="0" width="180"></div>
									<table width="100%">
									<tr><td align="center"><div style="width: 600px; margin-top: -35px; border-top: 5px solid #69C374;">
											<table border="0" cellpadding="15" cellspacing="0" width="100%" bgcolor="#fff"  class="info_table">
													<tr>
														<td align="center" valign="middle" colspan="3" align="center" >
																<img src="'.base_url().'/images/hand-icon-17864.png" width="180" height="" style="margin: 0 auto;">
														</td>
													</tr>
												  <tr>
														<td colspan="2" align="center"><h2 style="font-size:32px;    line-height: 36px; color:#555555; margin:10px 0">Vendor Registration Request has been submitted</h2>
														<p style=" margin:20px 0; color:#99A1A6; line-height:24px; font-size:13px;">Your request for vendor registration has been recieved, we will get back to you soon!</p>
														</td>
													</tr>
												 
													<tr>																
														 <td width="530" colspan="3" style="padding:15px; font-size:14px; color:#888; line-height:24px;">							 
																	<table width="100%"  cellspacing="10">
																		 <tr>
																				<td>														 
																						<table class="main_table" width="100%" cellspacing="0"  cellpadding="0">
																								<tr><td>Email</td><td>'.$email.'</td></tr>
																								<tr><td>Mobile no.</td><td>'.$_POST['mobile'].'</td></tr>
																								<tr><td>Category</td><td>'.$this->session->userdata('vendors_choose_cat').'</td></tr>																								
																								<tr><td>Experience</td><td>'.$_POST['candidate_provider'].'</td></tr>
																						</table>												
																				</td>
																				
																		 </tr>
																 </table>							 								 								 
														 </td>																
													</tr>
													<tr>
														<td colspan="3" style="padding:10px;" align="center" height="45"> 
																<a class="link3" href="#" style="background:#EFB650; color:#000; padding:15px 40px;text-decoration:none;font-size:16px;">Get Back Shortly</a>																
														</td>
													</tr>					
													<tr bgcolor="69C374">
															<td align="left"><p style="font-family:Georgia;font-style:italic;color:#0F4666;font-size:15px;line-height:19px; ">Stay in Touch!</p></td>
															<td align="right"><img src="'.base_url().'/images/facebook.png" alt="facebook"  width="45" height="45"><img src="'.base_url().'/images/twitter.png" alt="Twitter" width="45" height="45"></td>					
													</tr>    
													<tr bgcolor="#3C3C3C"><td align="center" style="padding:10px; color:#fff" colspan="2">© 2017 88HomePros. All Rights Reserved</td></tr>
											</table>
									</div></td></tr></table>
								</body>
								</html>
							';	
				$this->sendmail($to,$subject,$message);
				// end mail
                $this->session->unset_userdata('vendor_email');
                $nmsg = 'Your account has been register.your account will be activated by Admin...';
                $this->_set_msg($nmsg, 'green');
                redirect(base_url().'Vendors');
            }
        }
        $data['get_country'] = $this->common_model->getAllrecord('ai_countries');
        $data['state'] = $this->common_model->getAllwherenew('ai_states',  array('countryid' => 236),  array('regionid','region','code','status'));
        $this->get_front_header('Home');
        $this->load->view('front/vendors/vendors_details',$data);
        $this->load->view('front/include/footer');
    }
    
    function change_state()
	{
		$country = $this->input->post('Country');
		$rec = $this->myclass->ChangeStateByCountry($country);
                //print_r($rec);exit;
		echo $rec;
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
	
	public function sendmail($to,$subject,$message){		
				
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: <admin@88homepros.com>' . "\r\n";
		//$headers .= 'Cc: myboss@example.com' . "\r\n";
		
		mail($to,$subject,$message,$headers);
	}
}
