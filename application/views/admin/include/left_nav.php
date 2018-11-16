<div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
        <!----------------logo---------------------------->
        <a href="<?php echo base_url();?>/apanel"><img src="<?php echo base_url();?>assets/images/logo-copy.png" alt="" height="50" width="200"></a>
<!--            <a href="<?php echo base_url();?>">Admin</a>-->
        </div>

     <!--  <div class="logo-icon text-center">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo_icon1.png" alt=""></a>
        </div>
        logo and iconic logo end-->

        <div class="left-side-inner">

<div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="<?php echo base_url();?>images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">John Doe</a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

<ul class="nav nav-pills nav-stacked custom-nav"> 
            <?php $active1="";
            $active="";
            $active_suppliers="";
            $active_consumer =""; 
            $active_video =""; 
            $active_categories="";
            $active_offer= "";
            $active_redemption_report="";
            $active_cancellation_report="";
            $active_reportings='';
            $active_template="";
            $active_product="";
            $active_discount = "";
            $active_banner = "";   
            $active_blog = "";
            $active_vendor = "";
            $active_review = "";
            $active_testimonial ="";
            $active_promocode = "";
            $active_page="";
            $active_brand="";
            $active_setting="";
            $active_keyword="";
            $active_home_offer="";
            $active_orders="";
            $active_theme="";
            $active_prebook="";
            $active_mailer="";
            $active_egift="";
            $active_combo="";
            $active_money="";
            $active_sale="";
            $active_hot_offer='';
            $active_notification='';
            $track_visitors_active = '';
            $active_bulk = '';
            $active_post = '';
            $active_cod = '';
            $active_location = '';
            $active_plan = '';
            $active_real = '';
            $active_improvent = '';
            $active_booking = '';
          							
                  if($this->uri->segment(1)=='ManageSuppliers' || $this->uri->segment(1)=='AddSupplier' || $this->uri->segment(1)=='AddSupplierPost' || $this->uri->segment(1)=='SupplierProfile' || $this->uri->segment(1)=='AddSupplierPost' || $this->uri->segment(1)=='EditSupplierProfile' || $this->uri->segment(1)=='EditSupplierPost' ||$this->uri->segment(1)== 'VerifySupplierEmail' || $this->uri->segment(1)=='SupplierOffers' || $this->uri->segment(1)=='AddUser'){
          			$active_suppliers = "active";
          		} 
                  elseif($this->uri->segment(1)=='ManageUser' || $this->uri->segment(1)=='AddConsumer' || $this->uri->segment(1)=='ConsumerProfile' || $this->uri->segment(1)=='AddConsumerPost' || $this->uri->segment(1)=='EditConsumerProfile' || $this->uri->segment(1)=='EditConsumerPost' || $this->uri->segment(1)=='VerifyConsumerEmail' || $this->uri->segment(1)=='CancelledOffers' || $this->uri->segment(1)=='PurchasedOffers'|| $this->uri->segment(1)=='ViewUser'){
                      $active_consumer = "active";
                  }
                  elseif($this->uri->segment(1)=='video/manage_video'){
                      $active_video = "active";
                  }
                  elseif($this->uri->segment(1)=='ManageCategories' || $this->uri->segment(1)=='AddCategory' || $this->uri->segment(1)=='AddCategoryPost' || $this->uri->segment(1)=='EditCategory' || $this->uri->segment(1)=='EditCategoryPost'){
                      $active_categories = "active";
                  }
                  elseif($this->uri->segment(1)=='ManageOffers' || $this->uri->segment(1)=='ViewOffer' || $this->uri->segment(1)=='EditOffer'){
                      $active_offers = "active";
                  }
                  elseif($this->uri->segment(1)=='ManageOfferRedemptionReport' || $this->uri->segment(1)=='ViewOrder'){
                      $active_redemption_report = "active";
                  }
                  elseif($this->uri->segment(1)=='ManageCancellationReport' || $this->uri->segment(1)=='ViewCancelOrder'){
                      $active_cancellation_report = "active";
                  }
                  elseif($this->uri->segment(1)=='ManageTemplate' || $this->uri->segment(1)=='EditTemplateDetails' || $this->uri->segment(1)=='AddTemplate')
                  { $active_template = "active";
                  }
                    elseif($this->uri->segment(1)=='ManageBlog' || $this->uri->segment(1)=='EditBlogDetails' || $this->uri->segment(1)=='AddBlog')
                  { $active_blog = "active";
                  }
                   elseif($this->uri->segment(1)=='ManageVendor' || $this->uri->segment(1)=='EditVendorDetails' || $this->uri->segment(1)=='AddVendor')
                  { $active_vendor = "active";
                  }
                   elseif($this->uri->segment(1)=='ManageTestimonial' || $this->uri->segment(1)=='EditTestimonialDetails' || $this->uri->segment(1)=='AddTestimonial')
                  { $active_testimonial = "active";
                  }
                   elseif($this->uri->segment(1)=='ManageReview' || $this->uri->segment(1)=='EditReviewDetails' || $this->uri->segment(1)=='AddReview')
                  { $active_review = "active";
                  }
                   elseif($this->uri->segment(1)=='ManagePromocode' || $this->uri->segment(1)=='EditPromocodeDetails' || $this->uri->segment(1)=='AddPromocode')
                  { $active_promocode = "active";
                  }
                  elseif($this->uri->segment(1)=='active_reportings' ){
                    $active_reportings = "active";
                  }elseif($this->uri->segment(1)=='ManageProducts' || $this->uri->segment(1)=='SaveProduct'){
                    $active_product = "active";
                  }elseif($this->uri->segment(1)=='ManagePost' || $this->uri->segment(1)=='SavePost'){
                    $active_post = "active";
                  }elseif($this->uri->segment(1)=='ManageDiscount' || $this->uri->segment(1)=='AddDiscount'){
                    $active_discount = "active";
                  }elseif($this->uri->segment(1)=='ManageBanner' || $this->uri->segment(1)=='SaveBanner'){
                    $active_banner = "active";
                  }elseif($this->uri->segment(1)=='managebrand' || $this->uri->segment(1)=='savebrand'){
                    $active_brand = "active";
                  }elseif($this->uri->segment(1)=='ManagePages' || $this->uri->segment(1)=='AddPage' || $this->uri->segment(1)=='EditPageDetails' || $this->uri->segment(1)=='pages' || $this->uri->segment(1)=='Preview'){
                    $active_page = "active";
                  }elseif($this->uri->segment(1)=='managesetting' || $this->uri->segment(1)=='addsetting'){
                    $active_setting = "active";
                  }elseif($this->uri->segment(1)=='ManageKeyword' || $this->uri->segment(1)=='SaveKeyword'){
                    $active_keyword = "active";
                  }  
                  elseif($this->uri->segment(1)=='ManageHomeOffer' || $this->uri->segment(1)=='EditHomeOffer'){
                    $active_home_offer = "active";
                  }elseif($this->uri->segment(1)=='ManageOrders' || $this->uri->segment(1)=='EditOrders' || $this->uri->segment(1)=='SortOrders'){
                    $active_orders = "active";
                  }elseif($this->uri->segment(1)=='ManageTheme' || $this->uri->segment(1)=='UpdateTheme'){
                    $active_theme = "active";
                  }elseif($this->uri->segment(1)=='ManagePrebooking' || $this->uri->segment(1)=='Prebooking-Detail'){
		   $active_prebook = "active";
				   }elseif($this->uri->segment(1)=='ManageMailer' || $this->uri->segment(1)=='SendMailer'){
					  $active_mailer = "active";
				   }elseif($this->uri->segment(1)=='ManageEgift' || $this->uri->segment(1)=='ViewEgift'){
					  $active_egift = "active";
				   }elseif($this->uri->segment(1)=='ManageCombo' || $this->uri->segment(1)=='AddCombo' || $this->uri->segment(1)=='EditCombo'){
					  $active_combo = "active";
				   }elseif($this->uri->segment(1)=='LotusMoney' || $this->uri->segment(1)=='LotusMoney-Confirmation' || $this->uri->segment(1)=='ViewOrders'){
					   $active_money = "active";
				   }elseif($this->uri->segment(1)=='ManageSales' || $this->uri->segment(1)=='ViewSale'){
					     $active_sale = "active";
					   }elseif($this->uri->segment(1)=='hotoffer' || $this->uri->segment(1)=='hotproduct'){
							$active_hot_offer = "active";
					 }elseif($this->uri->segment(1)=='notification'){
								$active_notification ="active";
							  } elseif($this->uri->segment(1)=='track_visitors'){
						$track_visitors_active = "active";
					 }elseif($this->uri->segment(1)=='ManageBulk' || $this->uri->segment(1)=='ViewBulk'){
							$active_bulk = "active";
					 }elseif($this->uri->segment(1)=='ManageZip' || $this->uri->segment(1)=='AddZipcode' || $this->uri->segment(1)=='EditZipcode'){
							$active_cod = "active";
					 }elseif($this->uri->segment(1)=='ManageLocation' || $this->uri->segment(1)=='AddLocation' || $this->uri->segment(1)=='EditLocation'){
							$active_location = "active";
					 }
                                         elseif($this->uri->segment(1)=='ManagePlan' || $this->uri->segment(1)=='AddPlan' || $this->uri->segment(1)=='EditPlan'){
							$active_plan = "active";
					 }elseif($this->uri->segment(1)=='ManageImprovement'){
							$active_improvent = "active";
					 }elseif($this->uri->segment(1)=='ManageRealState'){
							$active_real = "active";
					 }elseif($this->uri->segment(1)=='ManageBooking'){
							$active_booking = "active";
					 }else
						{
							$active1 = "active";
						}
          										
             ?>
            <li class="<?php echo $active1;?>">
                <a href="<?php echo base_url();?>admin/dashboard">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="<?php echo $active_consumer;?>">
                <a href="<?php echo base_url();?>ManageUser">
                    <i class="fa fa-users"></i><span>Manage User</span>
                </a>
            </li>
            
