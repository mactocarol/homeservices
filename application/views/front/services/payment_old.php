<section class="finalize_dv">
    <div class="container"> 
        <div id="page-wrap" class="page-wrap_left">
            <form action="<?php echo base_url() . 'front/Service/checkout'; ?>" name="payment_form" id="payment_form" method="post">
                <div class="membership_planes_payment">
                    <div class="left_page_description align-left"><!-----address feild--->
                        <h4></h4>
                        <div class="adress_form">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>FullName :</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="" id="" value="<?php echo $getFetch->first_name.' '.$getFetch->last_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label> Email : </label> 
                                </div> 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="email" class="form-control" id="email" value="<?php echo $getFetch->emailid; ?>">
                                </div>
                            </div>
                            <?php if($getFetch->plans != ''){ ?>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label> Plan For :</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12"> 									
                                    <input type="text" name="plan" readonly="readonly" value="<?php echo $getFetch->plans; ?>" id="plan" class="form-control">
                                </div>
                            </div>
                            <?php }else{ ?>
							<div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label> Plan For :</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12"> 									
                                    <input type="text" name="plan" readonly="readonly" value="One Time" id="plan" class="form-control">
                                </div>
                            </div>
							<?php } ?>
							
                            <?php if($getFetch->monthly_plan != 'One Time'){ ?>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label> Plan :</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12"> 									
                                    <input type="text" name="finalplan" readonly="readonly" value="<?php echo (!empty($getFetch->monthly_plan)) ? $getFetch->monthly_plan : 'One Time'; ?>" id="finalplan" class="form-control">
                                </div>
                            </div>
							<?php } ?>
                            
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label> Amount : </label>
                                </div>
<!--                                <div class="col-md-3 col-sm-3 col-xs-3">									
                                    <input type="text" value="£" class="form-control">
                                </div>-->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" readonly="readonly" name="amount" value="<?php echo $getFetch->fullprice; ?>" id="amount" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
<!--                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">+1</span>
                                            <input type="text" class="form-control" name='phonenumber'>
                                        </div>
                                    </div>-->

                            <div class="form-group pay_button">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <!--                                       <button class="btn btn-large" id="stripe-demo">Pay With Card</button>-->
                                    <button class="btn btn-primary btn-large" id="stripe-demo">Pay With Card</button>
                                    <script src="https://checkout.stripe.com/checkout.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>

