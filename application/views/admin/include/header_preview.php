<!DOCTYPE html>
<html lang="en">
<head>

<?php
	foreach($records as $rec)
	{
?>
    
  <meta charset="utf-8">
  <meta name="<?php echo $rec->meta_title; ?>" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="<?php echo $rec->meta_keyword; ?>" content="Ontoday">
  <meta name="<?php echo $rec->meta_description; ?>" content="">

  <link rel="shortcut icon" href="#" type="image/png">

  <title><?php echo $rec->title; ?></title>
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
		//echo link_tag('css/jquery.datetimepicker.css'); //menu css


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
<?php
	}
?>

</head>
<body class="sticky-header">

<section>