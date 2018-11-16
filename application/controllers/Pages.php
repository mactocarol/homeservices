<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
    }
    //show list of all users.
    public function index() {
        //$data['records'] = $this->common_model->get_entry_by_data('users',false,array('name !='=>''));
        //$this->check_admin_login();
        $this->load->model('common_model');
        $data['records'] = $this->common_model->getAllrecord('pages');
        //print_r($data['records']);exit;
        $this->get_header('Manage Pages');
        $this->load->view('admin/pages/manage_pages', $data);
        $this->load->view('admin/include/footer_other');
    }

//    public function get_header($title = '') {
//        $this->load->model('page_model');
//        $data['title'] = $title;
//        $this->load->view('admin/include/header_other', $data);
//        $this->load->view('admin/include/left_nav');
//        $this->load->view('admin/include/user_header');
//        $admin_login = $this->session->userdata('admin_id');
//        if ($admin_login) {
//            return true;
//        } else {
//            redirect('admin/index');
//        }
//    }

    public function get_preview_header($title = '', $data) {
        $this->load->model('page_model');
        $data['title'] = $title;
        $this->load->view('admin/include/header_preview', $data);
        $this->load->view('admin/include/user_header');
    }

    private function check_admin_login() {

        $this->load->model('page_model');
        $admin_login = $this->session->userdata('admin_id');
        if ($admin_login) {
            return true;
        } else {
            redirect(base_url());
        }
    }

    public function add_page() {
        $this->check_admin_login();
        $path = base_url() . 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        $this->form_validation->set_rules('description', 'Page Description', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['page_add_date'] = date('Y-m-d h:i:s');
            $this->get_header('Add Page');
            $this->load->view('admin/pages/add_page', $data);
            $this->load->view('admin/include/footer_other');
        }
    }

    function editor($path,$width) {
    //Loading Library For Ckeditor
    $this->load->library('ckeditor');
    $this->load->library('ckFinder');
    //configure base path of ckeditor folder 
    $this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
    $this->ckeditor-> config['toolbar'] = 'Full';
    $this->ckeditor->config['language'] = 'en';
    $this->ckeditor-> config['width'] = $width;
    //configure ckfinder with ckeditor config 
    $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }

    public function add_page_post() {
        $this->check_admin_login();
        $request = $this->common_model->add_page_post();

        if ($request == 2) {
            $this->session->set_flashdata('Register_error', 'Page title already exist');
            redirect(base_url() . 'AddPage');
        } elseif ($request == 0) {
            $this->session->set_flashdata('Register_error', 'Error in page');
            redirect(base_url() . 'AddPage');
        } else {
             $this->session->set_flashdata('succ', "Pages has been Add successfully. ");
            redirect(base_url() . 'ManagePages');
        }
    }

    public function edit_page_detail() {
        //$this->load->model('page_model');
        $this->check_admin_login();
        $iid = ci_dec($this->uri->segment(2));
        $path = base_url().'assets/js/ckfinder';
        $path = 'assets/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        $this->form_validation->set_rules('description', 'Page Description', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $title = trim($this->input->post('title', TRUE));
            $description = trim($this->input->post('description', TRUE));
            $meta_title = trim($this->input->post('meta_title', TRUE));
            $meta_desc = trim($this->input->post('meta_desc', TRUE));
            $meta_keyword = trim($this->input->post('meta_keyword', TRUE));
            $status = trim($this->input->post('status', TRUE));
            $update_where = array('page_id'=>$iid);
            $data_update = array(
                                    'page_title' => $title,
                                    'page_content' => $description,
                                    'meta_title' => $meta_title,
                                    'meta_description' => $meta_desc,
                                    'meta_keyword' => $meta_keyword,
                                    'is_active' => $status,
                                    'update_date' => date('Y-m-d H:i:s')
                                );
            $this->common_model->update_entry('pages',$data_update,$update_where);
            $this->session->set_flashdata('succ', "Pages has been update successfully. ");
            redirect(base_url() . 'pages');
        }
            $where = array('page_id' => $iid);
            $data['page_update_date'] = date('Y-m-d h:i:s');
            $data['records'] = $this->common_model->getsingle('pages',$where,'*');
            $this->get_header('Edit Pages');
            $this->load->view('admin/pages/edit_page', $data);
            $this->load->view('admin/include/footer_other');
    }

    public function edit_page_post($id) {
        $this->check_admin_login();
        $request = $this->common_model->edit_page_post($id);
        redirect(base_url() . 'ManagePages');
    }

    public function active_pages() {
        $id = $this->input->post('pageid', TRUE);
        $data['result'] = $this->common_model->active_pages($id);
    }

    public function block_pages() {
        $this->load->model('page_model');
        $id = $this->input->post('pageid', TRUE);
        $data['result'] = $this->page_model->block_pages($id);
    }
    
    function delete($id) {
         $id = ci_dec($id);
	$where = array('page_id' => $id);
        $rec = $this->common_model->DeleteRecordWhere('ai_pages',$where);
        $this->session->set_flashdata('succ', "Pages has been deleted successfully. ");
        redirect('ManagePages');
    }

}

/* End of file user.php */
/* Location: ./application/controllers/api/user.php */