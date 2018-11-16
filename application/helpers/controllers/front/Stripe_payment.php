<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Stripe_payment extends CI_Controller {
    
    public function __construct()
       {
            parent::__construct();             
       }
 
 
          public function index()
         {
            $data['title'] = "Membership";
            $data['membership_record'] = $this->common_model->getAllwherenew('sys_account', array('status' => 1), 'membership_limit,membership_package,amount');
            $data['setting_new'] = $this->common_model->getAllwherenew('sys_clinic', array('id'=>$this->session->userdata('id')), 'id,company_name,address,city,state,country,phone,email,clinic_name,owner,contact,transaction_id');
            
            //echo $data['setting_new'][0]->transaction_id;exit;
            if($data['setting_new'][0]->transaction_id != '-')
            {
            $data['total_sms'] = $this->common_model->getcount('sys_patient',array('clinic_id' => $this->session->userdata('id')));
            $data['smsprice'] = $this->common_model->getAllwherenew('sys_smsprice', array('status'=>1), 'id,price');
            }
            else 
            {
                $data['total_sms'] = "0";
                $data['smsprice'] = $this->common_model->getAllwherenew('sys_smsprice', array('status'=>1), 'id,price');
            }
            //print_r($data['setting_new']);exit; 
            $this->load->view('common/header',$data);
            $this->load->view('stripe');
            $this->load->view('common/footer');
          }
 
	public function checkout()
	{
           
		$this->load->helper('url');
                
		try {
                    
                    //$this->load->library('Stripe');
			require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you
			Stripe::setApiKey("sk_test_sni0BVKBkakCzkUOcQ8N7TB3"); //Replace with your Secret Key
                        //exit;
                         $smscount = $_POST['smscount'];
                         $smsprice = $_POST['smsprice'];
                         $member_price = $_POST['member_price'];
                         $amt = $_POST['amt'];
                         $total = $smscount * $smsprice;
                         $member_price = $_POST['member_price'];
                         $cost = $_POST['cost'];
                         $package = $_POST['package'];
                         $limit = $_POST['limit'];
                         $amount = $amt + $total;
                         
                         if($smscount == '0'){
                             $smsA = '0';
                         }else{
                             $smsA = $smscount;
                         }
                        
			$charge = Stripe_Charge::create(array(
				"amount" => $amt,
				"currency" => "USD",
				"card" => $_POST['stripeToken'],
				"description" => "Transaction"
			));
                        //print_r($charge);exit;
                       //print_r($_POST);exit;
                       $mail = $this->session->userdata('email');
                       $iid = $this->session->userdata('id');
                       $email =  $_POST['stripeEmail'];
                       $total_amt = substr($amount, 0, -2);
                       //if($mail == $email){
                       $form_date = date('Y-m-d H:i:s');
                       $endTime = strtotime("+".$limit."months", strtotime($form_date));
                       $end_date = date('Y-m-d H:i:s', $endTime);
                      
                    $rest = Stripe_Charge::retrieve($charge->id);
                    
                    if($total != '0'){
                       $insert_array = array(
                                            'clinic_id' => $iid,
                                            'package' => $package,
                                            'transaction_id' => $charge->balance_transaction,
                                            'amount' => $total,
                                            'payment_from' => $form_date,
                                            'payment_to' => $end_date,
                                            'status' => 2,
                                        );
                      
                    $this->common_model->insertData('sys_sms_bill_info', $insert_array); 
                    }else
                    {
                     $insert_array = array(
                                            'clinic_id' => $iid,
                                            'package' => $package,
                                            'transaction_id' => '-',
                                            'amount' => $total,
                                            'payment_from' => $form_date,
                                            'payment_to' => $end_date,
                                            'status' => 1,
                                        );
                    $this->common_model->insertData('sys_sms_bill_info', $insert_array);
                        
                    }
                    
                    $insert_array = array(
                                            'user_id' => $iid,
                                            'email' => $mail,
                                            'transaction_id' => $charge->balance_transaction,
                                            'amount' => $cost,
                                            'total_sms' => $smsA,
                                            'package' => $package,
                                            'payment_from' => $form_date,
                                            'payment_to' => $end_date,
                                            'status' => 1,
                                            'date_added' => date('Y-m-d H:i:s')
                                        );
                       //print_r($rest);exit;
                    //print_r($insert_array);exit;
                    $this->common_model->insertData('sys_payment_info', $insert_array);
                    $where_email = array('email'=>$mail);
                    
                    //Clinic 
                    $this->common_model->updateFields('sys_clinic',array('amount'=>$cost,'package'=>$package,'payment_status'=>2,'payment_from'=>$form_date,'payment_to'=>$end_date,'transaction_id'=>$charge->balance_transaction),$where_email);
                    //Employee
                    //$this->common_model->updateFields('sys_com_emp',array('payment_from'=>$form_date,'payment_to'=>$end_date,'transaction_id'=>$charge->balance_transaction),array('clinic_id' => $iid));
                    
                    $record_new = $this->common_model->getsingle('sys_email_setting', array('type' => 2), 'id,title,message');
                    
                    //$email_html = '<p>Dear '.$this->session->userdata('owner').','.$record_new->message.'.<br>Your Transation id :'.$charge->balance_transaction.'.'.'</p><p>Thanks,<br>Team Clinic,<br>Date: '.date('Y-m-d H:i:s');
                    
                    $email_html = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to Clinic</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"><a href="#">
                        <img style="height:70px;" src="' . IMGURL . 'Logo.png" /></a></td>
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear ' . $this->session->userdata('owner') . '</td>
                      </tr>
                      <tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          '.$record_new->message.'
                        </td>
                      </tr>

                              <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email :</strong>' .$mail . '</td>
          </tr>
          
          <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Your Transation id :</strong>'.$charge->balance_transaction.'</td>
          </tr>
          
          <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Date :</strong>'.date('Y-m-d H:i:s').'</td>
          </tr>
                               
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    The Clinic Team<br />
                    <a href="#">info@clinicq.com</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>

                    </body>
                    </html>';
                    
                    $this->load->library('email');
                    $config['charset'] = 'iso-8859-1';
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from('info@clinicq.com', 'Clinic Administrator');
                    $this->email->to($mail);
                    $this->email->cc('anand.caroldata@gmail.com');
                    $this->email->subject($record_new->title);
                    $this->email->message($email_html);
                    $this->email->send();
                    
                    redirect(SITEBASEURL.'patient');
//                       }else {
//                           echo "Email id not match.";
//                       }
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
 
}