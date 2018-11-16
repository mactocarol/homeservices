<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * discount category
 */

function get_discount_category(){
	return array(
		'category',
		'product',		
		'Brand',
		'Coupon',	
		'City',
		'wishlist',
		'incomplete order',
		'first time shopper',
		'App launch',
		'Limited Time Offer',
		'Subcategory offer'
	);
}

/*
 *discount type
 */
function get_discount_type(){
	return array(
		'flat',
		'percent'
	);
}
function get_device_type(){
	 return  array(
	  'all'=>'All',
	  'web' => 'Web',
	  'app'=>'App' 
	 );
}


/*
 * offer type
 */
function get_offer_type(){
	return array(
		'quantity'=>'quantity',//provide more quantity if the user shopping in bulk 
                'product'=>'product',//provide a product free with another product,
                'sign_up_app'=>'Sign up app offer',//this offer can only be avail once
                'wishlist'=>'Wish List',
               /* 'offer_of_day'=>'Offer of the day',
                'best_sell'=>'Best Seller',
                'hot_offer'=>'Hot Offers',*/
	);
}

function get_colors(){
	return array(
		'Black',
		'Blue',
		'Brown',
		'Charcoal',
		'Green',
		'Grey',
		'Indigo',
		'Ivory',
		'Khaki',
		'Oatmeal',
		'Orange',
		'Pink',
		'Purple',
		'Red',
		'Silver',
		'Taupe',
		'White',
		'Yellow'
	);
}

function set_pagination_config($total_rows,$uri_segment,$base_url){

	    $config["base_url"] = $base_url;//full path including controller and action names
        $config["total_rows"] = $total_rows;//total rows 
        $config["per_page"] = 3;
        $config["uri_segment"] = $uri_segment;
 		$config['first_link'] = 'First';
 		$config['last_link'] = 'Last';
 		$config['use_page_numbers'] = TRUE;
 		$config['first_link'] = 'First';

		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';

 		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

 		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		return $config;
}

/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($id,$edit_url = null,$delete_url = null, $view_url = null, $gallery_url = null , $image_url = null)
{
    $ci = & get_instance();
    $html = '<span class="actions">';

    if(!empty($edit_url)){
    	$html .= '<a href="' . $edit_url . $id . '"><i title="Edit" class="fa fa-edit"></i></a>&nbsp;&nbsp;';
    }

    if(!empty($delete_url)){
    	//$html .= '<a href="' . $delete_url . $id . '"><i class="fa fa-trash-o"></i></a>';
    	$html .= '<a href="#" class="delete_row" id="'.$id.'"><i title="Delete" class="fa fa-trash-o"></i></a>';
    }

    if(!empty($view_url)){
    	//$html .= '<a href="' . $delete_url . $id . '"><i class="fa fa-trash-o"></i></a>';
    	$html .= '<a href="' . $view_url . $id . '" ><i title="View" class="fa fa-eye fa-lg"></i></a>';
    }

   if(!empty($gallery_url)){
    	//$html .= '<a href="' . $delete_url . $id . '"><i class="fa fa-trash-o"></i></a>';
    	$html .= '<a href="#" class="gallery_div" id="'.$id.'"><i title="Gallery" class="fa fa-picture-o"></i></a>';
    }

    if(!empty($image_url)){
    	//$html .= '<a href="' . $delete_url . $id . '"><i class="fa fa-trash-o"></i></a>';
     	$html .= '<img src="'.$image_url.'/'.$id . '" alt = " " style="width:60%;height:50%"></img>';
    }

    $html .= '</span>';
 
    return $html;
}

//used in add banner
function get_banner_type(){
	return array(
		'banner',
		'product',
		'category',
		'left banner',
		'right banner'
	);
}

//get single image path from json
function product_single_image($img_json){
    $img_arr = json_decode($img_json,true);
      if(!empty($img_arr) && count($img_arr)>0){
      	$img_path = '';
      	foreach ($img_arr as $key => $value) {
      		 if(!empty($value) && empty($img_path)){
      		 	$img_path = IMAGE_PRODUCT_200.$value;
      		 }
      	}
        
        
    }else{
       $img_path = '';        
    }
    return $img_path;
    
}

//get header navigation class by category name(cat_title)
function get_menu_class_by_category($category_name)
{

	// $cate_array = array(
	// 'HOME Entertainment' => 'home-enter',
	// 'Phones'=>'phones',
	// 'Computers'=>'computers',
	// 'Cameras'=>'cameras',
	// 'Music Systems'=>'music-system',
	// 'Home Appliances'=>'home-appll',
	// 'Kitchen Appliances'=>'kitchen',
	// 'Gaming'=>'gaming'	
	// );

$cate_array = array(
	'HOME ENTERTAINMENT' => 'home-enter',
	'PHONES'=>'phones',
	'COMPUTERS'=>'computers',
	'CAMERAS'=>'cameras',
	'MUSIC SYSTEMS'=>'music-system',
	'HOME APPLIANCES'=>'home-appll',
	'KITCHEN APPLIANCES'=>'kitchen',
	'GAMING'=>'gaming'	
	);
   $category_name = strtoupper($category_name);
	if(!empty($category_name) && !empty($cate_array[$category_name])){
		return $cate_array[$category_name];
	} else {
		return '';
	}
}

