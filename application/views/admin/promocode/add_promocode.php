<div class="wrapper"><div class="page-heading">  
        <h3>Add Promocode </h3></div>  
    <?php
    $msg = "";
    if ($this->session->flashdata('upload_error')) {
        $class = "alert-success";
        $msg .= $this->session->flashdata('upload_error');
    } if ($msg != "") {
        ?>       
        <br/>     
        <div class="alert  <?php echo $class; ?> fade in">        
            <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>     
            <?php echo $msg; ?>                                     
        </div>       
    <?php } ?>  <div class="row">   
        <div class="col-lg-12">    
            <section class="panel">       
                <header class="panel-heading">    
                    <span class="tools pull-right">        
                        <span class="message"><?php echo MANDATORY; ?></span>   
                </header>      
                <div class="panel-body"> <span style="color:red"><?php echo validation_errors(); ?> <?php echo $this->session->flashdata('Register_error'); ?></span>       
                    <form role="form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data"  name="myForm" id="myForm">         
                             
                        <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4"> Title<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="promo_title" id="banner_title" class="form-control" required="required">    
                            </div>
                        </div> 
                         <div class="form-group">             
                    <label class="control-label col-sm-4">Promocode For<?php echo ASTRIK; ?></label>     
                   
                    <div class="col-sm-7">               
                        <select name="promo_for" class="form-control">             
                            <option value="">Please Select</option>    
                             <?php 
                        foreach($cat_details as $row){
                        $cat_name = $row->cat_name;
                        $cat_id = $row->cat_id;
                    
                    ?>
                            <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>   
                    <?php } ?>
                      </select>
                    </div>            
                </div>  
                     
                     <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4"><?php //echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="promo_code"  class="form-control" id='res_value' value="">    
                            </div>
                            <br/>
                            <br/>
                            <div class="col-sm-offset-7 col-sm-8">        
                                <button type="submit" class="btn btn-primary" name="banner_form" onclick='gen_code()' value="banner"> See Code</button>        
                     </div>    
                        </div> 
                         
                          <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4">Total Member<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="max_no_uses" id="banner_title" class="form-control" required="required">    
                            </div>
                        </div> 
                          <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4">Discount<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="promo_discount_val" id="banner_title" class="form-control" required="required">    
                            </div>
                        </div> 
                         <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4">Active On<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="created_date" id="datepicker" class="form-control" required="required">    
                            </div>
                        </div> 
                          <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4">Exprie On<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="expiry_date" id="datepickers" class="form-control" required="required">    
                            </div>
                        </div> 
                    <div class="form-group">             
                    <label class="control-label col-sm-4">Status<?php echo ASTRIK; ?></label>     
                    <div class="col-sm-7">               
                        <select name="status" class="form-control">             
                            <option value="">Please Select Status</option>        
                            <option value="1">Active</option>   
                            <option value="0">Inactive</option>        
                        </select>
                    </div>            
                </div>            
                <div class="col-sm-offset-4 col-sm-8">        
                    <button type="submit" class="btn btn-primary" name="banner_form" value="banner"> Submit</button>        
                </div>           
                </form>
                        
                </div>                
        </div> 
        </section>   
    </div> 
</div></div><link rel="stylesheet" href="<?php echo base_url() ?>css/auto_select/chosen.css"> 
<link rel="stylesheet" href="<?php echo base_url() ?>js/docsupport/prism.css">
<script src="<?php echo base_url() ?>js/docsupport/chosen.jquery.js" type="text/javascript">
</script><script src="<?php echo base_url() ?>js/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script>  $(document).ready(function(){     var _URL = window.URL || window.webkitURL; $("#user").change(function(e) {        }); $("#banner_type").trigger('change'); var isValidImage = function(value) {           var file, img; var img_height, img_width; window.isportrait = false; if ((file = value.files[0])) {                img = new Image(); img.onload = function() {                    img_height = Number(this.naturalHeight); img_width = Number(this.naturalWidth); if (img_height < 457 || img_width < 571){ } else{}  imageLoaded(img_height, img_width); }; file.src = _URL.createObjectURL(file); }  }  $.validator.addMethod("isValidImage", function(value, element) {  return isValidImage(element); }, 'Please select a minimun width 571 px and height 457px'); $("#myForm").validate({          rules: {            userfile: {              accept:"jpg,png,jpeg,gif", }          }, messages: {          userfile:{                  required: "Select Image", accept: "Only image type jpg/png/jpeg/gif is allowed"              }             }        }); }); function readURL(input, item) {		if (input.files[0]) {	                    document.getElementById(item).style.display = "block"; var reader = new FileReader(); reader.onload = function (e) {                    $('#' + item).attr('src', e.target.result); }; reader.readAsDataURL(input.files[0]); }		}</script>
<script type="text/javascript">    var config = {      '.chosen-select'           : {}, '.chosen-select-prd'       :{}, '.chosen-select-brand'       :{}, '.chosen-select-city'       :{}, '.chosen-select-deselect'  : {allow_single_deselect:true}, '.chosen-select-no-single' : {disable_search_threshold:10}, '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'}, '.chosen-select-width'     : {width:"95%"}    }    for (var selector in config) {      $(selector).chosen(config[selector]); }</script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  $( function() {
    $( "#datepickers" ).datepicker();
  } );
  
   function gen_code() {
        //alert('test');
        $.ajax({
            url: "<?php echo site_url('promocode/promocode_gen'); ?>",
            success: function (result)
            {
               // alert(result);
                $('#res_value').val(result);
                
               // alert(result);
            }

        });

    } 
  </script>