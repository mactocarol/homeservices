<?php
//echo "<pre>";
//print_r($menu_categories); die;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>88HomePros - <?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
        <link rel="shortcut icon" href="<?php echo FRONTIMG; ?>favicon.png">
        <!--boootstrap css----->
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>bootstrap.min.css">
        <!--fontawesom----->
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>font-awesome.css">
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>font-awesome.min.css">
        <!----owel carosel--->
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>owl.theme.default.min.css">
        <!--style---->
		<link rel="stylesheet" href="<?php echo FRONTCSS; ?>responsive.css">
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>jquery-ui.css">
		
		<link rel="stylesheet" href="<?php echo FRONTCSS; ?>style.css">
    </head>
    <!--<body oncontextmenu="return false">-->
	<body>
        <!----header--->
        <header>
        
            <div class="mid_header">
                <div class="container">
                    <div class="">
                        
                        <div class="bottom_header">
                            <nav role="navigation" class="navbar-default pull-left">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
									 <a href="<?php echo base_url(); ?>"><img src="<?php echo FRONTIMG; ?>logo.png"></a>
                                </div>
                                <div id="navbarCollapse" class="collapse navbar-collapse pull-left">
                                    <ul class="nav navbar-nav">
                                        <li class="active">
                                            <a href="<?php echo SITEBASEURL; ?>">HOME </a></li>
                                        <li>
                                            <a href="<?php echo SITEBASEURL; ?>AboutUs">ABOUT</a>
                                        </li>

                                        
                                        <li class="dropdown mega-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">SERVICES <span class="caret"></span></a>				
				<ul class="dropdown-menu mega-dropdown-menu">
                                     <?php
                                                            if (!empty($menu_categories)) :
                                                            foreach ($menu_categories as $super_category) :
                                                                $super_cat_img = $super_category->cat_picture;
                                                                $super_catid = $super_category->cat_id;
                                                                ?>
					<li class="col-sm-2">
						<ul>
                                                    <li class="dropdown-header"><b><?php echo strtoupper($super_category->cat_name); ?></b></li>
                                                    <?php  foreach ($submain_cat as $sub_cat):
                                                            $cat_id = $sub_cat->cat_id;
                                                            $cat_name = $sub_cat->cat_name;
                                                            $parent_id = $sub_cat->cat_parent_id;
                                                            if ($super_catid == $parent_id):
                                                    ?>
                                                    <li><a href="<?php echo base_url('Services/' . encode_category($super_category->cat_name) . '/' . encode_category($sub_cat->cat_name)); ?>">
                                                            <?php echo ucfirst($cat_name); ?>
                                                            </a></li>
                                                            <?php endif; endforeach; ?>
						</ul>
					</li>
                                        <?php endforeach;                                                            
                                                        endif; ?>
				</ul>				
			</li>
                                     
                                        <li><a href="<?php echo SITEBASEURL; ?>Blog">BLOG </a></li>
                                        <li><a href="<?php echo SITEBASEURL; ?>Contact-us">CONTACT US</a></li>
                                    </ul>
									
									   <ul class="pull-right mid_right">
                                <?php if ($this->session->userdata('id')) { ?>
                                    <li><a href="<?php echo SITEBASEURL; ?>Logout">Logout</a></li>
                                    <li><a href="<?php echo SITEBASEURL; ?>My-account">My Account</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo SITEBASEURL; ?>Login">Login</a></li>
                                
                                 <li><a href="<?php echo SITEBASEURL; ?>Signup">Sign Up</a></li>
                                  <?php } ?>
                            </ul>
                                </div>
                            </nav>
                         
                        </div>
                    </div>
                </div>
            </div>
        </header><!-----header end--->
