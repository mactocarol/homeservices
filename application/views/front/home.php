<style type="text/css">
	.success-txn{
		border: 1px solid #f9c05b !important ;
		color: #f9c05b !important;
	}
</style><section class="slider">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <?php if($slider_data != 'no'):
                $i = 1;
             foreach ($slider_data as $slider):
                ?>
            <div <?php if($i == 1){ echo  'class="item active"'; }else{ echo 'class="item"'; }?> >
                <img src="<?php echo MEDIAURL; ?>baner/<?php echo $slider->banner_image; ?>" alt="First slide">
            </div>
     <?php 
    $i++;    endforeach;
    endif; ?>
        </div>
		 <div class="header-text">
                <div class="col-md-12 text-center">
                    <h2><span>Your Projects, Done</span></h2>
                    <h2><span class="success-txn"><?php if(!empty($this->session->flashdata('txn_success'))){
                     echo $this->session->flashdata('txn_success'); 
                    } ?>
                    </span></h2>
                    <h3><span>We make it easy to maintain your home by connecting you with the right pro.</span></h3>
                    <div class="form_bottom">
                        <form class="form-inline" method="post" action="<?php echo base_url(); ?>Serching">
                            <div class="form-group">
                                <!---<input type="text"  class="form-control" onkeyup="cat_name(this.value)" name="cat" id="cat" placeholder="What kind of pro are you looking for?">--->
                                <div class="bloc">
                                    <select class="dropdown_front form-control" name="cat" required>
                                        <option value="">What kind of pro are you looking for?</option>
                                        <?php 
                                        if (!empty($menu_categories)) :
                                        foreach ($menu_categories as $super_category) :
                                        $super_cat_img = $super_category->cat_picture;
                                        ?>
					<option value="<?php echo $super_category->cat_name; ?>"><?php echo $super_category->cat_name; ?></option>
                                        <?php endforeach;
                                 endif; ?>
				</select>
				<!---<span><i class="fa fa-sort-desc" aria-hidden="true"></i></span>--->
                                </div>								
			        </div>
<!--                            <input type="submit" class="btn btn-primary" value="Continue">-->
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</section>
<!-----slider end--->
<!---why choose us--->
<section class="why_choose padding_60">
    <div class="container">
        <h1 class="main_head">Your one stop shop for home services?</h1>
        <div class="inner_sec">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="box_inner">
                    <img src="<?php echo FRONTIMG; ?>trusted.png">
                    <h4>Why Choose Us</h4>
                    <p>All your home services is managed by our network of professionals from home improvement professions, cleaners, gardeners, homepros to pest removers. All performed by dedicated service professionals.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="box_inner">
                    <img src="<?php echo FRONTIMG; ?>wwr.png">
                    <h4>Who We Are ?</h4>
                    <p>We are a network of dedicated highly skilled professionals in their own service field. So no matter if its cleaning, landscaping, or home repair, you can always count on us to send the right specialist team for the job. Our professionals carry liability insurance, guaranteeing you a trouble free experience.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="box_inner">
                    <img src="<?php echo FRONTIMG; ?>money_back.png">
                    <h4>Our Quality Guarantee</h4>
                    <p>Your complete satisfaction is our ultimate objective. If youre not happy, well work to make it right.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!----why choose us end---->
<!---Top categories--->
<!---<section class="Top_Categories padding_60">
    <div class="container">
        <h1 class="main_head">Top Categories</h1>
        <div class="inner_sec">
            <div class="owl-carousel owl-theme" id="owel_carosel_new">
             <?php //if($child_cat != 'no'):
                //$i = 1;
                //foreach ($child_cat as $child_catname):
                   // print_r($child_catname);
                    $child_name = $child_catname->cat_name;
                    $child_picture = $child_catname->cat_picture;
                    $child_desc = $child_catname->cat_desc;
                    $child_id = $child_catname->cat_id;
                    $parent_id = $child_catname->cat_parent_id;
                 ?>
                  <div  <?php //if($i == 1){ echo  'class="item active"'; }else{ echo 'class="item"'; }?>>
                    <div class="item_one">
                        <div class="item_img">
                            <img src="<?php //echo MEDIAURL; ?>category/<?php echo $child_picture; ?>">
                        </div>
                        <h4><?php// echo $child_name; ?></h4>
                    </div>
<!--                    <div class="item_one">
                        <div class="item_img">
                            <img src="<?php //echo MEDIAURL; ?>category/<?php //echo $child_picture; ?>">
                        </div>
                        <h4><?php //echo $child_name; ?></h4>
                    </div>
                  </div>
    <?php 
    //$i++;  
    //endforeach;
    //endif; ?>
            </div>
         </div>
           </div>
