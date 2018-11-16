<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function date_to_database($date){

	$datetime_parts = explode(' ', $date);
	$date_parts 	= explode('.', $datetime_parts[0]);
	$time_parts 	= (!empty($datetime_parts[1])) ? explode(':', $datetime_parts[1]) : false;
	
	$timestamp = mktime((!empty($time_parts[0])) ? $time_parts[0] : 0, (!empty($time_parts[1])) ? $time_parts[1] : 0, 0, (!empty($date_parts[1])) ? $date_parts[1] : 0, (!empty($date_parts[0])) ? $date_parts[0] : 0, (!empty($date_parts[0])) ? $date_parts[2] : 0);		

	return date("Y-m-d H:i:s", $timestamp);

}

/**
 * this method will display all the validation error at the top of the page just need to
 * call this funtion instant of validation_errors this will do all the formating itself.
 *
 * @return type
 */
function form_error_function() {
    return validation_errors('<div>* ', '</div>', '<div class="alert alert-error"><button data-dismiss="alert" class="close" type="button">�</button>', '</div>');
}

/**
 * This is supproting function for set_msg in extended model.
 * if you set anything this will help to show that message with the them.
 *
 * currently it is using 4 thmes
 *      1. red for error
 *      2. green for success
 *      3. blue for general message
 *      4. yellow for alert.
 *
 * @return string
 */
function flash_error_function() {
    $CI = & get_instance();
    if ($CI->session->flashdata('errorm')) {
        $div_class = ' alert-error';
        if ($CI->session->flashdata('errorm_theme')) {
            $theme = $CI->session->flashdata('errorm_theme');
            if ($theme == 'red') {
                $div_class = ' alert-danger';
            } else if ($theme == 'green') {
                $div_class = ' alert-success';
            } else if ($theme == 'blue') {
                $div_class = ' alert-info';
            } else if ($theme == 'yellow') {
                $div_class = ' alert-warning';
            }
        }
        $msg = '<div class="alert ' . $div_class . '">'.$CI->session->flashdata('errorm') . '</div>';

        //if you are using the userdata at the place of flash data then need to delete the session.
        /* $msg_arr = array(
          'errorm' => '',
          'errorm_theme' => ''
          );
          $CI->session->unset_userdata($msg_arr); */
        return $msg;
    } else {
        return '';
    }
}


function get_file_extension($str) 
{
    $i = strrpos($str,".");
    if (!$i) return "";
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

function randNumber($digits='')
{


if(! $digits)
$digits = 5;


$num =  rand(pow(10, $digits-1), pow(10, $digits)-1);

return $num;
}

function Check_Currency()
{
	$CI =& get_instance();
	if($CI->session->userdata('user_id')!="")
	{
		$rec = $CI->user_model->getNumOnlyRecord('settings',array('user_id'=>$CI->session->userdata('user_id'),'user_role'=>$CI->session->userdata('member_role')));
	 if($rec==0)
	 {
		 $CI->session->set_flashdata('err','Please select first your courrency.');
		 redirect(base_url().'settings/AddSettings');
	 }
	}
}

function generate_random_password() {
  //Initialize the random password
  $password = 'el' . randLetter() . randLetter() . rand(0,9);

  return strtolower($password);
}

function randLetter()
{
    $int = rand(0,6);
    $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $rand_letter = $a_z[$int];
    return $rand_letter;
}


function send_mail($recipients, $subject, $message, $from='')
{
	$ci =& get_instance();
	$from_email = ($from=='')? "info@EnglishLeap.com" : "info@EnglishLeap.com";
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

function range_week() {
        
    date_default_timezone_set(date_default_timezone_get());
    
    $dt = time();
    $start_date = (date('N', $dt) == 1) ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
    $end_date   = (date('N', $dt) == 7) ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));        

    $res = array();

    for ($i = 1; $i <= 7; $i++){
        if ($i === 1){
            $res[] = $start_date;
        }
        elseif ($i === 7){
            $res[] = $end_date;
        }
        else{
            $res[] = date("Y-m-d", strtotime('+ '.($i - 1).' day', strtotime($start_date)));
        }
    }

    return $res;
}


