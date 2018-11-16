<div class="wrapper"><div class="page-heading">  
        <h3> Manage Plan </h3></div>  
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
    <?php } ?>
    <div class="row">   
        <div class="col-lg-12">    
            <section class="panel">       
                <header class="panel-heading">    
                    <span class="tools pull-right">        
                        <span class="message"><?php echo MANDATORY; ?></span>   
                </header>      
                <div class="panel-body"> 
                    <span style="color:red">
                        <?php echo validation_errors(); ?> 
                            <?php echo $this->session->flashdata('Register_error'); ?>
                    </span>       
                    <form role="form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data"  name="myForm" id="myForm">         

                        <div class="form-group" id="category_section">     
                            <label class="control-label col-sm-4">Title<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="plan_title" id="banner_title" class="form-control" required="required">    
                            </div>
                        </div> 
                        <div class="form-group">             
                            <label class="control-label col-sm-4">Parent Category<?php echo ASTRIK; ?></label>     
                            <div class="col-sm-7">               
                                <select name="plan_cat" id="plan_cat" class="form-control" onchange="get_cat(this.value);">
                                    <option value="">Select Category</option> 
                                    <?php if($main_cat != 'no'){
                                            foreach ($main_cat as $category){
                                        ?>
                                    <option value="<?php echo $category->cat_id; ?>"><?php echo $category->cat_name; ?></option> 
                                    <?php } }?>
                                </select>
                            </div>            
                        </div> 
<!--                        <div class="form-group">             
                            <label class="control-label col-sm-4">Plan For<?php echo ASTRIK; ?></label>     
                            <div class="col-sm-7">               
                                <select name="plan_for" class="form-control" onchange="myFunction(this.value)">   
                                    <option value="">Please Select</option>     
                                    <option value="1">Badroom</option>   
                                    <option value="2">Bathroom</option>   
                                </select>
                            </div>            
                        </div> -->
<!--                        <div class="form-group">             
                            <label class="control-label col-sm-4">Status<?php echo ASTRIK; ?></label>     
                            <div class="col-sm-7">               
                                <select name="plan_status" class="form-control" required="required">             
                                    <option value="">Please Select Status</option>        
                                    <option value="1">Active</option>   
                                    <option value="0">Inactive</option>        
                                </select>
                            </div>            
                        </div>-->
                        
<!--                        <div class="form-group">             
                            <label class="control-label col-sm-4">Plan Term</label>     
                            <div class="col-sm-7">               
                                <select name="plan_term" class="form-control" required="required">             
                                    <option value="">Select Plan</option>        
                                    <option value="3">3 Months</option>   
                                    <option value="6">6 Months</option>  
                                    <option value="12">12 Months</option>  
                                </select>
                            </div>            
                        </div>-->
                        
                        <div id="bath_thired_div">
                           <div class="row">
                   
                            </div>
                        </div>
                        
                <header class="panel-heading"> Extras</header><br/>
                <div class="row" id="img_box_1">
                <div class="col-sm-4">
                <div class="form-group" id="product_img_div">
                  <label class="control-label">Extra</label>
                  <input type='text' class="form-control" id="extra_1" name="extra[]"/>
                  </div>
                </div>
                <div class="col-sm-4">
                      <label class="control-label">Price</label>
                      <div class="form-group">
                          <input type='text' class='form-control' name="extra_price[]" id='price_1'/>
                      </div>
                </div>  
                <div class="col-sm-4">
                      <label class="control-label">&nbsp;</label>
                      <div class="form-group">
                        <input type="button" class="btn btn-primary" id="add_more_image" value="Add More"/>
                      </div>
                </div>
              </div>

                <div id="img_upload_section">
                <?php $id = 1; ?>
                </div>
                <input type="hidden" name="img_count" id="img_count" value="<?php echo $id;?>"/>
                        <div class="col-sm-offset-4 col-sm-8">        
                            <button type="submit" class="btn btn-primary" name="banner_form" value="banner">Submit</button>        
                        </div>           
                    </form>
                </div>                
        </div> 
        </section>   
    </div> 
</div>
<!--// for get sub categories....-->

<script type="text/javascript">
    // for fget sub categories..
    function get_cat(iid)
    {
        //alert(iid);
        //return false;
        $.ajax({
            url: "<?php echo base_url().('plan/get_all'); ?>/"+iid,
            success: function (result)
            {
                alert(result);
                //return false;
                $('#bath_thired_div').html(result);
            }
        });
    }

    $(document).ready(function () {
        
     $(document).on("click",".remove_img_div",function(){
          $(this).closest(".row").remove();
      });

      $(document).on("click","#add_more_image",function(){
          var img_count = Number($("#img_count").val());
          img_count = Number(img_count) + 1;         
          $("#img_count").val(img_count);
          //if(img_count <= 3){
          var html = '';
          html += "<div class='row'>";
          html += "<div class='col-sm-4'>";
          html += "<div class='form-group' id='product_img_div'>";
          html += "<label class='control-label'>Extra</label>";
          html += "<input type='text' class='form-control' id='"+img_count+"' name='extra[]'/>";
          html += "</div>";
          html += "</div>";          
          html += "<div class='col-sm-4'>";
          html += "<label class='control-label'>Price</label>";
          html += "<div class='form-group'>";
          html += "<input type='text'  name='extra_price[]' class='form-control' id='price_"+img_count+"'/>";
          html += "</div>";
          html += "</div>";
          html+= "<div class='col-sm-4'>";
          html+= "<label class='control-label'>&nbsp;</label>";
          html+= "<div class='form-group'>";
          html+= "<img src='<?php echo base_url();?>assets/images/bt_delete.png' style='cursor:pointer' title='Remove Image' class='remove_img_div'/>";
          html+= "</div>";
          html+= "</div>";
          html += "</div>";
          $("#img_upload_section").append(html);
      //}else{
         // alert('Please Add only 3 fields.');
     // }
      });
        
    });

    function myFunction(id) {
        alert(id);
        if (id == 1) {
            document.getElementById('first_div').style.display = 'block';
            document.getElementById('second_div').style.display = 'block';
            document.getElementById('thired_div').style.display = 'block';
            document.getElementById('bath_first_div').style.display = 'none';
            document.getElementById('bath_second_div').style.display = 'none';
            document.getElementById('bath_thired_div').style.display = 'none';
        }
        if (id == 2) {
            document.getElementById('bath_first_div').style.display = 'block';
            document.getElementById('bath_second_div').style.display = 'block';
            document.getElementById('bath_thired_div').style.display = 'block';
            document.getElementById('first_div').style.display = 'none';
            document.getElementById('second_div').style.display = 'none';
            document.getElementById('thired_div').style.display = 'none';
        }
    }
</script>

