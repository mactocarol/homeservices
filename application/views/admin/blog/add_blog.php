<div class="wrapper"><div class="page-heading">  
        <h3> Add Blog </h3></div>  
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
                        <div class="form-group">     
                            <label class="control-label col-sm-4">Blog Image<?php echo ASTRIK; ?></label> 
                            <div class="col-sm-7">
<!--                                <input type="file" name="banner_img" id="banner_img">-->
                                <input type="file" class="form-control required" id="banner_img" name="post_img" onChange="readURL(this,'banner_image_view')">
                                <div class="valid_error" >                                     
                                    <?php
                                    if (form_error('banner_img') != '') {
                                        echo form_error('banner_img', '<span class="perror">', '</span>');
                                    }
                                    ?>  
                                </div>
                            </div>        
                        </div>         
                        <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4">Title<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="post_title" id="banner_title" class="form-control" required="required">    
                            </div>
                        </div> 
                        <div class="form-group" id="category_section" style="<?php //echo $category_display; ?>">
                            <label class="control-label col-sm-4">Discription<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <?php echo $this->ckeditor->editor('post_description');?> 
				<?php echo form_error('post_description','<p class="error">'); ?>
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
</div>

<link rel="stylesheet" href="<?php echo base_url() ?>css/auto_select/chosen.css"> 
<link rel="stylesheet" href="<?php echo base_url() ?>js/docsupport/prism.css">
<script src="<?php echo base_url() ?>js/docsupport/chosen.jquery.js" type="text/javascript">
</script><script src="<?php echo base_url() ?>js/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script>  $(document).ready(function(){     var _URL = window.URL || window.webkitURL; $("#user").change(function(e) {        }); $("#banner_type").trigger('change'); var isValidImage = function(value) {           var file, img; var img_height, img_width; window.isportrait = false; if ((file = value.files[0])) {                img = new Image(); img.onload = function() {                    img_height = Number(this.naturalHeight); img_width = Number(this.naturalWidth); if (img_height < 457 || img_width < 571){ } else{}  imageLoaded(img_height, img_width); }; file.src = _URL.createObjectURL(file); }  }  $.validator.addMethod("isValidImage", function(value, element) {  return isValidImage(element); }, 'Please select a minimun width 571 px and height 457px'); $("#myForm").validate({          rules: {            userfile: {              accept:"jpg,png,jpeg,gif", }          }, messages: {          userfile:{                  required: "Select Image", accept: "Only image type jpg/png/jpeg/gif is allowed"              }             }        }); }); function readURL(input, item) {		if (input.files[0]) {	                    document.getElementById(item).style.display = "block"; var reader = new FileReader(); reader.onload = function (e) {                    $('#' + item).attr('src', e.target.result); }; reader.readAsDataURL(input.files[0]); }		}</script>
<script type="text/javascript">    var config = {      '.chosen-select'           : {}, '.chosen-select-prd'       :{}, '.chosen-select-brand'       :{}, '.chosen-select-city'       :{}, '.chosen-select-deselect'  : {allow_single_deselect:true}, '.chosen-select-no-single' : {disable_search_threshold:10}, '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'}, '.chosen-select-width'     : {width:"95%"}    }    for (var selector in config) {      $(selector).chosen(config[selector]); }</script>