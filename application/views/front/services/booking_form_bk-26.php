<section class="finalize_dv">
    <div class="container"> 
        <div id="page-wrap">
            <form method='post' name="booking_form" id="booking_form" action="<?php //echo base_url() . 'front/Service/checkout';   ?>">
                <div class="col-md-9 col-sm-8 col-xs-12">

                    <div class="page-wrap_left" id="content">
                        <?php
                        if ($get_fetch_plan != 'no record found') {
                            if ($get_fetch_plan->plan != '') {
                                ?>
                                <div class="left_page_hed">
        <?php $cat_name = $this->session->userdata('child_cat'); ?>
                                    <h3>  Set up a Plan  For <?php echo $get_category; ?></h3>
                                </div>
                            <?php
                            }
                        } else {
                            
                        }
                        ?>
                        <input type="hidden" name="category" value="<?php echo $get_category; ?>">
                        <div class="left_page_description">

                            <?php
                            if ($get_fetch_plan != 'no record found') {
                                if ($get_fetch_plan->plan != '') {
                                    $get_record = json_decode($get_fetch_plan->plan);

                                    $limit_O = (!empty($get_record[0]->one_price)) ? $get_record[0]->one_price : '';
                                    $limit_1 = (!empty($get_record[1]->one_price)) ? $get_record[1]->one_price : '';
                                    $total_1_month = $limit_O + $limit_1;

                                    $first_1 = (!empty($get_record[0]->three_price)) ? $get_record[0]->three_price : '';
                                    $first_2 = (!empty($get_record[1]->three_price)) ? $get_record[1]->three_price : '';
                                    $total_3_month = $first_1 + $first_2;

                                    $second_1 = (!empty($get_record[0]->six_price)) ? $get_record[0]->six_price : '';
                                    $second_2 = (!empty($get_record[1]->six_price)) ? $get_record[1]->six_price : '';
                                    $total_6_month = $second_1 + $second_2;

                                    $third_1 = (!empty($get_record[0]->twale_price)) ? $get_record[0]->twale_price : '';
                                    $third_2 = (!empty($get_record[1]->twale_price)) ? $get_record[1]->twale_price : '';
                                    $total_12_month = $third_1 + $third_2;

                                    $week = (!empty($get_record[0]->weekly_price)) ? $get_record[0]->weekly_price : '';
                                    $biweek = (!empty($get_record[0]->biweekly_price)) ? $get_record[0]->biweekly_price : '';
                                    ?>
                                    <h4>Select a frequency </h4>
                                    <p>Choose a frequency that's right for you! You can always change frequencies, reschedule, or save cleanings for later!</p>
                                    <div class="btn_inline_desc">
                                        <ul class="price_btns" id="plans_new">
                                            <?php if ($week != '') { ?>
                                                <li class="aactive"  id="test">
                                                    <a name='weekly' onclick="weekly_new('Weekly')"><?php echo(!empty($get_record[0]->weekly)) ? $get_record[0]->weekly : ''; ?></a>
                                                </li>
        <?php } ?>
                                            <?php if ($biweek != '') { ?>
                                                <li id="test1">
                                                    <a  name='biweekly' onclick="weekly_new('Biweekly')"><?php echo(!empty($get_record[0]->biweekly)) ? $get_record[0]->biweekly : ''; ?></a>
                                                </li>
        <?php } ?>
                                        </ul>
                                    </div>

                                    <div class="minimum_plans  price_btns_deatis" id="minimum_plans">


         <?php if ($limit_O != '') { ?>      
                
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="price_table_new">
                    <div  id="1_month">
                        <a  onclick="plan_select_one('<?php echo $total_1_month; ?>','<?php echo(!empty($get_record[0]->one_month)) ? $get_record[0]->one_month : ''; ?>')"></a>
                        </div>
                    <h4> 1 Months </h4>
                    <div class="price-text"><span>$</span>
                        <span class="js-price" name='three_mnth'>
    <?php echo $total_1_month; ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php } ?>                               
        

        <?php if ($first_1 != '') { ?>      
				
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="price_table_new">
                                                    <div  id="3_month">
                                                        <a  onclick="plan_select('<?php echo $total_3_month; ?>','<?php echo(!empty($get_record[0]->three_month)) ? $get_record[0]->three_month : ''; ?>')"></a>
                                                        </div>
                                                    <h4> 3 Months </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='three_mnth'>
            <?php echo $total_3_month; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
        <?php } ?>
        <?php if ($second_1 != '') { ?>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="price_table_new">
                                                    <div id="6_month"><a  onclick="six_mnth('<?php echo $total_6_month; ?>','<?php echo(!empty($get_record[0]->six_month)) ? $get_record[0]->six_month : ''; ?>')"></a></div>
                                                    <h4> 6 Months </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='six_mnth'>
            <?php echo $total_6_month; ?> 
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
        <?php } ?>
        <?php if ($third_1 != '') { ?>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="price_table_new">
                                                    <div id="12_month"><a onclick="tweleve_mnth('<?php echo $total_12_month; ?>','<?php echo(!empty($get_record[0]->twale_month)) ? $get_record[0]->twale_month : ''; ?>')"></a></div>
                                                    <h4> 12 Months </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='tweleve_mnth'>
                                            <?php echo $total_12_month; ?> 
                                                        </span></div>
                                                </div>
                                            </div>
                                    <?php } ?>
                                    </div>
    <?php
    }
} else {
    ?>
                                <h4>Complete your booking</h4>
                                <p>Great! We have availability at this time. A few more details and we can complete your booking.</p>
<?php } ?>
                        </div>
                        <div class="left_page_description align-left">
                            <h4>Address</h4>
                            <div class="adress_form">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name='fname' id="fname">
                                        <?php
                                        if (form_error('fname') != '') {
                                            echo form_error('fname', '<span class="perror">', '</span>');
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name='lname' id="lname">
                                        <?php
                                        if (form_error('lname') != '') {
                                            echo form_error('lname', '<span class="perror">', '</span>');
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>Street Address</label>
                                        <input type="text" class="form-control" name='address' id="address">
                                        <?php
                                        if (form_error('address') != '') {
                                            echo form_error('address', '<span class="perror">', '</span>');
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>Apartment Number (optional)</label>
                                        <input type="text" class="form-control" name='flat_add' id="flat_add">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>City</label>
                                        <input type="text" class="form-control" name='city' value="<?php
                                        if ($get_location != 'no record found') {
                                            if ($get_location->city != '-') {
                                                echo $get_location->city;
                                            } else {
                                                
                                            }
                                        } else {
                                            
                                        }
                                        ?>">
                                               <?php
                                               if (form_error('city') != '') {
                                                   echo form_error('city', '<span class="perror">', '</span>');
                                               }
                                               ?>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>Country</label>
                                        <select name="country" id="country" class="form-control" onchange="change_ajax_state(this.value)">
                                            <option value="">Select Country</option>
                                            <?php
                                            if (!empty($get_country)) {
                                                foreach ($get_country as $country):
                                                    ?>
                                                    <option value="<?php echo $country->id; ?>"><?php echo $country->short_name; ?></option>
                                            <?php endforeach;
                                        }
                                        ?>
                                        </select>
<?php
if (form_error('country') != '') {
    echo form_error('country', '<span class="perror">', '</span>');
}
?>
                                    </div>

                                </div>


                                <div class="form-group">

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>State</label>
                                        <select name="state" id="change" class="form-control">
                                            <option>Select State</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">+1</span>
                                            <input type="text" class="form-control" name='phonenumber'>
<?php
if (form_error('phonenumber') != '') {
    echo form_error('phonenumber', '<span class="perror">', '</span>');
}
?>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <?php
                        if ($get_fetch_plan != 'no record found') {
                            if ($get_fetch_plan->extra != '') {
                                $get_extra = json_decode($get_fetch_plan->extra);
                                if ($get_extra[0]->extra != '') {
                                    //print_r($get_extra);exit;
                                    $count_extra = count($get_extra);
                                    ?>

                                    <div class="left_page_description align-left">
                                        <h4>Extras</h4>
                                        <div class="payment-info-block-row">
                                            <ul>
            <?php if ($count_extra == 1) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input value="1" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 2) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input value="1" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input value="2" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 3) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input value="1" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input value="2" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input value="3" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 4) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input value="1" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input value="2" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input value="3" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_4">
                                                        <label>
                                                            <input value="4" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine(1).png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine.png">
                                                                </div>
                                                                <p><?php echo $get_extra[3]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 5) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input id="extra_first" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input id="extras_third" class="first_check" value="<?php echo $get_extra[2]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_4">
                                                        <label>
                                                            <input id="extras_fourth" class="first_check" value="<?php echo $get_extra[3]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine(1).png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine.png">
                                                                </div>
                                                                <p><?php echo $get_extra[3]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_5">
                                                        <label>
                                                            <input id="extras_five" class="first_check" value="<?php echo $get_extra[4]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/window.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/window(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[4]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                    <?php } ?>
                                            </ul>
                                        </div>
                                    </div>		
            <?php
        }
    }
}
?>

                        <div class="left_page_description align-center"> <!---Payment ---->
                            <div class="">By clicking Complete Booking I understand that I am purchasing a recurring cleaning plan subject to HomePros Cancellation Policy and <a href="<?php echo base_url() . 'Term-Condition'; ?>" >Terms of Use</a>.</div>
                            <button class="Complete_Booking"><span>Complete Booking </span></button>

                            <!--                            <button class="btn btn-primary btn-large" id="stripe-demo">Pay With Card</button>
                            
                                                        <script src="https://checkout.stripe.com/checkout.js"></script>-->
                        </div><!---Payment end---->
                    </div>

                </div>
                <nav class="col-md-3 col-sm-4 col-xs-12">
                    <div  id="sidebar"><!-----right-sidebar---->
                        <div class="page-wrap_right">	
                            <div class="tab-content top_pannel1">
                                <div id="Weekly" class="tab-pane fade in active">
                                    <h3><?php //echo $get_booking->plan_book;     ?> &nbsp;<?php echo $get_category; ?>
									
                                   <a class="pull-right" href ="javascript:history.back()">Edit</a>
                                </div>
                                <div id="Biweekly" class="tab-pane fade">
                                    <h3>Biweekly Cleaning Plan </h3>
                                </div>
								
                            </div>
                            <div class="tab-content">
