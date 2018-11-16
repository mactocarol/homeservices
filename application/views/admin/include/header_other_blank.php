<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="Ontoday">
  <meta name="description" content="">

  <link rel="shortcut icon" href="#" type="image/png">

  <title><?php echo (!empty($title)) ? $title : 'Admin Panel';?></title>
 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script> 

 <?php 
 		////icheck
	  
		 

		//responsive
		echo link_tag('css/table-responsive.css'); 
		
		
		echo link_tag('js/iCheck/skins/minimal/minimal.css'); 
		echo link_tag('js/iCheck/skins/square/square.css'); 
		echo link_tag('js/iCheck/skins/square/red.css');
		echo link_tag('js/iCheck/skins/square/blue.css');
		
		
		///upload image
		echo link_tag('css/bootstrap-fileupload.min.css'); 
		
		//moris chart css
		echo link_tag('js/morris-chart/morris.css'); 
		
		//dashboard calender
		echo link_tag('css/clndr.css'); 
		
		//common css
		echo link_tag('css/style.css'); 
		echo link_tag('css/style-responsive.css'); //menu css


	///datatable 
		echo link_tag('js/data-tables/DT_bootstrap.css'); 

		$js_arr = array('js/jquery-1.10.2.min.js','js/bootstrap.min.js','js/modernizr.min.js');
		
		echo script_tag($js_arr);
	?>	

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<noscript>
    <style type="text/css">
        #myForm {display:none;}
    </style>
    <div class="noscriptmsg" style="color:#F30;">
    You don't have javascript enabled. Please enable javascript first.
    </div>
</noscript>

<body class="sticky-header">

<section>