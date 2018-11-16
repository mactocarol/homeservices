<div>
    
    <form  id="candidate_providers_apply" method="post" name="candidate_providers_apply">
        <div class="" id="page1">
            <div class="main-body-container">
                
                <div class="pro-header">
                    <div class="pro-header-img">
                        
                        <div class="container marginleft">
                            
                            <div class="pro-header-text">
								<?php echo flash_error_function(); ?>
                                <h1> Start earning money this week! </h1>
                            </div>
                            <div class="pro-content-container">
                                <p class="pro-header-subtext-mobile">Gain access to hundreds of jobs in your city and build your own schedule.</p>
                                <div class="pro-content-wrapper pad-top">
                                    
                                    <div class="pro-content-box">
                                        <div class="pro-input">
                                            <input class="form-input" id="company" name="company"  placeholder="Company"  type="text" required="required">
                                        </div>
                                    </div>
                                    
                                    <div class="pro-content-box">
                                        <div class="pro-input">
                                            <input class="form-input" id="vendor_firstname" name="vendor_firstname"  placeholder="First Name"  type="text" required="required">
                                        </div>
                                    </div>
                                    <div class="pro-content-box">
                                        <div class="pro-input">
                                            <input class="form-input"  id="vendor_lastname" name="vendor_lastname" placeholder="Last Name" type="text" required="required">
                                        </div>
                                    </div>
                                    <div class="pro-content-box">
                                        <div class="pro-input">
                                            <input class="form-input"  id="vendor_email" name="vendor_email" placeholder="Email"  type="email" required="required">
                                        </div>
                                    </div>
<!--                                    <div class="pro-content-box drop_box">
                                        <div class="pro-select-wrapper">
                                            <select class="pro-select" id="country" name="country">
                                                <option value="">Select any Country</option>
                                                <?php
                                                foreach ($get_country as $allcountry) {
                                                    $country_name = $allcountry->name;
                                                    $country_id = $allcountry->id;
                                                    ?>
                                                    <option value="<?php echo$country_id; ?> "><?php echo $country_name; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="pro-submit-line">
                                        <div class="pro-submit-line">
                                            <div class="pro-select-wrapper">
                                                
												<dl class="dropdown"> 
   											     	<dt><a><span class="hida">Select</span>
													<span class="cart_left">
													<i class="fa fa-caret-down" aria-hidden="true"></i>
														</span></a> <p class="multiSel"></p>  </dt>
													<dd>
														<div class="mutliSelect">
															<ul>
															<?php
                                                    foreach ($get_catname as $cat_name) {
                                                        $parnt_catname = $cat_name->cat_name;
                                                        $cat_id = $cat_name->cat_id;
                                                        $parnt_id = $cat_name->cat_parent_id;
                                                        ?><?php
                                                        if ($parnt_id == 0) {
                                                            ?>
																<li>
																	<input name="vendors_choose_cat[]" type="checkbox" value="<?php echo $parnt_catname; ?>" /><?php echo $parnt_catname; ?></li>
																<?php
                                                        }
                                                    }
                                                    ?>
															</ul>
														</div>
													</dd>
												 
												</dl>
												
												
                                            </div>
                                        </div>
<!--                                        <input type="button" class="pro-btn btn-primary" id="" name="commit" 
                                               value="Get Started" onclick="$('#page1').hide(); $('#page2').show()">-->
                                       <input type="submit" name="first_submit" id="first_submit" value="Get Started" class="pro-btn btn-primary">
<!--                                        <a href="#" class="pro-btn btn-primary"  onclick="$('#page1').hide(); $('#page2').show()">Get Started</a>-->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blank-background">
                    <div class="container">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="icon"><i class="fa fa-usd"></i></div>
                                <div class="iconheading"> <h2>Great Pay</h2> 
                                    <p>Make up to $22/hour as a cleaner or $45/hour as a handyman. Our top professionals make more than $1,000 a week.</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="icon"><i class="fa fa-calendar"></i></div>
                                <div class="iconheading"> <h2>Flexible schedule</h2>
                                    <p>You choose when you want to work and how much. Build a full schedule or simply claim a few jobs on the side.</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="icon"><i class="fa fa-pencil-square-o"></i></div>
                                <div class="iconheading"> <h2>Easy payments</h2>
                                    <p>No more tracking down customers for payments. 88 Home Pros will direct deposit your earnings into your bank account as soon as the job is complete.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="ourprofess">
                                <div class="pro-header-line">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="pro-row-wrapper">
                                    <h2>What our professionals are saying</h2>
                                    <div class="testimony-content">
                                        <p>I moved from an agency to 88 Home Pros last month. They pay better, have plenty of jobs, and I love the flexibility!</p>
                                        <div class="pro-testimony-block">
                                            <div class="testi_img">
                                                <img src="">
                                            </div>
                                            <div class="testi_con">
                                                <div class="testi_name">Joy</div>
                                                <div class="testi_cont"> Cleaner, New York</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimony-content">
                                        <p>What I really like is that I can take a couple of jobs a day, and I don’t have to deal with the headache of finding my own customers and dealing with payments.</p>
                                        <div class="pro-testimony-block">
                                            <div class="testi_img">
                                                <img src="">
                                            </div>
                                            <div class="testi_con">
                                                <div class="testi_name"> Ihor </div>
                                                <div class="testi_cont"> Handyman, Boston </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="ourprofess">
                                <div class="pro-header-line">
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <div class="pro-row-wrapper">
                                    <h2>Previous experience in home services is not required but it's definitely an advantage. 
                                        If you haven't done anything like this in the past we can provide all necessary training and support. </h2>
                                    <div class="requirements">
                                        <ul>
                                            <li> Having the equipment and vehicle required to deliver a high quality service is an advantage, though we offer vehicle leasing and high-grade equipment on a rental basis; </li>
                                            <li> A go-getting attitude, and a commitment to honesty and reliability;</li>
                                            <li> Eligibility for work in the UK;</li>
                                            <li> Having Public Liability and vehicle insurance is a must, we can assist in case you don't have it;</li>
                                            <li> A clean driving licence;</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="empsimple">homeservices is not an employer, but simply connects independent service professionals with customers. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        
    </form>
</div>