function create_thumbnail($w, $h, $path){

  $uploads = $_SERVER['DOCUMENT_ROOT'].'/upload_image/challenge/'; 
              
  $config = array(
    'image_library'  => 'gd2',
    'source_image'   => $path,
    'new_image'      => $uploads.basename($path),
    'create_thumb'   => true,
    'maintain_ratio' => true,
    'width'      => $w,
    'height'     => $h,
    'thumb_marker'   => '',
    'quality' => 100
  );
  
  $CI =& get_instance();  

  $CI->image_lib->initialize($config);

  $CI->image_lib->resize();       


}


function cretae_image_thumbinal($jpgimage,$outputfile)
{

  $maxwidth = 100;
$maxheight = 100;

$img = imagecreatefromjpeg($jpgimage); 
//or imagecreatefrompng,imagecreatefromgif,etc. depending on user's uploaded file extension

$width = imagesx($img); //get width and height of original image
$height = imagesy($img);

//determine which side is the longest to use in calculating length of the shorter side, since the longest will be the max size for whichever side is longest.    
if ($height > $width) 
{   
$ratio = $maxheight / $height;  
$newheight = $maxheight;
$newwidth = $width * $ratio; 
}
else 
{
$ratio = $maxwidth / $width;   
$newwidth = $maxwidth;  
$newheight = $height * $ratio;   
}


//create new image resource to hold the resized image
$newimg = imagecreatetruecolor($newwidth,$newheight); 

$palsize = ImageColorsTotal($img);  //Get palette size for original image
for ($i = 0; $i < $palsize; $i++) //Assign color palette to new image
{ 
$colors = ImageColorsForIndex($img, $i);   
ImageColorAllocate($newimg, $colors['red'], $colors['green'], $colors['blue']);
} 

//copy original image into new image at new size.
imagecopyresized($newimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($newimg,$outputfile); //$output file is the path/filename where you wish to save the file.  
//Have to figure that one out yourself using whatever rules you want.  Can use imagegif() or imagepng() or whatever.

}

function image_thumb( $image_path, $height, $width ) {

    // Get the CodeIgniter super object
    $CI =& get_instance();

    // Path to image thumbnail
    $image_thumb = dirname( $image_path ) . '/' . $height . '_' . $width . '.jpg';

    if ( !file_exists( $image_thumb ) ) {
        // LOAD LIBRARY
        $CI->load->library( 'image_lib' );

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
        $config['height']           = $height;
        $config['width']            = $width;
        $CI->image_lib->initialize( $config );
        $CI->image_lib->resize();
        $CI->image_lib->clear();
    }

   // return '<img src="' . dirname( $_SERVER['SCRIPT_NAME'] ) . '/' . $image_thumb . '" />';
}

function pmxi_copy_url_file($filePath, $detect = false){    
    
    $type = (preg_match('%\W(csv|txt|dat|psv)$%i', basename($filePath))) ? 'csv' : false;
    if (!$type) $type = (preg_match('%\W(xml)$%i', basename($filePath))) ? 'xml' : false;

    $uploads = $_SERVER['DOCUMENT_ROOT'].'/files/feeds';    
    $tmpname = basename($filePath);
    $localPath = $uploads  .'/'. $tmpname;              

    if (@file_exists($localPath)) @unlink($localPath);

    $file = @fopen($filePath, "rb");

    if (is_resource($file)){            
        $fp = @fopen($localPath, 'w');
        $first_chunk = true;
        while (!feof($file)) {
            $chunk = @fread($file, 1024);               
            if (!$type and $first_chunk and strpos($chunk, "<") !== false) $type = 'xml'; elseif (!$type and $first_chunk) $type = 'csv'; // if it's a 1st chunk, then chunk <? symbols to detect XML file
            $first_chunk = false;
            @fwrite($fp, $chunk);           
        }
        @fclose($file);
        @fclose($fp);       
    }

    if (!file_exists($localPath)) {
        
        get_file_curl($filePath, $localPath);

        if (!$type){                
            $file = @fopen($localPath, "rb");           
            while (!feof($file)) {
                $chunk = @fread($file, 1024);                   
                if (strpos($chunk, "<?") !== false) $type = 'xml'; else $type = 'csv'; // if it's a 1st chunk, then chunk <? symbols to detect XML file                 
                break;          
            }
            @fclose($file); 
        }
        
    }           
    
    return ($detect) ? array('type' => $type, 'localPath' => $localPath) : $localPath;
}

if ( ! function_exists('get_file_curl')):

    function get_file_curl($url, $fullpath, $to_variable = false) {
            
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $rawdata = curl_exec_follow($ch);
        
        $result = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close ($ch);

        if (!@file_put_contents($fullpath, $rawdata)){
            $fp = fopen($fullpath,'w');     
            fwrite($fp, $rawdata);
            fclose($fp);            
        }       

        return ($result == 200) ? (($to_variable) ? $rawdata : true) : false;        

    }

endif;

if (!function_exists('curl_exec_follow')):

    function curl_exec_follow($ch, &$maxredirect = null) {
      
      $mr = $maxredirect === null ? 5 : intval($maxredirect);

      if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
        curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      } else {
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

        if ($mr > 0)
        {
          $original_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
          $newurl = $original_url;
          
          $rch = curl_copy_handle($ch);
          
          curl_setopt($rch, CURLOPT_HEADER, true);
          curl_setopt($rch, CURLOPT_NOBODY, true);
          curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
          do
          {
            curl_setopt($rch, CURLOPT_URL, $newurl);
            $header = curl_exec($rch);
            if (curl_errno($rch)) {
              $code = 0;
            } else {
              $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
              if ($code == 301 || $code == 302) {
                preg_match('/Location:(.*?)\n/', $header, $matches);
                $newurl = trim(array_pop($matches));
                
                // if no scheme is present then the new url is a
                // relative path and thus needs some extra care
                if(!preg_match("/^https?:/i", $newurl)){
                  $newurl = $original_url . $newurl;
                }   
              } else {
                $code = 0;
              }
            }
          } while ($code && --$mr);
          
          curl_close($rch);
          
          if (!$mr)
          {
            if ($maxredirect === null)
            trigger_error('Too many redirects.', E_USER_WARNING);
            else
            $maxredirect = 0;
            
            return false;
          }
          curl_setopt($ch, CURLOPT_URL, $newurl);
        }
      }
      return curl_exec($ch);
    }
