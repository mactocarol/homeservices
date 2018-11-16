<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Blog extends MY_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('common_model');
    }
    public function index(){
        
        $data['blod_details'] = $this->common_model->getAllrecord('blog');
        $this->get_front_header('Blog');
        $this->load->view('front/blog/blog',$data);
        $this->load->view('front/include/footer');
    }
     public function blog_details(){
       
        //Single Record
        $b_iid = ci_dec($this->uri->segment(2)); 
        $data['single_blog'] = $this->common_model->getsingle('blog', array('blog.post_id' => $b_iid), 'post_id,post_title,post_description,post_img,update_date');
        //All Blog
        $data['all_blog'] = $this->common_model->getAllrecord('blog');
        $this->get_front_header('Single Blog');
        $this->load->view('front/blog/single_blog',$data);
        $this->load->view('front/include/footer');
    } 
    
}