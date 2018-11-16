    <div class="inner_pages_section"> 
    <section class="price_main_pages">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="rench">
                        <i>  <img src="<?php echo MEDIAURL; ?>category/<?php echo $single_parnt_img[0]->cat_picture; ?>" alt="First slide" height="100" width=""></i> 
                    </div>
                    <p class="headprice"><?php echo $single_cate[0]->cat_name; ?> </p>
                    <p class="headprice"><?php echo $single_cate[0]->cat_desc; ?> </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="when-checkout-container center">
                        <div class="payment-content-wrapper">
                            <form accept-charset="UTF-8" action="<?php echo base_url(); ?>Booking" class="simple_form new_quote_request" id="quote_when_form" method="post" name="when_form">
                                <div style="margin:0;padding:0;display:inline">
                                    <input name="category" value="<?php echo $this->uri->segment(3); ?>" id="category" type="hidden">
                                </div>
<!--                                <input id="quote_request_service_id" name="quote_request[service_id]" value="8" type="hidden">
                                <input id="quote_request_number_providers" name="quote_request[number_providers]" value="1" type="hidden">
                                <input id="quote_request_min_3" name="quote_request[min_3]" value="true" type="hidden">
                                <input id="quote_request_home_cleaning" name="quote_request[home_cleaning]" value="false" type="hidden">-->
                                <div class="checkout-row">
                                    <div class="when-main-header">Get a Price</div>
                                </div>
                                <div class="checkout-row">
                                    <div class="col-md-12 columns">
                                        <input class="string optional zipcode-field required when-font placeholder" 
                                               data-status="/bookings/service_zipcode_price" id="quote_request_zipcode" maxlength="255" 
                                               name="quote_request[zipcode]" placeholder="ZIP Code" size="50" type="text" 
                                               value="<?php echo $this->session->userdata('zipcode'); ?>">
                                    </div>
                                </div>
                                <div class="when-section" id="service-details-section">
                                    <div class="checkout-row">
                                        <div class="when-sub-header pad-bot"><h4>Tell us about the job</h4></div>
                                    </div>
                                    <?php
                                    if ($single_items_record != '') {
                                        $decode_val = $single_items_record[0]->cat_attribute;
                                        $pp = json_decode($decode_val);
                                        $tt = count($pp);
                                        if ($tt == '1' && $pp[0]->professionals != '') {
                                            ?>
                                        <?php echo $pp[0]->professionals; ?>
                                            <div class="checkout-row stepper">
                                                <div class="col-md-12 columns">
                                                    <div class="numbers-row"> 
                                                        <input type='button' name='add' onclick='javascript: document.getElementById("qty").value++;' value='+'/>
                                                        <input type='text' name='qty' id='qty'/>
                                                        <input type='text' name='first_qun' id='first_qun'/>
                                                        <input type='button' name='subtract' onclick='javascript: subtractQty();' value='-'/>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($tt == '2' && $pp[1]->professionals != '') { ?>
                                                <div class="checkout-row stepper">
        <?php echo $pp[0]->professionals; ?>
                                                    <div class="col-md-12 columns">
                                                        <div class="numbers-row">  
                                                            <input type='button' name='add' onclick='javascript: addQty();' value='+'/>
                                                            <input type='text' name='qty' id='qty' />
                                                            <input type='text' name='second_qun' id='second_qun'/>
                                                            <input type='button' name='subtract' onclick='javascript: subtractQty();' value='-'/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 columns">
                                                    <?php echo $pp[1]->professionals; ?>
                                                        <div class="numbers-row">   
                                                            <input type='button' name='add' onclick='javascript:l_addQty();' value='+'/>
                                                            <input type='text' name='qunty' id='l_qunty'/>
                                                            <input type='text' name='thired_qun' id='thired_qun'/>
                                                            <input type='button' name='subtract' onclick='javascript: l_subtractqunty();' value='-'/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }
                                            ?>
                                                <?php if ($tt == '3' && $pp[1]->professionals != '') { ?>
                                                <div class="checkout-row stepper">
                                                    <div class="col-md-12 columns">
                                                    <?php echo $pp[0]->professionals; ?>
                                                        <div class="numbers-row">  
                                                            <input type='button' name='add' onclick='javascript:addQty();' value='+'/>
                                                            <input type='text' name='qty' id='qty' />
                                                            <input type='text' name='first_qun' id='first_qun' value="<?php echo $pp[0]->hours; ?>"/>
                                                            <input type='text' name='aa' id='aa' value="0"/>
                                                            <input type='button' name='subtract' onclick='javascript:subtractQty();' value='-'/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 columns">
                                                    <?php echo $pp[1]->professionals; ?>
                                                        <div class="numbers-row">   
                                                            <input type='button' name='add' onclick='javascript:medium_addQty();' value='+'/>
                                                            <input type='text' name='mediumqty' id='mediumqty'<?php //echo $pp[0]->professionals;  ?> />
                                                            <input type='text' name='thired_qun' id='thired_qun' value="<?php echo $pp[1]->hours; ?>"/>
                                                            <input type='button' name='subtract' onclick='javascript: medium_subtractQty();' value='-'/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 columns">
                                                    <?php echo $pp[2]->professionals; ?>
                                                        <div class="numbers-row">   
                                                            <input type='button' name='add' onclick='javascript:l_addQty();' value='+'/>
                                                            <input type='text' name='qunty' id='l_qunty'<?php //echo $pp[0]->professionals;  ?> />
                                                            <input type='text' name='second_qun' id='second_qun' value="<?php echo $pp[2]->hours; ?>"/>
                                                            <input type='button' name='subtract' onclick='javascript:l_subtractqunty();' value='-'/>
                                                        </div>
                                                    </div>
                                                    <?php }
                                                ?>
                                                <div id="q1_wrapper">
                                                    <div class="form-line">
                                                        <div class="checkout-row">
                                                            <div class="col-md-12 column">
                                                                <p class="when-sub-header pad-bot"><?php echo $single_items_record[0]->req_message; ?></p>
                                                                <div class="select-wrapper form-select-wrapper">
                                                                    <select class="hb_select" data-warn-on-option="1,2" id="booking_params_answers_q1" name="booking_params[answers[q1]]">
                                                                        <option value="0" selected="selected">Please Select</option>
                                                                        <?php
                                                                        if ($single_items_record != '') {
                                                                            $decode_val = $single_items_record[0]->stuff;
                                                                            //print_r($decode_val);
                                                                            $pt = json_decode($decode_val);
                                                                            foreach ($pt as $stuffs):
                                                                                ?>
                                                                                <option value="1"> <?php echo $stuffs->stuff; ?> </option>
                                                                                <?php
                                                                            endforeach;
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="hidden when-sub-header warn-style custom_warn checkout-row">There will be an additional fee.</p>
                                                    </div>
                                                </div>
                                                <div class="checkout-row push-top">
                                                    <div class="col-md-12 columns">
                                                        <textarea class="placeholder" cols="40" id="booking_params_notes" name="booking_params[notes]" placeholder="Please describe the job in detail. (optional)" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
<?php } ?>
                                        <div class="checkout-row">
                                            <div class="when-sub-header pad-bot">
                                                We recommend
                                                <strong>
                                                    <span class="js-estimated-job-hours">2</span>
                                                    <span>hours</span>
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="checkout-row">
                                            <div class="col-md-12 columns">
                                                <input class="form-input required when-font inspectletIgnore placeholder" id="get_hourss" name="quote_request[email]" placeholder="Email Address" size="30" type="email">
                                                <div class="select-wrapper form-select-wrapper">
                                                </div>
                                            </div>
                                            <div class="col-md-12 columns">
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
                                            <div class="col-md-12 columns">
                                                <input class="pikaday when-font" id="datepicker" data-format="MM/DD/YYYY" id="quote_request_date" name="quote_request_date" value="2/1/2017" type="text">
                                            </div>
                                            <div class="col-md-12 columns">
                                                <div class="select-wrapper form-select-wrapper">
                                                    <select id="quote_request_start_time" name="quote_request_start_time"><option value="07:00">7:00 AM</option>
                                                        <option value="07:30">7:30 AM</option>
                                                        <option value="08:00">8:00 AM</option>
                                                        <option value="08:30">8:30 AM</option>
                                                        <option value="09:00">9:00 AM</option>
                                                        <option value="09:30">9:30 AM</option>
                                                        <option value="10:00">10:00 AM</option>
                                                        <option value="10:30">10:30 AM</option>
                                                        <option value="11:00">11:00 AM</option>
                                                        <option value="11:30">11:30 AM</option>
                                                        <option value="12:00">12:00 PM</option>
                                                        <option value="12:30">12:30 PM</option>
                                                        <option value="13:00">1:00 PM</option>
                                                        <option value="13:30">1:30 PM</option>
                                                        <option value="14:00" selected="selected">2:00 PM</option>
                                                        <option value="14:30">2:30 PM</option>
                                                        <option value="15:00">3:00 PM</option>
                                                        <option value="15:30">3:30 PM</option>
                                                        <option value="16:00">4:00 PM</option>
                                                        <option value="16:30">4:30 PM</option>
                                                        <option value="17:00">5:00 PM</option>
                                                        <option value="17:30">5:30 PM</option>
                                                        <option value="18:00">6:00 PM</option>
                                                        <option value="18:30">6:30 PM</option>
                                                        <option value="19:00">7:00 PM</option>
                                                        <option value="19:30">7:30 PM</option>
                                                        <option value="20:00">8:00 PM</option>
                                                        <option value="20:30">8:30 PM</option>
                                                        <option value="21:00">9:00 PM</option></select>
                                                </div>
                                                <input id="quote_request_date_start" name="quote_request[date_start]" value="2017-02-01 14:00:00" type="hidden">
                                                <input id="display_date" name="display_date" value="2017-02-01 14:00:00 -0500" type="hidden">
                                            </div>
                                        </div>
                                        <div class="checkout-row push-top">
                                            <div class="col-md-12 columns">
                                                <input class="form-input required when-font inspectletIgnore placeholder" id="get_hourss" name="quote_request[email]" placeholder="Email Address" size="30" type="email">
                                            </div>
                                        </div>
                                        <div class="when-continue-button-container checkout-row">
                                            <div class="col-md-12 columns">
                                                <button class="booking-continue-button btn-continue when-button btn-primary js-submit-payment" type="submit">Get a Price</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                </section>
            </div>
            <script src="<?php echo FRONTJS; ?>jquery.min.js"></script>
            <script type="text/javascript">
//               $(document).ready(function () { 
//                $(function() {
//
//  $(".numbers-row").append('<div class="inc button">+</div><div class="dec button">-</div>');
//  //$(".numbers-row1").append('<div class="inc button">+</div><div class="dec button">-</div>');
//
//  $(".button").on("click", function() {
//
//    var $button = $(this);
//    var oldValue = $button.parent().find("input").val();
//    if ($button.text() == "+") {
//          var f_cur_val = document.getElementById("first_qun").value;
//          var s_cur_val = document.getElementById("second_qun").value;
//  	  var newVal = parseFloat(oldValue) + 1;
//          alert(f_cur_val);
//          //alert(newVal);
//          var tt = f_cur_val * newVal;
//          //alert(newVal);
//          //alert(tt);
//  	} else {
//	   // Don't allow decrementing below zero
//      if (oldValue > 0) {
//        var newVal = parseFloat(oldValue) - 1;
//	    } else {
//        newVal = 0;
//      }
//	  }
//
//    $button.parent().find("input").val(newVal);
//
//  });
//
//});
//});

//                function first_add(){
//                    var cat = document.getElementById("category").value;
//                    var rr = document.getElementById("qty").value;
//                    if(rr === '0'){
//                        alert('empty1');
//                        return false;
//                    }else{
//                        alert()
//                    }
//                    alert(rr);
//                    return false;
//                    var f_qty = document.getElementById("qty").value++;
//                    var ff_qty = f_qty + 1;
//                    if(ff_qty > 0){
//                    var f_cur_val = document.getElementById("first_qun").value;
//                    var f_val = ff_qty * f_cur_val;
//                    }else{
//                        var f_val = 0;
//                    }
//                
//                }


                
                
                function subtractQty() {
                    var cat = document.getElementById("category").value;
                    var iid = $('#qty').val();
                    var cur_val = document.getElementById("first_qun").value;
                    if (iid > 0) {
                        var iid = document.getElementById("qty").value--;
                        var get_id = $('#get_hourss').val();
                        if (get_id != '') {
                            var iiiid = $('#get_hourss').val();
                        } else {
                            var iiiid = '0';
                        }
                        var tt = iid - 1;
                        var mul = tt * cur_val;
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url().('Minus_GetPrice') ?>/"+cat+'/'+mul,
                                success: function (msg) {
                                    alert(msg);
                                $('#get_hourss').val(msg);
                            }
                        });
                    } else {
                        $('#qty').val('0');
                    }

                }
                
                
                
                function addQty() {
                
                    var cat = document.getElementById("category").value;
                   var qty1 = document.getElementById("qty").value;
//                    alert(qty1);
//                    return false;
                    //var tt = qty1 + 1;
                    
                    //first
                    if(document.getElementById('qty').value === ''){
                        alert('empty1');
                        document.getElementById("qty").value++;
                    }
                    else{
                        alert('not empty1');
                        return false;
                    var f_qty = document.getElementById("qty").value++;
                    var ff_qty = f_qty + 1;
                    if(ff_qty > 0){
                    var f_cur_val = document.getElementById("first_qun").value;
                    var f_val = ff_qty * f_cur_val;
                    }else{
                        var f_val = 0;
                    }
                    }
                    return false;
                    
                }

                function l_addQty() {
                    var cat = document.getElementById("category").value;
                    var iid = document.getElementById("l_qunty").value++;
                    var cur_val = document.getElementById("second_qun").value;
                    var get_id = $('#get_hourss').val();
                   
                    if (get_id != '') {
                        var iiiid = $('#get_hourss').val();
                    } else {
                        var iiiid = '0';
                    }
                    var tt = iid + 1;
                    var mul = tt * cur_val;
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url().('l_GetPrice') ?>/"+cat+'/'+iiiid+'/'+mul,
                                success: function (result) {
                                 alert(result);
                            $('#get_hourss').val(result);
                        }
                    });
                }
                function l_subtractqunty() {
                    var cat = document.getElementById("category").value;
                    var cur_val = document.getElementById("second_qun").value;
                    var iid = $('#l_qunty').val();
                    if (iid > 0) {
                        var iid = document.getElementById("l_qunty").value--;
                        var get_id = $('#get_hourss').val();
                        if (get_id != '') {
                            var iiiid = $('#get_hourss').val();
                        } else {
                            var iiiid = '0';
                        }
                        var tt = iid - 1;
                        var mul = tt * cur_val;
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url().('l_minus_GetPrice') ?>/"+cat+'/'+iiiid+'/'+mul,
                            success: function (msg)
                            {
                                alert(msg);
                                $('#thired_qun').val(msg);
                            }
                        });
                    } else {
                        $('#l_qunty').val('0');
                    }
                }

                function medium_addQty() {
                    var cat = document.getElementById("category").value;
                    var iid = document.getElementById("mediumqty").value++;
                    var cur_val = document.getElementById("thired_qun").value;
                    var get_id = $('#get_hourss').val();
                    if (get_id != '') {
                        var iiiid = $('#get_hourss').val();
                    } else {
                        var iiiid = '0';
                    }
                    var tt = iid + 1;
                    var mul = tt * cur_val;
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url().('m_GetPrice') ?>/"+cat+'/'+iiiid+'/'+tt+'/'+mul,
                        success: function (result) {
                            alert(result);
                            $('#get_hourss').val(result);

                        }
                    });
                }
                function medium_subtractQty() {
                    var cat = document.getElementById("category").value;
                    var cur_val = document.getElementById("thired_qun").value;
                    var iid = $('#mediumqty').val();
                    if(iid > 0){
                    var iid = document.getElementById("mediumqty").value--;
                    var get_id = $('#get_hourss').val();
                    if (get_id != '') {
                        var iiiid = $('#get_hourss').val();
                    } else {
                        var iiiid = '0';
                    }
                    var tt = iid - 1;
                    var mul = tt * cur_val;
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url().('m_minus_GetPrice') ?>/"+cat+'/'+iiiid+'/'+tt+'/'+mul,
                        success: function (msg) {
                            alert(msg);
                            $('#get_hourss').val(msg);
                        }
                    });
                    }else {
                        $('#mediumqty').val('0');
                    }
                }
            </script>