<!--             <li class="<?php echo $active_video;?>">
                <a href="<?php echo base_url();?>video/manage_video">
                    <i class="fa fa-users"></i><span>Manage Video</span>
                </a>
            </li>-->
            
            <li class="<?php echo $active_page;?>">
                <a href="<?php echo base_url();?>pages">
                <!-- <a href="<?php //echo base_url();?>/redirect/under_construction"> -->
                   <i class="fa fa-files-o"></i><span>Manage Pages</span>
                </a>
            </li>

            <li class="<?php echo $active_categories;?>">
                <a href="<?php echo base_url();?>ManageCategories">
                     <i class="fa fa-list"></i> <span>Manage Categories</span>
                </a>
            </li>

<!--            <li class="<?php echo $active_template ;?>">
                <a href="<?php echo base_url();?>ManageTemplate">
                     <i class="fa fa-th-large"></i> Manage Tempalte <span></span>
                </a>
            </li>    -->
<!--             <li class="<?php echo $active_sale;?>">
                <a href="<?php echo base_url();?>ManageSales">
                     <i class="fa fa-money"></i> <span>Manage Orders</span>
                </a>
            </li>     -->
              <!--   <li class="<?php echo $active_orders;?>">
                <a href="<?php echo base_url();?>ManageOrders">
                     <i class="fa fa-money"></i> <span>Manage Orders</span>
                </a>
            </li> -->
			

            <li class="<?php echo $active_banner;?>">
                <a href="<?php echo base_url();?>ManageBanner">
                     <i class="fa fa-money"></i> <span>Manage Banner</span>
                </a>
            </li>
         <li class="<?php echo $active_blog;?>">
                <a href="<?php echo base_url();?>ManageBlog">
                   <i class="fa fa-btc"></i><span>Manage Blog</span>
                </a>
            </li>
	<li class="<?php echo $active_vendor;?>">
                <a href="<?php echo base_url();?>ManageVendor">
                     <i class="fa fa-th-large"></i> <span>Manage Vendor</span>
                </a>
            </li>
