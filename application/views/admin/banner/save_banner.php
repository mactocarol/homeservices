<div class="wrapper">
<div class="page-heading">
    <h3>
      Manage Banner
    </h3>
</div>
      <?php $msg ="";
      if($this->session->flashdata('upload_error'))
      {
        $class = "alert-success";
        $msg .= $this->session->flashdata('upload_error');
      }
     if($msg!=""){?>
         <br />
        <div class="alert  <?php echo $class;?> fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
           <?php echo $msg;?>                                                          
       </div>
        <?php }?>
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading"> 
         <span class="tools pull-right">  <span class="message"><?php echo MANDATORY; ?></span></header>
        <div class="panel-body"> <span style="color:red"><?php echo validation_errors(); ?> <?php  echo $this->session->flashdata('Register_error'); ?></span>
            <form name="frm" id="frm" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
              <label class="control-label col-sm-4">Banner Image</label>
              <div class="col-sm-7">
                  <input type="file" name="banner" id="banner" value="">
              </div>
            </div>
                
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" class="btn btn-primary" name="banner_form" value="banner">Submit</button>
            </div>
                
            </form>
        </div>
      </section>
    </div>
  </div>
</div>
