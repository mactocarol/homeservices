<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//get axis emi payment credentials
function get_axis_config()
{
	$CI =& get_instance();
	if(ENVIRONMENT == 'production'){
		$payment_mode = 'live';	
	} else {
		$payment_mode = 'sandbox';
	}
	
	$config_vars = $CI->common_model->get_entry_by_data('config',true,array('setting_title'=>'axis_emi_mode'),'setting_value');
	if(!empty($config_vars['setting_value']) && ($config_vars['setting_value'] == 'sandbox' || $config_vars['setting_value'] == 'live')){
		$payment_mode = $config_vars['setting_value'];
	}

	$items = $CI->config->item('axis_'.$payment_mode);
	return $items;	
	//this function return axis details
}

//get PayU payment credentials
function get_payu_config(){

$CI =& get_instance();
	
	if(ENVIRONMENT == 'production'){
		$payment_mode = 'live';	
	} else {
		$payment_mode = 'sandbox';
	}
	$config_vars = $CI->common_model->get_entry_by_data('config',true,array('setting_title'=>'payu_mode'),'setting_value');
	if(!empty($config_vars['setting_value']) && ($config_vars['setting_value'] == 'sandbox' || $config_vars['setting_value'] == 'live')){
		$payment_mode = $config_vars['setting_value'];
	}

	$items = $CI->config->item('payu_'.$payment_mode);
	return $items;

}

 /*
  |---------------------------------------------
  | Get cart data from db using unique cart key
  |---------------------------------------------
  */  
function db_cart_data($lt_cart_key)
{
	$cart_data = array();
	if(!empty($lt_cart_key)){
		$CI =& get_instance();
		$cart_data = $CI->common_model->get_entry_by_data('cart',false,array('cart_key'=>$lt_cart_key),'*');
	}

	return $cart_data;

	
}

/*
  |---------------------------------------------
  | Get random order code
  |---------------------------------------------
  */  
function GenerateOrderCode()
{
   
    $rand_letter = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
   
    //check code already exists or not
    $CI =& get_instance();
	$is_code_exists = $CI->common_model->get_entry_by_data('orders',false,array('order_code'=>$rand_letter),'order_code');
	if($is_code_exists){
		$rand_letter = GenerateOrderCode(); 
	}

    return $rand_letter;
}

function generate_random_password1() {
  //Initialize the random password
  $password = 'les' . randLetter() . randLetter() . rand(0,8);

  return strtolower($password);
}

/// common function for check if any discounts applied on current cart or not and return total discounted amount.
function get_total_discounted_amount_on_cart(){
	
	$total_amount = 0;
	$CI =& get_instance();
	//if coupon code applied than add amount of coupon code
	$les_coupon_discount = $CI->session->userdata('les_coupon_discount');
	$les_coupon_amount = $CI->session->userdata('les_coupon_amount');
	$les_coupon_id = $CI->session->userdata('les_coupon_id');
	if(($les_coupon_discount) && !empty($les_coupon_amount) && !empty($les_coupon_id)){
		$total_amount = $total_amount+$les_coupon_amount;
	}

	//if any special discount applied than calculate discount amount
	$les_discount_applied = $CI->session->userdata('les_discount_applied');
	$les_discount_amount = $CI->session->userdata('les_discount_amount');
	$les_discount_id = $CI->session->userdata('les_discount_id');
	
	if(($les_discount_applied) && !empty($les_discount_amount) && !empty($les_discount_id)){
		$total_amount = $total_amount+$les_discount_amount;	
	}

	//if any E Gift voucher applied than calculate amount
	$les_egift_applied = $CI->session->userdata('les_egift_applied');
	$les_egift_amount = $CI->session->userdata('les_egift_amount');
	$les_egift_id = $CI->session->userdata('les_egift_id');
	
	if(($les_egift_applied) && !empty($les_egift_amount) && !empty($les_egift_id)){
		$total_amount = $total_amount+$les_egift_amount;	
	}
	//if lotus money applied than calculate discount from all discounted amount
	$les_lotus_money_amount = $CI->session->userdata('les_lotus_money_amount');
	$les_lotus_money_applied = $CI->session->userdata('les_lotus_money_discount');
	
	if(($les_lotus_money_applied) && !empty($les_lotus_money_amount))
	{
		$total_amount = $total_amount+$les_lotus_money_amount;
	}
	
	return $total_amount;
}

