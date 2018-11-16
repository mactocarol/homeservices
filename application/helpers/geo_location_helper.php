<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function find_lat_long($string)
{
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return null;
   }
   //print_r($response);
   $geometry = $response['results'][0]['geometry'];
    $longitude = $geometry['location']['lat'];
    $latitude = $geometry['location']['lng'];
    $array = array(
        'latitude' => $geometry['location']['lng'],
        'longitude' => $geometry['location']['lat'],
        'location_type' => $geometry['location_type'],
    );
    return $array;
}
//find formated address from lat , long
function getaddress_by_lat_long($lat,$lng)
{
    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
    $json = @file_get_contents($url);
    $data=json_decode($json);
    $status = $data->status;
    if($status=="OK")
    return $data->results[0]->formatted_address;
    else
    return false;
}
//this function is for calculate distance in mile unit by source and destination address 
function getDistanceByAddress($source,$destination,$unit='imperial'){
    $params = array(
        'origin'        => $source,
        'destination'   => $destination,
        'sensor'        => 'true',
        'units'         => $unit
    );
    $params_string = '';    
    // Join parameters into URL string
    foreach($params as $var => $val){
        $params_string .= '&' . $var . '=' . urlencode($val); 
    }
    // Request URL
    $url = "http://maps.googleapis.com/maps/api/directions/json?".ltrim($params_string, '&');
    // Make our API request
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    $directions = json_decode($return);

    if(!empty($directions->routes[0]->legs[0]->distance->text)) {
        return $directions->routes[0]->legs[0]->distance->text;
    } else {
        return 0;
    }
    //print($directions->routes[0]->legs[0]->distance->text); // 31.8 mi
    //print($directions->routes[0]->legs[0]->steps[0]->duration->text); // 4 min
    //print($directions->routes[0]->legs[0]->steps[0]->html_instructions); // Head northwest on North St toward Chertsey St
}



function get_user_thumb($profile_image){
    $img_name = explode('.', $profile_image);
    if(!empty($img_name[0])){
      return $img_name[0].'_thumb.'.$img_name[1];    
    }
}

function reverse_geocode($address) {
    $address = str_replace(" ", "+", "$address");
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
    $result = file_get_contents("$url");
    $json = json_decode($result);
    //print_r($json);
    foreach ($json->results as $result) {
        $fulladdres =  $result->formatted_address;        
        if($result->geometry->location->lat != '')
        {
            $latitude = $result->geometry->location->lat;
        }else{
            $latitude = '';
        }
        
        if($result->geometry->location->lng != '')
        {
        $longitude = $result->geometry->location->lng;
        }else{
            $longitude = '';
        }
        
        foreach($result->address_components as $addressPart) {
            
             if((in_array('postal_code', $addressPart->types))){
                 $postcode = $addressPart->long_name;
             }else{
                 $postcode = '-';
             }
            
          if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types))){
          $city = $addressPart->long_name;
          }else{
              $city = '-';
          }
            if((in_array('administrative_area_level_1', $addressPart->types)) && (in_array('political', $addressPart->types))){
            $state = $addressPart->long_name;
            }else{
                $state = '-';
            }
            if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types))){
            $country = $addressPart->long_name;
            }else{
                $country = '-';
            }
         
        }
    }
    return array($city,$state,$country,$postcode,$fulladdres,$latitude,$longitude);
}

// ------------------------------------------------------------------------

/* End of file geo_location_helper.php */

/* Location: ./application/helpers/geo_location_helper.php */