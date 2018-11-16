<?php $get_data = json_decode($get_fetch_data->cat_attribute);

    // echo "<pre>";print_r($get_data);exit;
	 //print_r($get_booking); die;
     
     ?>
<section class="finalize_dv">
    <div class="container"> 
        <div id="page-wrap">
            <form method='post' name="booking_form" id="booking_form" action="<?php //echo base_url() . 'front/Service/checkout';     ?>">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="page-wrap_left" id="content">
                        <?php if ($get_fetch_plan != 'no record found') { ?>
                            <div class="left_page_hed">
                                <?php $cat_name = $this->session->userdata('child_cat'); ?>
                                <h3>  Set up a Plan  For <?php echo $get_category; ?></h3>
                            </div>
                        <?php } else {
                            
                        }
                        ?>
                        <input type="hidden" name="category" value="<?php echo $get_category; ?>">
                        <div class="left_page_description">
						 <div class="">
								  <div class="col-lg-12">
								  <span id="cmsg"></span>
									 <div class="well well-lg">
										<div class="media1">										  
										   <div class="media-body">
										    <p><b><em>*If you are looking custom plan then please contact us!*</em></b></p>
											  <div class="form-group" style="padding:12px;">
												 <textarea name="cplans" id="cplans" class="form-control animated" placeholder="Share your plan with Home Services team..."></textarea>
												 <a class="btn btn-info pull-right" style="margin-top:10px" href="#" onclick="sendplans();">Submit</a>
											  </div>
										   </div>
										</div>
									 </div>
									 <!-- well-sm -->
								  </div>					 
						 
						 </div>
						

                            <?php							
							//print_r($get_fetch_data);
                            if ($get_fetch_plan != 'no record found') {

                                $one_monthly_per = (!empty($get_fetch_plan->one_monthly_per)) ? $get_fetch_plan->one_monthly_per : '';
                                $three_monthly_per = (!empty($get_fetch_plan->three_monthly_per)) ? $get_fetch_plan->three_monthly_per : '';
                                $six_monthly_per = (!empty($get_fetch_plan->six_monthly_per)) ? $get_fetch_plan->six_monthly_per : '';
                                $yearly_per = (!empty($get_fetch_plan->yearly_per)) ? $get_fetch_plan->yearly_per : '';
                                $week = (!empty($get_fetch_plan->weekly_price)) ? $get_fetch_plan->weekly_price : '';
                                $biweek = (!empty($get_fetch_plan->biweekly_price)) ? $get_fetch_plan->biweekly_price : '';
                                ?>
                                <h4>Select a frequency </h4>
                                <p>Choose a frequency that's right for you! You can always change frequencies, reschedule, or save cleanings for later!</p>
                                <div class="btn_inline_desc">
                                    <ul class="price_btns" id="plans_new">
    <?php if ($week != '') { ?>
                                            <li class="active"  id="test">
                                                <a name='weekly' class="w1" onclick="weekly_new('Weekly')">Weekly</a>
                                            </li>
                                        <?php } ?>
    <?php if ($biweek != '') { ?>
                                            <li id="test1">
                                                <a  name='biweekly' onclick="biweekly_new('Biweekly')">Biweekly</a>
                                            </li>
    <?php } ?>
                                        <li id="test2">
                                            <a  name='monthlys' onclick="monthlys_new('Monthly')">Monthly</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="minimum_plans  price_btns_deatis" id="minimum_plans">
                                    <?php
									//echo "<script> alert($get_fetch_data)</script>";
                                    if ($get_fetch_data->cat_attribute != '') {
                                        $get_data = json_decode($get_fetch_data->cat_attribute);
                                        //echo "<pre>";print_r($get_data);exit;
                                        //$rating = (!empty($member_review)) ? $member_review : '0';
                                        $weekly_price_1 = (!empty($get_data[0]->weekly_price)) ? $get_data[0]->weekly_price : '';
                                        $weekly_price_2 = (!empty($get_data[1]->weekly_price)) ? $get_data[1]->weekly_price : '';
                                        $weekly_price_3 = (!empty($get_data[2]->weekly_price)) ? $get_data[2]->weekly_price : '';

                                        $biweekly_price_1 = (!empty($get_data[0]->biweekly_price)) ? $get_data[0]->biweekly_price : '';
                                        $biweekly_price_2 = (!empty($get_data[1]->biweekly_price)) ? $get_data[1]->biweekly_price : '';
                                        $biweekly_price_3 = (!empty($get_data[2]->biweekly_price)) ? $get_data[2]->biweekly_price : '';

                                        $monthly_price_1 = (!empty($get_data[0]->monthly_price)) ? $get_data[0]->monthly_price : '';
                                        $monthly_price_2 = (!empty($get_data[1]->monthly_price)) ? $get_data[1]->monthly_price : '';
                                        $monthly_price_3 = (!empty($get_data[2]->monthly_price)) ? $get_data[2]->monthly_price : '';
																				

                                        $h1 = (!empty($get_data[0]->unit)) ? $get_data[0]->unit : '';
                                        $h2 = (!empty($get_data[1]->unit)) ? $get_data[1]->unit : '';
                                        $h3 = (!empty($get_data[2]->unit)) ? $get_data[2]->unit : '';
                                        
                                        $first_item = (($get_booking->first_item!='-')) ? $get_booking->first_item : 0;
                                        $second_item = (($get_booking->second_item!='-')) ? $get_booking->second_item : 0;
                                        $third_item = (($get_booking->thired_item!='-')) ? $get_booking->thired_item : 0;
                                        $helper = ($get_booking->helper) ? $get_booking->helper : 1;
										$hour_prc = ($get_booking->hour_prc) ? $get_booking->hour_prc : 1; 
                                        
                                        $helper = (is_numeric($helper)) ? $helper : 1;
										if($get_booking->hour_prc == ''){
                                        $weekly_plan = (($h1 * $first_item*$weekly_price_1)+($h2 * $second_item*$weekly_price_2)+($h3 * $third_item*$weekly_price_3))*$helper;


                                        $biweekly_plan = (($h1 * $first_item*$biweekly_price_1)+($h2 * $second_item*$biweekly_price_2)+($h3 * $third_item*$biweekly_price_3))*$helper;

                                        $monthly_plan = (($h1 * $first_item*$monthly_price_1)+($h2 * $second_item*$monthly_price_2)+($h3 * $third_item*$monthly_price_3))*$helper;
										}else{
											
										$weekly_plan = ($hour_prc)*$helper;
                                        
                                        $biweekly_plan = ($hour_prc)*$helper;

                                        $monthly_plan = ($hour_prc)*$helper;
										}
										
                                        // echo "<pre>";    
                                        // print_r($get_data);
                                        // print_r($get_booking);
                                        // die;
										
										
										//getting fixed price data
										

                                        //$first_plan = (($h1 * $first_time)+($h2 * $second_item)+($h3 * $third_item))**$helper;


                                        //$second_plan = $get_fetch_price_2 * $second_item;
                                        //$third_plan = $get_fetch_price_3 * $third_item;
                                        $total = 1;//$weekly_plan; //$first_plan + $second_plan + $third_plan;

                                        $hour_price = (!empty($get_booking->hour_prc)) ? $get_booking->hour_prc : '';
                                        ?>

                                        <?php
                                        $m = date('m');
                                        $full = date('M');
                                        $y = date('Y');
                                        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);
                                        $when = strtotime($d . $full . ',' . $y);
                                        //if ($when === null) 
                                        //$when = time();
                                        $week = date('W', $when); // note that ISO weeks start on Monday
                                        $firstWeekOfMonth = date('W', strtotime(date('Y-m-01', $when)));
                                        $getweek = 1 + ($week < $firstWeekOfMonth ? $week : $week - $firstWeekOfMonth);
                                       // changed by prateek
                                      $getbiweek = $getweek * 2;
                                      // $getbiweek = 2;
                                        $monthlys = 1;
                                        ?>
                                        <input type="hidden" name="getweek" id="getweek" value="4">
                                        <input type="hidden" name="getbiweek" id="getbiweek" value="2">
                                        <input type="hidden" name="month_freq" id="month_freq" value="<?php echo $monthlys ?>">

                                        <?php
                                        if ($one_monthly_per != '') {
                                            //echo $total;die;
                                            $multiply = $total * 1;
                                            $getweeklyprice = $weekly_plan;//$multiply * $getweek;
                                            
                                            $per = $getweeklyprice * $one_monthly_per / 100;

                                            $final_price = $getweeklyprice - $per;
						
                                            $bimultiply = $total * 1;
                                            $getbiweeklyprice = $biweekly_plan;//$bimultiply * $getbiweek;
                                            $bi_per = $getbiweeklyprice * $one_monthly_per / 100;
                                            $bi_final_price = $getbiweeklyprice - $bi_per;

                                            $mon_multiply = $total * 1;
                                            $getmon_price = $monthly_plan;// weekly_plan;//$mon_multiply * $monthlys;
                                            $mon_per = $getmon_price * $one_monthly_per / 100;
                                            $mon_final_price = $getmon_price - $mon_per;
                                            ?>      
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="price_table_new">
                                                    <div class="persetag"><span><?php echo $one_monthly_per; ?> % Save</span></div>
                                                    <div  id="1_month">
                                                        <a class="plan_1 active set_dis_1" id="set_1" onclick="plan_select_one('<?php echo $total; ?>', '<?php echo '1'; ?>', 'One Month')"></a>
                                                    </div>
                                                    <h4> 1 Month </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='three_mnth' id="one_mnth">
                                                        <?php echo $final_price; ?>
                                                        </span>

                                                        <input type="hidden" name="bi_one_mnth" id="bi_one_mnth" value="<?php echo $bi_final_price; ?>">
                                                        <input type="hidden" name="week_one_mnth" id="week_one_mnth" value="<?php echo $final_price; ?>">
                                                        <input type="hidden" name="des_week_one_mnth" id="des_week_one_mnth" value="<?php echo $mon_per; ?>">
                                                        <input type="hidden" name="monthly_frq" id="monthly_frq" value="<?php echo $mon_final_price; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>                               
                                        <?php
                                        if ($three_monthly_per != '') {

                                            $multiply = $total * 3;
                                            $getweeklyprice = $weekly_plan; //$multiply * $getweek;
                                            $per = $getweeklyprice * $three_monthly_per / 100;
                                            $weekthree_final_price = $getweeklyprice - $per;

                                            $bimultiply = $total * 3;
                                            $getbiweeklyprice = $biweekly_plan;//$bimultiply * $getbiweek;
                                            $bi_per = $getbiweeklyprice * $three_monthly_per / 100;
                                            $bithree_final_price = $getbiweeklyprice - $bi_per;

                                            $mon_multiply = $total * 3;
                                            $getmon_price = $monthly_plan;//$mon_multiply * $monthlys;
                                            $mon_per = $getmon_price * $three_monthly_per / 100;
                                            $mon_three_final_price = $getmon_price - $mon_per;
                                            ?>      

                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="price_table_new">
                                                    <div class="persetag"><span><?php echo $three_monthly_per; ?> % Save</span></div>
                                                    <div  id="3_month">
                                                        <a class="plan_3 set_dis_3" id="set_3" onclick="plan_select('<?php echo $total; ?>', '<?php echo '3'; ?>', 'Three Month')"></a>
                                                    </div>
                                                    <h4> 3 Months </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='three_mnth' id="three_mnth">
                                                        
                                                        <?php
                                                        	$f3m=$weekthree_final_price;//3;
                                                        	$bithree_final_price= $bithree_final_price;//3;
                                                        	$mon_three_final_price=$mon_three_final_price;//3;			
                                                        ?>
            <?php echo $f3m; ?>
                                                        </span>
                                                        <input type="hidden" name="bi_three_mnth" id="bi_three_mnth" value="<?php echo $bithree_final_price; ?>">
                                                        <input type="hidden" name="week_three_mnth" id="week_three_mnth" value="<?php echo $f3m; ?>">
                                                        <input type="hidden" name="des_week_three_mnth" id="des_week_three_mnth" value="<?php echo $mon_per; ?>">
                                                        <input type="hidden" name="mon_three_final_price" id="mon_three_final_price" value="<?php echo $mon_three_final_price; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if ($six_monthly_per != '') {
                                            $multiply = $total * 6;
                                            $getweeklyprice = $weekly_plan; //$multiply * $getweek;
                                            $per = $getweeklyprice * $six_monthly_per / 100;
                                            $weeksix_final_price = $getweeklyprice - $per;

                                            $bimultiply = $total * 6;
                                            $getbiweeklyprice = $biweekly_plan;//$bimultiply * $getbiweek;
                                            //die;
                                            $bi_per = $getbiweeklyprice * $six_monthly_per / 100;
                                            $bisix_final_price = $getbiweeklyprice - $bi_per;
                                            #die;
                                            $mon_multiply = $total * 6;
                                            $getmon_price = $monthly_plan;//$mon_multiply * $monthlys;
                                            $mon_per = $getmon_price * $six_monthly_per / 100;
                                            $mon_six_final_price = $getmon_price - $mon_per;
                                            ?>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="price_table_new">
                                                    <div class="persetag"><span><?php echo $six_monthly_per; ?> % Save</span></div>
                                                    <div id="6_month">
                                                        <a class="plan_6 set_dis_6" id="set_6" onclick="six_mnth('<?php echo $total; ?>', '<?php echo '6'; ?>', 'Six Month')" ></a></div>
                                                    <h4> 6 Months </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='six_mnth' id="six_mnth">
                                                        <?php
                                                        $f6m= $weeksix_final_price;///6;
                                                        $bisix_final_price=$bisix_final_price;///6;
                                                        $mon_six_final_price=$mon_six_final_price;//6;
                                                        ?>
            <?php echo $f6m; ?>
                                                        </span>
                                                        <input type="hidden" name="bi_six_mnth" id="bi_six_mnth" value="<?php echo $bisix_final_price; ?>">
                                                        <input type="hidden" name="week_six_mnth" id="week_six_mnth" value="<?php echo $f6m; ?>">
                                                        <input type="hidden" name="des_week_six_mnth" id="des_week_six_mnth" value="<?php echo $mon_per; ?>">
                                                        <input type="hidden" name="mon_six_final_price" id="mon_six_final_price" value="<?php echo $mon_six_final_price; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if ($yearly_per != '') {
                                            $multiply = $total * 12;
                                            $getweeklyprice = $weekly_plan;//$multiply * $getweek;
                                            $per = $getweeklyprice * $yearly_per / 100;
                                            $weektwelve_final_price = $getweeklyprice - $per;

                                            $bimultiply = $total * 12;
                                            $getbiweeklyprice = $biweekly_plan;//$bimultiply * $getbiweek;
                                            $bi_per = $getbiweeklyprice * $yearly_per / 100;
                                            $bitwelve_final_price = $getbiweeklyprice - $bi_per;

                                            $mon_multiply = $total * 12;
                                            $getmon_price =$monthly_plan ;$mon_multiply * $monthlys;
                                            $mon_per = $getmon_price * $yearly_per / 100;
                                            $mon_twelve_final_price = $getmon_price - $mon_per;
                                            ?>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="price_table_new">
                                                    <div class="persetag"><span><?php echo $yearly_per; ?> % Save</span></div>
                                                    <div id="12_month">
                                                        <a class="plan_12 set_dis_12" id="set_12" onclick="tweleve_mnth('<?php echo $total; ?>', '<?php echo '12'; ?>', 'Tweleve Month')"></a></div>
                                                    <h4> 12 Months </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='twelve_mnth' id="twelve_mnth">
                                                        <?php
                                                        $f12m=$weektwelve_final_price;///12;
                                                        $bitwelve_final_price=$bitwelve_final_price;///12;
                                                        $mon_twelve_final_price=$mon_twelve_final_price;///12;
                                                        ?>
            <?php echo $f12m; ?>
                                                        </span>
                                                        <input type="hidden" name="bi_twelve_mnth" id="bi_twelve_mnth" value="<?php echo $bitwelve_final_price; ?>">
                                                        <input type="hidden" name="week_twelve_mnth" id="week_twelve_mnth" value="<?php echo $f12m; ?>">
                                                        <input type="hidden" name="des_week_twelve_mnth" id="des_week_twelve_mnth" value="<?php echo $mon_per; ?>">
                                                        <input type="hidden" name="mon_twelve_final_price" id="mon_twelve_final_price" value="<?php echo $mon_twelve_final_price; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                    <?php } ?>									 

                                <?php } ?>
                                </div>
    <?php
    //}
} else {
										if ($get_fetch_data->cat_attribute != '') {
											$get_data = json_decode($get_fetch_data->cat_attribute);
										}
										$fixed_price_1 = (!empty($get_data[0]->fixed_price)) ? $get_data[0]->fixed_price : '';
                                        $fixed_price_2 = (!empty($get_data[1]->fixed_price)) ? $get_data[1]->fixed_price : '';
                                        $fixed_price_3 = (!empty($get_data[2]->fixed_price)) ? $get_data[2]->fixed_price : '';
										
										//print_r($get_fetch_data);
										$h1_fixed = (!empty($get_data[0]->unit)) ? $get_data[0]->unit : '';
                                        $h2_fixed = (!empty($get_data[1]->unit)) ? $get_data[1]->unit : '';
                                        $h3_fixed = (!empty($get_data[2]->unit)) ? $get_data[2]->unit : '';
										
										$first_item = (($get_booking->first_item!='-')) ? $get_booking->first_item : 0;
                                        $second_item = (($get_booking->second_item!='-')) ? $get_booking->second_item : 0;
                                        $third_item = (($get_booking->thired_item!='-')) ? $get_booking->thired_item : 0;
										
										$helper = ($get_booking->helper) ? $get_booking->helper : 1;
                                        $helper = (is_numeric($helper)) ? $helper : 1;
                                        //----------------------                                        
										$hour_prc = ($get_booking->hour_prc) ? $get_booking->hour_prc : 1; 
                                        
										if($get_booking->hour_prc == ''){
                                        $final_price = (($h1_fixed * $first_item * $fixed_price_1)+($h2_fixed * $second_item * $fixed_price_2)+($h3_fixed * $third_item * $fixed_price_3))*$helper;
										}else{										
										$final_price = ($hour_prc)* $helper;
										}
                                        //---------------------
                                        
                                        //$final_price = (($h1_fixed * $first_item * $fixed_price_1)+($h2_fixed * $second_item * $fixed_price_2)+($h3_fixed * $third_item * $fixed_price_3))*$helper;
																				
    ?>									 
									<?php
                                        if ($fixed_price_1 != '' ||  $get_fetch_plan == 'no record found') {             
                                            ?>      
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="price_table_new">                                                    
                                                    <h4> One Time Payment </h4>
                                                    <div class="price-text"><span>$</span>
                                                        <span class="js-price" name='one_time' id="one_time_fixed">
															<?php echo $final_price; ?>
                                                        </span>                                                        
                                                    </div>
													<input type="hidden" name="chang_plans_fixed" id="chang_plans_fixed" value="Fixed">
                                                </div>

                                            </div>
                                        <?php } ?> 
                                <br><h4>Complete your booking</h4>
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
//                                            if (!empty($get_country)) {
//                                                foreach ($get_country as $country):
                                                    ?>
<!--                                                    <option value="<?php //echo $country->id; ?>"><?php //echo $country->short_name; ?></option>-->
                                                    <option value="<?php echo $single_countries->id; ?>"><?php echo $single_countries->short_name; ?></option>
                                                <?php
//                                            endforeach;
//                                                }
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
                                                            <input id="extra_first" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">

                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                                <input type="hidden" name="extras_one" class="extras_one" value="<?php echo $get_extra[0]->extra; ?>">
                                                               
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 2) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input id="extra_first" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                                 <input type="hidden" name="extras_one" class="extras_one" value="<?php echo $get_extra[0]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                               <input type="hidden" name="extras_two" class="extras_two" value="<?php echo $get_extra[1]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 3) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input id="extra_first" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                                <input type="hidden" name="extras_one" class="extras_one" value="<?php echo $get_extra[0]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                                <input type="hidden" name="extras_two" class="extras_two" value="<?php echo $get_extra[1]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input id="extras_third" class="first_check" value="<?php echo $get_extra[2]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 3">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                                 <input type="hidden" name="extras_three" class="extras_three" value="<?php echo $get_extra[2]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 4) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input id="extra_first" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                                 <input type="hidden" name="extras_one" class="extras_one" value="<?php echo $get_extra[0]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                                <input type="hidden" name="extras_two" class="extras_two" value="<?php echo $get_extra[1]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input id="extras_third" class="first_check" value="<?php echo $get_extra[2]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 3">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                                <input type="hidden" name="extras_three" class="extras_three" value="<?php echo $get_extra[2]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_4">
                                                        <label>
                                                            <input id="extras_fourth" class="first_check" value="<?php echo $get_extra[3]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 4">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine(1).png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine.png">
                                                                </div>
                                                                <p><?php echo $get_extra[3]->extra; ?></p>
                                                                <input type="hidden" name="extras_fourth" class="extras_fourth" value="<?php echo $get_extra[3]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
            <?php } ?>
            <?php if ($count_extra == 5) { ?>
                                                    <li id="div_1">
                                                        <label>
                                                            <input id="extra_first" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                                 <input type="hidden" name="extras_one" class="extras_one" value="<?php echo $get_extra[0]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                                <input type="hidden" name="extras_two" class="extras_two" value="<?php echo $get_extra[1]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input id="extras_third" class="first_check" value="<?php echo $get_extra[2]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 3">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                                <input type="hidden" name="extras_three" class="extras_three" value="<?php echo $get_extra[2]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_4">
                                                        <label>
                                                            <input id="extras_fourth" class="first_check" value="<?php echo $get_extra[3]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 4">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine(1).png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine.png">
                                                                </div>
                                                                <p><?php echo $get_extra[3]->extra; ?></p>
                                                                <input type="hidden" name="extras_fourth" class="extras_fourth" value="<?php echo $get_extra[3]->extra; ?>">
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_5">
                                                        <label>
                                                            <input id="extras_five" class="first_check" value="<?php echo $get_extra[4]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 5">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/window.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/window(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[4]->extra; ?></p>
                                                                <input type="hidden" name="extras_five" class="extras_five" value="<?php echo $get_extra[4]->extra; ?>">
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
						
						 <?php
                        if ($get_fetch_data != 'no record found') {
                            if ($get_fetch_data->extra != '') {
                                $get_extra = json_decode($get_fetch_data->extra);
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
                                                            <input id="extra_first_fixed" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
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
                                                            <input id="extra_first_fixed" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second_fixed" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
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
                                                            <input id="extra_first_fixed" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second_fixed" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input id="extras_third_fixed" class="first_check" value="<?php echo $get_extra[2]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 3">
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
                                                            <input id="extra_first_fixed" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second_fixed" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input id="extras_third_fixed" class="first_check" value="<?php echo $get_extra[2]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 3">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_4">
                                                        <label>
                                                            <input id="extras_fourth_fixed" class="first_check" value="<?php echo $get_extra[3]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 4">
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
                                                            <input id="extra_first_fixed" class="first_check" value="<?php echo $get_extra[0]->extra_price; ?>" type="checkbox">
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 1">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/cabinet(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[0]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_2">
                                                        <label>
                                                            <input id="extras_second_fixed" class="first_check" value="<?php echo $get_extra[1]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 2">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/icon.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/icon(2).png">
                                                                </div>
                                                                <p><?php echo $get_extra[1]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_3">
                                                        <label>
                                                            <input id="extras_third_fixed" class="first_check" value="<?php echo $get_extra[2]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 3">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/oven.png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/oven(1).png">
                                                                </div>
                                                                <p><?php echo $get_extra[2]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_4">
                                                        <label>
                                                            <input id="extras_fourth_fixed" class="first_check" value="<?php echo $get_extra[3]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 4">
                                                                    <img class="green_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine(1).png">
                                                                    <img class="white_icon" src="<?php echo base_url(); ?>assets/front/img/drying-machine.png">
                                                                </div>
                                                                <p><?php echo $get_extra[3]->extra; ?></p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li id="div_5">
                                                        <label>
                                                            <input id="extras_five_fixed" class="first_check" value="<?php echo $get_extra[4]->extra_price; ?>" type="checkbox" >
                                                            <div class="cleaning-extra">
                                                                <div class="cleaning_check_box 5">
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
                                    <h3><?php //echo $get_booking->plan_book;      ?> &nbsp;<?php echo $get_category; ?>

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
                                <p id="12_months" class="tab-pane fade">Your plan For<span><?php //echo $get_booking->plan_book_mnth;     ?></span> </p>
<?php //}      ?>
    <!--					  <p id="3_months" class="tab-pane fade in active"> Minimum 12 months<span></span> </p>
                                 <p id="6_months" class="tab-pane fade"> Minimum 6 months <span>£39.00</span> </p>-->
                            </div>
                            <div class="top_pannel2">						
                                <p>Date &nbsp;<?php echo date('d M Y', strtotime(!empty($get_booking->select_date) ? $get_booking->select_date : '')); ?> </p>
                                <p>Time on  &nbsp;<?php echo (!empty($get_booking->select_time)) ? $get_booking->select_time : ''; ?> </p>
                                <?php if ($get_fetch_plan != 'no record found') { ?>

                                    <p id="monthlyplan"></p>
                                    <p id="final_plan" ></p>
<?php } else {
    ?>
                                <?php } ?>
								
                                <input type="hidden" name="chang_plans" id="chang_plans" value="">								
                                <input type="hidden" name="monthlyplans" id="monthlyplans" value="One Time">
                                <p id="one_time" style="display: none;">One Time</p>
                                <?php if ($get_booking->first_item != '-') { ?>
                                    <p><?php echo $get_booking->first_item; ?> - &nbsp;&nbsp;<?php echo $get_booking->plan_hr_badroom ?></p>
                                <?php } ?>
                                <?php if ($get_booking->second_item != '-') { ?>
                                    <p><?php echo $get_booking->second_item; ?> - &nbsp;&nbsp;<?php echo $get_booking->plan_hr_bathroom; ?></p>
<?php } ?>
<?php if ($get_booking->thired_item != '-') { ?>
                                    <p><?php echo $get_booking->thired_item; ?> - &nbsp;&nbsp;<?php echo $get_booking->livingroom; ?></p>
<?php } ?>

<?php if ($get_booking->hour_prc != '') { ?>
                                    <p id="one_time" style="display: none;">One Time</p>
                                    <?php (is_numeric($get_booking->helper))?$help_name = 'x '.$get_booking->helper.' (helper)':'';?>
                                    <?php $get_booking->helper = (is_numeric($get_booking->helper))?$get_booking->helper :1;?>
                                    <p><?php echo $get_booking->hourly.' hours @ $'.round($get_booking->hour_prc/$get_booking->hourly,2).'/hour '.$help_name; ?></p>
                                    <p >Subtotal - &nbsp;&nbsp; $ <span ><?php echo $get_booking->hour_prc *$get_booking->helper;?></span></p>
                                    <?php if ($get_fetch_plan != 'no record found') { ?>
                                    <p >Discount - &nbsp;&nbsp;  <span class="show_dis"></span></p>
                                    <?php } ?>
                                    
<?php } ?>
<p><b class="extras_show" >Extra</b></p>
                                    <p class="extras_name_one" style="display: none; "></p>
                                    <p class="extras_name_two" style="display: none; "></p>
                                    <p class="extras_name_three" style="display: none; "></p>
                                    <p class="extras_name_fourth" style="display: none; "></p>
                                    <p class="extras_name_five" style="display: none; "></p>
                            </div>
                            
                        </div>


                        <div class="payment-summary" id="payment_breakdown" style="display: block;">
                            <div data-symbol="£" id="payment_summary_symbol"></div>
                            <div data-commitment="no_commitment" id="commitment-type"></div>
                            <div class="payment-section">
                                <div class="checkout-row">
                                    <div class="payment-summary-subtotal payment-summary-row" style="display: block;">
                                        <!--                                        <div class="payment-summary-title">Subtotal</div>-->
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
                                            //print_r($get_fetch_data); die;
                                            $hourly= (!empty($get_booking->hourly)) ? $get_booking->hourly : '';
                                            $first_plan = $get_fetch_price_1 * $first_time;
                                            $second_plan = $get_fetch_price_2 * $second_item;
                                            $third_plan = $get_fetch_price_3 * $third_item;
                                            $total = $first_plan + $second_plan + $third_plan;
                                            
											if(isset($get_data[0]->fixed_price)){
													$get_fetch_price_1 = (!empty($get_data[0]->fixed_price)) ? $get_data[0]->fixed_price : '';
													$get_fetch_price_2 = (!empty($get_data[1]->fixed_price)) ? $get_data[1]->fixed_price : '';
													$get_fetch_price_3 = (!empty($get_data[2]->fixed_price)) ? $get_data[2]->fixed_price : '';
													
													$h1_fixed = (!empty($get_data[0]->unit)) ? $get_data[0]->unit : '';
													$h2_fixed = (!empty($get_data[1]->unit)) ? $get_data[1]->unit : '';
													$h3_fixed = (!empty($get_data[2]->unit)) ? $get_data[2]->unit : '';
													
													$first_item = (($get_booking->first_item!='-')) ? $get_booking->first_item : 0;
													$second_item = (($get_booking->second_item!='-')) ? $get_booking->second_item : 0;
													$third_item = (($get_booking->thired_item!='-')) ? $get_booking->thired_item : 0;
													
													$helper = ($get_booking->helper) ? $get_booking->helper : 1;  
                                                    
													//$total = (($h1_fixed * $first_item * $get_fetch_price_1)+($h2_fixed * $second_item * $get_fetch_price_2)+($h3_fixed * $third_item * $get_fetch_price_3))*$helper;
                                                    //----------------------
                                                    $hour_prc = ($get_booking->hour_prc) ? $get_booking->hour_prc : 1; 
                                                   
                                                    if($get_booking->hour_prc == ''){
                                                    $total = (($h1_fixed * $first_item * $get_fetch_price_1)+($h2_fixed * $second_item * $get_fetch_price_2)+($h3_fixed * $third_item * $get_fetch_price_3))*$helper;
                                                    }else{										
                                                    $total = ($hour_prc)*$helper;






                                                    }
                                                    //----------------------
											}											
											                                        
                                            $hour_price = (!empty($get_booking->hour_prc)) ? $get_booking->hour_prc : '0';
                                            ?>

    <!--                                            <div class="payment-summary-amount">$<span id="change_plan"><?php echo (!empty($total)) ? $total : $hour_price; ?></span></div>-->

                                            <input type="hidden" name="total_amt" id="total_amt" value="<?php echo $total; ?>">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($get_fetch_plan != 'no record found') {
                                if ($one_monthly_per != '') {

                                    $one_monthly_per = (!empty($get_fetch_plan->one_monthly_per)) ? $get_fetch_plan->one_monthly_per : '';
                                    $three_monthly_per = (!empty($get_fetch_plan->three_monthly_per)) ? $get_fetch_plan->three_monthly_per : '';
                                    $six_monthly_per = (!empty($get_fetch_plan->six_monthly_per)) ? $get_fetch_plan->six_monthly_per : '';
                                    $yearly_per = (!empty($get_fetch_plan->yearly_per)) ? $get_fetch_plan->yearly_per : '';

                                    $m = date('m');
                                    $full = date('M');
                                    $y = date('Y');
                                    $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);
                                    $when = strtotime($d . $full . ',' . $y);
                                    $week = date('W', $when); // note that ISO weeks start on Monday
                                    $firstWeekOfMonth = date('W', strtotime(date('Y-m-01', $when)));
                                    $getweek = 1 + ($week < $firstWeekOfMonth ? $week : $week - $firstWeekOfMonth);
                                    $getbiweek = $getweek * 2;


                                    $multiply = $total * 1;
                                    $getweeklyprice = $multiply * $getweek;
                                    $per = $getweeklyprice * $one_monthly_per / 100;
                                    $final_price = $getweeklyprice - $per;
                                    ?>
            <?php //if($one_monthly_per != ''){  ?>
                                    <div class="payment-section no-border-bottom">
                                        <div class="checkout-row total-price-row">
                                            <div class="total-price-text">
                                                <span>Total</span>
                                            </div>
                                            <div class="total-price">$ 
                                                <span class="js-total-price" style="display: inline;" id="total">
            <?php echo (!empty($final_price)) ? $final_price : $final_price; ?>

                                                </span> <span class="price-suffix"></span>
                                                <input type="hidden" name="fullprice" id="fullprice" value="<?php echo (!empty($final_price)) ? $final_price : $final_price; ?>">
                                                <input type="hidden" name="discount" id="discount" value="<?php echo (!empty($per)) ? $per : $per; ?>">
                                            </div>
                                            <input type="hidden" name="total_new" id="total_new" value="<?php ?>">
                                        </div>
                                    </div>
        <?php }
    } else {
        ?>
                                <div class="payment-section no-border-bottom">
                                    <div class="checkout-row total-price-row">
                                        <div class="total-price-text">
                                            <span>Total</span>
                                        </div>
                                        <div class="total-price">$
                                            
											<span class="js-total-price" style="display: inline;" id="total_fixed">
												<?php echo (!empty($total)) ? $total : $hour_price * $get_booking->helper; ?>
                                            </span> 
											<span class="price-suffix"></span>
                                            <input type="hidden" name="fullprice" id="fullprice" value="<?php echo (!empty($total)) ? $total : $hour_price; ?>">
											<input type="hidden" name="fullprice" id="fullprice_fixed" value="<?php echo (!empty($total)) ? $total : $hour_price; ?>">
                                        </div>
                                        <input type="hidden" name="total_new" id="total_new" value="<?php ?>">
                                    </div>
                                </div>
    <?php } ?>
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
                                    <div class="panel-body">It’s easy to change or cancel your booking on your booking page.</div>
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

		<script>
		
		function sendplans()
		{
			var cplan=document.getElementById("cplans").value;
			jQuery.ajax({
				url: '<?php echo base_url();?>Plan/sendplans',
				type: 'post',
				data: {cplan:cplan},
			    success: function (result)
				{
					$('#cplans').val('');
					document.getElementById("cmsg").innerHTML="<div class='alert alert-success' role='alert'>"+
                                "<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>"+
                                "<h3 class='errormsgs'>Thank you for contactus.</h3> </div>"; 
            
				   
				}
			});
			
		}
		

		/*!
    Autosize v1.18.1 - 2013-11-05
	Automatically adjust textarea height based on user input.
	(c) 2013 Jack Moore - http://www.jacklmoore.com/autosize
	license: http://www.opensource.org/licenses/mit-license.php
*/
(function ($) {
	var
	defaults = {
		className: 'autosizejs',
		append: '',
		callback: false,
		resizeDelay: 10
	},

	// border:0 is unnecessary, but avoids a bug in Firefox on OSX
	copy = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',

	// line-height is conditionally included because IE7/IE8/old Opera do not return the correct value.
	typographyStyles = [
		'fontFamily',
		'fontSize',
		'fontWeight',
		'fontStyle',
		'letterSpacing',
		'textTransform',
		'wordSpacing',
		'textIndent'
	],

	// to keep track which textarea is being mirrored when adjust() is called.
	mirrored,

	// the mirror element, which is used to calculate what size the mirrored element should be.
	mirror = $(copy).data('autosize', true)[0];

	// test that line-height can be accurately copied.
	mirror.style.lineHeight = '99px';
	if ($(mirror).css('lineHeight') === '99px') {
		typographyStyles.push('lineHeight');
	}
	mirror.style.lineHeight = '';

	$.fn.autosize = function (options) {
		if (!this.length) {
			return this;
		}

		options = $.extend({}, defaults, options || {});

		if (mirror.parentNode !== document.body) {
			$(document.body).append(mirror);
		}

		return this.each(function () {
			var
			ta = this,
			$ta = $(ta),
			maxHeight,
			minHeight,
			boxOffset = 0,
			callback = $.isFunction(options.callback),
			originalStyles = {
				height: ta.style.height,
				overflow: ta.style.overflow,
				overflowY: ta.style.overflowY,
				wordWrap: ta.style.wordWrap,
				resize: ta.style.resize
			},
			timeout,
			width = $ta.width();

			if ($ta.data('autosize')) {
				// exit if autosize has already been applied, or if the textarea is the mirror element.
				return;
			}
			$ta.data('autosize', true);

			if ($ta.css('box-sizing') === 'border-box' || $ta.css('-moz-box-sizing') === 'border-box' || $ta.css('-webkit-box-sizing') === 'border-box'){
				boxOffset = $ta.outerHeight() - $ta.height();
			}

			// IE8 and lower return 'auto', which parses to NaN, if no min-height is set.
			minHeight = Math.max(parseInt($ta.css('minHeight'), 10) - boxOffset || 0, $ta.height());

			$ta.css({
				overflow: 'hidden',
				overflowY: 'hidden',
				wordWrap: 'break-word', // horizontal overflow is hidden, so break-word is necessary for handling words longer than the textarea width
				resize: ($ta.css('resize') === 'none' || $ta.css('resize') === 'vertical') ? 'none' : 'horizontal'
			});

			// The mirror width must exactly match the textarea width, so using getBoundingClientRect because it doesn't round the sub-pixel value.
			function setWidth() {
				var style, width;
				
				if ('getComputedStyle' in window) {
					style = window.getComputedStyle(ta, null);
					width = ta.getBoundingClientRect().width;

					$.each(['paddingLeft', 'paddingRight', 'borderLeftWidth', 'borderRightWidth'], function(i,val){
						width -= parseInt(style[val],10);
					});

					mirror.style.width = width + 'px';
				}
				else {
					// window.getComputedStyle, getBoundingClientRect returning a width are unsupported and unneeded in IE8 and lower.
					mirror.style.width = Math.max($ta.width(), 0) + 'px';
				}
			}

			function initMirror() {
				var styles = {};

				mirrored = ta;
				mirror.className = options.className;
				maxHeight = parseInt($ta.css('maxHeight'), 10);

				// mirror is a duplicate textarea located off-screen that
				// is automatically updated to contain the same text as the
				// original textarea.  mirror always has a height of 0.
				// This gives a cross-browser supported way getting the actual
				// height of the text, through the scrollTop property.
				$.each(typographyStyles, function(i,val){
					styles[val] = $ta.css(val);
				});
				$(mirror).css(styles);

				setWidth();

				// Chrome-specific fix:
				// When the textarea y-overflow is hidden, Chrome doesn't reflow the text to account for the space
				// made available by removing the scrollbar. This workaround triggers the reflow for Chrome.
				if (window.chrome) {
					var width = ta.style.width;
					ta.style.width = '0px';
					var ignore = ta.offsetWidth;
					ta.style.width = width;
				}
			}

			// Using mainly bare JS in this function because it is going
			// to fire very often while typing, and needs to very efficient.
			function adjust() {
				var height, original;

				if (mirrored !== ta) {
					initMirror();
				} else {
					setWidth();
				}

				mirror.value = ta.value + options.append;
				mirror.style.overflowY = ta.style.overflowY;
				original = parseInt(ta.style.height,10);

				// Setting scrollTop to zero is needed in IE8 and lower for the next step to be accurately applied
				mirror.scrollTop = 0;

				mirror.scrollTop = 9e4;

				// Using scrollTop rather than scrollHeight because scrollHeight is non-standard and includes padding.
				height = mirror.scrollTop;

				if (maxHeight && height > maxHeight) {
					ta.style.overflowY = 'scroll';
					height = maxHeight;
				} else {
					ta.style.overflowY = 'hidden';
					if (height < minHeight) {
						height = minHeight;
					}
				}

				height += boxOffset;

				if (original !== height) {
					ta.style.height = height + 'px';
					if (callback) {
						options.callback.call(ta,ta);
					}
				}
			}

			function resize () {
				clearTimeout(timeout);
				timeout = setTimeout(function(){
					var newWidth = $ta.width();

					if (newWidth !== width) {
						width = newWidth;
						adjust();
					}
				}, parseInt(options.resizeDelay,10));
			}

			if ('onpropertychange' in ta) {
				if ('oninput' in ta) {
					// Detects IE9.  IE9 does not fire onpropertychange or oninput for deletions,
					// so binding to onkeyup to catch most of those occasions.  There is no way that I
					// know of to detect something like 'cut' in IE9.
					$ta.on('input.autosize keyup.autosize', adjust);
				} else {
					// IE7 / IE8
					$ta.on('propertychange.autosize', function(){
						if(event.propertyName === 'value'){
							adjust();
						}
					});
				}
			} else {
				// Modern Browsers
				$ta.on('input.autosize', adjust);
			}

			// Set options.resizeDelay to false if using fixed-width textarea elements.
			// Uses a timeout and width check to reduce the amount of times adjust needs to be called after window resize.

			if (options.resizeDelay !== false) {
				$(window).on('resize.autosize', resize);
			}

			// Event for manual triggering if needed.
			// Should only be needed when the value of the textarea is changed through JavaScript rather than user input.
			$ta.on('autosize.resize', adjust);

			// Event for manual triggering that also forces the styles to update as well.
			// Should only be needed if one of typography styles of the textarea change, and the textarea is already the target of the adjust method.
			$ta.on('autosize.resizeIncludeStyle', function() {
				mirrored = null;
				adjust();
			});

			$ta.on('autosize.destroy', function(){
				mirrored = null;
				clearTimeout(timeout);
				$(window).off('resize', resize);
				$ta
					.off('autosize')
					.off('.autosize')
					.css(originalStyles)
					.removeData('autosize');
			});

			// Call adjust in case the textarea already contains text.
			adjust();
		});
	};
}(window.jQuery || window.$)); // jQuery or jQuery-like library, such as Zepto
		</script>
<script  type="text/javascript">
var ext=new Array();

                                            $(document).ready(function () {
                                               $('.extras_show').hide();
                                               plan_select_one('1', '1', 'One Month');
                                               //weekly_new('Weekly');
												<?php //if($get_fetch_data->extra != '') { ?>
													delete_cookie('extra_first');
													delete_cookie('extra_second');
													delete_cookie('extra_third');
													delete_cookie('extra_fourth');
													delete_cookie('extra_five');
                                                     //document.cookie = "Biweekly=1";
                                                    delete_cookie('Biweekly');
                                                    delete_cookie('weekly');
                                                    delete_cookie('Monthly');
                                                    delete_cookie('plan_1');
                                                    delete_cookie('plan_3');
                                                    delete_cookie('plan_6');
                                                    delete_cookie('plan_12');
												<?php //} ?>	
                                            	<?php
                                            	if(!empty($get_booking->first_stuff) && is_numeric($get_booking->first_stuff))
                                            	{
                                            	?>
                                            		var price =  <?php  echo $get_booking->first_stuff ; ?> ;
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) * parseFloat(price);
														//alert('change_plan');

                                                        $('#total').html(math);
                                                        var discount = $('#discount').val();
                                                        
                                                        $('#discount_show').html(discount);
                                                        $('#fullprice').val(math);
                                                        
                                                        <?php
                                                        }
                                                        ?>
												
														
													
                                                //First     
                                                var ext1 = [];                                           
                                                var ext2 = [];
                                                var ext3 = [];
                                                var ext4 = [];
                                                var ext5 = [];
                                                $('#extra_first').click(function () {

                                                    if ($('#extra_first').is(":checked"))
                                                    {
                                                         $('.extras_show').show();
                                                        //alert('it is checked');
                                                        var price = $('#extra_first').val(); 
                                                        var extra_name= $('.extras_one').val();
                                                        
                                                        $('.extras_name_one').show().html(extra_name+' -$'+price+ '<br>');
                                                        //$('.extras_name_one');
                                                        var change_plan = $('#total').html();
														//alert(price);
                                                        var math = parseFloat(change_plan) + parseFloat(price);      
                                                       
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);      
                                                            document.cookie = "extra_first=1";                                                     
                                                    } else {
														//alert('it is not checked');
                                                        var price = $('#extra_first').val();
                
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) - parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        if ($('#extras_second').is(":checked")== false && 
                                                            $('#extras_third').is(":checked") == false &&
                                                            $('#extras_fourth').is(":checked")== false &&
                                                            $('#extras_five').is(":checked")== false)
                                                        {
                                                             $('.extras_show').hide();
                                                        }
                                                       
                                                        $('.extras_name_one').hide();
                                                        delete_cookie('extra_first');
                                                    }
                                                });                                                
                                                //Second
                                                $('#extras_second').click(function () {
                                                    
                                                    if ($('#extras_second').is(":checked"))
                                                    {
                                                        var price = $('#extras_second').val(); 
                                                        var extra_name= $('.extras_two').val();
                                                        $('.extras_show').show();
                                                        $('.extras_name_two').show().html(extra_name+' -$'+price+ '<br>');
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) + parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        document.cookie = "extra_second=1";

                                                    } else {
                                                        var price = $('#extras_second').val();
                                                        
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) - parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);  
                                                        if ($('#extra_first').is(":checked")== false &&
                                                            $('#extras_third').is(":checked") == false &&
                                                            $('#extras_fourth').is(":checked")== false &&
                                                            $('#extras_five').is(":checked")== false)
                                                        {
                                                             $('.extras_show').hide();
                                                        }
                                                        $('.extras_name_two').hide();    
                                                        delete_cookie('extra_second');
                                                    }
                                                });
                                                //Third
                                                $('#extras_third').click(function () {
                                                    if ($('#extras_third').is(":checked"))
                                                    {
                                                        var price = $('#extras_third').val();
                                                        var extra_name= $('.extras_three').val();
                                                        $('.extras_show').show();
                                                        $('.extras_name_three').show().html(extra_name+' -$'+price+ '<br>');
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) + parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        document.cookie = "extra_third=1";

                                                    } else {
                                                        var price = $('#extras_third').val();
                                                        
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) - parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        if ($('#extra_first').is(":checked")== false &&
                                                            $('#extras_second').is(":checked") == false &&
                                                            $('#extras_fourth').is(":checked")== false &&
                                                            $('#extras_five').is(":checked")== false)
                                                        {
                                                             $('.extras_show').hide();
                                                        }
                                                         $('.extras_name_three').hide();  
                                                        delete_cookie('extra_third');
                                                    }
                                                });
                                                //Fourth
                                                $('#extras_fourth').click(function () {
                                                    if ($('#extras_fourth').is(":checked"))
                                                    {
                                                        var price = $('#extras_fourth').val();
                                                        var extra_name= $('.extras_fourth').val();
                                                        $('.extras_show').show();
                                                        $('.extras_name_fourth').show().html(extra_name+' -$'+price+ '<br>');
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) + parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        document.cookie = "extra_fourth=1";

                                                    } else {
                                                        var price = $('#extras_fourth').val();
                                                        
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) - parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        if ($('#extra_first').is(":checked")== false &&
                                                            $('#extras_second').is(":checked") == false &&
                                                            $('#extras_third').is(":checked") == false &&
                                                            $('#extras_five').is(":checked")== false)
                                                        {
                                                             $('.extras_show').hide();
                                                        }
                                                        $('.extras_name_fourth').hide();  
                                                        delete_cookie('extra_fourth');
                                                    }
                                                });
                                                //Five
                                                $('#extras_five').click(function () {
                                                    if ($('#extras_five').is(":checked"))
                                                    {
                                                        var price = $('#extras_five').val();
                                                         var extra_name= $('.extras_five').val();
                                                         $('.extras_show').show();
                                                        $('.extras_name_five').show().html(extra_name+' -$'+price+ '<br>');
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) + parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        document.cookie = "extra_five=1";

                                                    } else {
                                                        var price = $('#extras_five').val();
                                                        
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan) - parseFloat(price);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        if ($('#extra_first').is(":checked")== false &&
                                                            $('#extras_second').is(":checked") == false &&
                                                            $('#extras_third').is(":checked") == false &&
                                                            $('#extras_fourth').is(":checked")== false)
                                                        {
                                                             $('.extras_show').hide();
                                                        }
                                                        $('.extras_name_five').hide();  
                                                        delete_cookie('extra_five');
                                                    }
                                                });
                                            
											
											//First     
													
													$('#extra_first_fixed').click(function () {														
														if ($('#extra_first_fixed').is(":checked"))
														{
															//alert('it is checked');
															var price = $('#extra_first_fixed').val();
                                                            var extra_name= $('.extras_one').val();
                                                           
                                                            $('.extras_name_one').show().html(extra_name+' -$'+price+ '<br>');      
															var change_plan = $('#total_fixed').html();
															//alert(price);
															var math = parseFloat(change_plan) + parseFloat(price);      
														   
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);      
																document.cookie = "extra_first_fixed=1";                                                     
														} else {
														 //  alert('not');
															var price = $('#extra_first_fixed').val();
															
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) - parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
                                                            $('.extras_name_one').hide();    
															delete_cookie('extra_first_fixed');
															
														}
													});                                                
													//Second
													$('#extras_second_fixed').click(function () {
														if ($('#extras_second_fixed').is(":checked"))
														{
															var price = $('#extras_second_fixed').val();
															
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) + parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
															document.cookie = "extra_second_fixed=1";
	
														} else {
															var price = $('#extras_second_fixed').val();
															
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) - parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);      
															delete_cookie('extra_second_fixed');
														}
													});
													//Third
													$('#extras_third_fixed').click(function () {
														if ($('#extras_third_fixed').is(":checked"))
														{
															var price = $('#extras_third_fixed').val();
															//alert('checked');
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) + parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
															document.cookie = "extra_third_fixed=1";
	
														} else {
															var price = $('#extras_third_fixed').val();
															//alert('kk');
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) - parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
															delete_cookie('extra_third_fixed');
														}
													});
													//Fourth
													$('#extras_fourth_fixed').click(function () {
														if ($('#extras_fourth_fixed').is(":checked"))
														{
															var price = $('#extras_fourth_fixed').val();
															
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) + parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
															document.cookie = "extra_fourth_fixed=1";
	
														} else {
															var price = $('#extras_fourth_fixed').val();
															
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) - parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
															delete_cookie('extra_fourth_fixed');
														}
													});
													//Five
													$('#extras_five_fixed').click(function () {
														if ($('#extras_five_fixed').is(":checked"))
														{
															var price = $('#extras_five_fixed').val();
															
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) + parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
															document.cookie = "extra_five_fixed=1";
	
														} else {
															var price = $('#extras_five_fixed').val();
															
															var change_plan = $('#total_fixed').html();
															var math = parseFloat(change_plan) - parseFloat(price);
															$('#total_fixed').html(math);
															$('#fullprice_fixed').val(math);
															delete_cookie('extra_five_fixed');
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
                                            var des_week_one_mnth = $('#des_week_one_mnth').val();

                                            var des_week_three_mnth = $('#des_week_three_mnth').val();
                                            var des_week_six_mnth = $('#des_week_six_mnth').val();
                                            var des_week_twelve_mnth = $('#des_week_twelve_mnth').val();
                                           
                                            if ($('#set_1').hasClass('active')== true)
                                            {
                                                
                                               $('.show_dis').html('$ '+ des_week_one_mnth);
                                            }
                                            
                                            
                                             $('.set_dis_1').click(function (){
                                                    $('.show_dis').html('$ '+ des_week_one_mnth);
                                                });
                                                $('.set_dis_3').click(function (){
                                                    $('.show_dis').html('$ '+des_week_three_mnth);
                                                });
                                                $('.set_dis_6').click(function (){
                                                    $('.show_dis').html('$ '+des_week_six_mnth);
                                                });
                                                $('.set_dis_12').click(function (){
                                                    $('.show_dis').html('$ '+des_week_twelve_mnth);
                                                });

                                            // End Discont order

                                            function weekly_new(plan) {
                                                //alert(plan);
                                                var week_one_mnth = $('#week_one_mnth').val();    
                                                var week_three_mnth = $('#week_three_mnth').val();
                                                var week_six_mnth = $('#week_six_mnth').val();
                                                var week_twelve_mnth = $('#week_twelve_mnth').val();
                                                /*var des_week_one_mnth = $('#des_week_one_mnth').val();
                                               var des_week_three_mnth = $('#des_week_three_mnth').val();
                                                var des_week_six_mnth = $('#des_week_six_mnth').val();
                                                var des_week_twelve_mnth = $('#des_week_twelve_mnth').val();
                                                console.log(des_week_one_mnth);
                                                console.log(des_week_three_mnth);
                                                console.log(des_week_six_mnth);
                                                console.log(des_week_twelve_mnth);*/

                                                $('#one_mnth').html(week_one_mnth);
                                                $('#three_mnth').html(week_three_mnth);
                                                $('#six_mnth').html(week_six_mnth);
                                                $('#twelve_mnth').html(week_twelve_mnth);

                                                /*$('.set_dis_1').click(function (){
                                                    $('.show_dis').html('$ '+ des_week_one_mnth);
                                                });
                                                $('.set_dis_3').click(function (){
                                                    $('.show_dis').html('$ '+des_week_three_mnth);
                                                });
                                                $('.set_dis_6').click(function (){
                                                    $('.show_dis').html('$ '+des_week_six_mnth);
                                                });
                                                $('.set_dis_12').click(function (){
                                                    $('.show_dis').html('$ '+des_week_twelve_mnth);
                                                });
                                               */
                                                var tt = $('#week_one_mnth').val();//$('#total').html();

                                                $('#total').html(tt);

                                                var get_text = $('#plans_new li.active a').text();
                                                // if (get_text == 'Biweekly')
                                                // {
                                                //     var final = tt / 2;
                                                // } else {
                                                //     var final = tt * 5;
                                                // }          
                                                /*$('.w1').click(function(){
                                                    
                                                    delete_cookie('extra_first');
                                                    delete_cookie('extra_second');
                                                    delete_cookie('extra_third');
                                                    delete_cookie('extra_fourth');
                                                    delete_cookie('extra_five');                            
                                                    $('.1').removeClass('selected');
                                                    $('.2').removeClass('selected');
                                                    $('.3').removeClass('selected');
                                                    $('.4').removeClass('selected');
                                                    $('.5').removeClass('selected');

                                                

                                                })*/
                                
                                                
                                                // var final = tt+parseInt(ext['ex1'])+parseInt(ext['ex2'])+parseInt(ext['ex3'])+parseInt(ext['ex4'])+parseInt(ext['ex5'])
                                                if ($('#extra_first').is(":checked"))
                                                    {
                                                var e1 = $('#extra_first').val()?parseFloat($('#extra_first').val()):0;
                                                var e1_name = $('#extra_first').val()?parseFloat($('#extra_first').val()):0;
                                                }
                                                else{
                                                    var e1=0;
                                                }
                                                 if ($('#extras_second').is(":checked"))
                                                    {
                                                 var e2 = $('#extras_second').val()?parseFloat($('#extras_second').val()):0;
                                             }else{
                                                var e2 =0;
                                             }
                                              if ($('#extras_third').is(":checked"))
                                                    {
                                                  var e3 = $('#extras_third').val()?parseFloat($('#extras_third').val()):0;
                                              }
                                              else{
                                                var e3=0;
                                              }
                                               if ($('#extras_fourth').is(":checked"))
                                                    {
                                                   var e4 = $('#extras_fourth').val()?parseFloat($('#extras_fourth').val()):0;
                                               }
                                               else{
                                                var e4 = 0;
                                               }
                                                if ($('#extras_five').is(":checked"))
                                                    {
                                                    var e5 = $('#extras_five').val()?parseFloat($('#extras_five').val()):0;
                                                }
                                                else{
                                                    var e5 = 0;
                                                }
                                                 
                                                var final = parseFloat(tt)+(parseFloat(e1))+(parseFloat(e2))+(parseFloat(e3))+(parseFloat(e4))+(parseFloat(e5));


                                                $('#total').html(final);

                                                $('#final_plan').html(plan);
                                                $('#chang_plans').val(plan);
                                                $('#chang_plan').html(final);
                                                $('#fullprice').val(final);
                                                $('#plans_new li.active').removeClass('active');
                                                $(this).parent().addClass('active');
                                                document.getElementById('one_time').style.display = 'none';
                                                document.cookie = "weekly=1";
                                                delete_cookie('Biweekly');
                                                delete_cookie('Monthly');

                                            }

                                            function biweekly_new(plan)
                                            {
                                                //var getweek = $('#getweek').val();
                                                //var getbiweek = $('#getbiweek').val();
                                                var tt = $('#bi_one_mnth').val();//$('#total').html();  
                                                                 
                                                var bi_one_mnth = $('#bi_one_mnth').val();

                                                var bi_three_mnth = $('#bi_three_mnth').val();
                                                var bi_six_mnth = $('#bi_six_mnth').val();
                                                var bi_twelve_mnth = $('#bi_twelve_mnth').val();

                                                $('#one_mnth').html(bi_one_mnth);
                                                $('#three_mnth').html(bi_three_mnth);
                                                $('#six_mnth').html(bi_six_mnth);
                                                $('#twelve_mnth').html(bi_twelve_mnth);

                                                var get_text = $('#plans_new li.active a').text();  
                                                // if (get_text == 'Weekly')
                                                // {
                                                //     var final = tt * 2;
                                                // } else {
                                                //     var final = tt * 10;
                                                // }
                                                // $('.b1').click(function(){
                                                    
                                                //     delete_cookie('extra_first');
                                                //     delete_cookie('extra_second');
                                                //     delete_cookie('extra_third');
                                                //     delete_cookie('extra_fourth');
                                                //     delete_cookie('extra_five');                            
                                                //     $('.1').removeClass('selected');
                                                //     $('.2').removeClass('selected');
                                                //     $('.3').removeClass('selected');
                                                //     $('.4').removeClass('selected');
                                                //     $('.5').removeClass('selected');

                                                

                                                // })
                                                //var final = tt;
                                                if ($('#extra_first').is(":checked"))
                                                    {
                                                var e1 = $('#extra_first').val()?parseFloat($('#extra_first').val()):0;
                                                }
                                                else{
                                                    var e1=0;
                                                }
                                                 if ($('#extras_second').is(":checked"))
                                                    {
                                                 var e2 = $('#extras_second').val()?parseFloat($('#extras_second').val()):0;
                                             }else{
                                                var e2 =0;
                                             }
                                              if ($('#extras_third').is(":checked"))
                                                    {
                                                  var e3 = $('#extras_third').val()?parseFloat($('#extras_third').val()):0;
                                              }
                                              else{
                                                var e3=0;
                                              }
                                               if ($('#extras_fourth').is(":checked"))
                                                    {
                                                   var e4 = $('#extras_fourth').val()?parseFloat($('#extras_fourth').val()):0;
                                               }
                                               else{
                                                var e4 = 0;
                                               }
                                                if ($('#extras_five').is(":checked"))
                                                    {
                                                    var e5 = $('#extras_five').val()?parseFloat($('#extras_five').val()):0;
                                                }
                                                else{
                                                    var e5 = 0;
                                                }
                                                    
                                                var final = parseFloat(tt)+(parseFloat(e1))+(parseFloat(e2))+(parseFloat(e3))+(parseFloat(e4))+(parseFloat(e5));

                                                $('#total').html(final);
                                                $('#final_plan').html(plan);
                                                $('#chang_plans').val(plan);
                                                $('#fullprice').val(final);
                                                $('#chang_plan').html(final);
                                                $('#plans_new li.active').removeClass('active');
                                                $(this).parent().addClass('active');
                                                document.getElementById('one_time').style.display = 'none';

                                                document.cookie = "Biweekly=1";
                                                delete_cookie('weekly');
                                                delete_cookie('Monthly');
                                            }

                                            function monthlys_new(plan)
                                            {
                                                //alert(plan);
                                                //var getweek = $('#getweek').val();
                                                //var getbiweek = $('#getbiweek').val();
//                                                var prev = $(this).prev("");
//                                                alert(prev);
                                                //var prev_act_id = $('#plans_new li').prev().text();

                                                //var rre = $('ul#plans_new').children('li').last().text();

//                                                var tty = $('#plans_new li:last-child').text();
//                                                alert(tty);

                                                // alert($('#monthly_frq').val());  
                                               

                                                var monthly_frq = $('#monthly_frq').val();
                                                var mon_three_final_price = $('#mon_three_final_price').val();
                                                var mon_six_final_price = $('#mon_six_final_price').val();
                                                var mon_twelve_final_price = $('#mon_twelve_final_price').val();

                                                $('#one_mnth').html(monthly_frq);
                                                $('#three_mnth').html(mon_three_final_price);
                                                $('#six_mnth').html(mon_six_final_price);
                                                $('#twelve_mnth').html(mon_twelve_final_price);
                                                var get_text = $('#plans_new li.active a').text();
                                                // if (get_text == 'Weekly')
                                                // {
                                                //     var final = tt / 5;
                                                // } else {
                                                //     var final = tt / 10;
                                                // }
                                                var tt = $('#monthly_frq').val();//$('#total').html();
                                                if ($('#extra_first').is(":checked"))
                                                    {
                                                var e1 = $('#extra_first').val()?parseFloat($('#extra_first').val()):0;
                                                }
                                                else{
                                                    var e1=0;
                                                }
                                                 if ($('#extras_second').is(":checked"))
                                                    {
                                                 var e2 = $('#extras_second').val()?parseFloat($('#extras_second').val()):0;
                                             }else{
                                                var e2 =0;
                                             }
                                              if ($('#extras_third').is(":checked"))
                                                    {
                                                  var e3 = $('#extras_third').val()?parseFloat($('#extras_third').val()):0;
                                              }
                                              else{
                                                var e3=0;
                                              }
                                               if ($('#extras_fourth').is(":checked"))
                                                    {
                                                   var e4 = $('#extras_fourth').val()?parseFloat($('#extras_fourth').val()):0;
                                               }
                                               else{
                                                var e4 = 0;
                                               }
                                                if ($('#extras_five').is(":checked"))
                                                    {
                                                    var e5 = $('#extras_five').val()?parseFloat($('#extras_five').val()):0;
                                                }
                                                else{
                                                    var e5 = 0;
                                                }
                                                    
                                                var final = parseFloat(tt)+(parseFloat(e1))+(parseFloat(e2))+(parseFloat(e3))+(parseFloat(e4))+(parseFloat(e5));

                                                $('#total').html(final);
                                                $('#final_plan').html(plan);
                                                $('#chang_plans').val(plan);
                                                $('#chang_plan').html(final);
                                                $('#fullprice').val(final);
                                                $('#plans_new li.active').removeClass('active');
                                                $(this).parent().addClass('active');
                                                document.getElementById('one_time').style.display = 'none';
                                                document.cookie = "Monthly=1";
                                                delete_cookie('weekly');
                                                delete_cookie('Biweekly');
                                            }

                                            function plan_select_one(cat_total, month, plan) {                                               
//                                              
                                                document.cookie = "plan_1 = 1";
                                                delete_cookie('extra_first');
                                                delete_cookie('extra_second');
                                                delete_cookie('extra_third');
                                                delete_cookie('extra_fourth');
                                                delete_cookie('plan_3');
                                                delete_cookie('plan_6');
                                                delete_cookie('plan_12');
                                                    

  						                            $('.cleaning_check_box ').removeClass('selected');
                                                       
                                                      $('#extra_first').prop('checked',false) ;
                                                       $('#extras_second').prop('checked',false) ;
                                                       $('#extras_third').prop('checked',false) ;
                                                       $('#extras_fourth').prop('checked',false) ;
                                                       $('#extras_five').prop('checked',false) ;
                                                       
                                                     
                                                     
                                                        var change_plan = $('#total').html();                                                        
                                                        var math = parseFloat(change_plan);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                          
                                                var final_plan = $('#final_plan').html();
                                                if (final_plan == 'Biweekly') {
                                                    var discount_price = $('#bi_one_mnth').val();
                                                    
                                                } else if (final_plan == 'Monthly') {
                                                    var discount_price = $('#monthly_frq').val();
                                                } else {
                                                    var discount_price = $('#week_one_mnth').val();
                                                }
                                                
                                                //alert(discount_price);
                                                
                                                $('#change_plan').html(discount_price);
                                                $('#total').html(discount_price);
                                                $('#total_new').val(discount_price);
                                                $('#fullprice').val(discount_price);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);

                                            }

                                            function plan_select(cat_total, month, plan) {
                                                
                                                document.cookie = "plan_3 = 1";
                                                delete_cookie('extra_first');
                                                delete_cookie('extra_second');
                                                delete_cookie('extra_third');
                                                delete_cookie('extra_fourth');

                                                delete_cookie('plan_1');
                                                delete_cookie('plan_6');
                                                delete_cookie('plan_12');

                                             $('.cleaning_check_box ').removeClass('selected');
                                           
                                          $('#extra_first').prop('checked',false) ;
                                                       $('#extras_second').prop('checked',false) ;
                                                       $('#extras_third').prop('checked',false) ;
                                                       $('#extras_fourth').prop('checked',false) ;
                                                       $('#extras_five').prop('checked',false) ;
                                                       
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                            
                                                var final_plan = $('#final_plan').html();
                                                if (final_plan == 'Biweekly') {
                                                    var discount_price = $('#bi_three_mnth').val();

                                                } else if (final_plan == 'Monthly') {
                                                    var discount_price = $('#mon_three_final_price').val();
                                                } else {
                                                    var discount_price = $('#week_three_mnth').val();
                                                }
                                                $('#change_plan').html(discount_price);
                                                $('#total').html(discount_price);

                                                $('#total_new').val(discount_price);
                                                $('#fullprice').val(discount_price);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);

                                            }

                                            function six_mnth(cat_total, month, plan) {
                                                document.cookie = "plan_6 = 1";
                                                delete_cookie('extra_first');
                                                delete_cookie('extra_second');
                                                delete_cookie('extra_third');
                                                delete_cookie('extra_fourth');

                                                delete_cookie('plan_3');
                                                delete_cookie('plan_1');
                                                delete_cookie('plan_12');
                                             $('.cleaning_check_box ').removeClass('selected');
                                                       
                                                  $('#extra_first').prop('checked',false) ;
                                                       $('#extras_second').prop('checked',false) ;
                                                       $('#extras_third').prop('checked',false) ;
                                                       $('#extras_fourth').prop('checked',false) ;
                                                       $('#extras_five').prop('checked',false) ;
                                                       
                                                            
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        
                                                var final_plan = $('#final_plan').html();
                                                if (final_plan == 'Biweekly') {
                                                    var discount_price = $('#bi_six_mnth').val();
                                                } else if (final_plan == 'Monthly') {
                                                    var discount_price = $('#mon_six_final_price').val();
                                                } else {
                                                    var discount_price = $('#week_six_mnth').val();
                                                }
                                                $('#change_plan').html(discount_price);

                                                $('#total').html(discount_price);
                                                
                                                $('#total_new').val(discount_price);
                                                $('#fullprice').val(discount_price);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);
                                            }

                                            function tweleve_mnth(cat_total, month, plan)
                                            {
                                                document.cookie = "plan_12 = 1";
                                                delete_cookie('extra_first');
                                                delete_cookie('extra_second');
                                                delete_cookie('extra_third');
                                                delete_cookie('extra_fourth');

                                                delete_cookie('plan_3');
                                                delete_cookie('plan_6');
                                                delete_cookie('plan_1');
                                             $('.cleaning_check_box ').removeClass('selected');
                                                   
                                                $('#extra_first').prop('checked',false) ;
                                                       $('#extras_second').prop('checked',false) ;
                                                       $('#extras_third').prop('checked',false) ;
                                                       $('#extras_fourth').prop('checked',false) ;
                                                       $('#extras_five').prop('checked',false) ;
                                                       
                                                              
                                                        var change_plan = $('#total').html();
                                                        var math = parseFloat(change_plan);
                                                        $('#total').html(math);
                                                        $('#fullprice').val(math);
                                                        
                                                var final_plan = $('#final_plan').html();
                                                if (final_plan == 'Biweekly') {
                                                    var discount_price = $('#bi_twelve_mnth').val();
                                                } else if (final_plan == 'Monthly') {
                                                    var discount_price = $('#mon_twelve_final_price').val();
                                                } else {
                                                    var discount_price = $('#week_twelve_mnth').val();
                                                }

                                                $('#change_plan').html(discount_price);
                                                $('#total').html(discount_price);
                                                $('#total_new').val(discount_price);
                                                $('#fullprice').val(discount_price);
                                                $('#monthlyplan').html(plan);
                                                $('#monthlyplans').val(plan);
                                            }

                                            $(document).ready(function(){

                                                if(readCookie("extra_first")) {    
                                                        //$('#extra_first').click();
                                                        $('#extra_first').attr('checked','checked');
                                                        $('.1').addClass('selected')
                                                    }
                                                    if(readCookie("extra_second")) {
                                                        //$('#extras_second').click();
                                                         $('#extras_second').attr('checked','checked');      
                                                        $('.2').addClass('selected')
                                                    }
                                                    if(readCookie("extra_third")) {
                                                        $('#extras_third').attr('checked','checked');
                                                        //$('#extras_third').click();      
                                                        $('.3').addClass('selected')
                                                    }
                                                    if(readCookie("extra_fourth")) {
                                                        $('#extras_fourth').attr('checked','checked');
                                                        //$('#extras_fourth').click();      
                                                        $('.4').addClass('selected')
                                                    }
                                                    if(readCookie("extra_five")) {
                                                        $('#extras_five').attr('checked','checked');
                                                        //$('#extras_five').click();      
                                                        $('.5').addClass('selected')
                                                    }

                                                if(readCookie("weekly")) {
                                                        var amt = parseFloat($('#week_one_mnth').val());

                                                        $('#total').html(amt);
                                                        $('#fullprice').val(amt);

                                                        weekly_new('Weekly');
                                                        $('#test').addClass('active');
                                                        $('#test1').removeClass('active');
                                                        $('#test2').removeClass('active');                                         
                                                    }
                                                    else{
                                                        
                                                        $('#total').html($('#one_mnth').text());
                                                        $('#fullprice').val($('#one_mnth').text());
                                                    }
                                                    if(readCookie("Biweekly")) {  
                                                        var amt = parseFloat($('#bi_one_mnth').val());
                                                        $('#total').html(amt);
                                                        $('#fullprice').val(amt);
                                                        biweekly_new('Biweekly')
                                                        $('#test1').addClass('active');
                                                        $('#test').removeClass('active');
                                                        $('#test2').removeClass('active');
                                                    }
                                                    if(readCookie("Monthly")) {               
                                                        var amt = parseFloat($('#monthly_frq').val());
                                                        $('#total').html(amt);
                                                        $('#fullprice').val(amt);
                                                        monthlys_new('Monthly')
                                                        $('#test2').addClass('active');
                                                        $('#test').removeClass('active');
                                                        $('#test1').removeClass('active');
                                                    }


                                                    

                                                    //
                                                    if(readCookie("plan_1")) {  
                                                        $('.plan_1').addClass('active')
                                                        $('.plan_3').removeClass('active')
                                                        $('.plan_6').removeClass('active')
                                                        $('.plan_12').removeClass('active')
                                                    }
                                                    if(readCookie("plan_3")) {
                                                        $('.plan_3').addClass('active')
                                                        $('.plan_1').removeClass('active')
                                                        $('.plan_6').removeClass('active')
                                                        $('.plan_12').removeClass('active')
                                                    }
                                                    if(readCookie("plan_6")) {
                                                        $('.plan_6').addClass('active')
                                                        $('.plan_3').removeClass('active')
                                                        $('.plan_1').removeClass('active')
                                                        $('.plan_12').removeClass('active')
                                                    }
                                                    if(readCookie("plan_12")) {
                                                        $('.plan_12').addClass('active')
                                                        $('.plan_3').removeClass('active')
                                                        $('.plan_6').removeClass('active')
                                                        $('.plan_1').removeClass('active')
                                                    }

                                                    
                                                    
                                                
                                                console.log(readCookie("extra_first"));
                                            });
                        var delete_cookie = function(name) {
                            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                        };

                        function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');    
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];

        while (c.charAt(0)==' '){
            c = c.substring(1,c.length);            
        }
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

</script>




<!---footer--->