//function for show discount badge with dynamic amount on product listing and product details
function is_discount_applicable_on_product($product_id){

	/*$is_discount_applicable = false;
	$CI =& get_instance();
	$current_date = date('Y-m-d');
	$where = "('$current_date' between start_date and end_date) and dis_coupon_on = 'category' and is_active = 1";
        $discount_data = $CI->common_model->get_entry_by_data('discount_coupon',true,$where);
        if($discount_data){

            
            $disc_cat_string = $discount_data['dis_coupon_category_id'];
            $disc_min_purchase = $discount_data['min_purchase'];
            $discount_value = $discount_data['discount_value'];
           
                
            $disc_cat_array = explode(",",$disc_cat_string);
           
            if(!empty($disc_cat_array) && count($disc_cat_array) > 0){

	               $product_info = $CI->common_model->get_entry_by_data('products',true,array('product_id'=>$product_id),'cat_id,product_mrp');
	               if(($product_info) && $product_info['product_mrp'] >= $disc_min_purchase){
		               $cat_id =  $product_info['cat_id'];
		              
		               //get all parent categories of product category 
		               $product_category_array = get_all_parent_category_helper($cat_id);
		               foreach ($product_category_array as $cat_key => $cat_value) {
		                        
		                        if(in_array($cat_value,$disc_cat_array)){
		                            $is_discount_applicable = true;
		                        }
		                } 

		             
		            }   

            }//if cond end.
   
          
        

        }

    if($is_discount_applicable){
    	return $discount_value;
    } else {
    	return 0;
    } */    
    return 0;
    //return $is_discount_applicable;    

}//function end.

function get_all_parent_category_helper($cat_id,$cat_array=array()){
	
	$CI =& get_instance();
   $sel_parent = 'cat_name,cat_id,cat_parent_id';
  $where = array('cat_id'=>$cat_id,'is_active'=>1);
  $heiracy_data = $CI->common_model->get_entry_by_data('les_category',true,$where,$sel_parent);
   
   if(!empty($heiracy_data['cat_id']) && $heiracy_data['cat_parent_id'] == 0){
      $cat_array[] = $heiracy_data['cat_id'];
      
   } else {
    $cat_array[] = $heiracy_data['cat_id'];
      
    $cat_array = get_all_parent_category_helper($heiracy_data['cat_parent_id'],$cat_array);   
   }
   

   return $cat_array;	
	
}
/*********** combo offer's code start *************/
function get_combo_offer_product($product_id){

	$is_combo_offer = array();
	$CI =& get_instance();
	$current_date = date('Y-m-d');
	$where = "('$current_date' between combo_start_date and combo_end_date) and combo_status = '1'";
    $comboffer_data = $CI->common_model->getAllRecords("combo", '', '',$where, '');//get_entry_by_data('combo',true,$where);	
	if(!empty($comboffer_data)){		
	foreach($comboffer_data as $combo_data){
		$combo_products = explode(",",$combo_data['combo_free_with']);
		if(!empty($combo_products) && count($combo_products)>0){
			if(in_array($product_id,$combo_products)){	
				$cmb_where = array(
					'combo_id' => $combo_data['combo_id']
				);
				$comb_prd_data = $CI->common_model->get_entry_by_data('combo',true,$cmb_where);			
				$is_combo_offer = $comb_prd_data;					
			}	
		}
	}
		
}
	return $is_combo_offer;
	
}//function end

 function check_cod_zip($zip=''){
	 $CI =& get_instance();
	 if(empty($zip)){
	 	$get_zip = $CI->input->cookie('lotus_shipping_zip');
	 }else{
		 $get_zip = $zip;
	}
	 $check_cod = $CI->common_model->get_entry_by_data('cod_zip',true,array('cod_zip'=>$get_zip));
	 if(!empty($check_cod)){
		return true; 
	}else{
		return false;
	}
	
}
function check_prd_on_cart_update($product_id='',$qty=''){
	 $CI =& get_instance();
	 $CI->load->model('home_model');
	 $stock_value =  $CI->home_model->get_stock_count(); //getting stock value
	 $check_stock = $CI->common_model->get_entry_by_data('products',true,array('product_id' => $product_id),'product_quantity');	
	 if(!empty($check_stock)){		
	 	$pucrcase_qty = $check_stock['product_quantity'];
	//	if($pucrcase_qty>=$qty && $pucrcase_qty>=$stock_value){			
			return $pucrcase_qty;
		//}else{
			//return false;
		//}
	 }else{
		return false; 
	}
	
}
function check_old_prd_on_cart($product_id=''){
		$CI =& get_instance();
	 $CI->load->model('home_model');
	 $stock_value =  $CI->home_model->get_stock_count(); //getting stock value
	 $check_stock = $CI->common_model->get_entry_by_data('products',true,array('product_id' => $product_id,'product_quantity >='=>$stock_value),'product_quantity');	
	 if(!empty($check_stock)){
		 return true;
	 }else{
		 return false;
	 }
	}
	