<!--           <li class="<?php echo $active_review;?>">
                <a href="<?php echo base_url();?>ManageReview">
                   <i class="fa fa-files-o"></i><span>Manage Review</span>
                </a>
            </li>-->
            <li class="<?php echo $active_testimonial;?>">
                <a href="<?php echo base_url();?>ManageTestimonial">
                   <i class="fa fa-files-o"></i><span>Manage Testimonial</span>
                </a>
            </li>
<!--               <li class="<?php //echo $active_promocode;?>">
                <a href="<?php //echo base_url();?>ManagePromocode">
                   <i class="fa fa-files-o"></i><span>Manage Promocode</span>
                </a>
            </li>-->
             <!--<li class="<?php echo $active_location;?>">
                <a href="<?php echo base_url();?>ManageLocation">
                   <i class="fa fa-files-o"></i><span>Manage Location</span>
                </a>
            </li>-->
             <li class="<?php echo  $active_plan;?>">
                <a href="<?php echo base_url();?>ManagePlan">
                   <i class="fa fa-files-o"></i><span>Manage Plan</span>
                </a>
            </li>
             <li class="<?php echo $active_booking;?>">
                <a href="<?php echo base_url();?>ManageBooking">
                   <i class="fa fa-files-o"></i><span>Manage Booking</span>
                </a>
            </li>
             <li class="<?php echo $active_real;?>">
                <a href="<?php echo base_url();?>ManageRealState">
                   <i class="fa fa-files-o"></i><span>Manage RealState Info</span>
                </a>
            </li>
            
            <li class="<?php echo $active_improvent;?>">
                <a href="<?php echo base_url();?>ManageImprovement">
                   <i class="fa fa-files-o"></i><span>Manage Home Improvement</span>
                </a>
            </li>
             <?php /*?> <li class="<?php echo $active_offer;?>">
                <a href="<?php echo base_url();?>manageoffer">
                <!-- <a href="<?php //echo base_url();?>/redirect/under_construction"> -->
                   <i class="fa fa-list"></i><span>Manage Offer</span>
                </a>
            </li>
              * <?php */?>

          
              
                      
