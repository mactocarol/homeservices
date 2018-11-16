<!-----banner--->
<section class="slider main_pages">
    <img src="<?php echo MEDIAURL; ?>category/<?php echo $get_single_record[0]->cat_picture; ?>" alt="First slide" height="400" width="1000">
    <div class="checkprice">
        <ul><li> <i class="fa fa-angle-double-right"></i>72-hour guarantee of the service </li>
            <li> <i class="fa fa-angle-double-right"></i>Available 7 days a week, no matter the weather </li>
            <li><i class="fa fa-angle-double-right"></i>All necessary equipment and tools are provided </li>
            <li><i class="fa fa-angle-double-right"></i>Working in accordance to your needs & budget</li>
        </ul>
        <?php echo flash_error_function(); ?>
        <form method="post"> 
            <input type="text" name="code" id="code" placeholder="Enter your postcode">
            <button class="priceavailability" type="submit">Check prices & availability</button>           
		   <?php  
                if (form_error('code') != '') {
                echo form_error('code', '<span class="perror check_price_error">', '</span>');}
            ?>
           
        </form>
    </div>
</section>
<!-----banner end--->
<div class="inner_pages_section">
    <section class="inner_service_pg padding_60"> 
        <div class="container">
                <div class="inner_services">
                <div class="row">
		<div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="left_service_pg">
                        <div class="panel_1">
                <?php echo $get_single_record[0]->cat_desc; ?>  
            </div>
                    </div>
                </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
						    <div class="right_services_pg">
							    <div class="panel_1">
							    <h5>Features</h5>
								<ul>
                        
									<li>Highly trained &amp; verified cleaning professionals</li>
									
									<li>30 days service warranty</li>
									
									<li>Transparent &amp; upfront Prices</li>
									
									<li>24x7 customer support available</li>
									
									<li>Non-invasive &amp; herbal chemicals used</li>
									
								</ul>
							   </div>
							</div>
						</div>
                </div>
                </div>
        </div>
    </section>
</div>



