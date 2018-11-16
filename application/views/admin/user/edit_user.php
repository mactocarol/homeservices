<div class="wrapper">
    <div class="page-heading">
        <h3> Edit User</h3>
    </div>
    <?php
    $msg = "";
    if ($this->session->flashdata('upload_error')) {
        $class = "alert-success";
        $msg .= $this->session->flashdata('upload_error');
    }
    if ($msg != "") {
        ?>
        <br/>
        <div class="alert  <?php echo $class; ?> fade in">
            <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <?php echo $msg; ?>                                                          
        </div>
<?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading"> 
                    <span class="tools pull-right">  
                        <span class="message"><?php echo MANDATORY; ?></span>
                </header>
                <?php
                  
                $fname = $fetch_details->first_name;
                $lname = $fetch_details->last_name;
                $email = $fetch_details->email;
                $type = $fetch_details->type;
                $status = $fetch_details->status;
                ?>
                <div class="panel-body"> <span style="color:red"><?php echo validation_errors(); ?> <?php echo $this->session->flashdata('Register_error'); ?></span>
                    <form role="form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data"  name="myForm" id="myForm">
                       
                        <div class="form-group" id="category_section" style="<?php //echo $category_display; ?>">
                            <label class="control-label col-sm-4">First Name<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <input type="text" name="fname" id="banner_title" value="<?php echo $fname; ?>"class="form-control required">
                            </div>
                        </div>
                           <div class="form-group" id="category_section" style="<?php //echo $category_display; ?>">
                            <label class="control-label col-sm-4">Last Name<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <input type="text" name="lname" id="banner_title" value="<?php echo $lname; ?>"class="form-control required">
                            </div>
                        </div>
                           <div class="form-group" id="category_section" style="<?php //echo $category_display; ?>">
                            <label class="control-label col-sm-4">Email<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <input type="text" name="email" id="banner_title" value="<?php echo $email; ?>"class="form-control required">
                            </div>
                        </div>
                           <div class="form-group" id="category_section" style="<?php //echo $category_display; ?>">
                            <label class="control-label col-sm-4">Type<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                           
                                <input type="text" name="type" id="banner_title" value="<?php if($type == 1){ echo $user_type = "Customer"; }else{ echo $userf_type = "Vendor"; } ?>"class="form-control required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Status<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <select name="status" class="form-control">                  
                                    <option value=<?php if ($status = 1) {echo $value = 1;} ?>><?php if ($status == 1) {echo $type = "Active";} ?></option>  
                                    <option value=<?php if ($status = 0) {echo $value = 0;} ?>><?php if ($status == 0) {echo $type = "Inactive";  } ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-4 col-sm-8">
                         <button type="submit" class="btn btn-primary" name="banner_form" value="banner"> Update</button>
                       </div>
                    </form>
                </div>
            </section>

        </div>

    </div>

</div>
<link rel="stylesheet" href="<?php echo base_url() ?>css/auto_select/chosen.css">
<link rel="stylesheet" href="<?php echo base_url() ?>js/docsupport/prism.css">
<script src="<?php echo base_url() ?>js/docsupport/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
