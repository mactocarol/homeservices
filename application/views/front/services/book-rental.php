<link rel="stylesheet" href="<?php echo CSS; ?>bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Hind:400,300,500,600%7cMontserrat:400,700' rel='stylesheet' type='text/css'>
  <link href="<?php echo CSS; ?>owl.theme.default.min.css" rel="stylesheet">
  <link href="<?php echo CSS; ?>owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo CSS; ?>style.css">
  <link rel="stylesheet" href="<?php echo CSS; ?>font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo CSS; ?>jquery-ui-1.10.3.css">
  


  <section class="login_pag padding_45">
	    <div class="container"> 
		    <div class="col-md-8 col-sm-8 col-xs-12">
			
      <h3>Boek een nieuwe verhuur</h3>
	  
	  <?php $msgs = explode('|',$this->session->flashdata('msg'));
            	if($msgs[0] == 'pass'){ ?>
     		 	<div role="alert" class="alert alert-success alert-dismissible fade in">
        			<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
        			<div style="color:#00CC00;"><?php echo $msgs[1]; ?></div>
      			</div>
      		<?php }if($msgs[0] == 'fail'){ ?>
      			<div role="alert" class="alert alert-danger alert-dismissible fade in">
        			<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
        	<?php echo $msgs[1]; ?> </div>
      		<?php } ?>
	  
	  <div class="stepwizard">
					<div class="stepwizard-row setup-panel">
					  <div class="stepwizard-step">
						<a href="#step-1" type="button" class="btn btn-primary btn-circle">Customer</a>
					  </div>
					  <div class="stepwizard-step">
						<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">Bike</a>
					  </div>
					  <div class="stepwizard-step">
						<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">Rental activity</a>
					  </div>
					  <div class="stepwizard-step">
						<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">Employer</a>
					  </div>
					  <div class="stepwizard-step">
						<a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">Rental plan</a>
					  </div>
					</div>
				</div>
	  
      <div class="stm-register-form">
				  <!--<form role="form" action="" method="post">-->
				  <form method="post" name="customer_frm" action="<?php echo base_url().'book-rental'?>">
    <div class="row setup-content" id="step-1">
      
       
         
		   <div class="row form-group">
				<div class="col-md-6">
					<h4>Customer Name</h4>
					<input class="form-control" name="customer_name" id="customer_name" value="<?php echo set_value('customer_name'); ?>" placeholder="Voer Naam klant" type="text" required="required">
				</div>
			    
				<div class="col-md-6">
					<h4>Passport / ID nr</h4>
					<input required="required" class="form-control" name="passport_id" id="passport_id" placeholder="Voer paspoort / ID nr" value="<?php echo set_value('passport_id'); ?>" type="text">
				</div>
		   </div>
		   
		   
		    <div class="row form-group">
			    <div class="col-md-12">
					<h4>Address</h4>
					<textarea class="form-control" rows="2" required="required" name="address" id="address" value="<?php echo set_value('address'); ?>" placeholder="Adres invoeren"></textarea>
				</div>
			</div>
			
			
			
			<div class="row form-group">
				<div class="col-md-4">
					<h4>Zip code</h4>
					<input class="form-control" required="required" name="zip_code" id="zip_code" placeholder="Vul de zip code in" value="<?php echo set_value('zip_code'); ?>" type="text">
				</div>
				<div class="col-md-4">
					<h4>City</h4>
					<input class="form-control" required="required"  name="city" id="city" value="<?php echo set_value('city'); ?>" placeholder="Voer Stad" type="text">
				</div>
				<div class="col-md-4">
					<h4>Country </h4>
				<input class="form-control"  required="required" name="country" id="country" placeholder="Voer Land" value="<?php echo set_value('country'); ?>" type="text">
				</div>
			</div>
		    
		
								<div class="row form-group">
									<div class="col-md-6">
										<h4>Tel nr</h4>
										<input class="form-control" required="required" name="tel_no" id="tel_no" placeholder="Voer Registratie Nr" value="<?php echo set_value('tel_no'); ?>" type="text">
									</div>
									<div class="col-md-6">
										<h4>Email address</h4>
										<input class="form-control" required="required" name="email_address" id="email_address" placeholder="Vul email adres in" value="<?php echo set_value('email_address'); ?>" type="text">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-6">
										<h4>Credit card nr</h4>
										<input class="form-control" required="required" name="credit_card_nr" id="credit_card_nr" placeholder="Voer Credit card nr" value="<?php echo set_value('credit_card_nr'); ?>" type="text">
									</div>
									<div class="col-md-6">
										<h4>Credit card type</h4>
										 <input class="form-control" name="credit_card_type" id="credit_card_type" placeholder="Voer het type Credit card" value="<?php echo set_value('credit_card_type'); ?>" type="text"> 
									</div>
								</div>
        
         
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></button>
   
  
    </div>
    <div class="row setup-content" id="step-2">
    
       
            <div class="row form-group">
									<div class="col-md-6">
										<h4>Brand </h4>
										<input class="form-control" required="required" name="bike_brand" id="bike_brand" placeholder="Voer Brand" value="<?php echo set_value('bike_brand'); ?>" type="text">
									</div>
									<div class="col-md-6">
										<h4>Type</h4>
										<input class="form-control" required="required" name="bike_type" id="bike_type" value="<?php echo set_value('bike_type'); ?>" placeholder="Voer Type" type="text">
									</div>
								</div>
								
								<div class="row form-group">
									<div class="col-md-4">
										<h4>Bike nr</h4>
										<input class="form-control" required="required" name="bike_nr" id="bike_nr" value="<?php echo set_value('bike_nr'); ?>" placeholder="Voer Bike nr" type="text">
									</div>
									<div class="col-md-4">
										<h4>Color</h4>
										<input class="form-control" required="required" name="bike_color" id="bike_color" value="<?php echo set_value('bike_color'); ?>" placeholder="Voer Color" type="text">
									</div>
									<div class="col-md-4">
										<h4>Availability  </h4>
										<input class="form-control" required="required"  name="bike_availability" id="bike_availability" value="<?php echo set_value('bike_availability'); ?>" placeholder="Voer Beschikbaarheid" type="text">
									</div>
								</div>
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
       
    </div>
   

   <div class="row setup-content" id="step-3">
   
		  
		  
		    <div class="row form-group">
									<div class="col-md-6">
										<h4>Start date </h4>
										<input class="form-control" required="required" name="rental_activity_start_date" id="rental_activity_start_date" value="<?php echo set_value('rental_activity_start_date'); ?>" placeholder="Invoeren verhuuractiviteit" type="text">
									</div>
									<div class="col-md-6">
										<h4>Duration</h4>
										<input class="form-control" required="required" name="rental_duration" id="rental_duration" placeholder="Voer Duur" type="text">
									</div>
								</div>
								
								<div class="row form-group">
									<div class="col-md-6">
										<h4>End date</h4>
										<input class="form-control" required="required" name="rental_end_date" id="rental_end_date" placeholder="Voer Einddatum" type="text">
									</div>
									<div class="col-md-6">
										<h4>Nr of bikes</h4>
										<input class="form-control" required="required" name="rental_nr_bikes" id="rental_nr_bikes" placeholder="Voer Aantal fietsen" type="text">
									</div>
								</div>

								<div class="row form-group">
									<div class="col-md-6">
										<h4>Price</h4>
										<input class="form-control" required="required" name="rental_price" id="rental_price" placeholder="Voer Prijs" type="text">
									</div>
									<div class="col-md-6">
										<h4>Deposit</h4>
										<input class="form-control" name="rental_deposit" id="rental_deposit" placeholder="Voer Deposit" type="text">
									</div>
								</div>
							
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
   </div>
   
   
    <div class="row setup-content" id="step-4">
    
		  
		  
		       <div class="row form-group">
									<div class="col-md-6">
										<h4>Name</h4>
										<input class="form-control" name="emp_name" id="emp_name" placeholder="Voer naam in" value="<?php echo set_value('emp_name'); ?>" type="text">
									</div>
									<div class="col-md-6">
										<h4>Function</h4>
										<input  class="form-control" name="emp_function" id="emp_function" value="<?php echo set_value('emp_function'); ?>" placeholder="Ga naar de Function" type="text">
									</div>
								</div>
								
							
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
   </div>
   
   
   <div class="row setup-content" id="step-5">
      
      
		  
		  
		               <div class="row form-group">
									<div class="col-md-6">
										<h4>Duration</h4>
										<input class="form-control" required="required" name="rental_plan_duration" id="rental_plan_duration" placeholder="Voer Duur" value="<?php echo set_value('emp_name'); ?>" type="text">
									</div>
									<div class="col-md-6">
										<h4>Price</h4>
										<input class="form-control" required="required" name="rental_plan_price" id="rental_plan_price" value="<?php echo set_value('rental_plan_price'); ?>" placeholder="Voer Prijs" type="text">
									</div>
								</div>
								 <div class="row form-group">
									<div class="col-md-6">
										<h4>Discount</h4>
										<input class="form-control" required="required" name="rental_plan_discount" id="rental_plan_discount" value="<?php echo set_value('rental_plan_discount'); ?>" placeholder="Voer Discount" type="text">
									</div>
									<div class="col-md-6">
										
									</div>
								</div>
								
								
							
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
          <!--<button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>-->
		  <input name="submit" class="btn btn-success btn-lg pull-right" value="Submit" type="submit">
   </div>
     
  </form>
				
    			</div>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
  
  $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });
  
  allPrevBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

          prevStepWizard.removeAttr('disabled').trigger('click');
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
