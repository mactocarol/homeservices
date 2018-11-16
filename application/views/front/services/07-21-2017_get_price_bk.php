<div class="inner_pages_section"> 
    <section class="price_main_pages">
        <div class="container">
            <div class="col-md-9 col-sm-7 col-xs-12">

                <div id="get_pricc_container">
                    <div class="rench">
                        <i><img src="<?php echo MEDIAURL; ?>category/<?php echo $single_parnt_img[0]->cat_picture; ?>" alt="First slide" height="100" width=""></i> 
                    </div>
                    <?php //print_r($single_cate);exit; ?>
                    <p class="headprice"><?php echo $single_cate[0]->cat_name; ?> </p>
                    <p class="headprice"><?php echo $single_cate[0]->cat_desc; ?> </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-5 col-xs-12">
                <div class="when-checkout-container center">
                    <div class="payment-content-wrapper">
                        <form class="simple_form new_quote_request"  method="post" name="when_form">
                            <div style="margin:0;padding:0;display:inline">
                            </div>
                            <input id="cat" name="cat" value="<?php echo encode_category($single_cate[0]->cat_name); ?>" type="hidden">
                            <div class="checkout-row">
                                <div class="when-main-header">Get a Price</div>
                            </div>
                            <div class="checkout-row">
                                <div class="columns">
                                    <input class="string optional zipcode-field required when-font placeholder"  
                                           value="<?php echo $this->session->userdata('zipcode'); ?>" 
                                           id="quote_request_zipcode" maxlength="255" name="zipcode" placeholder="ZIP Code" size="50" type="text">
                                </div>
                            </div>
                            <div class="when-section">
                                <?php
                                $ttt = $single_cate[0]->cat_attribute;
                                if ($ttt != '') {
                                    $get_field = json_decode($ttt);
                                    $all_count = count($get_field);
                                    ?>
                                <?php if($get_field[0]->professionals != ''){ ?>
                                    <div class="checkout-row">
                                        <div class="when-sub-header pad-bot">Tell us about the job</div>
                                    </div>
                                    <?php if ($all_count == '1' && $get_field[0]->professionals != '') { ?>
                                    <div class="checkout-row stepper">
                                        <div class="columns">
                                            <div class="numbers-row">
												<input type='button' name='subtract' onclick='javascript: subtractQty();' value='-'/>
                                                <span class="show_room"><input type='text' name='qty' id='qty'/><span><?php echo $get_field[0]->professionals; ?></span></span>
                                                <input type='button' name='add' onclick='javascript: addQty();' value='+'/>
                                                <input type="hidden" name="plans_first" id="plans_first" value="<?php echo $get_field[0]->professionals; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($all_count == '2' && $get_field[1]->professionals != '') { ?>
                                    <div class="checkout-row stepper">
                                        <div class="columns">
                                            <div class="numbers-row">
												<input type='button' name='qty' onclick='javascript: subtractQty();' value='-'/>
                                               
                                                <span class="show_room">
                                                    <input type='text' name='qty' id='qty'/>
                                                    <span><?php echo $get_field[0]->professionals; ?></span>
                                                </span>
                                                 <input type='button' name='add' onclick='javascript: addQty();' value='+'/>
                                                <input type="hidden" name="plans_first" id="plans_first" value="<?php echo $get_field[0]->professionals; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="columns">
                                            <div class="numbers-row">
												<input type='button' name='subtract' onclick='javascript: medium_subtractQty();' value='-'/>
                                                <span class="show_room"><input type='text' name='mediumqty' id='mediumqty'/><span><?php echo $get_field[1]->professionals; ?></span></span>
                                                <input type='button' name='add' onclick='javascript:medium_addQty();' value='+'/>
                                                <input type="hidden" name="plans_second" id="plans_second" value="<?php echo $get_field[1]->professionals; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                        <?php if ($all_count == '3' && $get_field[2]->professionals != '') { ?>
                                    <div class="checkout-row stepper">
                                        <div class="columns">
                                            <div class="numbers-row">
												<input type='button' name='qty' onclick='javascript: subtractQty();' value='-'/>
                                                
                                                <span class="show_room">
                                                    <input type='text' name='qty' id='qty'/>
                                                    <span><?php echo $get_field[0]->professionals; ?></span>
                                                </span>
                                                <input type='button' name='add' onclick='javascript: addQty();' value='+'/>
                                                <input type="hidden" name="plans_first" id="plans_first" value="<?php echo $get_field[0]->professionals; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="columns">
                                            <div class="numbers-row">   
                                                <input type='button' name='subtract' onclick='javascript: medium_subtractQty();' value='-'/>
                                                <span class="show_room"><input type='text' name='mediumqty' id='mediumqty'/><span><?php echo $get_field[1]->professionals; ?></span></span>
												<input type='button' name='add' onclick='javascript:medium_addQty();' value='+'/>
                                                <input type="hidden" name="plans_second" id="plans_second" value="<?php echo $get_field[1]->professionals; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="columns">
                                            <div class="numbers-row">
									<input type='button' name='subtract' onclick='javascript: large_subtractQty();' value='-'/>											
                                                
                                                <span class="show_room"><input type='text' name='largeqty' id='largeqty'/>
                                                    <span><?php echo $get_field[2]->professionals; ?></span></span>
                                                <input type='button' name='add' onclick='javascript:large_addQty();' value='+'/>
                                                <input type="hidden" name="plans_third" id="plans_third" value="<?php echo $get_field[2]->professionals; ?>">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <?php } ?>
                                
                                <?php } } ?>
                                 <?php
                                    if ($single_cate[0]->hourly_rate != '') {
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
                                    } ?>
                                <?php 
                                if($single_cate[0]->stuff_1 != ''){
                                $pttt = json_decode($single_cate[0]->stuff_1);
                                if($single_cate[0]->required_field_1 != '' && $pttt[0]->stuff_1 != ''){ ?>
                                <div id="q1_wrapper">
                                    <div class="form-line">
                                        <div class="checkout-row">
                                            <div class="column">
                                                <p class="when-sub-header pad-bot"><?php echo $single_cate[0]->required_field_1; ?></p>                                                
                                                <div class="select-wrapper form-select-wrapper">
                                                    <select class="hb_select" id="helpers" name="helpers">
                                                        <option >Please Select </option>
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
                                <?php } }?>
                                
                                <?php if($single_cate[0]->staff_2 != ''){
                                $pt_2 = json_decode($single_cate[0]->staff_2);
                                if($single_cate[0]->required_field_2 != '' && $pt_2[0]->stuff_2 != ''){ ?>
                                <div id="q1_wrapper">
                                    <div class="form-line">
                                        <div class="checkout-row">
                                            <div class="column">
                                                <p class="when-sub-header pad-bot"><?php echo $single_cate[0]->required_field_2; ?></p>                                                
                                                <div class="select-wrapper form-select-wrapper">
                                                    <select class="hb_select" id="helpers" name="helpers">
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
                                <?php } }?>
                                
