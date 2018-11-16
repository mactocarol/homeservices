<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    //admin login section.
    public function index() {
        //print_r($_POST); die;
        $admin_login = $this->session->userdata('admin_login');
        $config['title'] = 'Admin | Login';
        if ($admin_login) {
            redirect('admin/dashboard');
        }
        $this->session->set_flashdata('posted_email', $this->input->post('email'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $data = $_POST;
            //echo $data['email'];die;
            $query_email = $this->db->get_where('admin', array("email" => $data['email']));
            $result = $query_email->result_array();
            
            if (!empty($result)) {
                foreach ($result as $res) {
                    $stored_salt = $res['salt'];
                    $stored_passsword = $res['password'];
                }
            } else {
                $this->session->set_flashdata('err', "Invalid username or password");
                redirect('admin');
            }
            $userPassword = $data['password']; 
            $hashedPassword = md5($userPassword);
            $where = array(
                'email' => $this->input->post('email'),
                'password' => $hashedPassword,
            );
            $data = $this->common_model->get_entry_by_data('admin', true, $where);
           // print_r($data); die;
            if ($data) {
                $session_array = array(
                    'admin_login' => true,
                    'admin_email' => $data['email'],
                    'admin_name' => $data['first_name'],
                    'admin_id' => $data['admin_id']
                );

                $this->session->set_userdata($session_array);
                //update last login for amdin
                //$this->common_model->save_entry('hvs_admin',array('last_login'=>date('Y-m-d H:i:s')),'admin_id',$data['admin_id']);
                //-----------------For Set Cookies Remember Me-------------------
                if ($this->input->post('remember_me')) {
                    $cookie = array(
                        'name' => 'les_rem_email',
                        'domain' => '',
                        'path' => '/',
                        'expire' => 2592000 + time(),
                        'value' => $this->input->post('email')
                    );
                    $cookie1 = array(
                        'name' => 'les_rem_password',
                        'expire' => 2592000 + time(),
                        'value' => $userPassword
                    );
                    set_cookie($cookie);
                    set_cookie($cookie1);
                } else {
                    $del_cookie = array(
                        'name' => 'les_rem_email',
                    );
                    delete_cookie($del_cookie);
                    $del_cookie1 = array(
                        'name' => 'les_rem_password',
                    );
                    delete_cookie($del_cookie1);
                }
                if (isset($_POST['remember_me'])) {
                    $this->input->set_cookie("a_name", $this->session->userdata('email'), time() + 2592000);
                    $this->input->set_cookie("a_id", $this->session->userdata('admin_id'), time() + 2592000);
                    $this->input->set_cookie("a_password", $_POST['password'], time() + 2592000);
                }
                //------------------------------------------------------------
                redirect(base_url('dashboard'));
            } else {
                $this->session->set_flashdata('err', "Invalid username or password");
                redirect('admin');
            }
        } else {
            $this->load->view('admin/include/header', $config);
            $this->load->view('admin/login');
            $this->load->view('admin/include/footer');
        }
    }

    public function dashboard() {
        $this->check_admin_login();
        $this->get_header();
        $this->load->view('admin/dashboard');
        $this->load->view('admin/include/footer_other');
    }

    // admin check login
    private function check_admin_login() {
        $admin_login = $this->session->userdata('admin_id');
        if ($admin_login) {
            return true;
        } else {
            redirect('admin/index');
        }
    }

    // for admin logout
    public function logout() {
        $newdata = array(
            'admin_email' => '',
            'admin_name' => '',
            'admin_id' => '',
            'admin_login' => FALSE,
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        redirect(base_url() . 'admin');
    }

    // for admin Change Password
    public function ChangePassword() {
        $this->check_admin_login();
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[new_password]');
        if ($this->form_validation->run() == TRUE) {

            $userPassword = $this->input->post('new_password');
            $salt = time();
            $hashedPassword = md5($userPassword);//sha1($userPassword . $salt);

            $up_array = array(
                'password' => $hashedPassword,
                'salt' => $salt,
                'update_date' => date('Y-m-d H:i:s'),
            );
            $this->common_model->save_entry('admin', $up_array, 'admin_id', $this->session->userdata('admin_id'));
            $this->session->set_flashdata('succ', 'Password has been updated successfully.');
            //redirect(base_url('dashboard'));
            $this->get_header('Profile | Admin');
             $this->load->view('admin/changepassword');
            $this->load->view('admin/include/footer_other');
           
        } else {
             $this->get_header('Profile | Admin');
             $this->load->view('admin/changepassword');
            $this->load->view('admin/include/footer_other');
           
        }
    }

    public function profile() {
        $this->check_admin_login();
        $data['records'] = $this->common_model->get_entry_by_data('admin', true, array('admin_id' => $this->session->userdata('admin_id')));
        if ($data['records']) {
            $this->get_header('Profile | Admin');
            $this->load->view('admin/profile', $data);
            $this->load->view('admin/include/footer_other');
        } else {
            redirect(base_url());
        }
    }

    public function edit_profile() {
        //echo $_FILES["upload"]["name"];die;
        $config['upload_path'] = './images/admin';
        $config['allowed_types'] = '*';
        $config['max_size'] = '10240';
        $config['create_thumb'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/profile', $error);
            $data = array();
            //echo '<pre>';
            //print_r($error);die;
        } else {
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('media_city/ajax_include/photoPostDiv', $req);
        }

        $data_array = array(
            'first_name' => $this->input->post('f_name'),
            'last_name' => $this->input->post('l_name'),
            'email' => $this->input->post('email'),
            'update_date' => date('Y-m-d H:i:s'),
            'contact_number' => $this->input->post('contact_number')
        );
        if (!empty($data)) {
            $data_array['photo_path'] = $data['upload_data']['file_name'];
        }
        $address = $this->input->post('address');
        if (!empty($address)) {
            $data_array['address'] = $this->input->post('address');
        } else {
            $data_array['address'] = "";
        }
        // $target_dir = "uploads/admin/";
        // $target_file = $target_dir . basename($_FILES["upload"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // // Check if file already exists
        // if (file_exists($target_file)) {
        //     //echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }
        // if ($_FILES["upload"]["size"] > 500000) {
        // 	//echo "Sorry, your file is too large.";
        // 	$uploadOk = 0;
        // }
        // if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        // 	//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        // } else {
        // 	//echo "Sorry, there was an error uploading your file.";
        // }
        //$data['path'] = $target_file;
        $admin_id = $this->session->userdata('admin_id');
        $where_admin = array('admin_id' => $admin_id);
        $this->common_model->update_entry('admin', $data_array, $where_admin);
        redirect(base_url() . 'admin/dashboard');
    }

}
