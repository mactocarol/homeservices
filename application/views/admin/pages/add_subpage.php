<div class="row">
    <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add New User
                    </header>
                    <div class="panel-body">
                        <span style="color:red"><?php echo $this->session->flashdata('Register_error'); ?></span>
                        
                        <form role="form" onsubmit="return validateForm()" action="<?php echo base_url(); ?>AddUserPost" method="POST" enctype="multipart/form-data" name="myForm">
                            
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>First Name</b></label>
                               <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name">
                            </div>
                            
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Last Name</b></label>
                               <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last Name">
                            </div>
                            
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Email address</b></label>
                               <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Country</b></label>
                               <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>City</b></label>
                               <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Address</b></label>
                               <textarea class="form-control" id="address" name="address" cols="12" rows="3" placeholder="Enter Address"></textarea>
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Contact Number</b></label>
                               <input type="number" maxlength="10" class="form-control" id="contact" name="contact" placeholder="Enter Contact">
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Select Event Category</b></label>
                               <select class="form-control" multiple="" name="event_category[]" id="event_category" required>
                                    <?php
										foreach($category as $cat)
										{
									?>
                                    	<option value="<?php echo $cat->event_category_uid; ?>"><?php echo ucfirst($cat->event_category_name);?></option>
                                    <?php
										}
									?>
                               </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1"><b>Password</b></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1"><b>Confirm Password</b></label>
                                <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Password" required>
                                 <span style="color:red; display:none;" id="error">Password is not matched</span>
                            </div>
                            
                            <div class="form-group">
                            
                            	<div class="edit_profile">

                                    <img id="blah" src="#" alt="your image" style="display:none; width:20%; height:20%;"/>
									
								</div>
                            
                            
                                <label for="exampleInputFile"><b>Select Profile Image</b></label>
                                 <input type="file" name="userfile"  class="upload" title="Choose a file to upload" onChange="readURL(this,this.value)">
                                
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Submit</button>
                            
                        </form>

                    </div>
                </section>
            </div>
</div>

<script>

	function readURL(input,item) {	 
		if (input.files[0]) {	
				document.getElementById('blah').style.display = "block";
				//document.getElementById('blah9').style.display = "none";
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
			$("#dn").html("Change Profile");
		}
		
	function validateForm()
	{
		if((document.myForm.password.value)!=(document.myForm.con_password.value))  
		{   
			document.getElementById('error').style.display = 'block';  
			return(false);  
		} 
	 
	}


</script>