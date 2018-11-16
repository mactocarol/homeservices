<!--footer---->
<?php

$obj = new Common_model();
?>
<footer>
    <div class="top_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3  col-sm-6 col-xs-12">
                    <div class="footer_one">
                        <h3>About</h3>
                        <p>Our goals is clear and simple. We deliver happiness-providing the best service possible home service to our customers.</p>
                    </div>
                </div>
                <div class="col-md-3  col-sm-6 col-xs-12">
                    <div class="footer_one">
                        <h3>Information</h3>
                        <ul>
                            <?php if($obj->get_page_status(10) == 1) { ?>
                            <li><a href="<?php echo base_url().'Privacy-Policy'; ?>">Privacy Policy</a></li>
                            <?php } ?>
                            
                            <?php if($obj->get_page_status(4) == 1) { ?>
                            <li><a href="<?php echo base_url().'Term-Condition'; ?>">Terms and conditions</a></li>
                            <?php } ?>
                            
                            <?php if($obj->get_page_status(11) == 1) { ?>
                            <li><a href="<?php echo base_url().'Cancellation_policy'; ?>">Cancellation Policy</a></li>
                            <?php } ?>
                            
                            <?php if($obj->get_page_status(12) == 1) { ?>
                            <li><a href="<?php echo base_url().'Press'; ?>">Press</a></li>
                            <?php } ?>
                            
                            <?php if($obj->get_page_status(9) == 1) { ?>
                            <li><a href="<?php echo base_url().'Blog'; ?>">Blog</a></li>
                            <?php } ?>
                            
                            <?php if($obj->get_page_status(8) == 1) { ?>
                            <li><a href="<?php echo base_url().'Contact-us'; ?>">Contact Us</a></li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-3  col-sm-6 col-xs-12">
                    <div class="footer_one">
                        <h3>Popular Services</h3>
                        <ul>
                            <?php 
                                if (!empty($menu_categories)) :
                                    foreach ($menu_categories as $super_category) :
                                    $super_cat_img = $super_category->cat_picture;
                                ?>
                            <li><a href="<?php echo base_url('Services/'.encode_category($super_category->cat_name)); ?>">
                                <?php echo $super_category->cat_name; ?>
                                </a>
                            </li>

                            <?php endforeach;
                                 endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3  col-sm-6 col-xs-12">
                    <div class="footer_one">
                        <h3>Contact Us</h3>
                        <p>14800 WESTHIEMER RD SUITE H2
                            RICHMOND TX<br/>
                        PHONE NUMBER - 657-229-2763
                        </p>
                        <h3>Follow Us</h3>
                        <ul class="social-network social-circle">

                            <li><a href="https://www.facebook.com/88HomePros/" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/88HomePros" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>	
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom_footer">
        <div class="container">
            <p>@Copyright <?php echo date('Y'); ?> 88 HomePros.all Rights Reserved</p>
        </div>
    </div>
</footer>

<!-----script---->
<script src="<?php echo FRONTJS; ?>jquery.min.js"></script>
<script src="<?php echo FRONTJS; ?>bootstrap.min.js"></script>
<!--<script src="<?php echo FRONTJS; ?>incrementing.js"></script>-->
<script src="<?php echo FRONTJS; ?>jquery-ui.min.js"></script>
<script src="<?php echo FRONTJS; ?>owl.carousel.js"></script>


<script>
$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown dt a').append(ret);

  }
});

    $(document).ready(function () {
        
//        $('#extra_first').click(function() {
//    alert("Checkbox state (method 1) = " + $('#extra_first').prop('checked'));
//    alert("Checkbox state (method 2) = " + $('#extra_first').is(':checked'));
//});
        
//        var selected_value = []; // initialize empty array 
//        $(".first_check:checked").each(function(){
//        selected_value.push($(this).val());
//    });
    
       
        $('#stripe-demo').click(function () {
            
            var amount = $("#amount").val();
            var total_amount = Math.abs(amount);
          var amount_new = Math.abs(total_amount * 100);
        var token = function (res) {
            var $id = $('<input type=hidden name=stripeToken />').val(res.id);
            var $email = $('<input type=hidden name=stripeEmail />').val(res.email);
            var $amt = $('<input type=hidden name=amt />').val(amount_new);
//            var $package = $('<input type=hidden name=package />').val(pack);
//            var $cost = $('<input type=hidden name=cost />').val(ammt);
//            var $limit = $('<input type=hidden name=limit />').val(lim);
            $('form').append($id).append($email).append($amt).submit();
        };

 StripeCheckout.open({
            //key: 'pk_test_m2Jdd1xIYQtgTqsvZ1Zz7qGb',pk_test_mPOgPgBdVzMvkj3mfBsqClRD
            key: 'pk_test_eIpH3xumgjlFT3qCCeUz4oTs',
            amount: amount_new,
            name: '88HomePros',
            interval: 'month',
           
            image: '<?php echo base_url(); ?>assets/front/img/payment_logo.png',
            description: 'Plan $'+ total_amount,
            panelLabel: 'Pay',
            billingAddress: 'true',
            token: token
        });

        return false;
    });
    
      
    

        
        $('#owel_carosel_new').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 2000,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 30
                }
            }
        });
          $('#my_profile').submit(function (e) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . ('My-account') ?>",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                  //  alert(result);
                     if (result == 1) {
                        window.location.href='<?php echo base_url() ?>My-account';
                          alert('Your Profile has been Change Successfully !!!!');
                    }
                       else {
                    var data = JSON.parse(result);
                    var arr = [];
                    for (var i in data) {
                        if (data.hasOwnProperty(i)) {
                            arr.push(i, data[i]);
                            if (data[i] != '') {
                                $('#' + i).html(data[i]);
                                $('#' + i).removeClass('perror_off').addClass('perror_on');
                            } else {
                                $('#' + i).html('');
                                $('#' + i).removeClass('perror_on').addClass('perror_off');
                            }
                        }
                    }
                }
                   
                }
            });
            e.preventDefault();
            return false;
        });
        
          $('#myaddress').submit(function (e) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . ('My-address') ?>",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    //alert(result);
                     if (result == 2) {
                        window.location.href='<?php echo base_url() ?>My-account';
                          alert('Your Details has been Change Successfully !!!!');
                    }
                      else {
                    var data = JSON.parse(result);
                    var arr = [];
                    for (var i in data) {
                        if (data.hasOwnProperty(i)) {
                            arr.push(i, data[i]);
                            if (data[i] != '') {
                                $('#' + i).html(data[i]);
                                $('#' + i).removeClass('perror_off').addClass('perror_on');
                            } else {
                                $('#' + i).html('');
                                $('#' + i).removeClass('perror_on').addClass('perror_off');
                            }
                        }
                    }
                }
                    
                   
                }
            });
            e.preventDefault();
            return false;
        });
        
          $('#change_pass').submit(function (e) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . ('changepassword') ?>",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    
                     if (result == 1) {
                        //window.location.href='<?php echo base_url() ?>My-account';
                        //alert('Your Password has been Change Successfully !!!!');
                        $('#sucess').html('Your Password has been Change Successfully !!!!');
                    }else if(result == 2){
                        $('#sucess').html('Old password did not match.');
                    }
                    else {
                    var data = JSON.parse(result);
                    var arr = [];
                    for (var i in data) {
                        if (data.hasOwnProperty(i)) {
                            arr.push(i, data[i]);
                            if (data[i] != '') {
                                $('#' + i).html(data[i]);
                                $('#' + i).removeClass('perror_off').addClass('perror_on');
                            } else {
                                $('#' + i).html('');
                                $('#' + i).removeClass('perror_on').addClass('perror_off');
                            }
                        }
                    }
                }
                   
                }
            });
            e.preventDefault();
            return false;
        });
        
          $('#comment').submit(function (e) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . ('Feedback') ?>",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                       if (result == 4) {
                        window.location.href='<?php echo base_url() ?>My-account';
                         alert('Your Feedback  has been Submited Successfully !!!!');
                    }
                    else {
                    var data = JSON.parse(result);
                    var arr = [];
                    for (var i in data) {
                        if (data.hasOwnProperty(i)) {
                            arr.push(i, data[i]);
                            if (data[i] != '') {
                                $('#' + i).html(data[i]);
                                $('#' + i).removeClass('perror_off').addClass('perror_on');
                            } else {
                                $('#' + i).html('');
                                $('#' + i).removeClass('perror_on').addClass('perror_off');
                            }
                        }
                    }
                }
                   
                }
            });
            e.preventDefault();
            return false;
        });
     function cat_name(value)
    {
            $.ajax({
               type: "GET",
               url: "<?php echo base_url() . ('Serching') ?>",
               data: {'search_keyword' : value},
               dataType: "text",
               success: function(msg){
                           //Receiving the result of search here
               }
            });
}

   //Date Picker
    $("#datepicker").datepicker({minDate:0});
    
    $("#search").keyup(function(){
  if($("#search").val().length>2){
  $.ajax({
   type: "post",
   url: "<?php echo base_url() . ('Serching') ?>",
   cache: false,    
   data:'search='+$("#search").val(),
   success: function(response){
    $('#finalResult').html("");
    var obj = JSON.parse(response);
    if(obj.length>0){
     try{
      var items=[];  
      $.each(obj, function(i,val){           
          items.push($('<li/>').text(val.FIRST_NAME + " " + val.LAST_NAME));
      }); 
      $('#finalResult').append.apply($('#finalResult'), items);
     }catch(e) {  
      alert('Exception while request..');
     }  
    }else{
     $('#finalResult').html($('<li/>').text("No Data Found"));  
    }  
    
   },
   error: function(){      
    alert('Error while request..');
   }
  });
  }
  return false;
   });
            });
         

