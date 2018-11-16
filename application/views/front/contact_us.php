<!-----banner_img--->
<div id="cms-page-title" class="cms-page-title text-center">
    <div id="cms-page-title-overlay">
        <div class="container">
            <div class="row">
                <div id="cms-page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <h1> CONTACT US</h1>
                </div>
                <div id="cms-breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">CONTACT US</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----banner_end--->
<!----inner_pages_section--->
<div class="inner_pages_section">
    <section class="social_media_conatct padding_60"><!--get in touch sec----->
        <div class="container">
            <h2><b>Get in Touch With Us</b></h2>
            <div class="row">

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="get_touch">
                        <span><a href="mailto:info@88HomePros.com?subject=Want to contact you.&body=I want to contact with HomePros.com"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></span>
                        <p><span>info@88HomePros.com</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="get_touch">
                        <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                        <p><span>+657-229-2763</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="get_touch">
                        <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <p><span>14800 Westhiemer Rd Suite H2 
                                Houston, TX 77082
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section><!--get in touch sec----->		
    <section class="map_nd_form">
        <div class="container">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6928.90887430482!2d-95.65063823040767!3d29.73555861621799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640de9fa555657f%3A0x21cc3eab9009d495!2s14800+Westheimer+Rd%2C+Houston%2C+TX+77082%2C+USA!5e0!3m2!1sen!2sin!4v1490714025509" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.4401183626355!2d-95.64995158489211!3d29.735973181995494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640de9fb0003e7b%3A0x77791dc3306151b!2s88HomePros!5e0!3m2!1sen!2s!4v1504086769310" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
              
            <div class="col-md-6 col-sm-6 col-xs-12">
				<?php echo flash_error_function(); ?>
                <form class="form-horizontal" method="post">
				  <div class="row">
                    <div class="col-md-12 margin_bottom_20">
                        <label>Your Name</label>
                        <input type="text" name="name" class="form-control" id="inputEmail" placeholder="Name">
                         <div class="valid_error" >                                     
                         <?php  if (form_error('name') != '') {                                          
                         echo form_error('name', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                    </div>
				  </div>
                  
				  
				  <div class="row">
                    <div class="col-md-12 margin_bottom_20">
                        <div class="row">
                            <div class="col-xs-6">
                                <label>Your Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                                 <div class="valid_error" >                                     
                         <?php  if (form_error('email') != '') {                                          
                         echo form_error('email', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                            </div>
                            <div class="col-xs-6">
                                <label for="inputEmail">Phone Number</label>
                                <input type="tel" class="form-control" id="inputEmail" name="contact_number" placeholder="Phone number">
                                 <div class="valid_error" >                                     
                         <?php  if (form_error('contact_number') != '') {                                          
                         echo form_error('contact_number', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                            </div>
                        </div>
                    </div>
				  </div>
                  
				   <div class="row">
                    <div class="col-md-12 margin_bottom_20">
                        <label>Your Message</label>
                        <textarea class="textarea_dv" name="message" id="exampleTextarea" rows="8"></textarea>
                         <div class="valid_error" >                                     
                         <?php  if (form_error('message') != '') {                                          
                         echo form_error('message', '<span class="perror">', '</span>');                                      
                         } ?>  
                        </div>
                    </div>
				  </div>
				   <div class="row">
                    <div class="col-xs-12 margin_bottom_20">
                        <button type="submit" class="btn btn-primary">SEND</button>
                    </div>
					</div>
                </form>
            </div>

        </div>
    </section>

</div>
