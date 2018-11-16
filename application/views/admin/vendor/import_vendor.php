<div class="wrapper">
<div class="page-heading">
    <h3>
   Import Vendor List
    </h3>
</div>
<?php $msg ="";
      if($this->session->flashdata('succ'))
      {
                
        $class = "alert-success";
        $msg .= $this->session->flashdata('succ');
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
        <div class="panel-body"> <span style="color:red"><?php echo validation_errors(); ?> <?php  echo $this->session->flashdata('Register_error'); ?></span>
          <form role="form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data" name="myForm" id="myForm">
            <div class="form-group">
              <label class="control-label col-sm-4">Import csv file<?php echo ASTRIK;?></label>
              <div class="col-sm-7">
                  <input type="hidden" name="fileHidden" value="yes"  />
                  <input type="file" name="imp_zip" id="imp_zip" required="required">
               </div>
            </div>
	
            <div class="col-sm-offset-4 col-sm-8">             
              <button type="submit" class="btn btn-primary" id="btn_status" name="submit">Import</button>            
            </div>
          </form>
        </div>
           </section>
  </div>
</div>
<script src="<?php echo base_url()?>js/docsupport/chosen.jquery.js" type="text/javascript"></script>
<script>
  $(document).ready(function(){
     $("#myForm").validate({
    rules: {    
        imp_zip: {
        required: true,
       extension: "csv"
      }
     } 
     
   });
  });
</script>