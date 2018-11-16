<?php
       
		date_default_timezone_set("Asia/Kolkata");
        include('config.php');
        include('hybridauth/Hybrid/Auth.php');
        if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider']; 
        	
        	try{
        	
        	$hybridauth = new Hybrid_Auth( $config );
        	
        	$authProvider = $hybridauth->authenticate($provider);
			
	        $user_profile = $authProvider->getUserProfile();
	        
			if($user_profile && isset($user_profile->identifier))
	        {
				
				/*echo "<b>Name</b> :".$user_profile->displayName."<br>";
	        	echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
	        	echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
	        	echo "<img src='".$user_profile->photoURL."'/><br>";
	        	echo "<b>Email</b> :".$user_profile->email."<br>";	*/ 
				
				
	          
				$fname=uniqid().'.jpg';
				$image = file_get_contents($user_profile->photoURL); // sets $image to the contents of the url
			   // echo file_put_contents('/home/evyntsco/public_html/images/user/'.$fname.'', $image);
			    //die;
				$socialId = $user_profile->identifier;
				$uname=$user_profile->displayName;
				$nameParts = explode(' ',$uname); 
$first = $nameParts[0];
if(empty($nameParts[1]))
{
$last="";
}
else
{
$last = array_pop($nameParts);
}
				
				$email=$user_profile->email;
				$cdt=date("Y-m-d H:i:s");
				
				$sql="select user_id from ai_user where email='".$email."'";
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
					
					$sql="insert into ai_user(first_name,last_name,email,user_fb_id,login_type) values('".$first."','".$last."','".$email."','".$socialId."','facebook')";
					$q=mysqli_query($con,$sql);
					$id=mysqli_insert_id($con);
										
				}
				//print_r($id);die;
				?>
				<script>
				window.location="<?php echo $base_url; ?>front/login/checkuser/<?php echo $id; ?>";
				</script>
				<?php
	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : header("location: $base_url"); break;
                        case 1 : header("location: $base_url"); break;
                        case 2 : header("location: $base_url"); break;
                        case 3 : header("location: $base_url"); break;
                        case 4 : header("location: $base_url"); break;
                        case 5 : header("location: $base_url"); break;
                        case 6 : header("location: $base_url"); break;
                        case 7 : header("location: $base_url"); $twitter->logout(); break;
                        case 8 : header("location: $base_url"); break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }
?>