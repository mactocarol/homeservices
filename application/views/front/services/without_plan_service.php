<?php
header("Cache-Control: no cache");
//session_cache_limiter("private_no_expire");
?>
<div class="inner_pages_section"> 
    <section class="price_main_pages">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-9 col-sm-9 col-xs-12">

                    <div class="rench">
                        <i>
                            <img src="<?php echo MEDIAURL; ?>category/<?php echo $single_parnt_img[0]->cat_picture; ?>" 
                                alt="First slide" height="100" width="">
                        </i> 
                    </div>
                    <p class="headprice"><?php echo $single_cate[0]->cat_name; ?></p>
                    <p class="headprice"><?php echo $single_cate[0]->cat_desc; ?></p>
                    
                </div>
                <div id="check_price_model_div"></div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="when-checkout-container center">
                        <form  class="simple_form new_quote_request" method='post'>
                            <div class="payment-content-wrapper">

                                <div style="margin:0;padding:0;display:inline">
                                    <input name="cat" id="cat" value="<?php echo $this->uri->segment(3); ?>" type="hidden">
                                </div>

                                <div class="checkout-row">
                                    <div class="when-main-header">Get a Price</div>
                                </div>

                                <div class="checkout-row">
                                    <div class="columns">
                                        <input class="string optional zipcode-field required when-font placeholder" 
                                               data-status="/bookings/service_zipcode_price" id="zipcode" maxlength="255" 
                                               name="zipcode" placeholder="ZIP Code" size="50" type="text" 
                                               value="<?php echo $this->session->userdata('zipcode'); ?>">
                                               <span class="perror" id="ziperror" style="display: none;">This Zipcode is required</span>
                                    </div>
                                </div>
                                <div class="when-section" id="service-details-section">
                                    <?php
                                    //print_r($single_items_record);exit;
                                    if ($single_items_record != '') {
                                        $decode_val = $single_items_record[0]->cat_attribute;
                                        if ($decode_val != '') {
                                            $pp = json_decode($decode_val);
                                            $tt = count($pp);
                                            if ($pp[0]->professionals != '') {
                                                ?>
                                                <div class="checkout-row">
                                                    <div class="when-sub-header pad-bot"><h4>Tell us about the job</h4></div>
                                                </div>
                                                <?php if ($tt == '1' && $pp[0]->professionals != '') { ?>
                                                    <div class="checkout-row stepper">
                                                        <div class="columns">
                                                            <div class="numbers-row">
																<input type='button' name='subtract' onclick='javascript: subtractQty();' value='-'/>
                                                                <span class="show_room"><input type='text' name='qty' id='qty' value='1'/><span><?php echo $pp[0]->professionals; ?></span></span>
                                                                <input type='button' name='add' onclick='javascript: addQty();' value='+'/>
                                                                <input type="hidden" name="plans_first" id="plans_first" value="<?php echo $pp[0]->professionals; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($tt == '2' && $pp[1]->professionals != '') { ?>
                                                    <div class="checkout-row stepper">
                                                        <div class="columns">
                                                            <div class="numbers-row">
																<input type='button' name='qty' onclick='javascript: subtractQty();' value='-'/>
                                                                <span class="show_room">
                                                                    <input type='text' name='qty' id='qty' value='1'/>
                                                                    <span><?php echo $pp[0]->professionals; ?></span>
                                                                </span>
                                                                <input type='button' name='add' onclick='javascript: addQty();' value='+'/>
                                                                <input type="hidden" name="plans_first" id="plans_first" value="<?php echo $pp[0]->professionals; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="columns">
                                                            <div class="numbers-row">   
                                                                <input type='button' name='subtract' onclick='javascript: medium_subtractQty();' value='-'/>
                                                                <span class="show_room"><input type='text' name='mediumqty' id='mediumqty' value='1'/><span><?php echo $pp[1]->professionals; ?></span></span>
																<input type='button' name='add' onclick='javascript:medium_addQty();' value='+'/>
                                                                <input type="hidden" name="plans_second" id="plans_second" value="<?php echo $pp[1]->professionals; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($tt == '3' && $pp[1]->professionals != '') { ?>
                                                    <div class="checkout-row stepper">
                                                        <div class="columns">
                                                            <div class="numbers-row"> 
                                                                <input type='button' name='qty' onclick='javascript: subtractQty();' value='-'/>
                                                                <span class="show_room">
                                                                    <input type='text' name='qty' id='qty' value='1'/>
                                                                    <span><?php echo $pp[0]->professionals; ?></span>
                                                                </span>
																<input type='button' name='add' onclick='javascript: addQty();' value='+'/>
                                                                <input type="hidden" name="plans_first" id="plans_first" value="<?php echo $pp[0]->professionals; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="columns">
                                                            <div class="numbers-row">   
                                                                <input type='button' name='subtract' onclick='javascript: medium_subtractQty();' value='-'/>
                                                                <span class="show_room"><input type='text' name='mediumqty' id='mediumqty' value='1'/><span><?php echo $pp[1]->professionals; ?></span></span>
																<input type='button' name='add' onclick='javascript:medium_addQty();' value='+'/>
                                                                <input type="hidden" name="plans_second" id="plans_second" value="<?php echo $pp[1]->professionals; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="columns">
                                                            <div class="numbers-row">   
                                                                <input type='button' name='subtract' onclick='javascript: large_subtractQty();' value='-'/>
                                                                <span class="show_room"><input type='text' name='largeqty' id='largeqty' value='1'/>
                                                                    <span><?php echo $pp[2]->professionals; ?></span></span>
                                                                <input type='button' name='add' onclick='javascript:large_addQty();' value='+'/>
																<input type="hidden" name="plans_third" id="plans_third" value="<?php echo $pp[2]->professionals; ?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php } ?>
                                            <?php }
                                        } ?>
                                    <?php } ?>
                                    <?php
                                   /* if ($single_cate[0]->hourly_rate != '') {
                                        $hours_record = $single_cate[0]->hourly_rate;
                                        $hh = json_decode($hours_record);
                                        //print_r($hh);exit;
                                        if ($hh[0]->hourly != '') {
                                            ?>
                                            <div id="q1_wrapper">
                                                <div class="form-line">
                                                    <div class="checkout-row">
                                                        <div class="column">
                                                            <p class="when-sub-header pad-bot">We recommend hours</p>
                                                            <div class="select-wrapper form-select-wrapper">
                                                                <select class="hb_select" id="hourly" name="hourly" onchange="testi(this.value)"  required>
                                                                    <option value="0">Please Select</option>
                                                                    <?php
                                                                    foreach ($hh as $hourly):
                                                                        ?>
                                                                    <option value="<?php echo $hourly->hourly.'~'.$hourly->hourly_price; ?>" > <?php echo $hourly->hourly . ' hours'; ?> </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                                <input type="hidden" name="hour_prc" id="hour_prc" value="">
                                                                <input type="hidden" name="hourly_time" id="hourly_time" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }*/
                                     if ($single_cate[0]->hourly_rate != '') {
                                        $hours_record = $single_cate[0]->hourly_rate;
                                        $hh = json_decode($hours_record);
                                        //print_r($hh);exit;
                                        if ($hh[0]->hourly != '') {
                                            ?>
											<p class="when-sub-header pad-bot"><input name="fixed_hourly_price" id="fixed_hourly_price" type="checkbox" onclick="enablehourlyprice()" style="width:14px; height:13px; margin-right:10px;" value="fixed_hours">Get Price Based on Hourly Rate</p>
                                            <div id="q1_wrapper" >
                                                <div class="form-line">
                                                    <div class="checkout-row">
                                                        <div class="column" id="hourly_div" style="display: none">
                                                            <p class="when-sub-header pad-bot">Select No. of Hours</p>
                                                            <div class="select-wrapper form-select-wrapper" id="hour_price" >
                                                                <select class="hb_select disabled" id="hourly" name="hourly" onchange="testi(this.value);" onclick="chekk();" disabled="true"  required>
                                                                    <option value="<?php echo $hh[0]->hourly.'~'.$hh[0]->hourly_price; ?>">Please Select</option>
                                                                    <?php
                                                                    foreach ($hh as $hourly):
                                                                        ?>
                                                                    <option value="<?php echo $hourly->hourly.'~'.$hourly->hourly_price; ?>" > <?php echo $hourly->hourly . ' hours'; ?> </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                                <input type="hidden" name="hour_prc" id="hour_prc" value="<?=$hh[0]->hourly_price?>">
                                                                <input type="hidden" name="hourly_time" id="hourly_time" value="<?=$hh[0]->hourly?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                    ?>
                                    <?php
        //                            if ($single_cate[0]->stuff_1 != '') {
        //                                $pttt = json_decode($single_cate[0]->stuff_1);
        //                                if ($single_cate[0]->required_field_1 != '' && $pttt[0]->stuff_1 != '') {
        //                                    ?>
                                           <!-- <div id="q1_wrapper">
        //                                        <div class="form-line">
        //                                            <div class="checkout-row">
        //                                                <div class="column">
        //                                                    <p class="when-sub-header pad-bot"><?php //echo $single_cate[0]->required_field_1; ?></p>                                                
        //                                                    <div class="select-wrapper form-select-wrapper">
        //                                                        <select class="hb_select" id="first_stuff" name="first_stuff">
        //                                                            <option >Please Select </option>
        //                                                            <?php
        //                                                            $pt = json_decode($single_cate[0]->stuff_1);
        //                                                            foreach ($pt as $stuffs):
        //                                                                ?>
        //                                                                <option value="<?php //echo $stuffs->stuff_1; ?>"> <?php //echo $stuffs->stuff_1; ?> </option>
        //    <?php
        //endforeach;
        //?>
        //                                                        </select>
        //                                                    </div>
        //                                                </div>
        //                                            </div>
        //                                        </div>
        //                                    </div>-->
                                        <?php //}
        //                            }
        
                                    if($single_cate[0]->stuff_1 != ''){
                                $pttt = json_decode($single_cate[0]->stuff_1);
                                if($single_cate[0]->required_field_1 != '' && $pttt[0]->stuff_1 != ''){ ?>
                                <div id="q1_wrapper" >
                                    <div class="form-line">
                                        <div class="checkout-row">
                                            <div class="column" id="helpers_div" style="display: none">
                                                <p class="when-sub-header pad-bot"><?php echo $single_cate[0]->required_field_1; ?></p>                                                
                                                <div class="select-wrapper form-select-wrapper">
                                                    <select class="hb_select disabled" id="helpers" name="helpers" disabled="true" required >
                                                        <!-- <option >Please Select </option> -->
                                                        <?php
                                                            $pt = json_decode($single_cate[0]->stuff_1);
                                                            foreach ($pt as $stuffs):
                                                                ?>
                                                                <option value="<?php echo $stuffs->stuff_1; ?>"> <?php echo $stuffs->stuff_1; ?> </option>
                                                                <?php
                                                            endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } }
                                    ?>

<?php
if ($single_cate[0]->staff_2 != '') {
    $pt_2 = json_decode($single_cate[0]->staff_2);
    if ($single_cate[0]->required_field_2 != '' && $pt_2[0]->stuff_2 != '') {
        ?>
                                            <div id="q1_wrapper">
                                                <div class="form-line">
                                                    <div class="checkout-row">
                                                        <div class="column">
                                                            <p class="when-sub-header pad-bot"><?php echo $single_cate[0]->required_field_2; ?></p>                                                
                                                            <div class="select-wrapper form-select-wrapper">
                                                                <select class="hb_select" id="second_stuff" name="second_stuff">
                                                                    <option >Please Select </option>
                                                                    <?php
                                                                    $pt = json_decode($single_cate[0]->staff_2);
                                                                    foreach ($pt as $stuffs):
                                                                        ?>
                                                                        <option value="<?php echo $stuffs->stuff_2; ?>"> <?php echo $stuffs->stuff_2; ?> </option>
            <?php
        endforeach;
        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    <?php }
} ?>
                                    <div class="checkout-row push-top">
                                        <div class="columns">
                                            <textarea class="placeholder" cols="40" id="booking_params_notes" name="job_desc" placeholder="Please describe the job in detail. (optional)" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="checkout-row">
                                    <div class="when-sub-header pad-bot">When would you like us to come?</div>
                                </div>
                                <div class="checkout-row">
                                    <div class="columns">
                                        <input class="pikaday when-font" id="datepicker"  name="on_date" type="text" placeholder="MM/DD/YYYY">
                                        <span class="perror" id="dateerror" style="display: none;">This Date is required</span>
<?php
if (form_error('on_date') != '') {
    echo form_error('on_date', '<span class="perror">', '</span>');
}
?>
                                    </div>
                                    <div class="columns">
                                        <div class="select-wrapper form-select-wrapper">
                                            <select id="quote_request_start_time" name="on_time">
                                                <option value="07:00 AM">7:00 AM</option>
                                                <option value="07:30 AM">7:30 AM</option>
                                                <option value="08:00 AM">8:00 AM</option>
                                                <option value="08:30 AM">8:30 AM</option>
                                                <option value="09:00 AM">9:00 AM</option>
                                                <option value="09:30 AM">9:30 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="10:30 AM">10:30 AM</option>
                                                <option value="11:00 AM">11:00 AM</option>
                                                <option value="11:30 AM">11:30 AM</option>
                                                <option value="12:00 PM">12:00 PM</option>
                                                <option value="12:30 PM">12:30 PM</option>
                                                <option value="01:00 PM">1:00 PM</option>
                                                <option value="01:30 PM">1:30 PM</option>
                                                <option value="02:00 PM">2:00 PM</option>
                                                <option value="02:30 PM">2:30 PM</option>
                                                <option value="03:00 PM">3:00 PM</option>
                                                <option value="03:30 PM">3:30 PM</option>
                                                <option value="04:00 PM">4:00 PM</option>
                                                <option value="04:30 PM">4:30 PM</option>
                                                <option value="05:00 PM">5:00 PM</option>
                                                <option value="05:30 PM">5:30 PM</option>
                                                <option value="06:00 PM">6:00 PM</option>
                                                <option value="06:30 PM">6:30 PM</option>
                                                <option value="07:00 PM">7:00 PM</option>
                                                <option value="07:30 PM">7:30 PM</option>
                                                <option value="08:00 PM">8:00 PM</option>
                                                <option value="08:30 PM">8:30 PM</option>
                                                <option value="09:00 PM">9:00 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 <div class="checkout-row push-top new_form_j">
                                    <div class="columns">
                                        <label>Name:</label>
                                        <input class="form-input" name="fname" id="fname" type="text" required="">
                                        <span class="perror" id="nameerror" style="display: none;">This Name is required</span>
                                    </div>
                                </div>
                                			<div class="checkout-row push-top new_form_j">
                                    <div class="columns">
                                        <label>Address:</label>
                                        <textarea class="form-control" rows="4" id="address" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="checkout-row push-top">
                                    <div class="columns">
                                        <input class="form-input when-font inspectletIgnore placeholder"  
                                               name="emailid" id="emailid" placeholder="Email Address" size="30" type="email">
                                         <span class="perror" id="emailerror" style="display: none;">This Email is required</span>
<?php
if (form_error('emailid') != '') {
    echo form_error('emailid', '<span class="perror">', '</span>');
}
?>

                                    </div>
                                </div>
                                <div class="when-continue-button-container checkout-row">
                                    <div class="columns">
                                        <button class="booking-continue-button btn-continue when-button btn-primary js-submit-payment" type="submit" id="getPrice1" >Get a Price</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="term_con">
                    <p>By submitting,I agree to receive updates & exclusive offer from Home Pros.Consent can be withdrawn at any time.For more details see our <a href="<?php echo base_url(); ?>Term-Condition" target="_blank">Terms of Use</a> or <a href="<?php echo base_url(); ?>Contact-us" target="_blank">Contact Us</a>.</p>
                </div>
            </div>
            </form>
        </div>

</div>
</div>
</section>
</div>
<script type="text/javascript">

function enablehourlyprice(){
		//alert('kkkkkkk');
		//$('#hourly').prop('disabled', true);
		if($("#fixed_hourly_price").prop('checked') === true){
			//alert('yyyyyy');
			$('#hourly').prop('disabled', false);
			$('#hourly').removeClass('disabled');
			$("#hourly_div").show(1000);
			
			$('#helpers').prop('disabled', false);
			$('#helpers').removeClass('disabled');
			$("#helpers_div").show(1000);
		}else{
			//alert('nnnnnn');
			$('#hourly').prop('disabled', true);
			$('#hourly').addClass('disabled');			
			$("#hourly_div").hide(1000);
			
			$('#helpers').prop('disabled', true);
			$('#helpers').addClass('disabled');
			$("#helpers_div").hide(1000);
		}		
	}
	
	window.onload = function () {
			if($("#fixed_hourly_price").prop('checked') === true){
					 //alert('yyyyyy');
					 $('#hourly').prop('disabled', false);
					 $('#hourly').removeClass('disabled');
					 $("#hourly_div").show(1000);
					 
					 $('#helpers').prop('disabled', false);
					 $('#helpers').removeClass('disabled');
					 $("#helpers_div").show(1000);
				 }
	}

function testi(price){
    dataOne = price.split('~');
    $('#hourly_time').val(dataOne[0]);
    $('#hour_prc').val(dataOne[1]);
    }
    
//    function subtractQty() {
//        var iid = $('#qty').val();
//        var cat_name = $('#cat').val();
//        if (iid > 0) {
//            var iid = document.getElementById("qty").value--;
//            var get_id = $('#second_val').val();
//            if (get_id != '') {
//                var iiiid = $('#second_val').val();
//            } else {
//                var iiiid = '0';
//            }
//            var input_val = iid - 1;
//            $.ajax({
//                type: "GET",
//                url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
//                success: function (msg) {
//                    // alert(msg);
//                    $('#get_hourss').val(msg);
//                }
//            });
//        } else {
//            $('#qty').val('0');
//        }
//
//    }
//    function addQty() {
//        var iid = document.getElementById("qty").value++;
//        var cat_name = $('#cat').val();
////                    alert(iid);
////                    var cat_name = $('#cat').val();
//        var get_id = $('#second_val').val();
//
//        if (get_id != '') {
//            var iiiid = $('#second_val').val();
//            // alert(iiiid);
//        } else {
//            var iiiid = '0';
//        }
//        var input_val = iid + 1;
//
//        $.ajax({
//            type: "GET",
//            url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
//            success: function (result)
//            {
//                // alert(result);
//                $('#get_hourss').val(result);
//            }
//        });
//    }

function subtractQty() {
                                                    var iid = $('#qty').val();
													
                                                    var cat_name = $('#cat').val();
                                                    if (iid > 0) {
                                                        var iid = document.getElementById("qty").value--;
                                                        var get_id = $('#second_val').val();
                                                        if (get_id != '') {
                                                            var iiiid = $('#second_val').val();
                                                        } else {
                                                            var iiiid = '0';
                                                        }
                                                        var input_val = iid - 1;
                                                        $.ajax({
                                                            type: "GET",
                                                            url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
                                                            success: function (msg) {
                                                                // alert(msg);
                                                                $('#get_hourss').val(msg);
                                                            }
                                                        });
                                                    } else {
                                                        $('#qty').val('0');
                                                    }

                                                }
                                                function addQty() {
                                                    var iid = document.getElementById("qty").value++;
													//alert(iid);
                                                    var cat_name = $('#cat').val();
//                    alert(iid);
//                    var cat_name = $('#cat').val();
                                                    var get_id = $('#second_val').val();

                                                    if (get_id != '') {
                                                        var iiiid = $('#second_val').val();
                                                        // alert(iiiid);
                                                    } else {
                                                        var iiiid = '0';
                                                    }
                                                    var input_val = iid + 1;

                                                    $.ajax({
                                                        type: "GET",
                                                        url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
                                                        success: function (result)
                                                        {
                                                            // alert(result);
                                                            $('#get_hourss').val(result);
                                                        }
                                                    });
                                                }
                                                
                                                function medium_addQty() {

                                                    var iid = document.getElementById("mediumqty").value++;
                                                    var cat_name = $('#cat').val();
                                                    var get_id = $('#get_hourss').val();
                                                    if (get_id != '') {
                                                        var iiiid = $('#get_hourss').val();
                                                    } else {
                                                        var iiiid = '0';
                                                    }
                                                    var input_val = iid + 1;
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + input_val + '/' + cat_name + '/' + '-',
                                                        success: function (result) {
                                                            // alert(result);
                                                            $('#second_val').val(result);

                                                        }
                                                    });
                                                }
                                                function medium_subtractQty() {
                                                    var cat_name = $('#cat').val();
                                                    var iid = $('#mediumqty').val();
                                                    if (iid > 0) {
                                                        var iid = document.getElementById("mediumqty").value--;
                                                        var get_id = $('#get_hourss').val();
                                                        if (get_id != '') {
                                                            var iiiid = $('#get_hourss').val();
                                                        } else {
                                                            var iiiid = '0';
                                                        }
                                                        var input_val = iid - 1;
                                                        $.ajax({
                                                            type: "GET",
                                                            url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + input_val + '/' + cat_name + '/' + '-',
                                                            success: function (msg) {
                                                                //  alert(msg);
                                                                $('#second_val').val(msg);
                                                            }
                                                        });
                                                    } else {
                                                        $('#mediumqty').val('0');
                                                    }
                                                }
                                                
                                                function large_addQty() {
                                                    var iid = document.getElementById("largeqty").value++;
                                                    var cat_name = $('#cat').val();
//                    alert(iid);
//                    var cat_name = $('#cat').val();
                                                    var get_id = $('#second_val').val();

                                                    if (get_id != '') {
                                                        var iiiid = $('#second_val').val();
                                                        // alert(iiiid);
                                                    } else {
                                                        var iiiid = '0';
                                                    }
                                                    var input_val = iid + 1;

                                                    $.ajax({
                                                        type: "GET",
                                                        url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
                                                        success: function (result)
                                                        {
                                                            // alert(result);
                                                            $('#get_hourss').val(result);
                                                        }
                                                    });
                                                }
                                                
                                                function large_subtractQty() {
                                                    var iid = $('#largeqty').val();
                                                    var cat_name = $('#cat').val();
                                                    if (iid > 0) {
                                                        var iid = document.getElementById("largeqty").value--;
                                                        var get_id = $('#second_val').val();
                                                        if (get_id != '') {
                                                            var iiiid = $('#second_val').val();
                                                        } else {
                                                            var iiiid = '0';
                                                        }
                                                        var input_val = iid - 1;
                                                        $.ajax({
                                                            type: "GET",
                                                            url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
                                                            success: function (msg) {
                                                                // alert(msg);
                                                                $('#get_hourss').val(msg);
                                                            }
                                                        });
                                                    } else {
                                                        $('#largeqty').val('0');
                                                    }

                                                }


//    function medium_addQty() {
//
//        var iid = document.getElementById("mediumqty").value++;
//        var cat_name = $('#cat').val();
//        var get_id = $('#get_hourss').val();
//        if (get_id != '') {
//            var iiiid = $('#get_hourss').val();
//        } else {
//            var iiiid = '0';
//        }
//        var input_val = iid + 1;
//        $.ajax({
//            type: "GET",
//            url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + input_val + '/' + cat_name + '/' + '-',
//            success: function (result) {
//                // alert(result);
//                $('#second_val').val(result);
//
//            }
//        });
//    }
//    function medium_subtractQty() {
//        var cat_name = $('#cat').val();
//        var iid = $('#mediumqty').val();
//        if (iid > 0) {
//            var iid = document.getElementById("mediumqty").value--;
//            var get_id = $('#get_hourss').val();
//            if (get_id != '') {
//                var iiiid = $('#get_hourss').val();
//            } else {
//                var iiiid = '0';
//            }
//            var input_val = iid - 1;
//            $.ajax({
//                type: "GET",
//                url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + input_val + '/' + cat_name + '/' + '-',
//                success: function (msg) {
//                    //  alert(msg);
//                    $('#second_val').val(msg);
//                }
//            });
//        } else {
//            $('#mediumqty').val('0');
//        }
//    }
//
//    function large_addQty() {
//        var iid = document.getElementById("largeqty").value++;
//        var cat_name = $('#cat').val();
////                    alert(iid);
////                    var cat_name = $('#cat').val();
//        var get_id = $('#second_val').val();
//
//        if (get_id != '') {
//            var iiiid = $('#second_val').val();
//            // alert(iiiid);
//        } else {
//            var iiiid = '0';
//        }
//        var input_val = iid + 1;
//
//        $.ajax({
//            type: "GET",
//            url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
//            success: function (result)
//            {
//                // alert(result);
//                $('#get_hourss').val(result);
//            }
//        });
//    }
//
//    function large_subtractQty() {
//        var iid = $('#largeqty').val();
//        var cat_name = $('#cat').val();
//        if (iid > 0) {
//            var iid = document.getElementById("largeqty").value--;
//            var get_id = $('#second_val').val();
//            if (get_id != '') {
//                var iiiid = $('#second_val').val();
//            } else {
//                var iiiid = '0';
//            }
//            var input_val = iid - 1;
//            $.ajax({
//                type: "GET",
//                url: "<?php echo base_url() . ('BadroomPlan') ?>/" + iiiid + '/' + '-' + '/' + cat_name + '/' + input_val,
//                success: function (msg) {
//                    // alert(msg);
//                    $('#get_hourss').val(msg);
//                }
//            });
//        } else {
//            $('#largeqty').val('0');
//        }
//
//    }
</script>