<?php
//if ($get_booking->plan_book_mnth != '') {
?>
                                <p id="12_months" class="tab-pane fade">Your plan For<span><?php //echo $get_booking->plan_book_mnth;   ?></span> </p>
<?php //}    ?>
    <!--					  <p id="3_months" class="tab-pane fade in active"> Minimum 12 months<span></span> </p>
                                 <p id="6_months" class="tab-pane fade"> Minimum 6 months <span>£39.00</span> </p>-->
                            </div>
                            <div class="top_pannel2">
                                <p>Date &nbsp;<?php echo date('d M Y', strtotime(!empty($get_booking->select_date) ? $get_booking->select_date : '')); ?> </p>
                                <p>Time on  &nbsp;<?php echo (!empty($get_booking->select_time)) ? $get_booking->select_time : ''; ?> </p>
<?php
if ($get_fetch_plan != 'no record found') {
    if ($get_fetch_plan->plan != '') {
        $get_record_new = json_decode($get_fetch_plan->plan);
        ?>
                                <p id="monthlyplan"></p>
                                <p id="final_plan"></p>
                                       
                                    <?php }
                                }else{ ?>
<!--                                        <p>One Time</p>      -->
                                <?php } ?>
                                         <input type="hidden" name="chang_plans" id="chang_plans" value="">
                                        <input type="hidden" name="monthlyplans" id="monthlyplans" value="One Time">
                                        <p id="one_time" style="display: block;">One Time</p>
                                <?php if ($get_booking->first_item != '-') { ?>
                                    <p><?php echo $get_booking->first_item; ?> - &nbsp;&nbsp;<?php echo $get_booking->plan_hr_badroom; ?></p>
                                <?php } ?>
