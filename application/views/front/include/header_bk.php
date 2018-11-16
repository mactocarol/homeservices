<!DOCTYPE html>
<html lang="en">
    <head>
        <title>88HomePros - <?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>jquery-ui.css">
        <link rel="stylesheet" href="<?php echo FRONTCSS; ?>style.css">
    </head>
    <body>
        <!----header--->
        <header>
          
            <div class="mid_header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="logo">
                                <a href="<?php echo base_url(); ?>"><img src="<?php echo FRONTIMG; ?>logo.png"></a>
                            </div>
                        </div>
                        <div class="col-md-9 bottom_header">
                            <nav role="navigation" class="navbar-default pull-left">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div id="navbarCollapse" class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav">
                                        <li class="active">
                                            <a href="<?php echo SITEBASEURL; ?>">HOME </a></li>
                                        <li>
                                            <a href="<?php echo SITEBASEURL; ?>AboutUs">ABOUT</a></li>
                                        <li>
                                            <div class="dropdown">
                                                <a href="<?php echo SITEBASEURL; ?>" class="dropbtn">SERVICES<b class="caret"></b></a>
                                                <div class="dropdown-content">
                                                    <?php
                                                    if (!empty($menu_categories)) :
                                                        foreach ($menu_categories as $super_category) :
                                                            $super_cat_img = $super_category->cat_picture;
                                                            //if($cat_record != 'no'):
                                                            //foreach ($cat_record as $category):
                                                            ?>
                                                            <a href="<?php echo base_url('Services/' . encode_category($super_category->cat_name)); ?>"><span><img src="<?php echo SITEBASEURL; ?>assets/category/<?php echo $super_cat_img; ?>"></span><?php echo $super_category->cat_name; ?></a>
                                                        <?php endforeach;
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                        </li><li><a href="#">PRICES</a></li>
                                        <li><a href="<?php echo SITEBASEURL; ?>Blog">BLOG </a></li>
                                        <li><a href="<?php echo SITEBASEURL; ?>Contact-us">CONTACT US</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <ul class="pull-right mid_right">
                                <?php if ($this->session->userdata('id')) { ?>
                                    <li><a href="<?php echo SITEBASEURL; ?>Logout">Logout</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo SITEBASEURL; ?>Login">Login</a></li>
<?php } ?>
                                <li><a href="<?php echo SITEBASEURL; ?>Signup" class="help_dv">Sign UP</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-----header end--->