endif;

if ( !function_exists( 'esc_html' ) ) {
    function esc_html( $html, $char_set = 'UTF-8' ) {
        if ( empty( $html ) ) {
            return '';
        }
 
        $html = (string) $html;
        $html = htmlspecialchars( $html, ENT_QUOTES, $char_set );
 
        return $html;
    }
	
function ci_enc($str){
	$new_str = strtr(base64_encode(addslashes(@gzcompress(serialize($str), 9))), '+/=', '-_.');
	return $new_str;	
}




function ci_dec($str){
	$new_str = unserialize(@gzuncompress(stripslashes(base64_decode(strtr($str, '-_.', '+/=')))));
	return $new_str;
}



function getGeoLocation($address)
{
 $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$address."&sensor=true";
  

  $xml = simplexml_load_file($request_url) or die("url not loading");
  $status = $xml->status;
  if ($status=="OK") {
      $lat = $xml->result->geometry->location->lat;
      $long = $xml->result->geometry->location->lng;
 return  "$lat,$long";
  }
  else
  return false;
}


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

function randomString($length = 6) {
    $alphabets = range('A','Z');
    $numbers = range('1','9');
   $additional_characters = array('_','=');
    $final_array = array_merge($alphabets,$numbers);
       while($length--) {
      $key = array_rand($final_array);

      $password .= $final_array[$key];
                        }
  if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password))
    {
     return $password;
    }else{
    return  random_string();
    }

 }