<!--               <li class="<?php echo $active_combo;?>">
                <a href="<?php echo base_url();?>ManageCombo">
                 <a href="<?php //echo base_url();?>/redirect/under_construction"> 
                   <i class="fa fa-inbox"></i><span>Manage Combo offers</span>
                </a>
            </li>          -->
<!--                <li class="<?php echo $active_home_offer;?>">
                <a href="<?php echo base_url();?>ManageHomeOffer">
                     <i class="fa fa-money"></i> <span>Manage home Offer</span>
                </a>
            </li>   -->

             </li>           
<!--                <li class="<?php echo $active_hot_offer;?>">
                <a href="<?php echo base_url();?>hotoffer">
                     <i class="fa fa-money"></i> <span>Manage Hot Offer</span>
                </a>
            </li>-->

<!--              <li class="<?php echo $active_setting;?>">
                <a href="<?php echo base_url();?>managesetting">
                 <a href="<?php //echo base_url();?>/redirect/under_construction"> 
                   <i class="fa fa-cogs"></i><span>Manage Settings</span>
                </a>
            </li>            -->
<!--                <li class="<?php echo $active_theme;?>">
                <a href="<?php echo base_url();?>ManageTheme">
                     <i class="fa fa-money"></i> <span>Manage Theme</span>
                </a>
            </li>       -->
                  
             </li>       
<!--                <li class="<?php echo $active_money;?>">
                <a href="<?php echo base_url();?>LotusMoney">
                     <i class="fa fa-money"></i> <span>Manage Lotus Money</span>
                </a>
            </li>           -->
<!--                <li class="<?php echo $active_egift;?>">
                <a href="<?php echo base_url();?>ManageEgift">
                     <i class="fa fa-money"></i> <span>Manage Egift</span>
                </a>
            </li>-->

<!--              <li class="<?php echo $active_keyword;?>">
                <a href="<?php echo base_url();?>ManageKeyword">
                     <i class="fa fa-money"></i> <span>Bottom Quick Links</span>
                </a>
               </li>-->

<!--                <li class="<?php echo $active_notification;?>">
                <a href="<?php echo base_url();?>notification">
                     <i class="fa fa-envelope"></i> <span>Notifications</span>
                </a>
            </li>-->

            

            </ul>
            </div>
    </div>
    
     <!-- main content start-->
    <div class="main-content" >