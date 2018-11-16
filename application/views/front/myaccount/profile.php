<!-----banner_img--->
<div id="cms-page-title" class="cms-page-title text-center">
    <div id="cms-page-title-overlay">
        <div class="container">
            <div class="row">
                <div id="cms-page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <h1>My Dashboard</h1>
                </div>
                <div id="cms-breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo SITEBASEURL; ?>">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----banner_end--->
<div class="inner_pages_section">
    <section class="service padding_60">
        <div class="container">
            <div class="inner_profile">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="left_profile">
                        <div class="profile_img text-center">
                            <img src="https://www.unplan.in/assets/images/icon-default-profile.png" class="img-rounded" >
                            <p><?php echo $profile_details->first_name; ?>&nbsp;<?php echo $profile_details->last_name; ?></p>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">My Profile</a></li>
                            <li><a data-toggle="tab" href="#menu1">My Address </a></li>
                            <li><a data-toggle="tab" href="#menu2">My Orders</a></li>
                            <li><a data-toggle="tab" href="#menu3">Change Password</a></li>
                            <li><a data-toggle="tab" href="#menu4">Feedback</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="right_profile">
                        <div class="tab-content">
                            <!-----My Profile=---->
                            <div id="home" class="tab-pane fade in active">
                              <?php echo flash_error_function(); ?>
                              <h3>Manage Profile</h3>
                                <div class="mange_profile">
                                    <form name="profile_frm" id="my_prof" action="" method="post" enctype="form/multipart">
                                          
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="Name">First Name</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control"  type="text" tabindex="1" autocomplete="off" name="first_name" id="fullname" value="<?php echo $profile_details->first_name; ?>">
                       <div class="valid_error" >                                     
                         <?php  if (form_error('first_name') != '') {                                          
                         echo form_error('first_name', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="Name">Last Name</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control"  type="text" tabindex="1" autocomplete="off" name="last_name" id="fullname" value="<?php echo $profile_details->last_name; ?>">
                        <div class="valid_error" >                                     
                         <?php  if (form_error('last_name') != '') {                                          
                         echo form_error('last_name', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="email">Email ID</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control"  type="email" tabindex="2" autocomplete="off" name="email" id="email" value="<?php echo $profile_details->email; ?>">
                       <div class="valid_error" >                                     
                         <?php  if (form_error('email') != '') {                                          
                         echo form_error('email', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="mobile">Phone No</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control"  type="tel" name="mobile" id="mobile" tabindex="3" autocomplete="off" value="<?php echo $profile_details->phone; ?>">
                         <div class="valid_error" >                                     
                         <?php  if (form_error('mobile') != '') {                                          
                         echo form_error('mobile', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonlogin">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <button type="submit" class="btn btn-default loginbtn" tabindex="4">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                   <!----my address---->
                            <div id="menu1" class="tab-pane fade">
                                <h3>My Address </h3>
                                <div class="mange_profile">
                                    <form method="post" id="myaddress">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <input class="form-control"  name="mobile" type="tel" placeholder="Enter Mobile Number" value="<?php echo $profile_details->phone; ?>">
                                                      <div class="perror perror_off" id="phone"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <input class="form-control"  name="address" type="Text" placeholder="House Number, Street No" value="<?php echo $profile_details->house_number; ?>">  
                                                    <div class="perror perror_off" id="address"></div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <input class="form-control" name="landmark"  type="Text" placeholder="Landmark" value="<?php echo $profile_details->landmark; ?>">
                                                      <div class="perror perror_off" id="landmark"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <input class="form-control" name="location" type="Text" placeholder="Enter Location" value="<?php echo $profile_details->geo_location; ?>">
                                                      <div class="perror perror_off" id="location"></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <select class="form-control" name="country">
                                                        <option value="<?php //echo $country_name; ?>"><?php echo $profile_details->country; ?></option>
                                                        <?php
                                                        //print_r($country);
                                                        foreach($country as $row){
                                                            $country_name = $row->name;
                                                           ?>                                                                                                                ?>
                                                        <option value="<?php echo $country_name; ?>"><?php echo $country_name; ?> </option>
                                                      <?php } ?>
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <input class="form-control" name="zipcode" type="Text" placeholder="Pincode" value="<?php echo $profile_details->zipcode; ?>">
                                                   <div class="perror perror_off" id="zipcode"></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="buttonlogin">
                                            <div class="form-group">
                                                <div class="row">

                                                    <div class="col-xs-12  padding_bottom_j">
                                                        <button type="submit" class="btn btn-default loginbtn">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!---address end---->
                            <div id="menu2" class="tab-pane fade">
                                <h3>My Orders</h3>
                                <div class="mange_profile"><p>Your recent Orders.</p>
                                <?php if(isset($order_history) && $order_history != 'no'){
                                        $i = 0;
                                        foreach($order_history as $row){
                                            if($row->fullprice != '' && $i < 5){?>
                                        <p><strong>Service</strong> - <?php print_r(implode(' ',explode('-',$row->cat_id)));?></p>
                                        <p><strong>Plan</strong> - <?php print_r($row->monthly_plan);?></p>
                                        <p><strong>Amount</strong> - <?php print_r($row->fullprice.'$');?></p>
                                        <p><strong>Booking Date</strong> - <?php print_r($row->booking_date);?></p>
                                        <p><strong>Status</strong> - <?php print_r($row->booking_status);?></p><br><br>
                                <?php } $i++; } }else{ ?>                                
                                <p>No Orders yet.</p>
                                <?php } ?>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <h3>Change Password</h3>
                                <div class="mange_profile">
                                    <p id="sucess" style="text-align: center;"><b></b></p>
                                    <form method="post" id="change_pass">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="email">Old Password</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control" name="password" type="password" placeholder="Old Password">
                                                      <div class="perror perror_off" id="opass"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="email">New Password</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control" name="newpassword" type="password" placeholder="New Password">
                                                     <div class="perror perror_off" id="newpass"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="email">Confirm Password</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control" name="reppassword" type="password" placeholder="Confirm Password">
                                                     <div class="perror perror_off" id="reppass"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="buttonlogin">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">

                                                    </div>
                                                    <div class="col-xs-6">
                                                        <button type="submit" class="btn btn-default loginbtn">Change</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!----Feedback----->
                            <div id="menu4" class="tab-pane fade">
                                <h3>Give Us Feedback</h3>
                                <div class="mange_profile">
                                       <form method="post" id="comment">
                                             <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <input class="form-control" name="name" type="Text" placeholder="Name">
                                                       <div class="perror perror_off" id="fname"></div>
                                                    </div>
                                            </div>
                                          </div> 
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <input class="form-control" name="email" type="Text" placeholder="Email-Id">
                                                       <div class="perror perror_off" id="emailid"></div>
                                                    </div>
                                            </div>
                                          </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <textarea class="form-control" rows="5" name="message"></textarea>
                                               
                                                   <div class="perror perror_off" id="messsage"></div>
                                                   <span class="ng-binding">You have 1000 characters left.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttonlogin">
                                        <div class="form-group">
                                            <div class="row">

                                                <div class="col-xs-12 padding_bottom_j">
                                                    <button type="submit" class="btn btn-default loginbtn">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </form>
                                </div>
                            </div>
                    <!-----Feedback----->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