</script>
<script>
$(document).ready(function(){
  $('#minimum_plans a').click(function(){
    $('a').removeClass("active");
    $(this).addClass("active");
});
});
</script>

<script>

$(".cleaning_check_box").on("click", function() {
    $(this).toggleClass('selected');
    var selectedIds = $('.selected').map(function() {
    	return this.id;
    }).get();
    console.log(selectedIds);
});

</script>
<script>
$(document).ready(function(){
  $('#plans_new li').click(function(){
    $('li').removeClass("active");
    $(this).addClass("active");
});
});
</script>

<script>
    $('#getPrice').click(function (e) {
        if($('#quote_request_zipcode').val() === ''){ $('#ziperror').css('display','block'); return false;} else{ $('#ziperror').css('display','none'); }
        if($('#datepicker').val() === ''){ $('#dateerror').css('display','block'); return false;} else{ $('#dateerror').css('display','none'); }
        if($('#emailid').val() === ''){ $('#emailerror').css('display','block'); return false;} else{ $('#emailerror').css('display','none'); }
        //if($('#hourly').val() === ''){ $('#hourlyerror').css('display','block'); return false;} else{ $('#hourlyerror').css('display','none'); }
        
        e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . ('CheckPrice1/'.$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4)) ?>",
                data: $('form').serialize(),                
                success: function (result) {
                       
                   console.log(result);
                   $('#check_price_model_div').html(result);
                   $('#myModal1').modal('show');
                }
            });
            
            return false;
        });
</script>

<script>
    $('#getPrice1').click(function (e) {
        if($('#zipcode').val() === ''){ $('#ziperror').css('display','block'); return false;} else{ $('#ziperror').css('display','none'); }
        if($('#datepicker').val() === ''){ $('#dateerror').css('display','block'); return false;} else{ $('#dateerror').css('display','none'); }
        if($('#fname').val() === ''){ $('#nameerror').css('display','block'); return false;} else{ $('#nameerror').css('display','none'); }
        if($('#emailid').val() === ''){ $('#emailerror').css('display','block'); return false;} else{ $('#emailerror').css('display','none'); }
        //if($('#hourly').val() === ''){ $('#hourlyerror').css('display','block'); return false;} else{ $('#hourlyerror').css('display','none'); }
        
        e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . ('Plan1/'.$this->uri->segment(2)."/".$this->uri->segment(3)) ?>",
                data: $('form').serialize(),                
                success: function (result) {
                       
                   console.log(result);
                   $('#check_price_model_div').html(result);
                   $('#myModal1').modal('show');
                }
            });
            
            return false;
        });
</script>
</body>
</html>