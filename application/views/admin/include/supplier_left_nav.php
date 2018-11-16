<div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
        <!----------------logo---------------------------->
            <!--<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" alt="" width="50" height="50"> Admin</a>-->
            <a href="<?php echo base_url('supplierdashboard');?>"><img src="<?php echo base_url();?>images/sup_logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/sup_logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

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
            <?php $active1="";$active="";$active_offers=""; $active_contact="";
          							
                  if($this->uri->segment(1)=='SupManageOffers' || $this->uri->segment(1)=='SupAddOffers' || $this->uri->segment(1)=='OfferDetail' || $this->uri->segment(1)=='EditOfferDetail'){
          			$active_offers = "active";
          		} 
                  elseif($this->uri->segment(1)=='ManageContact' || $this->uri->segment(1)=='SupAddContact' || $this->uri->segment(1)=='EditContactDetail'){
                      $active_contact = "active";
                  }
				  
                  
                  else
          		{
          			$active1 = "active";
          		}
          										
             ?>
            <li class="<?php echo $active1;?>">
                <a href="<?php echo base_url('supplierdashboard');?>">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="<?php echo $active_offers;?>">
                <a href="<?php echo base_url();?>SupManageOffers">
                    <i class="fa fa-tasks"></i> <span>Manage Offers</span>
                </a>

            </li>

            <li class="<?php echo $active_contact;?>">
                <a href="<?php echo base_url();?>ManageContact">
                    <i class="fa fa-users"></i><span>Manage Contact</span>
                </a>
            </li>            
            
            <li><a href="<?php echo base_url();?>SupProfile"><i class="fa fa-user"></i>  <span>Profile</span></a></li>
            
            <li><a data-target="#myModal_changepassword" data-toggle="modal"  href="<?php echo base_url();?>SupChangePassword"><i class="fa fa-edit"></i>  <span>Change Password</span></a></li>
            
            <li><a href="<?php echo base_url();?>SupplierLogout"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>


            
           
            </ul>
            </div>
    </div>
    
     <!-- main content start-->
    <div class="main-content" >