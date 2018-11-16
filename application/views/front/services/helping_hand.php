<div class="inner_pages_section"> 
    <section class="price_main_pages">
        <div class="container">

            <div class="col-md-9 col-sm-7 col-xs-12">
                <div id="get_pricc_container_new">
                    <div class="rench">
                        <i><img src="<?php echo base_url(); ?>assets/category/<?php echo $get_record->cat_picture; ?>" alt="<?php echo $get_record->cat_name; ?>" height="100" width=""></i> 
                    </div>
                    <p class="headprice"><?php echo $get_record->cat_name; ?></p>
                    <p class="headprice"></p>
                    <div class="inner_services">
                        <div class="row">
                           
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="right_services_pg">
                                    <div class="panel_1">
                                        <?php echo $get_record->cat_desc; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
            <div class="col-md-3 col-sm-5 col-xs-12">
                <div class="when-checkout-container center">
                    <?php echo flash_error_function();?>
                        <div class="payment-content-wrapper">

                            <div style="margin:0;padding:0;display:inline">
                                <input name="category" value="Garage-Door-Repair" id="category" type="hidden">
                            </div>

                            <div class="checkout-row">
                                <div class="when-main-header">Get A Free Consultation!</div>
                                <p>interested in getting an estimate for your next project? tell us about it.</p>
                            </div>

                            <form class="simple_form new_quote_request" method="post">
                                <div class="when-section" id="service-details-section">
                                    <div class="checkout-row push-top new_form_j">
                                        <div class="columns">
                                            <input class="form-input" name="name" type="text" placeholder="Name" required="required">
                                        </div>
                                    </div>

                                    <div class="checkout-row push-top new_form_j">
                                        <div class="columns">
                                            <input class="form-input" name="email" type="email" placeholder="Email" required="required">
                                        </div>
                                    </div>
                                    <div class="checkout-row push-top new_form_j">
                                        <div class="columns">

                                            <input class="form-input" name="mnumber" type="number" placeholder="Phone Number" required="required">
                                        </div>
                                    </div>
                                    <div class="checkout-row push-top new_form_j">
                                        <div class="columns">
                                            <textarea class="form-control" rows="4" id="company" name="address" placeholder="Address" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="checkout-row push-top new_form_j">
                                        <div class="columns">
                                            <textarea class="form-control" rows="4" id="comment" name="comment" placeholder="Tell us a bit about the job" required="required"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="checkout-row">
                                    <div class="when-sub-header pad-bot">When would you like us to come?</div>
                                    </div>
                                    
                                    <div class="checkout-row">
                                    <div class="columns">
                                        <input class="pikaday when-font" id="datepicker" placeholder="MM/DD/YYYY" data-format="MM/DD/YYYY" name="on_date" type="text">
                                        <?php  if (form_error('on_date') != '') {
                                            echo form_error('on_date', '<span class="perror">', '</span>');}
                                            ?>
                                    </div>
                                    </div>


                                    <div class="when-continue-button-container checkout-row">
                                        <div class="columns">
                                            <button class="btn" type="submit">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                </div>
                 <div class="term_con">
                    <p>By submitting,I agree to receive updates & exclusive offer from Home Pros.Consent can be withdrawn at any time.For more details see our <a href="<?php echo base_url(); ?>Term-Condition" target="_blank">Terms of Use</a> or <a href="<?php echo base_url(); ?>Contact-us" target="_blank">Contact Us</a>.</p>
                </div>
            </div>

        </div>
    </section>
</div>