//get header navigation class by category name(cat_title)
function get_hometab_class_by_category($category_name)
{

	// $cate_array = array(
	// 'HOME Entertainment' => 'home-enter',
	// 'Phones'=>'phones',
	// 'Computers'=>'computers',
	// 'Cameras'=>'cameras',
	// 'Music Systems'=>'music-system',
	// 'Home Appliances'=>'home-appll',
	// 'Kitchen Appliances'=>'kitchen',
	// 'Gaming'=>'gaming'	
	// );

$cate_array = array(
	'HOME ENTERTAINMENT' => 'home-enter',
	'PHONES'=>'phone',
	'COMPUTERS'=>'computer',
	'CAMERAS'=>'camera',
	'MUSIC SYSTEMS'=>'music',
	'HOME APPLIANCES'=>'home-appl',
	'KITCHEN APPLIANCES'=>'kitchen',
	'GAMING'=>'gaming'	
	);
   $category_name = strtoupper($category_name);
	if(!empty($category_name) && !empty($cate_array[$category_name])){
		return $cate_array[$category_name];
	} else {
		return '';
	}
}

////////////// funciton for make category name url frendly ////////////////////////////////////////////////
function encode_category($cat_name){
    
    $str =  str_replace(" ","-",trim($cat_name));
    $str =  str_replace("+","plus",$str);
    
    return  str_replace("/","_slash_",$str);
}

function decode_category($cat_name){
    
    $str =  str_replace("-"," ",trim($cat_name));
    $str =  str_replace("plus","+",$str);
    return  str_replace("_slash_","/",$str);
}
function moneyFormatIndia($num){
   $explrestunits = "" ;
   if(strlen($num)>3){
       $lastthree = substr($num, strlen($num)-3, strlen($num));
       $restunits = substr($num, 0, strlen($num)-3);
       $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits;
       $expunit = str_split($restunits, 2);
       for($i=0; $i<sizeof($expunit); $i++){
           if($i==0)
           {
               $explrestunits .= (int)$expunit[$i].",";
           }else{
               $explrestunits .= $expunit[$i].",";
           }
       }
       $thecash = $explrestunits.$lastthree;
   } else {
       $thecash = $num;
   }
   return $thecash.".00";
}

//show formated product price
function show_price($price){

	if(!empty($price)){
		return number_format($price);
	}else {
		return '0';
	}
}

//function for get limit of showing product per page set by admin
function get_product_per_page_limit(){
	$CI =& get_instance();
	$per_page_limit = '5';
	$config_vars = $CI->common_model->get_entry_by_data('config',true,array('setting_title'=>'products_per_page'),'setting_value');
	if(!empty($config_vars['setting_value'])){
		$per_page_limit = $config_vars['setting_value'];
	}


	return $per_page_limit;		
}
//mail template header section start
function mail_temp_header(){

$head_content = "";	
$head_content .= '<table width="100%" style="margin-left:10px;" border="1" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td width="100%" valign="top" bgcolor="#ffffff">
		
			<!-- Start Header-->
			<table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
				<tr>
					<td width="100%" bgcolor="#ffffff" style="">

                         
                            <table border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth" width="100%">
                                <tr>
                                    <td style="padding:0px 0px" class="right">
                                       <a href="'.base_url().'"><img src="'.base_url().'front/images/header2.jpg" alt="" border="0" /></a>
                                    </td>
                                    
                                    
                                    
                                </tr>
                            </table>
                            
                            
					</td>
				</tr>
			</table>';
			
			return $head_content;
	
}//end mail header

//footer of mail template
function mail_temp_footer(){
$footer_content = "";	
$footer_content .='<p><b>Lotus electronics strives relentlessly to provide the best, so that you have a great shopping experience.</p>
<p>We hope you will have an exciting time shopping at <a 
href="http://www.lotuselectronics.com" style="text-decoration: none; color: rgb(68, 166, 148); font-weight: bold; margin-top: 0px; font-size: 15px;">Lotuselectronics</a></p>

<p>If you have any queries or suggestions regarding our service and products</p> 
<p>Please feel free to contact our 
<b>customer care at 0731- 4265555</b> or</p> 
<p><b>Email us at</b> <a href="enquiries@lotuselectronics.com" style="text-decoration: none; color: rgb(68, 166, 148); font-weight: bold; margin-top: 0px; font-size: 15px;">customerservices@lotuselectronics.com</a> </p>


<div class="thank">Thank you again, Happy Shopping!</div>

<div class="sinsly">
<p class="sincly">Sincerely</p>

<span class="lotus-team"><span class="lots"><img src="'.base_url().'front/images/footer-logo.png" alt="" border="0" /></span> </span>


</div>

</div>
              </td>
                </tr>              
      	</table>
	
		</td>
	</tr>
</table>';
return $footer_content;
}