</section>-->
<section class="Top_Categories padding_60">
	    <div class="container">
		    <h1 class="main_head">Top Categories</h1>
			<div class="inner_sec">
			    <div class="owl-carousel owl-theme" id="owel_carosel_new">
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
							 <a href="<?php echo base_url(); ?>Services/HOME-SERVICES/Air-Conditioning-and-Heating">  
                                                             <img src="<?php echo base_url(); ?>assets/front/img/Categories/Air Conditioning & Heating.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/HOME-SERVICES/Air-Conditioning-and-Heating"> <h4>Air Conditioner</h4> </a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Handyman/TV-Mounting">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/Architects & Building Designers2.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Handyman/TV-Mounting"> <h4> TV Mounting </h4> </a>
						</div>
					</div>
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Handyman/Lock-Smith">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/wood-saw.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Handyman/Lock-Smith"><h4>Lock Smith</h4></a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Plumbing/Toilet">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/toilet.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Plumbing/Toilet"> <h4>  Toilet </h4> </a>
						</div>
					</div>
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Handyman/Movers">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/Movers.png"></a>
						    </div>
							<a href="<?php echo base_url(); ?>Services/Handyman/Movers"> <h4>Movers</h4> </a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Plumbing/Drains">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/drainage.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Plumbing/Drains"> <h4>Drains</h4> </a>
						</div>
					</div>
				    <div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Plumbing/Faucets">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/tap.png"></a>
							</div>
						 <a href="<?php echo base_url(); ?>Services/Plumbing/Faucets"> <h4> Faucets </h4> </a>
						</div>
						<div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Handyman/Furniture-Assembly">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/Furniture Repair.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Handyman/Furniture-Assembly"> <h4>Furniture Assembly</h4> </a>
						</div>
					</div>
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Plumbing/Garbage-Disposal">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/throwing-trash.png"></a>
							</div>
						<a href="<?php echo base_url(); ?>Services/Plumbing/Garbage-Disposal"><h4>Garbage Disposal</h4> </a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Electrical/Light-Fixtures">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/development.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Electrical/Light-Fixtures"> <h4>Light Fixtures</h4> </a>
						</div>
					</div>
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Cleaning/Office-cleaning">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/cleaning.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Cleaning/Office-cleaning"> <h4>Office Cleaning</h4> </a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Cleaning/Office-cleaning">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/house.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Cleaning/Office-cleaning"><h4> Home Cleaning</h4></a>
						</div>
					</div>
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="#">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/curtains.png" width="100px"></a>
							</div>
						<a href="#"><h4>Curtains & Blinds</h4></a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Electrical/Outlets">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/socket.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Electrical/Outlets"> <h4> outlets</h4> </a>
						</div>
					</div>
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Cleaning/Carpet-Cleaning">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/carpet.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Cleaning/Carpet-Cleaning"> <h4>Carpet Cleaning</h4> </a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Cleaning/Window-Cleaning">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/window.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Cleaning/Window-Cleaning"> <h4>Window Cleaning</h4> </a>
						</div>
					</div>
				    <div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Cleaning/Window-Cleaning">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/window.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Cleaning/Window-Cleaning"><h4> Window Cleaning</h4></a>
						</div>
						 <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Handyman/Painting">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/Paint & Wall Coverings.png"></a>
							 </div>
							<a href="<?php echo base_url(); ?>Services/Handyman/Painting"><h4>Interior Painting </h4> </a>
						</div>
					</div>
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Handyman/Painting">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/help(1).png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Handyman/Painting"> <h4>Handy Helper</h4> </a>
						</div>
						<div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Handyman/Painting">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/Plumbers1.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Handyman/Painting"> <h4>Plumbers</h4> </a>
						</div>
					</div>
					
					<div class="item">
					    <div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Electrical/Ceiling-and-Bath-Fans">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/bathtub.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Electrical/Ceiling-and-Bath-Fans"> <h4> Ceiling & Bath Fans </h4> </a>
						</div>
						<div class="item_one">
						    <div class="item_img">
                                                        <a href="<?php echo base_url(); ?>Services/Electrical/Other-Electrical-Service">
                                                            <img src="<?php base_url(); ?>assets/front/img/Categories/idea.png"></a>
							</div>
							<a href="<?php echo base_url(); ?>Services/Electrical/Other-Electrical-Service"> <h4>Other Electrical Service </h4> </a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>