<?php if ($get_booking->second_item != '-') { ?>
                                    <p><?php echo $get_booking->second_item; ?> - &nbsp;&nbsp;<?php echo $get_booking->plan_hr_bathroom; ?></p>
<?php } ?>
<?php if ($get_booking->thired_item != '-') { ?>
                                    <p><?php echo $get_booking->thired_item; ?> - &nbsp;&nbsp;<?php echo $get_booking->livingroom; ?></p>
<?php } ?>

                            </div>
                        </div>

                        <div class="payment-summary" id="payment_breakdown" style="display: block;">
                            <div data-symbol="£" id="payment_summary_symbol"></div>
                            <div data-commitment="no_commitment" id="commitment-type"></div>
                            <div class="payment-section">
                                <div class="checkout-row">
                                    <div class="payment-summary-subtotal payment-summary-row" style="display: block;">
                                        <div class="payment-summary-title">Subtotal</div>
                                        <?php
                                        if ($get_fetch_data->cat_attribute != '') {
                                            $get_data = json_decode($get_fetch_data->cat_attribute);
                                            //print_r($get_data);exit;
                                            //$rating = (!empty($member_review)) ? $member_review : '0';
                                            $get_fetch_price_1 = (!empty($get_data[0]->price)) ? $get_data[0]->price : '';
                                            $get_fetch_price_2 = (!empty($get_data[1]->price)) ? $get_data[1]->price : '';
                                            $get_fetch_price_3 = (!empty($get_data[2]->price)) ? $get_data[2]->price : '';

                                            $first_time = (!empty($get_booking->first_item)) ? $get_booking->first_item : '';
                                            $second_item = (!empty($get_booking->second_item)) ? $get_booking->second_item : '';
                                            $third_item = (!empty($get_booking->thired_item)) ? $get_booking->thired_item : '';

                                            $first_plan = $get_fetch_price_1 * $first_time;
                                            $second_plan = $get_fetch_price_2 * $second_item;
                                            $third_plan = $get_fetch_price_3 * $third_item;
                                            $total = $first_plan + $second_plan + $third_plan;
                                            
                                            $hour_price = (!empty($get_booking->hour_prc)) ? $get_booking->hour_prc : '';
                                            ?>

                                            <div class="payment-summary-amount">$<span id="change_plan"><?php echo (!empty($total)) ? $total : $hour_price; ?></span></div>
                                            <input type="hidden" name="total_amt" id="total_amt" value="<?php echo $total; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-section no-border-bottom">
                                <div class="checkout-row total-price-row">
                                    <div class="total-price-text">
                                        <span>Total</span>
                                    </div>
                                    <div class="total-price">$
                                        <span class="js-total-price" style="display: inline;" id="total">
                                    <?php echo (!empty($total)) ? $total : $hour_price; ?>

                                        </span> <span class="price-suffix"></span>
                                        <input type="hidden" name="fullprice" id="fullprice" value="<?php echo (!empty($total)) ? $total : $hour_price; ?>">
                                    </div>
                                    <?php
                                    if ($get_fetch_plan != 'no record found') {
                                        if ($get_fetch_plan->plan != '') {
                                            $get_record = json_decode($get_fetch_plan->plan);

                                            $first_1 = (!empty($get_record[0]->three_price)) ? $get_record[0]->three_price : '';
                                            $first_2 = (!empty($get_record[1]->three_price)) ? $get_record[1]->three_price : '';
                                            $total_3_month = $first_1 + $first_2;

                                            $second_1 = (!empty($get_record[0]->six_price)) ? $get_record[0]->six_price : '';
                                            $second_2 = (!empty($get_record[1]->six_price)) ? $get_record[1]->six_price : '';
                                            $total_6_month = $second_1 + $second_2;

                                            $third_1 = (!empty($get_record[0]->twale_price)) ? $get_record[0]->twale_price : '';
                                            $third_2 = (!empty($get_record[1]->twale_price)) ? $get_record[1]->twale_price : '';
                                            $total_12_month = $third_1 + $third_2;
                                            ?>
                                            <input type="hidden" name="total_new" id="total_new" value="<?php
                                                   if ($total_3_month != '') {
                                                       echo $total_3_month;
                                                   } else {
                                                       
                                                   }
                                                   ?>">
            <?php
        }
    }
    ?>
                                </div>
                            </div>
<?php } ?>

                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 class="center">Questions?</h3>

                        <div id="accordion" class="panel-group">
                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle collapsed" href="#collapseOne" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"><i class="fa fa-caret-right"></i> What’s included in a cleaning service?</a></h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">See what's included in a cleaning service </div>
                                </div>
                            </div>

                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle collapsed" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"> <i class="fa fa-caret-right"></i>How does your pricing work?</a></h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Our cleanings are priced on a per hour basis, with a minimum booking of 3 hours.</li>
                                            <li>Your full price is based on the number of hours you select.</li>
                                            <li>For a deeper clean, we offer cleaning extras such as fridge or oven cleaning during checkout. Most cleaning extras add one half hour of time and cost to your booking.</li>
                                        </ul></div>
                                </div>
                            </div>

                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle collapsed" href="#collapseThree" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"> <i class="fa fa-caret-right"></i>Can I change or cancel my booking? </a></h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">It’s easy to change or cancel your booking on your bookings page.</div>
                                </div>
                            </div>

                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle collapsed" href="#collapsefour" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"> <i class="fa fa-caret-right"></i>What is your cancellation and rescheduling policy? </a></h4>
                                </div>
                                <div id="collapsefour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body"><ul>
                                            <li>Up to 24 hours before your booking, you may reschedule or cancel for free!</li>
                                            <li>Within the 2&ndash;24 hour range before your booking, you may reschedule or cancel for a 10GBP fee.</li>
                                            <li>Within 2 hours of your booking, you may reschedule or cancel, though no refund will be given for these changes.</li>
                                        </ul></div>
                                </div>
                            </div>

                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a class="accordion-toggle collapsed" href="#collapse5" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"> <i class="fa fa-caret-right"> </i>Which 88 Home Pros professional will come to my place? </a></h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body"><ul>
                                            <li>88 Home Pros has a vast network of friendly, experienced professional cleaners that have been vetted for quality, reliability, and customer satisfaction.</li>
                                            <li>Based on the time and date of your request, we work to assign the best professional available.</li>
                                            <li>Like working with a specific pro? Add them to your Pro Team from the mobile app and they'll be requested first for all future bookings.</li>
                                            <li>You will receive an email with details about your professional prior to your appointment.</li>
                                        </ul></div>
                                </div>
                            </div>

                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle collapsed" href="#collapse6" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"><i class="fa fa-caret-right"> </i>Why am I not able to book the time and date I want? </a></h4>
                                </div>
                                <div id="collapse6" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body"><ul> 
                                            <li>We do our very best to provide you with a cleaner at the time and date you request.</li>
                                            <li>During certain times/dates of increased demand, we may restrict appointment availability or suggest alternatives to ensure that a professional is available to complete your service.</li>
                                        </ul></div>
                                </div>
                            </div>

                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle collapsed" href="#collapse7" data-toggle="collapse" data-parent="#accordion" aria-expanded="false"><i class="fa fa-caret-right"> </i>I need more help. </a></h4>
                                </div>
                                <div id="collapse7" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">Need more help?</div>
                                </div>
                            </div>

                        </div>

                    </div>

                </nav>
            </form>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script  type="text/javascript">

                                            $(document).ready(function () {
                                                //First
                                                $('#extra_first').click(function () {
                                                    if ($('#extra_first').is(":checked"))
                                                    {
                                                        //alert('it is checked');
                                                        var price = $('#extra_first').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) + parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);

                                                    } else {
                                                        //alert('not');
                                                        var price = $('#extra_first').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) - parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                    }
                                                });
                                                //Second
                                                $('#extras_second').click(function () {
                                                    if ($('#extras_second').is(":checked"))
                                                    {
                                                        var price = $('#extras_second').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) + parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
 
                                                    } else {
                                                        var price = $('#extras_second').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) - parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                    }
                                                });
                                                //Third
                                                $('#extras_third').click(function () {
                                                    if ($('#extras_third').is(":checked"))
                                                    {
                                                        var price = $('#extras_third').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) + parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);

                                                    } else {
                                                        var price = $('#extras_third').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) - parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                    }
                                                });

                                                //Fourth
                                                $('#extras_fourth').click(function () {
                                                    if ($('#extras_fourth').is(":checked"))
                                                    {
                                                        var price = $('#extras_fourth').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) + parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);

                                                    } else {
                                                        var price = $('#extras_fourth').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) - parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                    }
                                                });

                                                //Five
                                                $('#extras_five').click(function () {
                                                    if ($('#extras_five').is(":checked"))
                                                    {
                                                        var price = $('#extras_five').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) + parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);

                                                    } else {
                                                        var price = $('#extras_five').val();
                                                        var change_plan = $('#total').html();
                                                        var math = parseInt(change_plan) - parseInt(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                    }
                                                });


                                            });

                                            function change_ajax_state(Str)
                                            {
                                                var datastring = "Country=" + Str;
                                                $.ajax({
                                                    url: "<?php echo base_url(); ?>front/service/change_state",
                                                    data: datastring,
                                                    type: "POST",
                                                    cache: false,
                                                    async: false,
                                                    success: function (html)
                                                    {
                                                        $("#change").html(html);
                                                    }
                                                });
                                            }

                                            function weekly_new(plan) {
                                                //alert(plan);
                                                $('#final_plan').html(plan);
                                                $('#chang_plans').val(plan);
                                                $('#plans_new li.active').removeClass('active');
                                                $(this).parent().addClass('active');
                                                document.getElementById('one_time').style.display = 'none';
                                            }


                                            function plan_select_one(selectPlan,plan) {
                                                //alert(selectPlan);
                                                $('#change_plan').html(selectPlan);
                                                $('#total').html(selectPlan);
                                                $('#total_new').val(selectPlan);
                                                $('#fullprice').val(selectPlan);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);
                                                
                                            }

                                            function plan_select(selectPlan,plan) {
                                                //alert(selectPlan);
                                                $('#change_plan').html(selectPlan);
                                                $('#total').html(selectPlan);
                                                $('#total_new').val(selectPlan);
                                                $('#fullprice').val(selectPlan);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);
                                                
                                            }

                                            function six_mnth(selectPlan,plan) {
                                                $('#change_plan').html(selectPlan);
                                                $('#total').html(selectPlan);
                                                $('#total_new').val(selectPlan);
                                                $('#fullprice').val(selectPlan);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);
                                            }

                                            function tweleve_mnth(selectPlan,plan)
                                            {
                                                $('#change_plan').html(selectPlan);
                                                $('#total').html(selectPlan);
                                                $('#total_new').val(selectPlan);
                                                $('#fullprice').val(selectPlan);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);
                                            }



</script>




<!---footer--->