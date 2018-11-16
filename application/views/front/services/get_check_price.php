
<div id="myModal1" class="modal fade" role="dialog">
<div class="modal-dialog custom_dialog">
    
      <!-- Modal content-->
      <div class="modal-content custom_content">
       
        <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
          <img src="<?php echo base_url();?>/assets/front/img/logo.png" class="img-responsive logo_img" />
		  <br>
          <?php if ($get_fetch_plan != 'no record found') { ?>
          <?php if($insert_data['hour_prc'] != '') {?>
          <!--<p class="inner_desi text-center"><b>No. of person :</b> &nbsp <span><?=$insert_data['helper']?></span></p>-->		  
          <!--<p class="inner_desi text-center"><b>Discount :</b> &nbsp <span>$ <?php $discount = (($insert_data['hourly'])*($insert_data['hour_prc']/$insert_data['hourly'])*(1)/$get_fetch_plan->one_monthly_per); echo $discount;?></span></p>-->
          <?php $insert_data['helper'] = is_numeric($insert_data['helper']) ? $insert_data['helper'] : 1; ?>
		  <p class="inner_desi text-center alert alert-success"> No. of persons - <?php echo ($insert_data['helper']);?></p>
          <p class="inner_desi text-center alert alert-success"><?php echo ($insert_data['hourly']); ?> hours @ $<?php echo round($insert_data['hour_prc']/$insert_data['hourly'],2); ?>/hour</p>
          <p class="inner_desi text-center"><b>Estimated Total :</b> &nbsp <span>$ <?php $subtotal = ($insert_data['hourly'])*($insert_data['hour_prc']/$insert_data['hourly'])*($insert_data['helper']); echo $subtotal;?></span></p>
          <?php } else { ?>
          <?php            
            $get_data = json_decode($get_fetch_data->cat_attribute);
            //print_r($get_data);
                $weekly_price_1 = (!empty($get_data[0]->weekly_price)) ? $get_data[0]->weekly_price : '0';
                $weekly_price_2 = (!empty($get_data[1]->weekly_price)) ? $get_data[1]->weekly_price : '0';
                $weekly_price_3 = (!empty($get_data[2]->weekly_price)) ? $get_data[2]->weekly_price : '0';								

                $h1 = (!empty($get_data[0]->unit)) ? $get_data[0]->unit : '0';
                $h2 = (!empty($get_data[1]->unit)) ? $get_data[1]->unit : '0';
                $h3 = (!empty($get_data[2]->unit)) ? $get_data[2]->unit : '0';
                //echo ($h1 * $insert_data['first_item']*$weekly_price_1)+($h2 * $insert_data['second_item']*$weekly_price_2)+($h3 * $insert_data['thired_item']*$weekly_price_3);
            $weekly_plan = (($h1 * $insert_data['first_item']*$weekly_price_1)+($h2 * $insert_data['second_item']*$weekly_price_2)+($h3 * $insert_data['thired_item']*$weekly_price_3))*1;
            $getweeklyprice = $weekly_plan;//$multiply * $getweek;        
            $per = $getweeklyprice * $get_fetch_plan->one_monthly_per / 100;
            $final_price = $getweeklyprice - $per;
            ?>                        
            <!--<p class="inner_desi text-center"><b>Discount :</b> &nbsp <span>$ <?php echo $per; ?></span></p>-->
            <!--<p class="inner_desi text-center"><b>Estimated Total :</b> &nbsp <span>$ <?php echo $final_price; ?></span></p>-->
            <p class="inner_desi text-center alert alert-success"><?php if($insert_data['first_item'] != '-'){ echo $insert_data['first_item']." &nbsp; ".$insert_data['plan_hr_badroom']." @ $".$weekly_price_1."/".$insert_data['plan_hr_badroom']." &nbsp&nbsp&nbsp = &nbsp&nbsp&nbsp$".($h1 * $insert_data['first_item']*$weekly_price_1); } ?></p>
            <p class="inner_desi text-center alert alert-success"><?php if($insert_data['second_item'] != '-'){ echo $insert_data['second_item']." &nbsp; ".$insert_data['plan_hr_bathroom']." @ $".$weekly_price_2."/".$insert_data['plan_hr_bathroom']." &nbsp&nbsp&nbsp = &nbsp&nbsp&nbsp$".($h1 * $insert_data['second_item']*$weekly_price_2); } ?></p>
            <p class="inner_desi text-center alert alert-success"><?php if($insert_data['thired_item'] != '-'){ echo $insert_data['thired_item']." &nbsp; ".$insert_data['livingroom']." @ $".$weekly_price_3."/".$insert_data['livingroom']." &nbsp&nbsp&nbsp = &nbsp&nbsp&nbsp$".($h1 * $insert_data['thired_item']*$weekly_price_3); } ?></p>
            <p class="inner_desi text-center"><b>Estimated Total :</b> &nbsp <span>$ <?php echo $getweeklyprice; ?></span></p>
            <?php } ?>
            <?php } else { ?>
            <?php if($insert_data['hour_prc'] != '') {?>
          <!--<p class="inner_desi text-center"><b>No. of person :</b> &nbsp <span><?=$insert_data['helper']?></span></p>-->		  
          <!--<p class="inner_desi text-center"><b>Discount :</b> &nbsp <span>$ <?php $discount = (($insert_data['hourly'])*($insert_data['hour_prc']/$insert_data['hourly'])*($insert_data['helper'])/$get_fetch_plan->one_monthly_per); echo $discount;?></span></p>-->
          <?php $insert_data['helper'] = is_numeric($insert_data['helper']) ? $insert_data['helper'] : 1; ?>
		  <p class="inner_desi text-center alert alert-success"> No. of persons - <?php echo ($insert_data['helper']);?></p>
          <p class="inner_desi text-center alert alert-success"><?php echo ($insert_data['hourly']); ?> hours @ $<?php echo ($insert_data['hour_prc']/$insert_data['hourly']); ?>/hour</p>
          <p class="inner_desi text-center"><b>Estimated Total :</b> &nbsp <span>$ <?php $subtotal = ($insert_data['hourly'])*($insert_data['hour_prc']/$insert_data['hourly'])*($insert_data['helper']); echo $subtotal;?></span></p>
          <?php } else { ?>
          <?php            
            $get_data = json_decode($get_fetch_data->cat_attribute);
            //print_r($get_data);
                $weekly_price_1 = (!empty($get_data[0]->fixed_price)) ? $get_data[0]->fixed_price : '0';
                $weekly_price_2 = (!empty($get_data[1]->fixed_price)) ? $get_data[1]->fixed_price : '0';
                $weekly_price_3 = (!empty($get_data[2]->fixed_price)) ? $get_data[2]->fixed_price : '0';								

                $h1 = (!empty($get_data[0]->unit)) ? $get_data[0]->unit : '0';
                $h2 = (!empty($get_data[1]->unit)) ? $get_data[1]->unit : '0';
                $h3 = (!empty($get_data[2]->unit)) ? $get_data[2]->unit : '0';
                //echo ($h1 * $insert_data['first_item']*$weekly_price_1)+($h2 * $insert_data['second_item']*$weekly_price_2)+($h3 * $insert_data['thired_item']*$weekly_price_3);
            $weekly_plan = (($h1 * $insert_data['first_item']*$weekly_price_1)+($h2 * $insert_data['second_item']*$weekly_price_2)+($h3 * $insert_data['thired_item']*$weekly_price_3))*1;
            $getweeklyprice = $weekly_plan;//$multiply * $getweek;        
            $per = $getweeklyprice * $get_fetch_plan->one_monthly_per / 100;
            $final_price = $getweeklyprice - $per;
            ?>                        
            <!--<p class="inner_desi text-center"><b>Discount :</b> &nbsp <span>$ <?php echo $per; ?></span></p>-->
            <!--<p class="inner_desi text-center"><b>Estimated Total :</b> &nbsp <span>$ <?php echo $final_price; ?></span></p>-->
            <?php if($insert_data['first_item'] != '-'){ ?><p class="inner_desi text-center alert alert-success"><?php echo $insert_data['first_item']." &nbsp; ".$insert_data['plan_hr_badroom']." @ $".$weekly_price_1."/".$insert_data['plan_hr_badroom']." &nbsp&nbsp&nbsp = &nbsp&nbsp&nbsp$".($h1 * $insert_data['first_item']*$weekly_price_1); ?></p><?php } ?>
            <?php if($insert_data['second_item'] != '-'){?><p class="inner_desi text-center alert alert-success"><?php echo $insert_data['second_item']." &nbsp; ".$insert_data['plan_hr_bathroom']." @ $".$weekly_price_2."/".$insert_data['plan_hr_bathroom']." &nbsp&nbsp&nbsp = &nbsp&nbsp&nbsp$".($h1 * $insert_data['second_item']*$weekly_price_2); ?></p><?php } ?>
            <?php if($insert_data['thired_item'] != '-'){ ?><p class="inner_desi text-center alert alert-success"><?php echo $insert_data['thired_item']." &nbsp; ".$insert_data['livingroom']." @ $".$weekly_price_3."/".$insert_data['livingroom']." &nbsp&nbsp&nbsp = &nbsp&nbsp&nbsp$".($h1 * $insert_data['thired_item']*$weekly_price_3); ?></p><?php } ?>
            <p class="inner_desi text-center"><b>Estimated Total :</b> &nbsp <span>$ <?php echo $getweeklyprice; ?></span></p>
            <?php } ?>
            <?php } ?>
		  <br>
		  <!-- <button type="button" class="btn btn-info">Open Modal</button> -->
		  <p class="text-center"><a href="<?php echo base_url().'finalize/'.$cat; ?>" class="btn btn-primary" <?php if($subtotal == 0 && $getweeklyprice == 0) { echo 'onclick="return false;"'.' disabled'; }?>><span class="glyphicon glyphicon-calendar"></span> Book an appointment</a></p>
        </div>
      </div>
      
    </div>
</div>