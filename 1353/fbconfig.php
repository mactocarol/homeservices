<?php
session_start();
// added in v4.0.0
$con = mysqli_connect("localhost","carolhhp_service","L-7HF&gG0(GV","carolhhp_services");
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1871879703131479','07818056e7fa51c6369b542a4647ee9d' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://democarol.com/homeservices/1353/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
		 $email = $femail; 
			//*******************************************
			$sql="select user_id from ai_user where user_fb_id='".$fbid."'";
				$query=mysqli_query($con,$sql);

				if(mysqli_num_rows($query)>0)
				{
					if($row=mysqli_fetch_array($query))
					{
						$id=$row['user_id'];

						$sql="update ai_user set email='".$email."' where id='".$id."'";
						$q=mysqli_query($con,$sql);
						
					}
					
				}	
				else
				{
					
					$sql="insert into ai_user(first_name,last_name,email,user_fb_id,login_type) values('".$fbfullname."','".$fbfullname."','".$email."','".$fbid."','facebook')";
					$q=mysqli_query($con,$sql);
					$id=mysqli_insert_id($con);
										
				}
				//***************************************
    /* ---- header location after session ----*/
				?>
				<script>
				window.location="http://democarol.com/homeservices/front/login/checkuser/<?php echo $id; ?>";
				</script>
				<?php
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>