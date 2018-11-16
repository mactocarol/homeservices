<div class="inner_pages_section"> 
    <section class="price_main_pages">
        <div class="container">

            <div class="col-md-9 col-sm-7 col-xs-12">
                <div id="get_pricc_container_new">
                                       <div class="rench">
                        <i><img src="<?php echo MEDIAURL; ?>category/<?php echo $single_cate[0]->cat_picture; ?>" alt="First slide" height="100" width=""></i> 
                    </div>
                    <p class="headprice"><?php echo $single_cate[0]->cat_name; ?> </p>
                    <p class="headprice"><?php echo $single_cate[0]->cat_desc; ?> </p>
                </div>
            </div>

            <div class="col-md-3 col-sm-5 col-xs-12">
                <div class="when-checkout-container center">
                    <?php echo flash_error_function(); ?>
                    <form class="simple_form new_quote_request" method="post">
                        <div class="payment-content-wrapper">

                            <div style="margin:0;padding:0;display:inline">
                                <input name="category" value="Garage-Door-Repair" id="category" type="hidden">
                            </div>

                            <div class="when-section" id="service-details-section">
                                <div class="checkout-row push-top new_form_j">
                                    <div class="columns">
                                        <label>Name:</label>
                                        <input class="form-input" name="fname" type="text" placeholder="Name" required="required">
                                    </div>
                                </div>
                                
                                <div class="checkout-row push-top new_form_j">
                                    <div class="columns">
                                        <label>Email: </label>
                                        <input class="form-input"  name="email" type="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="checkout-row push-top new_form_j">
                                    <div class="columns">
                                        <label>Phone:</label>
                                        <input class="form-input" name="mnumber" type="number" placeholder="Mobile No." required>
                                    </div>
                                </div>
                                
                                <div class="checkout-row push-top new_form_j">
                                    <div class="columns">
                                        <label>Address: </label>
                                        <textarea class="form-control" rows="4" id="address" name="address" placeholder='Address'></textarea>
                                    </div>
                                </div>
                                
                                <div class="checkout-row push-top new_form_j">
                                    <div class="columns">
                                        <label>Tell us a bit about the job: </label>
                                        <textarea class="form-control" rows="4" id="comment" name="comment" placeholder='About the Job'></textarea>
                                    </div>
                                </div>
                                
                                <div class="when-continue-button-container checkout-row">
                                    <div class="columns">
                                        <button class="btn" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div></form>
                </div>
                <div class="term_con">
                    <p>By submitting,I agree to receive updates & exclusive offer from Home Pros.Consent can be withdrawn at any time.For more details see our <a href="<?php echo base_url(); ?>Term-Condition" target="_blank">Terms of Use</a> or <a href="<?php echo base_url(); ?>Contact-us" target="_blank">Contact Us</a>.</p>
                </div>
            </div>

        </div>
    </section>
</div>