<!---How it Works--->
<section class="how_work padding_60">
    <div class="container">
        <h1 class="main_head">How It Works</h1>
        <div class="inner_work">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box_inner">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <h3>Choose a home service & boot it online</h3>
                    <p>Use our convenient online booking form to make an appointment. Same and next day availability available.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box_inner">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <h3>We send an 88HomePro to your place</h3>
                    <p>Your service is handled by a home professional with the right skill set and equipment to bring you optimal results.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box_inner">
                    <i class="fa fa-cogs" aria-hidden="true"></i>

                    <h3>Our 88HomePro takes care of everything</h3>
                    <p>Our specialist will make sure to understand your needs and complete the service as per your requirements.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box_inner">
                   <i class="fa fa-handshake-o" aria-hidden="true"></i>

                    <h3>Enjoy amazing results & more free time</h3>
                    <p>Start enjoying that extra free time you wanted... we bet you already know how
Change the referenced text below to 'We take the hassle away from finding the perfect home professional final home projects made easy.'
</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!----How it Works  end---->

<!---home Projects--->
<section class="home_Projects padding_60">
    <div class="container">
        <h1 class="main_head">Finally,Home Projects Made Easy-For Free</h1>
        <div class="inner_work">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="home_proje_inner">
                    <img src="<?php echo FRONTIMG; ?>home1.jpg" class="img-responsive">
                    <h3>HIGH QUALITY PROS</h3>
                    <p>Its simple. Fully trained and insured professionals. Experts who know exactly whats right for your home. Technicians with professional grade equipment.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="home_proje_inner">
                    <img src="<?php echo FRONTIMG; ?>home2.jpg" class="img-responsive">
                    <h3>EASY PROJECT MANAGEMENT</h3>
                    <p>Whether you are remodeling your kitchen or redecorating your home, you can know hire all the professionals and experts you need in one place.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="home_proje_inner">
                    <img src="<?php echo FRONTIMG; ?>home3.jpg" class="img-responsive">
                    <h3>HELP WHEN YOU NEED IT</h3>
                    <p>Our convenient online booking option allows you to reserve a professional when you need them. Quick and easy.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!----home Projects  end---->

<!---client say--->
<section class="client_say padding_60">
    <div class="container">
        <h1 class="main_head">WHAT OUR CLIENTS ARE SAYING</h1>
        <p>Incredibly friendly cleaner! Very Clean Carpets! Impressive communication whilst booking, even got...We are very happy with Tania, and would like to have as our regular cleaner.</p>
        <div class="inner_work">
            <div class="col-md-8 col-md-offset-2">
                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
                <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                    <!-- Carousel indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#fade-quote-carousel" data-slide-to="0"></li>
                        <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                        <li data-target="#fade-quote-carousel" data-slide-to="2" class="active"></li>

                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">

                            <?php
                            if($testimonial !=''){
                                $i = 1;
                            foreach($testimonial as $row){
                            $name = $row->author_name;    
                            $img = $row->author_img;
                            $email = $row->author_email;
                            $message = $row->author_msg;
                            ?>
                        <div <?php if($i == 1){ echo 'class="active item"'; }else { echo 'class="item"'; 
                        }?>>
                            <img src="<?php echo MEDIAURL;?>testimonial/<?php echo $img; ?>">
                            <blockquote>
                                <p><?php echo $message; ?>.</p>
                                <p class="name_city"><?php echo $name; ?></p>
                                 <p class="name_city"><?php echo $email; ?></p>
                            </blockquote>
                        </div>
                            <?php $i++;} }else {?>
                        <p>No Record found</p>
                            <?php } ?>
                    </div>
                </div>
            </div>						
        </div>
    </div>
</section>
<!----home Projects  end---->

<!---map---->
<section class="map">
    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6928.90887430482!2d-95.65063823040767!3d29.73555861621799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640de9fa555657f%3A0x21cc3eab9009d495!2s14800+Westheimer+Rd%2C+Houston%2C+TX+77082%2C+USA!5e0!3m2!1sen!2sin!4v1490714025509" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.4401183626355!2d-95.64995158489211!3d29.735973181995494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640de9fb0003e7b%3A0x77791dc3306151b!2s88HomePros!5e0!3m2!1sen!2s!4v1504086769310" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
<!---map end---->
<!----Are You Quality Pro--->
<section class="QUALITYPROS padding_60">
    <div class="container">
        <h3>Are You Quality Pro</h3>
        <p>
            Be a Professional with 88HomePros.com. Gain access to hundreds of jobs in Houston and build your own schedule.
        </p>
        <a class="newtwork_btn" href="<?php echo base_url().'Vendors'; ?>">Are you a quality pro</a>
    </div>
</section>
