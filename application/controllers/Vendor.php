<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('myclass');
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
    }
    
    public function index()
    {
       $data['vender'] = $this->common_model->getAllrecord('ai_vendors');
       // print_r($data['template']);
       $this->get_header('Manage Category');
       $this->load->view('admin/vendor/manage_vendor',$data);
       $this->load->view('admin/include/footer_other');
    }
    
    public function add_vendor()
    {
        if($_POST)
        {
           $fname = $this->input->post('vendor_firstname');
           $lname = $this->input->post('vendor_lastname'); 
           $email = $this->input->post('vendor_email');
           $type = $this->input->post('vendor_type'); 
           $exp = $this->input->post('vendor_experience');
           $status = $this->input->post('vendor_status');
           $vendor_joined_date = date('Y-m-d H:i:s');
           $vendor_value = array
                            (
                            'vendor_firstname'=>$fname,
                            'vendor_firstname'=>$lname,
                            'vendor_email'=>$email,
                            'vendor_type'=>$type,
                            'vendor_experience'=>$exp,
                            'vendor_status'=>$status,
                            'vendor_joined_date'=>$vendor_joined_date,
                                              );
           //print_r($cat_value);exit;
          $insert_vendor =  $this->common_model->insert_entry('ai_vendors',$vendor_value);
          if($insert_vendor){
            $this->session->set_flashdata('succ', "Vender has been added successfully. ");
          redirect('ManageVendor');
          }
        }
            else{
        //print_r($data['parent']);exit;
       $this->get_header('Manage Category');
       $this->load->view('admin/vendor/add_vendor');
       $this->load->view('admin/include/footer_other');
    }
}
    public function edit_vendor(){
        $ven_id = $this->uri->segment(2);
        $fetch_by = array('v_id'=>$ven_id);
        $get_field  = array('v_id','vendor_firstname','vendor_lastname','vendor_email','company','vendor_experience','vendor_status','date_updated','mobile');
        $data['vendor_details'] = $this->common_model->getsingle('ai_vendors',$fetch_by,$get_field);
        $old_status = $data['vendor_details']->vendor_status;
        //print_r($data['vendor_details']->vendor_status); die;
    if($_POST){
            $by = array('v_id'=>$ven_id);
            $fname = trim($this->input->post("vendor_firstname", TRUE));
            $lname = trim($this->input->post("vendor_lastname", TRUE));
            $email = trim($this->input->post("vendor_email", TRUE));
            //$type = trim($this->input->post("vendor_type", TRUE));
            $exp = trim($this->input->post("vendor_experience", TRUE));
            $status = trim($this->input->post("vendor_status", TRUE));
            $edit_details = array
                                (
                                  'vendor_firstname' => $fname,
                                  'vendor_lastname' => $lname,
                                  'vendor_email' => $email,
                                  //'vendor_type' => $type,  
                                  'vendor_experience' =>$exp,
                                  'vendor_status' => $status,
                                 'date_updated' => date('Y-m-d H:i:s')
                                );
            //print_r($edit_details);
            $data['update_vendor'] = $this->common_model->update_entry('ai_vendors',$edit_details,$by);
            if($data['update_vendor']){
                if($old_status != $status){
                    //send mail to vendor
                    if($status == 'active') { $status = "Activated"; $msg = "Congrats"; $msg1 = "You can start now";}
                    if($status == 'inactive') { $status = "Deactivated"; $msg = "Sorry"; $msg1 = "Please contact to admin";}
                    $to = $email;
                    $subject = "Your Vendor Registration has been ".$status;                                       
                    $message = '
							<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<title>Your Vendor Registration has been '.$status.'</title>
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
																<img src="'.base_url().'/images/images.png" width="180" height="" style="margin: 0 auto;">
														</td>
													</tr>
												  <tr>
														<td colspan="2" align="center"><h2 style="font-size:32px; line-height: 36px; color:#555555; margin:10px 0">Your Vendor Registration has been '.$status.'</h2>
														<p style=" margin:20px 0; color:#99A1A6; line-height:24px; font-size:13px;">'.$msg.'! Your Vendor Registration has been '.$status.', '.$msg1.'.</p>
														</td>
													</tr>
												 
													<tr>																
														 <td width="530" colspan="3" style="padding:15px; font-size:14px; color:#888; line-height:24px;">							 
																	<table width="100%"  cellspacing="10">
																		 <tr>
																				<td>														 
																						<table class="main_table" width="100%" cellspacing="0"  cellpadding="0">
																								<tr><td>Email</td><td>'.$email.'</td></tr>																								
																								<tr><td>Experience</td><td>'.$exp.'</td></tr>
																						</table>												
																				</td>
																				
																		 </tr>
																 </table>							 								 								 
														 </td>																
													</tr>
													<tr>
														<td colspan="3" style="padding:10px;" align="center" height="45"> 
																<a target="_blank" href="http://democarol.com/homeservices/" class="link3" href="#" style="background:#EFB650; color:#000; padding:15px 40px;text-decoration:none;font-size:16px;">Login</a>																
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
                }
                
                $this->session->set_flashdata('succ', "Vender has been update successfully.");
                redirect('ManageVendor');
            }
            
           }
        else{
        $this->get_header('Manage Category'); 
        $this->load->view('admin/vendor/edit_vendor',$data);
        $this->load->view('admin/include/footer_other');  
    }
     }
     public function delete_vendor(){
            $user_id = $this->uri->segment(2);
            $where  = array('v_id'=>$user_id);
           $delete_record = $this->common_model->DeleteRecordWhere('ai_vendors',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Vendor has been Delete successfully.");
           }
           redirect('ManageVendor');
    }
    
    
    public function import_vendor(){
                        //header('Content-Type: text/html; charset=UTF-8');
   			$this->form_validation->set_rules('fileHidden', "Import File", 'trim|required');
			
			if ($this->form_validation->run() == TRUE) { 
                            
                            $config['upload_path'] = './upload/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '100000';
                            $this->load->library('upload', $config);
	//print_r($_POST);exit;
        // If upload failed, display error
        if (!$this->upload->do_upload('imp_zip')) {
             $errors = $this->upload->display_errors();
             $this->session->set_flashdata('error',$errors);
             redirect('ManageVendor');
        } else {
             $file_data = $this->upload->data();
            $file_path =  './upload/'.$file_data['file_name'];
    
                
              
                 $sucssfull_update = 0;
                    $wrong_entries = 0;
                    $wrong_price = 0;
                    $total_unsuccessfull = 0;
               

                //////////////////////////////////////////////////////////////////
                 $file = fopen($file_path, 'r');
                 $mCount = 0;   
                 $update_date = date("Y-m-d H:i:s");
                 $skus = array();
                    while (($row = fgetcsv($file)) !== FALSE) {
                        
                        if($mCount != 0) {							
                             if(!empty($row[0]) && !empty($row[1])){								 
				$zip_check = $this->common_model->get_entry_by_data('ai_vendors',true,array('zipcode'=>$row[0]));
				if(empty($zip_check)){
                                
                                $company = trim($row[0]);
                                $services = trim($row[1]);
                                $email = trim($row[2]);  
                                $zip = trim($row[3]);
                                $address = trim($row[4]);
                                $city = trim($row[5]);
                                $state = trim($row[6]);
                                $country = trim($row[7]);
                                $mobile = trim($row[8]);
                                $date = date('Y-m-d h:i:s');
								$arr = array(
								'zipcode' => $zip,
								'city' => $city,
                                'company' => $company,                                //'last_update_date' => date('Y-m-d h:i:s'),
                                'address' => $address,
                                'state' => $state,
                                'vendor_email' => $email,
                                'password' => '123456',
                                'mobile' => $mobile,
                                'country' => $country,
                                'vendors_choose_cat' => $services,
								);
                                                                //print_r($arr);exit;
                                $this->common_model->save_entry('ai_vendors',$arr,'v_id');
                                $sucssfull_update++;   
								 }else{
									$wrong_entries++;
								}
                             } else {
                                $wrong_entries++;
                             }
                          }

                           $mCount++;  

                    }
                    fclose($file);               

                unlink($file_path);
                $summary = "<b>Summary : </b><br><b>Total Updates</b> : $sucssfull_update";
                
                $this->session->set_flashdata('succ', 'Vendor list has been Updated succesfully <br>'.$summary);
                redirect(base_url().'ManageVendor');
                //echo "<pre>"; print_r($insert_data);
            }
                            
                        }
                        else {
                            $this->get_header('Import Data');
                            $this->load->view('admin/vendor/import_vendor');
                            $this->load->view('admin/include/footer_other');
		}
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