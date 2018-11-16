<form  id="vendorfrm" method="post" name="vendorfrm">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container">
            <div class="venderreg_personal">
                <div class="vendersubhading border">  
                    <h2> Personal Details </h2> 
                </div>

                <div class="checkout-row push-top">
                    <div class="col-md-12 vendor">
                        <div class="labeltext "> <label>Mobile Phone Number</label> </div>
                        <input type="text" name="" value="" placeholder="+1" class="onenumber" readonly>
                        <input class="inputtext number" id="number" name="mobile" placeholder="Mobile Number" size="20" type="text">
                        <?php  if (form_error('mobile') != '') {
                                 echo form_error('mobile', '<span class="perror">', '</span>');
                        }?>
                    </div>
                    <div class="col-md-12 vendor">
                        <div class="labeltext "> <label>Confirm Mobile Phone Number</label> </div>
                        <input type="text" name="" value="" placeholder="+1" class="onenumber" readonly>
                        <input class="inputtext number" id="confirmnumber" name="confirmnumber" placeholder="Confirm Mobile Number" size="30" type="text">
                        <?php  if (form_error('confirmnumber') != '') {
                                 echo form_error('confirmnumber', '<span class="perror">', '</span>');
                        }?>
                    </div>
<!--                    <div class="mustable"> 
                        <i class="fa fa-info-circle"></i>
                        <p> You must be able to receive text messages at this number to complete the application. </p> 
                    </div>-->
                </div> 
                <div class="vendersubhading"> <h2> Mailing Address  </h2> </div>
                <div class="checkout-row push-top">
                    <div class="col-md-12 vendor">
                        <div class="labeltext"> <label>Street Address</label> </div>
                        <input class="inputtext" id="address" name="address" type="text" required="required">
                    </div>
                    <div class="col-md-12 vendor">
                        <div class="labeltext "> <label>Apt # (optional)</label> </div>
                        <input class="inputtext apt" id="apt" name="apt"  type="text">
                    </div>
					<div class="col-md-12 vendor">
                                        <div class="labeltext"> <label>Country</label> </div>
                                        <select name="country" id="country" class="select_box" onchange="change_ajax_state(this.value)" required="required">
                                            <option value="">Select Country</option>
                                            <?php if(!empty($get_country)){
                                                    foreach ($get_country as $country):
                                                ?>
                                            <option value="<?php echo $country->id; ?>" <?php if($country->id == '236') { echo "selected"; }?>><?php echo $country->short_name; ?></option>
                                            <?php endforeach; } ?>
                                        </select>
                                               <?php
                                               if (form_error('country') != '') {
                                                   echo form_error('country', '<span class="perror">', '</span>');
                                               }
                                               ?> 
                                    </div>
					<div class="col-md-12 vendor">
                                        <div class="labeltext"> <label>State</label> </div>
                                        <select  class="select_box" name="state" id="change" required>
											<?php foreach($state as $rowss){ ?>
											<option value="<?php echo $rowss->region;?>"><?php echo $rowss->region;?></option>
											<?php } ?>					     
					   </select> 
                                        </div>
                    
                                        <div class="col-md-12 vendor">
                                        <div class="labeltext"> <label>City</label> </div>
                                        <input class="inputtext" id="city" name="city" type="text" required="required">
                                        </div>
                    
                                        <div class="col-md-12 vendor">
                                        <div class="labeltext"> <label>Zip Code</label> </div>
                                        <input class="inputtext" id="zipcode" name="zipcode" type="text" required="required">
                                        </div>


<!--                    <div class="mustable"> <i class="fa fa-info-circle"></i><p> You must be able to receive packages at this address.  </p> </div>-->

                </div>


                <div class="vendersubhading border"> <h2> Work Experience  </h2> </div>

                <div class="checkout-row push-top">
                    <div class="exp-line">
                        <div class="exp-q-select">  How much paid cleaning experience do you have?  </div>
                        <div class="col-md-12 vendor">
                            <select id="candidate_provider_years_pro_experience" name="candidate_provider" class="expperiance" required="required">
                                <option value="">Select</option>
                                <option value="0 - 6 months">0 - 6 months</option>
                                <option value="6 months - 1 year">6 months - 1 year</option>
                                <option value="1 year - 3 years">1 year - 3 years</option>
                                <option value="3 years - 5 years">3 years - 5 years</option>
                                <option value="5+ years">5+ years</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="vendersubhading border"> <h2> Other Info  </h2> </div>
                <div class="checkout-row push-top">
                    <div class="exp-line">
                        <div class="exp-q-part">Gender</div>
                        <div class="radio-circle">
                            <div class="mycar"> <input type="radio" name="gender" value="male"  class="radioyes">Male</div>
                            <div class="mycar"> <input type="radio" name="gender" value="female"  class="radioyes">Female</div>
                            <?php
                                               if (form_error('gender') != '') {
                                                   echo form_error('gender', '<span class="perror">', '</span>');
                                               }
                                               ?>
                        </div>
                    </div>
                </div>

                <div class="checkout-row push-top">
                    <input id="terms-checkbox" class="invalidrequired"  name="check" type="checkbox" required="required">
                    <p>I agree to 88 Home Pros Terms of Use, and by clicking the box and proceeding, I agree that 88 Home Pros or its representatives may contact me by email, phone, or SMS (including by automatic telephone dialing system) at the email address or number I provide, including for marketing purposes. I have read and understand the relevant Privacy Statement.</p>
                </div>

                <div class="checkout-row push-top">
                    <input class="pro-btn btn-primary" id="submit-candidate-provider" name="commit" value="Submit Your Application" type="submit">
                </div>
            </div>
        </div>
    </div>
</form>

<script  type="text/javascript">

function change_ajax_state(Str)
 {
	var datastring = "Country="+Str;
	$.ajax({
		url: "<?php echo base_url();?>front/vendors/change_state",
		data:datastring,
		type:"POST",
		cache: false,
		async: false,
		success:function(html)
		{
                   //alert(html); 
			$("#change").html(html);
		}
	});
 }
 
 </script>