function notification_android($device_token,$data='')
{

  
  $apiKey = 'AIzaSyAUxc6EwlgRP6MITCynw3_vsYatPI4iZuw';
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


function send_welcome_email_social($recipient,$name,$email,$password,$service)
{

                    $mail_subject    =  "Welcome to EnglishLeap";    
            
                    $mail_body = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to EnglishLeap</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"><a href="'.base_url().'">
                        EnglishLeap Logo</a></td>
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear '.$name.'</td>
                      </tr>
                      <tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          Thank you for registering for an account on EnglishLeap with '.$service.'! You can login through mobile app with the help of below given credentials.
                        </td>
                      </tr>

                              <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email:</strong>'.$email.'</td>
          </tr>

             <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password:</strong>'.$password.'</td>
          </tr>

           <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:30px 10px 15px 10px;line-height:20px"><strong style="color:#000;float:left">Once you are logged in to your account, you will be able to change your password.</td>
          </tr>
                               
                     <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    The EnglishLeap Team<br />
                    If you want to leave feedback email us at <a href="#">'.SITE_HELP_EMAIL.'</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>

                                                                                                                
</body>
                    </html>';   

                $from = SITE_SUPPORT_EMAIL;       
                send_mail($recipient, $mail_subject, $mail_body, $from);

}

function send_forgot_password_email($email,$password,$name){

                  $mail_subject    =  "[EnglishLeap] Reset password ";    
            
                    $mail_body = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to EnglishLeap</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;">
                        <a href="#"><img src="http://192.168.88.129/svn/englishleap/englishleap/images/logo.png"></a></td>
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear '.$name.'</td>
                      </tr>
                      <tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          Below you can find your login details:
                        </td>
                      </tr>
                    
                              <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email:</strong>'.$email.'</td>
          </tr>

             <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password:</strong>'.$password.'</td>
          </tr>

                               
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    The EnglishLeap Team<br />
                    If you want to leave feedback email us at <a href="#">'.SITE_HELP_EMAIL.'</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>

                    </body>
                    </html>';   

                $from = "help@englishleap.com";    
                send_mail($email, $mail_subject, $mail_body, $from);   

}//end function.

function send_update_profile_email($recipient,$name,$email,$password)
{

                    $mail_subject    =  "Welcome to EnglishLeap";    
            
                    $mail_body = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to EnglishLeap</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"><a href="'.base_url().'">
                       <img style="max-height:70px;" src="'.base_url().'images/logo.png" /></a></td>
                      </tr>
                      <tr>
                        <td>
                        <table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear '.$name.'</td>
                      </tr>
                      <tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          Thank you for registering for an account on EnglishLeap ! You can login through mobile app with the help of below given credentials.
                        </td>
                      </tr>

                              <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email:</strong>'.$email.'</td>
          </tr>

             <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password:</strong>'.$password.'</td>
          </tr>

           <tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:30px 10px 15px 10px;line-height:20px"><strong style="color:#000;float:left">Once you are logged in to your account, you will be able to change your password.</td>
          </tr>
                               
                     <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    The EnglishLeap Team<br />
                    If you want to leave feedback email us at <a href="#">'.SITE_HELP_EMAIL.'</a></td>
                      </tr>
                    </table>
                    </td>
                    </table>

                    </body>
                    </html>';   

                $from = SITE_SUPPORT_EMAIL;       
                send_mail($recipient, $mail_subject, $mail_body, $from);

}

//function for delete images 
function unlink_old_image($base_path,$img_name){

  $file_path = $base_path.$img_name;
  $thumb_path = $base_path.'thumb/'.$img_name;
  if(file_exists($file_path)){
    unlink($file_path);
  }

  if(file_exists($thumb_path)){
    unlink($thumb_path);
  }

}

function getipadd() {
    //ip address of user
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($ip != '::1') {
        $customer_ip_address = $ip;
    } else {
        $customer_ip_address = '127.0.0.1';
    }
    //check for proxy ip users
    $customer_proxy_ip_address = 'n/a';
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        $customer_proxy_ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $customer_proxy_ip_address;
    }
    if ($customer_proxy_ip_address == 'n/a') {
        return $customer_ip_address;
    }
}

function find_city_by_address($string){
 
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
   
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
   //print_r($response);exit;
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return null;
   } elseif(!empty($response['results'][0]['address_components'][0]['long_name'])) {
     return $response['results'][0]['address_components'][0]['long_name'];
   } else {
     return null;
   }
 
}

function find_address($string){
 
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
   
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
   //print_r($response);exit;
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return null;
   }  else {
     return $response;
   }
 
}


function getAgeInYear($dob){
                   //creating a date object
$date1 = date_create($dob);
//creating a date object
$date2 = date_create(date("d-m-Y"));

$diff12 = date_diff($date2, $date1);

$years = $diff12->y;

return $years;
     }

function getAgeInMonth($dob){
                //creating a date object
$date1 = date_create($dob);
//creating a date object
$date2 = date_create(date("d-m-Y"));

$diff12 = date_diff($date2, $date1);


//accesing months
$months = $diff12->m;
return $monthsj;

     }

function getAgeInDay($dob){
                //creating a date object
$date1 = date_create($dob);
//creating a date object
$date2 = date_create(date("d-m-Y"));

$diff12 = date_diff($date2, $date1);

//accesing days
$days = $diff12->d;
return $days;

     }