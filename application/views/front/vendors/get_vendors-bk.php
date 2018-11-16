<div class="col-md-12">
    <div class="main-body-container">
        <div class="pro-header">
            <div class="pro-header-img">
                <div class="container marginleft">
                    <div class="pro-header-text">
                        <h1> Start earning money this week! </h1>
                    </div>
                    <div class="pro-content-container">
                        <p class="pro-header-subtext-mobile">Gain access to hundreds of jobs in your city and build your own schedule.</p>
                        <form  bounce=""  id="candidate_providers_apply" method="post" name="candidate_providers_apply" class="ng-pristine ng-invalid ng-invalid-required">
                            <div class="pro-content-wrapper pad-top">
                                <div class="pro-content-box">
                                    <div class="pro-input">
                                        <input class="form-input placeholder ng-pristine ng-invalid ng-invalid-required" hb-form-error="" id="candidate_provider_first_name" name="vendor_firstname" ng-model="candidate_provider_first_name" placeholder="First Name" required="" type="text">
                                    </div>
                                </div>
                                <div class="pro-content-box">
                                    <div class="pro-input">
                                        <input class="form-input placeholder ng-pristine ng-invalid ng-invalid-required" hb-form-error="" id="candidate_provider_last_name" name="vendor_lastname" ng-model="candidate_provider_last_name" placeholder="Last Name" required="" type="text">
                                    </div>
                                </div>
                                <div class="pro-content-box">
                                    <div class="pro-input">
                                        <input class="form-input placeholder ng-scope ng-pristine ng-invalid ng-invalid-required ng-valid-email ng-valid-pattern" hb-form-error="" id="candidate_provider_email" name="vendor_email" ng-model="candidate_provider_email" placeholder="Email" required="" ng-pattern="/^[A-Z0-9_\.&amp;%\+\-']+@(?:[A-Z0-9\-]+\.)+(?:[A-Z]{2,13})$/i" type="email">
                                    </div>
                                </div>
                                <div class="pro-content-box">
                                    <div class="pro-select-wrapper">
                                        <select class="pro-select ng-pristine ng-invalid ng-invalid-required" hb-form-error="" id="candidate_provider_region_id" name="country" ng-class="{'black': candidate_provider_region_id.length &gt; 0}" ng-model="candidate_provider_region_id" required="">
                                            <option disabled="disabled" selected="selected" value="">Select any Country</option>
                                            <?php
                                            foreach ($get_country as $allcountry) {
                                                $country_name = $allcountry->name;
                                                $country_id = $allcountry->id;
                                                ?>
                                                <option value="<?php echo$country_id; ?> "><?php echo $country_name; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="pro-submit-line">
                                    <div class="pro-select-wrapper">
                                        <select class="pro-select ng-pristine ng-invalid ng-invalid-required" hb-form-error="" id="candidate_provider_region_id" name="vendors_choose_cat" ng-class="{'black': candidate_provider_region_id.length &gt; 0}" ng-model="candidate_provider_region_id" required="">
                                            <option selected="selected" value=""> I’m a:&nbsp;Choose your work Profile</option>
                                            <?php
                                            foreach ($get_catname as $cat_name) {
                                                $parnt_catname = $cat_name->cat_name;
                                                $cat_id = $cat_name->cat_id;
                                                $parnt_id = $cat_name->cat_parent_id;
                                                ?>
                                                <?php
                                                if ($parnt_id == 0) {
                                                    ?>
                                                    <option  value="<?php echo $cat_id; ?> "><?php echo $parnt_catname; ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="pro-submit-line">
                                    <input class="pro-btn btn-primary" id="submit-candidate-provider" name="commit" value="Get Started" type="submit">
                                    <div class="smaller" id="candidate-provider-status-check">
                                        Already applied?
                                        <a href="#">Check your application status here.</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="blank-background">
            <div class="container">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="icon"><i class="fa fa-usd"></i></div>
                        <div class="iconheading"> <h2>Great Pay</h2> 
                            <p>Make up to $22/hour as a cleaner or $45/hour as a handyman. Our top professionals make more than $1,000 a week.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="icon"><i class="fa fa-calendar"></i></div>
                        <div class="iconheading"> <h2>Flexible schedule</h2>
                            <p>You choose when you want to work and how much. Build a full schedule or simply claim a few jobs on the side.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="icon"><i class="fa fa-pencil-square-o"></i></div>
                        <div class="iconheading"> <h2>Easy payments</h2>
                            <p>No more tracking down customers for payments. Handy will direct deposit your earnings into your bank account as soon as the job is complete.</p>
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
                                <p>I moved from an agency to Handy last month. They pay better, have plenty of jobs, and I love the flexibility!</p>
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
                            <h2> Requirements </h2>
                            <div class="requirements">
                                <ul>
                                    <li> Must have paid experience in cleaning or handyman services </li>
                                    <li> Must be authorized to work in the country you are applying in </li>
                                    <li> Must have excellent customer service skills </li>
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




