<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Location extends MY_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->library('myclass');
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
    }
    public function index()
    {
       $data['get_location'] = $this->common_model->getAllrecord('locations');
       $this->get_header('Manage Location');
       $this->load->view('admin/location/manage_location',$data);
       $this->load->view('admin/include/footer_other');
    }
    
    public function add_location()
    {
        if($_POST){
           
            
         //print_r($_POST);exit;   
        $source = trim($this->input->post('street'));
        
        $zipcode = trim($this->input->post('zipcode'));
        
        $status = trim($this->input->post('status'));
        
        //$source_city_name = find_address($source);
        //$get_info = reverse_geocode($source);
       
//        if (!empty($get_info[0])) { $city = $get_info[0]; }else{ $city = '-'; }
//        if (!empty($get_info[1])) { $state = $get_info[1]; }else{ $state = '-'; }
//        if (!empty($get_info[2])) { $country = $get_info[2]; }else{ $country = '-'; }       
//        if (!empty($get_info[3])) { $zipcode = $get_info[3]; }else{ $zipcode = '-'; }
//        if (!empty($get_info[4])) { $fulladdress = $get_info[4]; }else{ $fulladdress = '-'; }
//        if (!empty($get_info[5])) { $latitude = $get_info[5]; }else{ $latitude = '-'; }
//        if (!empty($get_info[6])) { $longitude = $get_info[6]; }else{ $longitude = '-'; }       
         
       
       $insert_array = array
                            (
                             'location_name' => '-',
                             'street' => '-',
                             'city' => $source,
                             'state' => '-',
                             'zip_code' => $zipcode,
                             'country' => '-',
                             'geo_lat_location' => '-',
                             'geo_lng_location' => '-',
                             'last_update_date' => date('Y-m-d H:i:s'),
                             'status' => $status
                            );
            $insert_cat =  $this->common_model->insert_entry('locations',$insert_array); 
            if($insert_cat){
                $this->session->set_flashdata('succ', "Location has been added successfully. ");
                redirect('ManageLocation');
            }
                            
        }
        
        $this->load->library('googlemaps');
        $config['center'] = '37.4419, -122.1419';
        $config['zoom'] = 'auto';
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        $config['placesAutocompleteOnChange'] = $this->input->post('street');
        $this->googlemaps->initialize($config);
    
        $this->get_header('Add Location');
        $this->load->view('admin/location/add_location');
        $this->load->view('admin/include/footer_other');
    }
    
    public function edit_location()
    {
       $iid = $this->uri->segment('2');  
      if($_POST){           
        $source = trim($this->input->post('street'));        
        $zipcode = trim($this->input->post('zipcode'));
        $status = trim($this->input->post('status'));
        
       $insert_array = array
                            (
                             'location_name' => '-',
                             'street' => '-',
                             'city' => $source,
                             'state' => '-',
                             'zip_code' => $zipcode,
                             'country' => '-',
                             'geo_lat_location' => '-',
                             'geo_lng_location' => '-',
                             'last_update_date' => date('Y-m-d H:i:s'),
                             'status' => $status
                            );
            $insert_cat =  $this->common_model->update_entry('locations', $insert_array, array('id' => $iid));
            if($insert_cat){
                $this->session->set_flashdata('succ', "Location has been Update successfully. ");
                redirect('ManageLocation');
            }
                            
        }  
       
       $data['get_record'] = $this->common_model->getsingle('locations',  array('id' => $iid),  array('id','zip_code','city','status'));
       //print_r($data['get_record']);exit;
       $this->get_header('Edit Location');
       $this->load->view('admin/location/edit_location',$data);
       $this->load->view('admin/include/footer_other');
    }
    
    public function delete_location()
    {
            $location_id = $this->uri->segment(2);
            $where  = array('id'=>$location_id);
           $delete_record = $this->common_model->DeleteRecordWhere('locations',$where);
           if($delete_record){
           $this->session->set_flashdata('succ', "Location has been Delete successfully.");
           redirect('ManageLocation');
           }
    }
    
    public function import_zipcode(){
                        //header('Content-Type: text/html; charset=UTF-8');
   			$this->form_validation->set_rules('fileHidden', "Import File", 'trim|required');
			
			if ($this->form_validation->run() == TRUE) {
                            
                            $config['upload_path'] = './upload/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '100000';
                            $this->load->library('upload', $config);
	//print_r($_POST);exit;
        // If upload failed, display error
        if (!$this->upload->do_upload('imp_zip')) {
             $errors = $this->upload->display_errors();
             $this->session->set_flashdata('error',$errors);
             redirect('ManageLocation');
        } else {
             $file_data = $this->upload->data();
            $file_path =  './upload/'.$file_data['file_name'];
    
                
              
                 $sucssfull_update = 0;
                    $wrong_entries = 0;
                    $wrong_price = 0;
                    $total_unsuccessfull = 0;
               

                //////////////////////////////////////////////////////////////////
                 $file = fopen($file_path, 'r');
                 $mCount = 0;   
                 $update_date = date("Y-m-d H:i:s");
                 $skus = array();
                    while (($row = fgetcsv($file)) !== FALSE) {
                        
                        if($mCount != 0) {							
                             if(!empty($row[0]) && !empty($row[1])){								 
				$zip_check = $this->common_model->get_entry_by_data('ai_locations',true,array('zip_code'=>$row[0]));
				if(empty($zip_check)){
                                $zip = trim($row[0]);
                                $city = trim($row[1]);
                                $date = date('Y-m-d h:i:s');
								$arr = array(
								'zip_code' => $zip,
								'city' => $city,
                                                                'last_update_date' => date('Y-m-d h:i:s'),
								);
                                                                //print_r($arr);exit;
                                $this->common_model->save_entry('ai_locations',$arr,'id');
                                $sucssfull_update++;   
								 }else{
									$wrong_entries++;
								}
                             } else {
                                $wrong_entries++;
                             }
                          }

                           $mCount++;  

                    }
                    fclose($file);               

                unlink($file_path);
                $summary = "<b>Summary : </b><br><b>Total Updates</b> : $sucssfull_update";
                
                $this->session->set_flashdata('succ', 'Zipcode list has been Updated succesfully <br>'.$summary);
                redirect(base_url().'ManageLocation');
                //echo "<pre>"; print_r($insert_data);
            }
                            
                        }
                        else {
                            $this->get_header('Import Data');
                            $this->load->view('admin/location/add_zip');
                            $this->load->view('admin/include/footer_other');
		}
	}
    
}