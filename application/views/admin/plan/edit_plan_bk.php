<div class="wrapper"><div class="page-heading">  
        <h3> Update Plan </h3></div>  
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
                                <input type="text" name="plan_title" id="banner_title" class="form-control" required="required" value="<?php echo $get_plan->plan_title; ?>">    
                            </div>
                        </div> 
                        <div class="form-group">             
                            <label class="control-label col-sm-4">Parent Category<?php echo ASTRIK; ?></label>     
                            <div class="col-sm-7">               
                                <select name="plan_cat" class="form-control">   
<!--                                    <option value="">Please Select Category</option>     -->
                                    <option value="1">Home Cleaning</option>   
                                    <option value="2">Vacation Rental Cleaning</option>   
                                </select>
                            </div>            
                        </div> 
                        <div class="form-group">             
                            <label class="control-label col-sm-4">Plan For<?php echo ASTRIK; ?></label>     
                            <div class="col-sm-7">               
                                <select name="plan_for" class="form-control" onchange="myFunction(this.value)">   
                                    <option value="">Please Select</option>     
                                    <option value="1">Badroom</option>   
                                    <option value="2">Bathroom</option>   
                                 
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
                        <div id="first_div" style="display: none;">
                            <header class="panel-heading">3 Month Plan</header>
                    <div class="row">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="badroom" name="badroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="3" name="month_fst"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="per_hours_fst"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="per_price_fst"  placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="original_price_fst"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="discount_price_fst"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
              </div>
                  <div id="bath_first_div" style="display: none;">
                  <header class="panel-heading">3 Month Plan</header>
                  <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="bathroom" name="bathroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="3" name="bath_month_fst"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="bath_hours_fst"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="price_bath_fst" placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_org_price_fst"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_dis_price_fst"  placeholder="Discount price"/>
                      </div>
                  </div>
                  </div>
                  </div>
              
                           <div id="second_div" style="display: none;"> 
                            <header class="panel-heading">6 Month Plan</header>
                     <div class="row">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="badroom" name="badroom_six"  placeholder="month"/>
                      </div>
                      </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="6" name="month_six"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="per_hours_six"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="per_price_six"  placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="original_price_six"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="discount_price_six"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
                            </div>
                           <div id="bath_second_div" style="display: none;">
                                  <header class="panel-heading">6 Month Plan</header>
                           <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="bathroom" name="bathroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="6" name="bath_month"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="bath_hours_six"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="price_bath_six" placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_ori_price_six"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_dis_price_six"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
</div>
                            <div id="thired_div" style="display: none;">
                            <header class="panel-heading">12 Month Plan</header>
                           <div class="row">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="badroom" name="badroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="12" name="month"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="per_hours_tweleve"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="per_price_tweleve"  placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="original_price_tweleve"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="discount_price_tweleve"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
            </div>
                   <div id="bath_thired_div" style="display: none;">
                    <header class="panel-heading">12 Month Plan</header>
                           <div class="row" id="img_box_1">
                    <div class="col-sm-2">
                      <label class="control-label">Plan For</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="bathroom" name="bathroom"  placeholder="month"/>
                      </div>
                  </div>
              <div class="col-sm-2">
                      <label class="control-label">For Month</label>
                      <div class="form-group">
                          <input type='text' class='form-control' value="12" name="bath_month"  placeholder="month"/>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <label class="control-label">Per Hours</label>
                      <div class="form-group">
                             <input type='text' class='form-control' value="1" name="bath_hours_tweleve"  placeholder="month"/>
                      </div>
                  </div>
                 <div class="col-sm-2">
                      <label class="control-label">Price/hours</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="price_bath_tweleve" placeholder="hours per price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Original price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_ori_price_tweleve"  placeholder="Totle price"/>
                      </div>
                  </div>
                <div class="col-sm-2">
                      <label class="control-label">Discount Price</label>
                      <div class="form-group">
                          <input type='number' class='form-control' name="bath_dis_price_tweleve"  placeholder="Discount price"/>
                      </div>
                  </div>
              </div>
              </div>
                        <div class="col-sm-offset-4 col-sm-8">        
                            <button type="submit" class="btn btn-primary" name="banner_form" value="banner">Update</button>        
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
            url: "<?php echo base_url() . ('plan/getsubcat'); ?>/" + id,
            success: function (result)
            {
                $('#catname').html(result);
            }
        });
    }
    
    function select_cat(){
    alert('sfsfsf');
    }    
    $(document).ready(function () {
        
    });
    
    function myFunction(id) {
     alert(id);
        if(id == 1){
            document.getElementById('first_div').style.display = 'block';
            document.getElementById('second_div').style.display = 'block';
            document.getElementById('thired_div').style.display = 'block';
            document.getElementById('bath_first_div').style.display = 'none';
            document.getElementById('bath_second_div').style.display = 'none';
            document.getElementById('bath_thired_div').style.display = 'none';
        }
          if(id == 2){
            document.getElementById('bath_first_div').style.display = 'block';
            document.getElementById('bath_second_div').style.display = 'block';
            document.getElementById('bath_thired_div').style.display = 'block';
            document.getElementById('first_div').style.display = 'none';
            document.getElementById('second_div').style.display = 'none';
            document.getElementById('thired_div').style.display = 'none';
        }
        
        
    }
</script>

