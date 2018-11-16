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
                <div class="panel-body"> <span style="color:red"><?php echo validation_errors(); ?> <?php echo $this->session->flashdata('Register_error'); ?></span>       
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
                                <select name="plan_cat" class="form-control">   
                                       <option value="">Please Select Category</option>     
                                       <option value="1">Home Cleaning</option>   
                                       <option value="2">Office Cleaning</option>   
                                       <option value="3">Vacation Rental Cleaning</option>   
                                   </select>
                        </div>            
                        </div>  
                         <div class="form-group">             
                            <label class="control-label col-sm-4">Status<?php echo ASTRIK; ?></label>     
                            <div class="col-sm-7">               
                                <select name="plan_status" class="form-control" required="required">             
                                    <option value="">Please Select Status</option>        
                                    <option value="1">Active</option>   
                                    <option value="0">Inactive</option>        
                                </select>
                            </div>            
                        </div>    
                          <div class="form-group">             
                            <label class="control-label col-sm-4">Status<?php echo ASTRIK; ?></label>     
                            <div class="col-sm-7" onclick="myFunction(this.value)">               
                                  <input type="checkbox" id="first_div" name="vehicle" value="3">3 Month<br>
                                  <input type="checkbox"  id="second_div" name="vehicle" value="6" checked>6 Month<br>
                                  <input type="checkbox" id="thired_div" name="vehicle" value="12" checked>12 Month<br>
                            </div>            
                        </div>   
                         <header class="panel-heading">Plan Fix</header><br/>
<!--                         for 3 month-->
               <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="badroom" name="badroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="3" name="month"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="per_hours"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="per_price[]"  placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="original_price[]"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="discount_price[]"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
                           <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="bathroom" name="bathroom[]"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="3" name="bath_month[]"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="bath_hours[]"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="price_bath[]" placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_original_price[]"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_discount_price[]"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
<!--                         //for six month-->
                          <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="badroom" name="six_badroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="6" name="six_month[]"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="six_per_hours[]"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="six_per_price[]" id='plan_duration_offer_1' placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="six_original_price[]"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="six_discount_price[]"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
                 <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="bathroom" name="six_bathroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="6" name="six_bath_month[]"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="six_bath_hours[]"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="six_bath_price[]"  placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="six_bath_original_price[]"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="six_bath_discount_six[]"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
<!--// for 12 month-->
                    <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="badroom" name="tweleve_badroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="12" name="twelevemonth[]"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="twelevehours[]"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="tweleve_bath_per_price[]" id='plan_duration_offer_1' placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="tweleve_bath_original_price[]"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="tweleve_bath_discount_price[]"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
  <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="bathroom" name="tweleve_bathroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="12" name="tweleve_bath_month[]"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="tweleve_bath_hours[]"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="tweleve_bath_price[]" id='plan_duration_offer_1' placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="tweleve_bath_original_price[]"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="tweleve_bath_discount[]"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
                   
                   <?php $id=1; ?>
                
              <div id="add_more_randomly">
             </div>
              <input type="hidden" name="readonly_section" id="readonly_section" value="<?php echo $id; ?>">
               <header class="panel-heading">Extras</header><br/>
               <?php $iid = 1; ?>
                <div class="row" id="img_extras">
                <div class="col-sm-3">
                      <label class="control-label">Title</label>
                      <div class="form-group">
                          <input type='text' class='form-control' name="extras_title[]" id='extras_title_1' placeholder="Duration"/>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <label class="control-label">Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="extras_price[]" id='extras_price_1' placeholder="Duration"/>
                      </div>
                  </div>
<!--                 <div class="col-sm-3">
                      <label class="control-label">Image</label>
                      <div class="form-group">
                          <input type='file' class='form-control' name="extras_image[]" id='extras_image_1' placeholder="Duration"/>
                      </div>
                  </div>-->
                 <div class="col-sm-3">
                      <label class="control-label">&nbsp;</label>
                      <div class="form-group">
                        <input type="button" class="btn btn-primary" id="add_more_extras" value="Add More"/>
                   </div>
                  </div>
              </div>
               <input type="hidden" name="readonly_section_extras" id="readonly_section_extras" value="<?php echo $iid; ?>">
                    
                <div id="add_more_extra">
                <?php $iid = 1; ?>
                    </div>
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
     function get_cat(id)
    {
      //  alert(id);
           $.ajax({
          url:"<?php echo base_url().('plan/getsubcat');?>/"+id,
          success: function (result)
           {
            $('#catname').html(result);
                 }
        });
         }
  function myFunction(id) {
     alert('test');
        if(id == 1){
            document.getElementById('first_div').style.display = 'block';
            //document.getElementById('second_div').style.display = 'none';
            //document.getElementById('thired_div').style.display = 'none';
        }
        
        
    }
</script>

 
 