<div class="wrapper">
    <div class="page-heading"><h3>Add New Category</h3></div>
    <?php
    $msg = "";
    if ($this->session->flashdata('upload_error')) {

        $class = "alert-success";
        $msg .= $this->session->flashdata('upload_error');
    }
    if ($msg != "") {
        ?>
        <br />
        <div class="alert  <?php echo $class; ?> fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <?php echo $msg; ?>                                                          
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add New Category <span class="tools pull-right">  <span class="message"><?php echo MANDATORY; ?></span>
                </header>
                <div class="panel-body"> <span style="color:red"><?php echo $this->session->flashdata('Register_error'); ?></span>
                    <form role="form" class="form" action="" method="POST" enctype="multipart/form-data" name="myForm" id="myForm">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Add Category as</label>
                                </div>
                            </div>
                            <div class="col-sm-8">  
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" id="parent_category" name="category" checked="checked" value="parent_category" onclick="check_non_display()"> Parent Category </label>
                                    <label class="radio-inline"><input type="radio" id="sub_category" name="category" value="sub_category" onclick="check_display()"> Sub Category</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="parent_event_div" style="display:none;">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Select Category</label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select class="form-control required" name="event_category" id="event_category" required="required">
                                        <option value="0">Select Parent Category</option>
                                        <?php
                                        foreach ($parent as $par) {
                                            $first_uid = $par->cat_id;
                                            $second_uid = $rec->cat_parent_id;
                                            ?>
                                            <option value="<?php echo $par->cat_id; ?>"><?php echo ucfirst($par->cat_name); ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block" style="color:red; display:none;" id="error">Please select atleast one parent event</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Category Name<?php echo ASTRIK; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="cat" name="cat" placeholder="Enter Category Name" value="" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Category Image<?php echo ASTRIK; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <img id="front_image_view" alt=" " style="width:20%; height:20%; margin-bottom:2px;"/> 
                                    <input type="file" class="form-control" id="cat_picture" name="cat_picture" onChange="readURL(this, 'front_image_view')" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Category Decription</label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <?php echo $this->ckeditor->editor('category_desc'); ?> 
                                    <?php echo form_error('product_description', '<p class="error">'); ?>	 
                                </div>
                            </div>
                        </div>

                        <header class="panel-heading"> Category Attribute</header><br/>
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Recurring</a></li>
                            <li><a data-toggle="tab" href="#menu1">Fixed</a></li>                            
                          </ul>
                          
                          <div class="tab-content">
                            <div id="home" class="tab-pane fade in active"><br>                              
                                <!-- start recurring div -->
                                <div class="row" id="img_box_1">
                                    <div class="col-sm-2">
                                        <div class="form-group" id="product_img_div">
                                            <label class="control-label">Professionals</label>
                                            <input type='text' class="form-control" id="professionals_1" name="professionals[]" placeholder="Professionals" />
                                        </div>
                                    </div>
        
                                    <div class="col-sm-1">
                                        <label class="control-label">Unit</label>
                                        <div class="form-group">
                                            <input type='number' class='form-control' name="unit[]" id='unit_1' placeholder="Unit"/>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-1">
                                        <label class="control-label">Hours</label>
                                        <div class="form-group">
                                            <input type='text' class='form-control' name="hours[]"  readonly='readonly' id='hours_1' placeholder="Hours" value='1' />
                                        </div>
                                    </div>                            
                                    <div class="col-sm-2">
                                            <label class="control-label">Weekly Price</label>
                                            <div class="form-group">
                                                <input type='text' class='form-control' name="weekly_price[]" id='weekly_price_<?php echo $id;?>' value="" />
                                            </div>
                                        </div> 
        
                                        <div class="col-sm-2">
                                            <label class="control-label">BiWeekly Price</label>
                                            <div class="form-group">
                                                <input type='text' class='form-control' name="biweekly_price[]" id='biweekly_price_<?php echo $id;?>' value="" />
                                            </div>
                                        </div> 
        
                                        <div class="col-sm-2">
                                            <label class="control-label">Monthly Price</label>
                                            <div class="form-group">
                                                <input type='text' class='form-control' name="monthly_price[]" id='monthly_price_<?php echo $id;?>' value="" />
                                            </div>
                                        </div> 
        
                                    <div class="col-sm-1">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary" id="add_more_image" value="Add More"/>
        
                                        </div>
                                    </div>
                                </div>
                                <div id="img_upload_section">
                                    <?php $id = 1; ?>
                                </div>
                                <!-- end recurring div -->
                            </div>
                            <div id="menu1" class="tab-pane fade"><br>                              
                                    <!-- start fixed div -->
                                    <div class="row" id="img_box_1">
                                        <div class="col-sm-2">
                                            <div class="form-group" id="product_img_div">
                                                <label class="control-label">Professionals</label>
                                                <input type='text' class="form-control" id="professionals_1" name="professionals_fixed[]" placeholder="Professionals" />
                                            </div>
                                        </div>
            
                                        <div class="col-sm-1">
                                            <label class="control-label">Unit</label>
                                            <div class="form-group">
                                                <input type='number' class='form-control' name="unit_fixed[]" id='unit_1' placeholder="Unit"/>
                                            </div>
                                        </div>
            
                                        <div class="col-sm-1">
                                            <label class="control-label">Hours</label>
                                            <div class="form-group">
                                                <input type='text' class='form-control' name="hours_fixed[]"  readonly='readonly' id='hours_1' placeholder="Hours" value='1' />
                                            </div>
                                        </div>                            
                                        <div class="col-sm-2">
                                                <label class="control-label">Price</label>
                                                <div class="form-group">
                                                    <input type='text' class='form-control' name="fixed_price[]" placeholder="Price" id='fixed_price_<?php echo $idf;?>' value="" />
                                                </div>
                                        </div>             
                                        <div class="col-sm-1">
                                            <label class="control-label">&nbsp;</label>
                                            <div class="form-group">
                                                <input type="button" class="btn btn-primary" id="add_more_image_fixed" value="Add More"/>            
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end div -->
                                    <div id="img_upload_section_fixed">
                                    <?php $idf = 1; ?>    
                                    </div>
                                    
                                    <!-- Extras field -->
                                    <header class="panel-heading"> Extras</header><br/>
                                    <div class="row" id="img_box_1">
                                    <div class="col-sm-4">
                                    <div class="form-group" id="product_img_div">
                                      <label class="control-label">Extra</label>
                                      <input type='text' class="form-control" id="extra_1" name="extra[]" />
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
                                            <input type="button" class="btn btn-primary" id="add_more_image_extra" value="Add More"/>
                                          </div>
                                    </div>
                                  </div>
                    
                                    <div id="img_upload_section_extra">
                                        <?php $ide = 1; ?>
                                    </div>
                            </div>                            
                          </div>
                          
                        
                        
                        <header class="panel-heading"> Others</header><br/>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label class="control-label">Required Message</label>
                                    <input type='text' class="form-control" id="required_field" name="required_field_1" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="stuff_1">
                            <div class="col-sm-3">
                                <div class="form-group" id="product_img_div">
                                    <label class="control-label">Stuff</label>
                                    <input type='text' class="form-control" id="stuff_1" name="first_staff[]" />
                                </div>
                            </div>
                            
                                <div class="col-sm-2">
                                <label class="control-label">&nbsp;</label>
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary" id="add_more_stuff" value="Add More"/>
                                </div>
                            </div>
                            
                        </div> 

                        <div id="stuff_upload_section">
                            <?php $iid = 1; ?>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label class="control-label">Required Message 2</label>
                                    <input type='text' class="form-control" id="required_field" name="required_field_2" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="stuff_2">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Stuff</label>
                                    <input type='text' class="form-control" id="stuff_2" name="second_staff[]" />
                                </div>
                            </div>
                            
                                <div class="col-sm-2">
                                <label class="control-label">&nbsp;</label>
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary" id="add_more_stuff_2" value="Add More"/>
                                </div>
                            </div>
                            
                        </div> 

                        <div id="stuff_upload_section_2">
                            <?php $iid_2 = 1; ?>
                        </div>
                        
                        <header class="panel-heading"> Hourly Rate</header><br/>
                        <div class="row" id="hourly_box_1">
                            <div class="col-sm-3">
                                <div class="form-group" id="product_img_div">
                                    <label class="control-label">Hours</label>
                                    <input type='text' class="form-control" id="hourly_1" name="hourly[]" placeholder="Hours"/>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <label class="control-label">Price</label>
                                <div class="form-group">
                                    <input type='number' class='form-control' name="hourly_price[]" id='hourly_price_1' placeholder="Price"/>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label class="control-label">&nbsp;</label>
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary" id="add_more_hours" value="Add More"/>

                                </div>
                            </div>
                        </div>
                        <div id="hourly_section">
                            <?php $hid = 1; ?>
                        </div>

                        <input type="hidden" name="img_count" id="img_count" value="<?php echo $id; ?>"/>
                        <input type="hidden" name="img_count_fixed" id="img_count_fixed" value="<?php echo $idf; ?>"/>
                        <input type="hidden" name="img_count_extra" id="img_count_extra" value="<?php echo $ide; ?>"/>
                        <input type="hidden" name="stuff_field" id="stuff_field" value="<?php echo $iid; ?>"/>
                        <input type="hidden" name="stuff_field_2" id="stuff_field_2" value="<?php echo $iid_2; ?>"/>
                        <input type="hidden" name="hourly_field" id="hourly_field" value="<?php echo $hid; ?>"/>
                        <hr/>
                        <header class="panel-heading">SEO Detail</header><br/>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Meta Title<?php echo ASTRIK; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Meta Description<?php echo ASTRIK; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <textarea class="form-control" id="meta_desc" name="meta_desc" placeholder="Enter Meta Description" required="required"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Meta Tag<?php echo ASTRIK; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="meta_tag" name="meta_tag" placeholder="Enter Meta Tag" required="required"/>
                                </div>

                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Order</label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control required" id="cat_order" name="cat_order" placeholder="Enter catgory oder" required="required"/>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label class="control-label">Status<?php echo ASTRIK; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="is_active" class="form-control" required="required">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-4">&nbsp;</div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        //remove product image from page
        $(document).on("click", ".remove_img_div", function () {
            $(this).closest(".row").remove();
        });

        $(document).on("click", "#add_more_image", function () {
            var img_count = Number($("#img_count").val());
            img_count = Number(img_count) + 1;
            $("#img_count").val(img_count);
            if (img_count <= 3) {
                var html = '';
                html += "<div class='row'>";
                html += "<div class='col-sm-2'>";
                html += "<div class='form-group' id='product_img_div'>";
                html += "<label class='control-label'>Professionals</label>";
                html += "<input type='text' class='form-control' id='" + img_count + "' name='professionals[]' placeholder='Professionals'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-1'>";
                html += "<label class='control-label'>Unit</label>";
                html += "<div class='form-group'>";
                html += "<input type='number'  name='unit[]' class='form-control' id='unit_" + img_count + "' placeholder='Unit'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-1'>";
                html += "<label class='control-label'>Hours</label>";
                html += "<div class='form-group'>";
                html += "<input type='text'  name='hours[]' class='form-control'  readonly='readonly' id='hours_" + img_count + "' placeholder='Hours' value='1' />";
                html += "</div>";
                html += "</div>";
                
                html += "<div class='col-sm-2'>";
                html += "<label class='control-label'>Weekly Price</label>";
                html += "<div class='form-group'>";
                html += "<input type='text'  name='weekly_price[]' class='form-control' id='weekly_price_"+img_count+"' placeholder='Price'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-2'>";
                html += "<label class='control-label'>BiWeekly Price</label>";
                html += "<div class='form-group'>";
                html += "<input type='text'  name='biweekly_price[]' class='form-control' id='biweekly_price_"+img_count+"' placeholder='Price'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-2'>";
                html += "<label class='control-label'>Monthly Price</label>";
                html += "<div class='form-group'>";
                html += "<input type='text'  name='monthly_price[]' class='form-control' id='monthly_price_"+img_count+"' placeholder='Price'/>";
                html += "</div>";
                html += "</div>";


                html += "<div class='col-sm-2'>";
                html += "<label class='control-label'>&nbsp;</label>";
                html += "<div class='form-group'>";
                html += "<img src='<?php echo base_url(); ?>assets/images/bt_delete.png' style='cursor:pointer' title='Remove Image' class='remove_img_div'/>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                $("#img_upload_section").append(html);
            } else {
                alert('Please Add only 3 fields.');
            }
        });
        
         $(document).on("click", "#add_more_image_fixed", function () {
            var img_count = Number($("#img_count_fixed").val());
            img_count = Number(img_count) + 1;
            $("#img_count_fixed").val(img_count);
            if (img_count <= 3) {
                var html = '';
                html += "<div class='row'>";
                html += "<div class='col-sm-2'>";
                html += "<div class='form-group' id='product_img_div'>";
                html += "<label class='control-label'>Professionals</label>";
                html += "<input type='text' class='form-control' id='" + img_count + "' name='professionals_fixed[]' placeholder='Professionals'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-1'>";
                html += "<label class='control-label'>Unit</label>";
                html += "<div class='form-group'>";
                html += "<input type='number'  name='unit_fixed[]' class='form-control' id='unit_" + img_count + "' placeholder='Unit'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-1'>";
                html += "<label class='control-label'>Hours</label>";
                html += "<div class='form-group'>";
                html += "<input type='text'  name='hours_fixed[]' class='form-control'  readonly='readonly' id='hours_" + img_count + "' placeholder='Hours' value='1' />";
                html += "</div>";
                html += "</div>";
                
                html += "<div class='col-sm-2'>";
                html += "<label class='control-label'>Fixed Price</label>";
                html += "<div class='form-group'>";
                html += "<input type='text'  name='fixed_price[]' class='form-control' id='fixed_price_"+img_count+"' placeholder='Price'/>";
                html += "</div>";
                html += "</div>";                

                html += "<div class='col-sm-2'>";
                html += "<label class='control-label'>&nbsp;</label>";
                html += "<div class='form-group'>";
                html += "<img src='<?php echo base_url(); ?>assets/images/bt_delete.png' style='cursor:pointer' title='Remove Image' class='remove_img_div'/>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                $("#img_upload_section_fixed").append(html);
            } else {
                alert('Please Add only 3 fields.');
            }
        });
         
            $(document).on("click","#add_more_image_extra",function(){
              var img_count = Number($("#img_count_extra").val());
              img_count = Number(img_count) + 1;         
              $("#img_count_extra").val(img_count);
              if(img_count <= 5){
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
              $("#img_upload_section_extra").append(html);
          }else{
              alert('Please Add only 5 fields.');
          }
          }); 


        $(document).on("click", "#add_more_stuff", function () {
            var img_count = Number($("#stuff_field").val());
            img_count = Number(img_count) + 1;
            $("#stuff_field").val(img_count);
            var html = '';
            html += "<div class='row'>";
            html += "<div class='col-sm-3'>";
            html += "<div class='form-group'>";
            html += "<label class='control-label'>Staff</label>";
            html += "<input type='text' class='form-control' id='"+img_count+"' name='first_staff[]' />";
            html += "</div>";
            html += "</div>";
            
            html += "<div class='col-sm-3'>";
            html += "<label class='control-label'>&nbsp;</label>";
            html += "<div class='form-group'>";
            html += "<img src='<?php echo base_url(); ?>assets/images/bt_delete.png' style='cursor:pointer' title='Remove Image' class='remove_img_div'/>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            $("#stuff_upload_section").append(html);
        });
        
        $(document).on("click", "#add_more_stuff_2", function () {
            var img_count = Number($("#stuff_field_2").val());
            img_count = Number(img_count) + 1;
            $("#stuff_field_2").val(img_count);
            var html = '';
            html += "<div class='row'>";
            html += "<div class='col-sm-3'>";
            html += "<div class='form-group'>";
            html += "<label class='control-label'>Staff</label>";
            html += "<input type='text' class='form-control' id='"+img_count+"' name='second_staff[]' />";
            html += "</div>";
            html += "</div>";
            
            html += "<div class='col-sm-3'>";
            html += "<label class='control-label'>&nbsp;</label>";
            html += "<div class='form-group'>";
            html += "<img src='<?php echo base_url(); ?>assets/images/bt_delete.png' style='cursor:pointer' title='Remove Image' class='remove_img_div'/>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            $("#stuff_upload_section_2").append(html);
        });
        
        $(document).on("click", "#add_more_hours", function () {
            var img_count = Number($("#hourly_field").val());
            img_count = Number(img_count) + 1;
            $("#hourly_field").val(img_count);
            //if (img_count <= 3) {
                var html = '';
                html += "<div class='row'>";
                html += "<div class='col-sm-3'>";
                html += "<div class='form-group'>";
                html += "<label class='control-label'>Hours</label>";
                html += "<input type='text' class='form-control' id='" + img_count + "' name='hourly[]'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-2'>";
                html += "<label class='control-label'>Price</label>";
                html += "<div class='form-group'>";
                html += "<input type='number'  name='hourly_price[]' class='form-control' id='hourly_price_" + img_count + "' />";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-3'>";
                html += "<label class='control-label'>&nbsp;</label>";
                html += "<div class='form-group'>";
                html += "<img src='<?php echo base_url(); ?>assets/images/bt_delete.png' style='cursor:pointer' title='Remove Image' class='remove_img_div'/>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                $("#hourly_section").append(html);
            //} else {
               // alert('Please Add only 3 fields.');
            //}
        });
        
        

        $.validator.addMethod("specialChars", function (value, element) {
            var regex = new RegExp("^[a-zA-Z0-9&+ ]+$");
            var key = value;
            if (!regex.test(key)) {
                return false;
            }
            return true;
        }, "please use only alphanumeric or alphabetic characters");

        $.validator.addMethod("specialCharsForCat", function (value, element) {
            var regex = new RegExp("^[a-zA-Z0-9 ]+$");
            if (value.length > 0) {
                var key = value;
                if (!regex.test(key)) {
                    return false;
                }
            }

            return true;
        }, "please use only alphanumeric or alphabetic characters");

        //remove specification attribute under specification heading
        $(document).on("click", ".remove_attribute", function () {
            //alert('sf');
            $(this).closest("#attr_block").remove();

        });
        //remove specification heading
        $(document).on("click", ".remove_heading", function () {
            //alert('s');
            var attr_block = $(this).attr('id');
            $("#" + attr_block + "_block").remove();
        });
        //Product specification section
        //add specification heading along with attribute and value
        $("#add_specification_heading").on("click", function () {
            var heading = $("#spec_heading").val();
            var heading_div = $("#spec_heading").val();
            heading_div = heading_div.replace(/\s/g, "_");

            //alert(heading_name);
            var div_exist = $("#" + heading_div + "_block").length;
            //alert(div_exist);
            if (heading.length != 0 && Number(div_exist) == 0) {
                var html = '';
                html = "<div id='" + heading_div + "_block'>";
                html += "<div class='form-group'><div class='row'><div class='col-sm-12'><div class='btn-warning col-sm-12'><label>" + heading + "</label><span class='pull-right'><i class='fa fa-plus-circle add_more_attr' id='" + heading_div + "' style='cursor:pointer'> Add More Attribute</i> | <i class='fa fa-times-circle remove_heading' id='" + heading_div + "' style='cursor:pointer'> Delete Heading</i></span></div></div><div class='clearfix'></div></div></div>";
                html += "<div id='attr_block'>";
                html += "<div class='row'>";
                html += "<div class='col-sm-4'>";
                html += "<div class='form-group'>";
                html += "<label class='control-label'>Attribute</label>";

                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-6'>";
                html += "<div class='form-group'>";

                html += "<input type='text' class='form-control' id='attribute' name='attribute[" + heading_div + "][]' placeholder='Enter Product Attribute'/>";
                html += "</div>";
                html += "</div>";
                html += "<div class='col-sm-2'>";

                html += "<div class='form-group'>";
                html += "<img src='<?php echo base_url(); ?>images/bt_delete.png' style='cursor:pointer' title='Remove Attribute' class='remove_attribute'/>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                $("#spec_heading_section").append(html);
            }
            $("#spec_heading").val('');
        });
        $(document).on("click", ".add_more_attr", function () {//add more attribute in a particular specification heading
            var div_section = $(this).attr('id');
            //alert(div_section);
            var html = '';
            html = "<div class='row'>";
            html += "<div id='attr_block'>";
            html += "<div class='col-sm-4'>";
            html += "<div class='form-group'>";
            html += "<label class='control-label'>Attribute</label>";

            html += "</div>";
            html += "</div>";
            html += "<div class='col-sm-6'>";
            html += "<div class='form-group'>";

            html += "<input type='text' class='form-control' id='attribute' name='attribute[" + div_section + "][]' placeholder='Enter Product Attribute'/>";
            html += "</div>";
            html += "</div>";
            html += "<div class='col-sm-2'>";

            html += "<div class='form-group'>";
            html += "<img src='<?php echo base_url(); ?>images/bt_delete.png' style='cursor:pointer' title='Remove Attribute' class='remove_attribute'/>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            $("#" + div_section + "_block").append(html);
        });



    });
    function check_display()
    {
        document.getElementById('parent_event_div').style.display = 'block';
        document.getElementById('cat_banner_div').style.display = 'none';
    }

    function check_non_display()
    {
        document.getElementById('cat_banner_div').style.display = 'block';
        document.getElementById('parent_event_div').style.display = 'none';
    }
    function readURL(input, item) {
        //alert('s');	 
        if (input.files[0]) {
            document.getElementById(item).style.display = "block";
            //document.getElementById('blah9').style.display = "none";
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + item)
                        .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }

    }

</script>