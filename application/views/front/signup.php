<div class="inner_pages_section new_dv_login">
    <div class="login_page">
        <div class="container">
            <div class="login_inner">
                <div class="white_bg">  <h2>Sign up to 88<span class="green">Home</span><span class="yellow">Pros</span></h2>
                    <?php echo flash_error_function(); ?>
                    <form class="form-horizontal" name="sign_up" id="sign_up" action="" method="post">
                        <div class="margin_20">
                            <label>Your Email-id</label>
                            <input class="form-control" id="email" name="email" placeholder="Email" type="email" autocomplete="off" tabindex="1" value="<?php echo set_value('email'); ?>">
                            <?php  if (form_error('email') != '') {
                                 echo form_error('email', '<span class="perror">', '</span>');}
                            ?>
                        </div>

                        <div class="margin_20">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>First Name</label>
                                    <input class="form-control" id="first_name" placeholder="First Name" type="text" name="first_name" autocomplete="off" tabindex="2" value="<?php echo set_value('first_name'); ?>">
                                    <?php  if (form_error('first_name') != '') {
                                    echo form_error('first_name', '<span class="perror">', '</span>');}
                                    ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="inputEmail">Last Name</label>
                                    <input class="form-control" id="last_name" name="last_name" placeholder="Last Name" type="text" autocomplete="off" tabindex="3" value="<?php echo set_value('last_name'); ?>">
                                    <?php  if (form_error('last_name') != '') {
                                    echo form_error('last_name', '<span class="perror">', '</span>');}
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="margin_20">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>Password </label>
                                    <input class="form-control" id="password" name="password" placeholder="*********" type="password" autocomplete="off" tabindex="4">
                                    <?php if(form_error('password') != ''){  echo form_error('password','<span class="perror">','</span>'); }?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="inputEmail">Confirm Password</label>
                                    <input class="form-control" id="confirm_password" name="confirm_password" placeholder="**********" type="password" autocomplete="off" tabindex="5">
                                    <?php if(form_error('confirm_password')!= ''){ echo form_error('confirm_password','<span class="perror">','</span>');} ?>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default loginbtn">Submit</button>
                        </div>
						
			<div class="vender_registration"><a href="<?php echo base_url(); ?>Vendors">Vendor Registration</a>
                    </form>
                </div>
            </div>
        </div> <!--//container-->
    </div>
</div>