//check product is shorlisted or no
function is_shortlisted($product_id){

  $rt = false;
  $CI =& get_instance();

  $unique_key = $CI->input->cookie('les_shortlist_key');
  if(!empty($unique_key)){
 	 $select_feilds = 'product_id,unique_key';
 	 $get_shortlist_data = $CI->common_model->get_entry_by_data("shortlist",true,array('product_id'=>$product_id,'unique_key'=>$unique_key,'status'=>'1'),$select_feilds);
 	 if($get_shortlist_data){
 	 	$rt = true;
 	 } 
  }

  return $rt;
 




}
function new_mail_header(){
	
$Template_header = '<table border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Arial, Helvetica, sans-serif; background-color:#f1f1f1;" width="700" class="main-table">
  <tr>
     <td style="background-color:#41a695; padding:5px 15px;" class="header">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="middle" width="60%"><a href="http://lotuselectronics.com/" target="_blank"><img src="http://lotuselectronics.com/promotion/common-images/logo.png" class="logo" alt="Lotus Electronics" style="max-width:100%; height:68px;"></a></td>
            <td valign="middle" width="60%">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">                  
                  <tr>
                    <td style="padding-top:0px; padding-bottom:8px;" colspan="3" align="right"><a href="https://play.google.com/store/apps/details?id=com.lotusapp&hl=en" target="_blank"><img src="http://lotuselectronics.com/promotion/common-images/call-us.png" alt="call-us" ></a> </td>
                  </tr>
                  <tr>
                    <td align="right" style="padding-top:0px;"><a href="http://www.lotuselectronics.com/egift" target="_blank"><img src="http://lotuselectronics.com/promotion/common-images/e-gift.png" alt="e-gift" ></a></td>
                     <td align="right" style="padding-top:0px;"><a target="_blank"><img src="http://lotuselectronics.com/promotion/common-images/free-shiping.png" alt="free-shiping" ></a></td>
                      <td align="right" style="padding-top:0px;"><a target="_blank"><img src="http://lotuselectronics.com/promotion/common-images/offers.png" alt="offers" ></a></td>
                   
                  </tr>
                </table>

            </td>
          </tr>
        </table>
    </td> 
  </tr>
  ';	
  return $Template_header;
}
function new_mail_footer(){
	$Template_footer = '<tr>
  <td style="background-color:#f2f2f2;">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           <td width="100%" valign="top" style="color:#000;font-size:14px; padding:0px 15px 10px 15px;">
           <h1 style="font-size:16px; margin-bottom:3px;">Happy Shopping! </h1>
           <h3 style="font-size:16px; margin-top:0px;"><div style="color:#e10a0a; display:inline-block;">Think Electronics,</div> <div style="color:#41a695; display:inline-block;">Think Lotus!</div></h3>
           
           
           
           </td>
</tr>
          

        </table>
    </td>
  
  </tr> 
 
</table>';
return $Template_footer;
	
	}
function ago($time)
{
   $periods = array("seconds", "minutes", "hours", "days", "weeks", "months", "years", "decades");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "";
   }

   $final_string = $difference.' '.$periods[$j];



  // $final_string = str_replace("month","mon", $final_string);
  // $final_string = str_replace("year","y", $final_string);
  // $final_string = str_replace("day","d", $final_string);
  // $final_string = str_replace("hour","h", $final_string);
  // $final_string = str_replace("minute","min", $final_string);
  // $final_string = str_replace("second","s", $final_string);
  // $final_string = str_replace("week","w", $final_string);
  // $final_string = str_replace("decade","de", $final_string);

  return $final_string;
}
function get_new_arr_product($remains_prd = '',$stock='',$slect=''){
	 $CI =& get_instance();
	 $where_new_arr = array(	
      'is_new' => 1,
      'status' => 'Active',
      'product_quantity >=' => (int)$stock                  
    );        
if(!empty($slect)){
	$new_arrival_select_column = $slect;
	}else{
    $new_arrival_select_column = 'product_id,product_name,product_image,product_mrp,product_msrp,product_quantity,ROUND((product_msrp-product_mrp)/product_msrp*100) as disc';  
}
	 $new_product = $CI->common_model->get_entry_by_data('products',false,$where_new_arr,$new_arrival_select_column,'','',$remains_prd);
	 return $new_product;
}
function get_home_cat_prd($limit='',$stock,$cat_id='',$cnt){
	 $CI =& get_instance();
	
	$cat_prd = $CI->home_model->get_home_products($cat_id,$limit,'','','','','1');   
	//echo $CI->db->last_query();exit;
	return $cat_prd;
}