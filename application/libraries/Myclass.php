<?php
class Myclass 
{
    function uploadImage($uploadData, $fieldName, $uploadPath, $uploadPath1, $thumbwidth, $thubHeight) {
        //echo $uploadData['name'];
        if (!empty($uploadData)) {
            $this->CI = & get_instance();
            $this->CI->load->library('upload');
            $config['upload_path'] = $_SERVER["DOCUMENT_ROOT"] . $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['file_name'] = $uploadData;
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '10240';
            $this->CI->upload->initialize($config);
            if ($this->CI->upload->do_upload($fieldName)) {
                $uploaded_img_data = $this->CI->upload->data();
                //print_r($uploaded_img_data);
                //exit;
                $config1['image_library'] = 'gd2';
                $config1['source_image'] = $_SERVER["DOCUMENT_ROOT"] . $uploadPath . $uploaded_img_data['file_name'];
                $config1['new_image'] = $_SERVER["DOCUMENT_ROOT"] . $uploadPath1 . $uploaded_img_data['file_name'];
                $config1['width'] = $thumbwidth;
                $config1['height'] = $thubHeight;
                $config1['maintain_ratio'] = TRUE;
                $config1['create_thumb'] = TRUE;

                $this->CI->load->library('image_lib', $config1);
                $this->CI->image_lib->initialize($config1);
                $this->CI->image_lib->resize();
                $this->CI->image_lib->clear();
                //@unlink('/assets/Banner/'.$uploaded_img_data['file_name']);
                return $uploaded_img_data['file_name'];
                //return '<img src="'.base_url().'images'.$uploadPath.$uploaded_img_data['file_name'].'">';;
            } else {
                return '<div class="alert alert-error">' . $this->CI->upload->display_errors() . '</div>';
            }
        }
    }

    function upload_pic($img = '') {
        //echo getcwd() . "\n";exit;
        $config['upload_path'] = getcwd() . '/assets/baner';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->CI = & get_instance();
        $config['max_width'] = '10241';
        $config['max_height'] = '7681';
        $config['encrypt_name'] = TRUE;
        $this->CI->load->library('upload', $config);
        if ($this->CI->upload->do_upload($img)) {
            $newdata = $this->CI->upload->data();
            $img_new = $newdata['file_name'];
            $config['image_library'] = 'gd2';
            //$config['source_image'] = getcwd().'/upload_image/thumb/'.$img_new;
            $config['source_image'] = getcwd() . '/assets/baner' . '/' . $img_new;
            $config['new_image'] = getcwd() . '/assets/baner' . '/thumb/' . $img_new;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 250;
            $config['height'] = 250;

           // print_r($config);
            $this->CI->load->library('image_lib', $config);
            $this->CI->image_lib->resize();
            //$this->CI->image_lib->initialize($config);
            //$this->CI->image_lib->resize();
            //$this->CI->image_lib->clear();
            return $img_new;
        }
    }

    function upload_picture_thumb($img = '',$uploadPath,$uploadPath1,$thumbwidth, $thubHeight) {
        //echo getcwd() . "\n";exit;
        $config['upload_path'] = getcwd() . $uploadPath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->CI = & get_instance();
        $config['max_width'] = '10241';
        $config['max_height'] = '7681';
        $config['encrypt_name'] = TRUE;
        $this->CI->load->library('upload', $config);
        if ($this->CI->upload->do_upload($img)) {
            $newdata = $this->CI->upload->data();
            $img_new = $newdata['file_name'];
            $config['image_library'] = 'gd2';
            //$config['source_image'] = getcwd().'/upload_image/thumb/'.$img_new;
            $config['source_image'] = getcwd() . $uploadPath.$img_new;
            $config['new_image'] = getcwd() .$uploadPath1. $img_new;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $thumbwidth;
            $config['height'] = $thubHeight;

            //print_r($config);
            $this->CI->load->library('image_lib', $config);
            $this->CI->image_lib->resize();
            //$this->CI->image_lib->initialize($config);
            //$this->CI->image_lib->resize();
            //$this->CI->image_lib->clear();
            return $img_new;
        }
    }
    
    function ChangeStateByCountry($country)
	{		
		
		$this->CI =& get_instance();
                $state = $this->CI->common_model->getAllwherenew('ai_states',  array('countryid' => $country),  array('regionid','region','code','status'));
		if($state!=FALSE)
		{
                    ?>
			<?php
                                foreach ($state as $states)
				{
			?>
			<option value="<?php echo $states->region;?>"><?php echo $states->region;?></option>
		 <?php }?>
		<?php }else{
			
			 }
	}

}

?>