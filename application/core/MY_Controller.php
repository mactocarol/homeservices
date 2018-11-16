<?php
class MY_Controller extends CI_Controller {
   public function __construct() 
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
        $this->load->library('googlemaps');
        date_default_timezone_set('Asia/Calcutta');
        $facebook_config = $this->config->item('facebook_config');
        $this->load->library('facebook', array('appId' => $facebook_config['api'], 'secret' => $facebook_config['api_secret']));
        parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
        $this->user = $this->facebook->getUser();
    }
    // for get header of admin panel
    public function get_header($title='')
    {
        $data['title'] = $title;
        $data['map'] = $this->googlemaps->create_map();
        $this->load->view('admin/include/header_other', $data);
        $this->load->view('admin/include/left_nav');
        $this->load->view('admin/include/user_header');
    }
    public function get_front_header($title='')
    {
        
        $data['title'] = $title;
        //Get Category
        $data['cat_record'] = $this->category_model->run_query_arr('SELECT `ai_category`.*, `b`.`cat_name` as `parent_level` FROM `ai_category` LEFT JOIN `ai_category` as `b` ON `ai_category`.`cat_parent_id` = `b`.`cat_id` WHERE `ai_category`.`cat_parent_id` = 0 ORDER BY `ai_category`.`cat_id` DESC');
        //Set login url for facebook login
        $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => base_url('front/login/social_user_data/'), 
                'scope' => array("email") // permissions here
            ));
        
        $data['menu_categories'] = $this->get_all_categories();
        $data['submain_cat'] = $this->get_sub_category();
      //  echo $this->db->last_query();
       // print_r($data['submain_cat']);exit;
        
        $this->load->view('front/include/header', $data);
        
    }
    function check_login()
    {
	$user_id = $this->session->userdata('id');
	$user_email = $this->session->userdata('email');
	$user_fullname = $this->session->userdata('fullname');
	if(!empty($user_id) && !empty($user_email) && !empty($user_fullname)){
		return true;	
	}else{
		return false;
		}
    }
    /* Get all Categories */
    public function get_all_categories() 
    {
        $where = array('cat_parent_id' => 0);
        $field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id');
        $data['main_cat'] = $this->common_model->getAllwherenewwith_order('ai_category', $where, $field,'cat_order','ASC');
      
        //        $sel_parent = 'cat_id,cat_name,cat_parent_id,is_active,cat_picture,cat_desc,cat_order';
//        $where = array('cat_parent_id' => 0, 'is_active' => 'active');
//        $active = 'active';
//        //$data['main_categories'] = $this->common_model->getAllRecords('category', 'cat_order', 'asc', $where, $sel_parent, '');
//        $main_categories = $this->category_model->run_query_arr('SELECT * FROM `ai_category` WHERE `cat_parent_id` =0 AND `is_active` = "'.$active.'" ORDER BY `cat_id` ASC');
//        //echo $this->db->last_query();
//        //print_r($data['main_categories']);exit;
//        if ($main_categories) {
//            foreach ($main_categories as $key => $value) 
//            {
//                $main_categories[$key]->child_cate = $this->getTree($value->cat_id);
//            }
//        }
        return $data['main_cat'];
    }
    /* Get category tree */
    public function get_sub_category(){
        $sub_where = array('cat_parent_id!=' => 0);
        $sub_field = array('cat_id', 'cat_name', 'cat_picture', 'cat_parent_id');
        $data['submain_cat'] = $this->common_model->getAllwherenew('ai_category', $sub_where, $sub_field);
         return $data['submain_cat'];
    }
    public function getTree($rootid) 
    {
        $arr = array();
        $sel_parent = 'cat_id,cat_name,cat_picture';
        $where = array('cat_parent_id' => $rootid, 'is_active' => 'active');
        $active = 'active';
        //$child_categories = $this->common_model->get_entry_by_data('category', false, $where, $sel_parent, 'asc', 'cat_order');
        $child_categories = $this->category_model->run_query_arr('SELECT `cat_id`, `cat_name`, `cat_picture` FROM `ai_category` WHERE `cat_parent_id` = "'.$rootid.'" AND `is_active` = "'.$active.'" ORDER BY `cat_order` ASC');
        
       //print_r($child_categories);exit;
        //echo $this->db->last_query();exit;
        //exit;
        if ($child_categories != 'no') {
            foreach ($child_categories as $row) {
                $row->child_cate = $this->getTree($row->cat_id);
                $arr[count($arr)] = $row;
            }
        }
        return $arr;
    }
    public function category(){
        
        
    }
}