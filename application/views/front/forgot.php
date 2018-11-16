<div class="inner_pages_section new_dv_login">
    <div class="login_page">
        <div class="container">
            <div class="login_inner">
                <h2>Reset your Password</h2>
                <div class="">You'll receive an email with a link to reset your password.</div>
                <?php echo flash_error_function(); ?>
                <form name="forgot_frm" id="forgot_frm" action="" method="post">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" tabindex="1" autocomplete="off" value="<?php echo set_value('email'); ?>">
                        <?php  if (form_error('email') != '') {
                                 echo form_error('email', '<span class="perror">', '</span>');}
                        ?>
                    </div>
                    <div class="buttonlogin">
                        <button type="submit" class="btn btn-default loginbtn" tabindex="2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
