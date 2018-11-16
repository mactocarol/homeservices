<div class="wrapper"><div class="page-heading">  
        <h3>Edit Location </h3></div>  
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
                       <div class="form-group" id="category_section" style="<?php //echo $category_display;  ?>">     
                            <label class="control-label col-sm-4">City<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="street" id="street" class="form-control" value="<?php echo $get_record->city; ?>" required="required">    
                            </div>
                        </div>
                        
                       <div class="form-group" id="category_section">     
                            <label class="control-label col-sm-4">Zip Code<?php echo ASTRIK; ?></label>      
                            <div class="col-sm-7">             
                                <input type="text" name="zipcode" id="zipcode" value="<?php echo $get_record->zip_code; ?>" class="form-control" required="required">    
                            </div>
                        </div>
                    <div class="form-group">             
                    <label class="control-label col-sm-4">Status<?php echo ASTRIK; ?></label>     
                    <div class="col-sm-7">               
                        <select name="status" class="form-control" required="required">             
                            <option value="">Please Select Status</option>
                            <option value="Active" <?php if ($get_record->status == 'Active') {echo 'selected="selected"'; } ?>>Active</option>
                            <option value="Inactive" <?php if ($get_record->status == 'Inactive') { echo 'selected="selected"'; }?>>Inactive</option>
                        </select>
                    </div>            
                    </div>
                <div class="col-sm-offset-4 col-sm-8">        
                    <button type="submit" class="btn btn-primary" name="banner_form" value="banner"> Submit</button>        
                </div>           
                </form>
                </div>                
        </div> 
            <div style="display: none;"><?php echo $map['html']; ?></div>
        </section>   
    </div> 
</div></div>