<!--                                <div class="checkout-row push-top">
                                    <div class="columns">
                                        <textarea  cols="40" id="job_desc" name="job_desc" 
                                                  placeholder="Please describe the job in detail.(optional)" rows="4">
                                        </textarea>
                                    </div>
                                </div>-->
                                
                                <div class="checkout-row push-top">
                                        <div class="columns">
                                            <textarea class="placeholder" cols="40" id="booking_params_notes" name="job_desc" placeholder="Please describe the job in detail. (optional)" rows="5"></textarea>
                                        </div>
                                    </div>
                                
                            </div>

                            <!--<div class="checkout-row">
                            <div class="when-sub-header pad-bot">
                            We recommend
                            <strong>
                            <span class="js-estimated-job-hours"></span>
                            <span>hours</span>
                            </strong>
                            </div>
                            </div>-->
                            <div class="checkout-row">
                                <div class="columns">
                                    <!--<div class="checkout-row push-top">
                                    <div class="col-md-12 columns">
                                    <input class="form-input required when-font inspectletIgnore placeholder" id="get_hourss" name="total_hr" placeholder="Total hours" size="30" type="number">
                                    </div>
                                    </div>-->
                                    <div class="columns">
                                        <p class="hidden when-sub-header warn-style time-warn">
                                            Because you are booking less time than recommended,
                                            we may not be able to finish the job.
                                        </p>
                                    </div>
                                </div>
                                <div class="checkout-row">
                                    <div class="when-sub-header pad-bot">When would you like us to come?</div>
                                </div>
                                <div class="checkout-row">
                                    <div class="columns">
                                        <input class="pikaday when-font" id="datepicker" data-format="MM/DD/YYYY" name="on_date" type="text">
                                        <?php  if (form_error('on_date') != '') {
                                            echo form_error('on_date', '<span class="perror">', '</span>');}
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
                                <div class="checkout-row push-top">
                                    <div class="columns">
                                        <input class="form-input when-font inspectletIgnore placeholder"  
                                               name="emailid" placeholder="Email Address" size="30" type="email">
                                        <?php  if (form_error('emailid') != '') {
                                            echo form_error('emailid', '<span class="perror">', '</span>');}
                                            ?>
                                        
                                    </div>
                                </div>
                                <div class="when-continue-button-container checkout-row">
                                    <div class="columns">
                                        <button class="booking-continue-button btn-continue when-button btn-primary js-submit-payment" type="submit" >Get a Price</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="term_con">
                <p>By submitting,I agree to receive updates & exclusive offer from Home Pros.Consent can be withdrawn at any time.For more details see our <a href="<?php echo base_url(); ?>Term-Condition" target="_blank">Terms of Use</a> or <a href="<?php echo base_url(); ?>Contact-us" target="_blank">Contact Us</a>.</p>
            </div>       

        </div>
            
    </section>

    <script src="<?php //echo FRONTJS;   ?>jquery.min.js"></script>
    <script type="text/javascript">
        
        function testi(price){
        dataOne = price.split('~');
    $('#hourly_time').val(dataOne[0]);
    $('#hour_prc').val(dataOne[1]);
    }

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
    </script>

