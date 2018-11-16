<div class="inner_pages_section new_dv_login">
    <div class="login_page">
        <div class="container">
            <div class="login_inner">
                <h2>Sign in to 88<span class="green">Home</span><span class="yellow">Pros</span></h2>
                <div class="">Need an account?<a href="<?php echo SITEBASEURL; ?>Signup">Sign up!</a></div>
                <?php echo flash_error_function(); ?>
                <form name="login_frm" id="login_frm" action="" method="post">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" tabindex="1" value="<?php echo set_value('email'); ?>">
                        <?php  if (form_error('email') != '') {
                                 echo form_error('email', '<span class="perror">', '</span>');}
                            ?>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off" tabindex="2">
                        <?php  if (form_error('password') != '') {
                                 echo form_error('password', '<span class="perror">', '</span>');}
                            ?>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                        <a href="<?php echo SITEBASEURL; ?>Forgot-password" class="forgot_pass" >Forgot password?</a>
                    </div>
                    <div class="buttonlogin">
                        <button type="submit" class="btn btn-default loginbtn">Submit</button>
                    </div>
                    <div class="pad-top2">
                        <div class="or-line">
                            <span class="or-text">or</span>
                        </div>
                    </div>
                    <div class="form-fields-wrapper">
                        <a href="http://democarol.com/homeservices/login-with.php?provider=Facebook<?php //echo $login_url;?>" class="no-decoration block" data-event-name="facebook log in attempt"><div class="push-top center btn-default btn-facebook">
                                <i class="fa fa-facebook-square"></i>
                                Log in with Facebook
                            </div>
                        </a></div>
                </form>
            </div>
        </div>
    </div>
</div>
