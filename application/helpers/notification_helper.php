<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_mail($recipients, $subject, $message, $from='')
{
	$ci =& get_instance();
	$from_email = ($from=='')? "info@englishleap.com" : "info@englishleap.com";
	$ci->load->library('email');
	$ci->email->clear(TRUE);
	$ci->email->from($from_email, 'EnglishLeap'); 
	$ci->email->to($recipients);
//	$ci->email->cc(array('ajay.syscraft@gmail.com','admin@act.com'));
	$ci->email->set_mailtype("html");
	$ci->email->subject($subject);
	$ci->email->message($message);  
	$ci->email->send();
	return TRUE;
}	



function notification_ios($device_token,$data='')
{

// Put your private key's passphrase here:
$passphrase = config_item('passphrase');

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', getcwd().'/Certificates.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
  
  'ssl://gateway.sandbox.push.apple.com:2195', $err,
  //'ssl://gateway.sandbox.push.apple.com:2195', $err,
  $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if ($fp)
{



// Create the payload body
$body['aps'] = $data;

// Encode the payload as JSON
$payload = json_encode($body);



// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

// Close the connection to the server
fclose($fp);

  }

}


function notification_android($device_token,$data='')
{

  $apiKey = config_item('apiKey');
  # $device token must be an array
  $registrationIDs = array();

  $registrationIDs[] = $device_token;

  // Set POST variables
  $url = 'https://android.googleapis.com/gcm/send';

  $fields = array(
                  'registration_ids'  => $registrationIDs,
                  'data'              => $data,
                  );

  $headers = array( 
                      'Authorization: key=' . $apiKey,
                      'Content-Type: application/json'
                  );

  // Open connection
   $ch = curl_init();
   
          // Set the url, number of POST vars, POST data
          curl_setopt($ch, CURLOPT_URL, $url);
   
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
          // Disabling SSL Certificate support temporarly
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   
          // Execute post
          $result = curl_exec($ch);
      
          // Close connection
          curl_close($ch);
     }


function send_welcome_email_social($recipient,$name,$username,$password,$service)
{

                    $mail_subject    =  "Welcome to EnglishLeap!";    
            
                    $mail_body = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to EnglishLeap</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"><a href="#">
                        <img style="height:70px;" src="'.base_url().'assets/img/logo.png" /></a></td>
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear '.$name.'</td>
                      </tr>
                      <tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          Thank you for registering for an account on EnglishLeap with '.$service.'! You may also login thorugh website or mobile app with the help of below given credentials.
                        </td>
                      </tr>

                              <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">User name:</strong>'.$username.'</td>
          </tr>

             <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password:</strong>'.$password.'</td>
          </tr>

           <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:30px 10px 15px 10px;line-height:20px"><strong style="color:#000;float:left">Once you are logged in to your account, you will be able to able change your username and password.</td>
          </tr>
                               
                     <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    The EnglishLeap Team<br />
                    If you want to leave feedback email us at <a href="#">help@EnglishLeap.com</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>

                                                                                                                
</body>
                    </html>';   

                $from = 'support@englishleap.com';       
                send_mail($recipient, $mail_subject, $mail_body, $from);

}