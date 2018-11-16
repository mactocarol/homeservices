<?php
class Common_model extends CI_Model {
    
    function get_entry_by_data($table_name, $single = false, $data = array(), $select = "", $order_by = '', $orderby_field = '', $limit = '', $offset = 0, $group_by = '') {
        if (!empty($select)) {
            $this->db->select($select);
        }
        if (empty($data)) {
            $id = $this->input->post('id');
            if (!$id)
                return false;
            $data = array('id' => $id);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }
        if (!empty($order_by) && !empty($orderby_field)) {
            $this->db->order_by($orderby_field, $order_by);
        }
        $query = $this->db->get_where($table_name, $data);
        $res = $query->result_array();
        //echo $this->db->last_query();exit;
        if (!empty($res)) {
            if ($single)
                return $res[0];
            else
                return $res;
        } else
            return false;
    }
    function save_entry($table_name, $data, $key_field = 'id', $id = false) {
        if (!empty($id)) {
            if (!empty($data) and $this->db->update($table_name, $data, array($key_field => $id))) {
                $query = $this->db->get_where($table_name, array($key_field => $id));
                $result = $query->result_array();
                return (!empty($result)) ? $result[0] : false;
            } else
                return false;
        }
        else {
            if ($this->db->insert($table_name, $data)) {
                return $this->get_entry_by_data($table_name, true, array($key_field => $this->db->insert_id()));
                echo $this->db->last_query();
            } else
                return false;
        }
    }
    public function getNumRows($table, $orderby_field = '', $orderby_val = '', $where_field = '', $where_val = '') {
        if (empty($data)) {
            $id = $this->input->post('id');
            if (!$id)
                return false;
            $data = array('id' => $id);
        }
        $query = $this->db->get_where($table_name, $data);
        $res = $query->num_rows;
        return $res;
    }
    public function getAllRecords($table, $orderby_field = '', $orderby_val = '', $where_field = '', $where_val = '', $select = '', $limit = '', $limit_val = '') {
        if (!empty($limit)) {
            $offset = (empty($limit_val)) ? '0' : $limit_val;
            $this->db->limit($limit, $offset);
        }
        if (!empty($select)) {
            $this->db->select($select);
        }
        if ($orderby_field)
            $this->db->order_by($orderby_field, $orderby_val);
        if ($where_field)
            $this->db->where($where_field, $where_val);
        $query = $this->db->get($table);
        //return $query->num_rows;
        //echo $this->db->last_query();
        if ($query->num_rows > 0) {
            return $query->result_array();
        }
    }
    	function getAllrecord($table) {
        $this->db->select('*');
        $q = $this->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    function allgetrecord($table) {
        $this->db->select('*');
        $q = $this->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
	
    public function get10Records($table, $orderby_field = '', $orderby_val = '', $where_field = '', $where_val = '', $select = '', $limit = '', $limit_val = '') {
        if (!empty($limit)) {
            $offset = (empty($limit_val)) ? '0' : $limit_val;
            $this->db->limit($limit, $offset);
        }
        if (!empty($select)) {
            $this->db->select($select);
        }
        if ($where_field)
            $this->db->where($where_field, $where_val);
        if ($orderby_field)
            $this->db->order_by($orderby_field, $orderby_val);
        if ($limit_val)
            $this->db->limit($limit_val);
        $query = $this->db->get($table);
        //return $query->num_rows;
        //echo $this->db->last_query();exit;
        if ($query->num_rows > 0) {
            return $query->result_array();
        }
    }
    public function count_results($table_name, $where = '') {
        $this->db->from($table_name);
        if ($where)
            $this->db->where($where);
        return $this->db->count_all_results();
    }
    function insert_entry($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    /* --------------------------------------------------------------------------------- */
    function update_entry($table_name, $data, $where) {
        return $this->db->update($table_name, $data, $where);
    }
    /* --------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------- */
    public function get_all_entries($table_name, $input = array()) {
        $default = array(
            'start' => 0,
            'limit' => false,
            'sort' => '',
            'sort_type' => 'asc',
            'single' => false,
            'distinct' => false,
            'custom_where' => false,
            'group_by' => false,
            'count' => false
        );
        $args = array_merge($default, $input);
        if (!empty($args['fields'])) {
            foreach ($args['fields'] as $key => $value) {
                foreach ($value as $val) {
                    if (strpos($val, "(") !== false)
                        $this->db->select($val);
                    else
                        $this->db->select($key . '.' . $val);
                }
            }
        }
        if ($args['limit'] && !$args['count'])
            $this->db->limit($args['limit'], $args['start']);
        if (!$args['count'])
            $this->db->order_by($args['sort'], $args['sort_type']);
        if (!empty($args['joins'])) {
            foreach ($args['joins'] as $key => $value) {
                if (is_array($value)) {
                    if ($value[0] == 'custom') {
                        $this->db->join($key, $value[1], ((!empty($value[2])) ? $value[2] : 'left'));
                    } else
                        $this->db->join($key, $key . '.' . $value[0] . ' = ' . $table_name . '.' . $value[1], ((!empty($value[2])) ? $value[2] : 'left'));
                }
                else {
                    $this->db->join($key, $key . '.id = ' . $table_name . '.' . $value, 'left');
                }
            }
        }
        if (!empty($args['where'])) {
            foreach ($args['where'] as $key => $value) {
                if (is_array($value)) {
                    if (!empty($value[0]) and $value[0] == 'custom')
                        $this->db->where($value[1], NULL, FALSE);
                    elseif (!empty($value[0]))
                        $this->db->where($value[0] . '.' . $key, $value[1]);
                    else
                        $this->db->where($table_name . '.' . $value[1], NULL, FALSE);
                }
                else {
                    if ($value !== '')
                        $this->db->where($table_name . '.' . $key, $value);
                }
            }
        };
        if (!empty($args['where_in'])) {
            foreach ($args['where_in'] as $key => $value) {
                if (is_array($value)) {
                    $this->db->where_in($table_name . '.' . $key, $value);
                }
            }
        };
        if (!empty($args['where_not_in'])) {
            foreach ($args['where_not_in'] as $key => $value) {
                if (is_array($value)) {
                    $this->db->where_not_in($table_name . '.' . $key, $value);
                }
            }
        };
        if ($args['custom_where']):
            $this->db->where($args['custom_where']);
        endif;
        if (!empty($args['or_where'])) {
            foreach ($args['or_where'] as $key => $value) {
                if ($value !== '')
                    $this->db->or_where($table_name . '.' . $key, $value);
            }
        };
        if (!empty($args['like'])) {
            foreach ($args['like'] as $key => $value) {
                if (is_array($value)) {
                    if (empty($value[2]))
                        $this->db->like($value[0] . '.' . $key, $value[1]);
                    else
                        $this->db->like($value[0] . '.' . $key, $value[1], $value[2]);
                }
                else {
                    if ($value !== '')
                        $this->db->like($table_name . '.' . $key, $value);
                }
            }
        };
        if (!empty($args['or_like'])) {
            foreach ($args['or_like'] as $key => $value) {
                if (is_array($value)) {
                    $this->db->or_like($value[0] . '.' . $key, $value[1]);
                } else {
                    if ($value !== '')
                        $this->db->or_like($table_name . '.' . $key, $value);
                }
            }
        };
        if (!empty($args['not_like'])) {
            foreach ($args['not_like'] as $key => $value) {
                if (is_array($value)) {
                    $this->db->not_like($value[0] . '.' . $key, $value[1]);
                } else {
                    if ($value !== '')
                        $this->db->not_like($table_name . '.' . $key, $value);
                }
            }
        };
        if ($args['distinct'])
            $this->db->distinct();
        if ($args['group_by'] && !$args['count'])
            $this->db->group_by($args['group_by']);
        if ($args['count']) {
            $this->db->from($table_name);
            return $this->db->count_all_results();
        } else {
            $query = $this->db->get($table_name);
            $results = $query->result_array();
            if (!empty($results)) {
                if ($args['single'])
                    return $results[0];
                else
                    return $results;
            } else
                return array();
        }
    }
    /* --------------------------------------------------------------------------------- */
    function UpdateRecords($table,$data,$id) {
        $this->db->where($id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    function DeleteRecord($table, $field, $id) {
        $this->db->where($field, $id);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    function DeleteRecordWhere($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    function CheckEmailName($table, $email) {
        $this->db->where('member_email', $email);
        $rec = $this->db->get($table);
        return $rec->num_rows();
    }
    function getSingleRow($table, $where_field, $where_val) {
        $this->db->where($where_field, $where_val);
        $query = $this->db->get($table);
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    function CheckExisting($table, $field_name, $param) {
        $this->db->where($field_name, $param);
        $rec = $this->db->get($table);
        return $rec->num_rows();
    }
    function CheckExistingMail($table, $email, $member_id) {
        $this->db->where('business_email', $email);
        $this->db->where('member_id <> ', $member_id);
        $rec = $this->db->get($table);
        return $rec->num_rows();
    }
    function selectColumn($table, $sel_field, $where_field, $where_val) {
        $this->db->select($sel_field);
        $this->db->from($table);
        $this->db->where($where_field, $where_val);
        return $this->db->get()->result();
    }
    //----------------------------------------------------------------------------------------
    public function check_register($email) {
        $query = $this->db->get_where('hvs_supplier', array("email" => $email));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $a) {
                $data = array(
                    'user_id' => $a->user_id,
                    'email' => $a->email
                        //'password'=>$a->password,
                        ///'password_without_md5'=>$a->password_without_md5 
                );
            }
            return $data;
        } else {
            return 0;
        }
    }
    public function change_forget_password($id) {
        $up_array = array(
            'password' => md5($this->input->post('new_password')),
                // 'password_without_md5' => $this->input->post('new_password'),	
        );
        $this->db->where('email', $id);
        $this->db->update('hvs_supplier', $up_array);
        return $this->db->affected_rows();
    }
    public function change_password() {
        $admin_id = $this->session->userdata('user_id');
        $up_array = array(
            'password' => md5($this->input->post('new_password')),
            'password_without_md5' => $this->input->post('new_password'),
        );
        $this->db->where('user_id', $admin_id);
        $this->db->update('hvs_supplier', $up_array);
        return true;
    }
//----------------------------------------Prasad--------------------------------------------
    public function get_entry_supplier() {
        $data = $_POST;
        $query_email = $this->db->get_where('hvs_supplier', array("sup_email" => $data['email']));
        $result = $query_email->result_array();
        foreach ($result as $res) {
            $stored_salt = $res['sup_salt'];
            $stored_passsword = $res['sup_password'];
        }
        $userPassword = $data['password'];
        $hashedPassword = sha1($userPassword . $stored_salt);
        $query = $this->db->get_where('hvs_supplier', array("sup_email" => $data['email'], "sup_password" => $hashedPassword));
        if ($query->num_rows() > 0) {
            $res = $query->result_array();
            return $res[0];
        }
    }
    public function check_supplier_status() {
        $data = $_POST;
        $query_email = $this->db->get_where('hvs_supplier', array("sup_email" => $data['email']));
        $result = $query_email->result_array();
        foreach ($result as $res) {
            $stored_salt = $res['sup_salt'];
            $stored_passsword = $res['sup_password'];
        }
        $userPassword = $data['password'];
        $hashedPassword = sha1($userPassword . $stored_salt);
        $query_block = $this->db->get_where('hvs_supplier', array("sup_email" => $data['email'], "sup_password" => $hashedPassword, "sup_status" => 4));
        if ($query_block->num_rows() > 0) {
            return "block";
        } else {
            $query_pending = $this->db->get_where('hvs_supplier', array("sup_email" => $data['email'], "sup_password" => $hashedPassword, "sup_status" => 1, "sup_status" => 0));
            if ($query_pending->num_rows() > 0) {
                return "pending";
            }
        }
    }
    public function check_supplier_verify() {
        $data = $_POST;
        $query_email = $this->db->get_where('hvs_supplier', array("sup_email" => $data['email']));
        $result = $query_email->result_array();
        foreach ($result as $res) {
            $stored_salt = $res['sup_salt'];
            $stored_passsword = $res['sup_password'];
        }
        $userPassword = $data['password'];
        $hashedPassword = sha1($userPassword . $stored_salt);
        $query = $this->db->get_where('hvs_supplier', array("sup_email" => $data['email'], "sup_password" => $hashedPassword, "sup_email_verified" => '0'));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    public function check_supplier_onhold() {
        $supplier_id = $this->session->userdata('supplier_id');
        $query = $this->db->get_where('hvs_supplier', array("sup_id" => $supplier_id, "sup_status" => '5', "sup_email_verified" => '1'));
        /* echo $this->db->last_query();
          die; */
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }
    public function check_attempt_counter() {
        $username = $this->input->post('email');
        $query = $this->db->get_where('hvs_supplier', array("sup_email" => $username));
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $res) {
                $stored_counter = $res['failed_login'];
            }
            $data_array = array(
                'failed_login' => $stored_counter + 1,
            );
            $this->db->where('sup_email', $username);
            $this->db->update('hvs_supplier', $data_array);
            return $this->db->affected_rows();
        } else {
            return "not valid";
        }
    }
    public function current_attempt($email) {
        $query = $this->db->get_where('hvs_supplier', array("sup_email" => $username,'asc'));
        $result = $query->result_array();
        foreach ($result as $res) {
            return $res['failed_login'];
        }
    }
    public function block_supplier() {
        $username = $this->input->post('email');
        $data_array = array(
            'sup_status' => 4,
        );
        $this->db->where('sup_email', $username);
        $this->db->update('hvs_supplier', $data_array);
    }
    public function get_all_state() {
        $this->db->order_by('states.stateName', 'asc');
        $query = $this->db->get_where('states');
        return $query->result();
    }
    public function get_all_city() {
        $query = $this->db->get_where('cities');
        return $query->result();
    }
    public function get_state($id) {
        //$query=$this->db->get_where('hvs_states',array('countryID'=>$id));
        $query = $this->db->select('sup_sts.*')
                ->from('states sup_sts')
                ->join('country sup_con', "sup_con.iso3 = sup_sts.countryId")
                ->where('sup_con.id', $id)
                ->get();
        return $query->result();
    }
    public function get_city($id) {
        $query = $this->db->get_where('cities', array('stateID' => $id));
        return $query->result();
    }
        public function get_single() {
        $query = $this->db->get_where('cities', array('stateID' => $id));
        return $query->result();
        
    }
    public function add_supplier_post() {
        //$random_code = date('his').random_string('alnum',6);
        //$my_random_number = rand(1000, 9999);
        $userPassword = $this->input->post('password');
        $salt = time();
        $hashedPassword = sha1($userPassword . $salt);
        $email_code = md5(uniqid(rand()));
        $check = $this->db->get_where('hvs_supplier', array('sup_email' => $this->input->post('email')));
        if ($check->num_rows() == 0) {
            $data_array = array(
                'sup_first_name' => $this->input->post('f_name'),
                'sup_last_name' => $this->input->post('l_name'),
                'sup_email' => $this->input->post('email'),
                'sup_address' => $this->input->post('address'),
                'sup_country' => $this->input->post('country'),
                'sup_city' => $this->input->post('city'),
                'sup_state' => $this->input->post('state'),
                'sup_zipcode' => $this->input->post('zipcode'),
                'createdat' => date('Y-m-d H:i:s'),
                'sup_password' => $hashedPassword,
                'sup_salt' => $salt,
                'sup_verification_code' => $email_code
            );
            $this->db->insert('hvs_supplier', $data_array);
            //-------Sending Email--------------------- 
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $config['priority'] = '1';
            $this->email->initialize($config);
            $this->email->from('SITE_EMAIL', "Admin Team");
            $this->email->to($this->input->post('email'));
            $this->email->subject('Welcome To HV Square');
            //$msg = '';
            $msg = 'Hello ' . $this->input->post('f_name');
            $msg.= '<br/>';
            $msg.= 'Welcome to HV Square';
            $msg.= '<br/>';
            $msg.= 'You should verify your email by clicking the link below';
            $msg.= '<br/>';
            $msg.= base_url() . 'VerifySupplierEmail/' . $email_code;
            //$data_email['user_name'] = $this->input->post('name');
            //$data_email['email_code'] = $email_code;
            //$msg = $this->load->view('email/verify_email',$data_email, TRUE);
            $this->email->message($msg);
            $this->email->send();
            return $this->db->affected_rows();
        } else {
            return 2;
        }
    }
    public function get_date_supplier_data($id) {
        $query = $this->db->get_where('hvs_supplier', array('sup_verification_code' => $id));
        return $query->result();
    }
    public function verify_supplier_email($id) {
        $up_array = array(
            'sup_email_verified' => '1',
        );
        $this->db->where('sup_verification_code', $id);
        $this->db->update('hvs_supplier', $up_array);
        return $this->db->affected_rows();
    }
//---------------------------------------------------------------------------------------------
    ///////////////////////////
    public function get_entry_consumer() {
        $data = $_POST;
        $query = $this->db->get_where('hvs_consumer', array("email" => $data['email'], "password" => md5($data['password'])));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    public function add_consumer_post($data) {
        $random_code = date('his') . random_string('alnum', 6);
        $my_random_number = rand(1000, 9999);
        $email_code = md5(uniqid(rand()));
        $check = $this->db->get_where('hvs_consumer', array('email' => $this->input->post('email')));
        if ($check->num_rows() == 0) {
            $data_array = array(
                //'user_uid'=>$random_code,
                'first_name' => $this->input->post('f_name'),
                'last_name' => $this->input->post('l_name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'password_without_md5' => $this->input->post('password'),
                'address' => $this->input->post('address'),
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zipcode' => $this->input->post('zipcode'),
                //'user_type'=>$this->input->post('user_type'),
                'createdat' => date('Y-m-d H:i:s'),
                'email_verified_code' => $email_code,
                    //'user_type'=>1,
            );
            $this->db->insert('hvs_consumer', $data_array);
            //-------Sending Email--------------------- 
            /* $config['wordwrap'] = TRUE;
              $config['mailtype'] = 'html';
              $config['priority'] = '1';
              $this->email->initialize($config);
              $this->email->from('SITE_EMAIL', "Admin Team");
              $this->email->to($this->input->post('email'));
              $this->email->subject('Welcome To HV Square');
              //$msg = '';
              $msg = 'Hello '.$this->input->post('f_name');
              $msg.= '<br/>';
              $msg.= 'Welcome to HV Square';
              $msg.= '<br/>';
              $msg.= 'You should verify your email by clicking the link below';
              $msg.= '<br/>';
              $msg.= base_url().'VerifySupplierEmail/'.$email_code;
              //$data_email['user_name'] = $this->input->post('name');
              //$data_email['email_code'] = $email_code;
              //$msg = $this->load->view('email/verify_email',$data_email, TRUE);
              $this->email->message($msg);
              $this->email->send(); */
            return $this->db->affected_rows();
        } else {
            return 2;
        }
    }
    public function get_date_consumer_data($id) {
        $query = $this->db->get_where('hvs_consumer', array('email' => $id));
        return $query->result();
    }
    public function verify_consumer_email($id) {
        $up_array = array(
            'verified' => '1',
        );
        $this->db->where('email_verified_code', $id);
        $this->db->update('hvs_consumer', $up_array);
        return $this->db->affected_rows();
    }
    ////////////////////////
    public function get_admin_data() {
        $admin_id = $this->session->userdata('hvs_admin');
        $query = $this->db->get_where('hvs_admin', array('user_id' => $admin_id));
        return $query->result();
    }
	
	 public function get_admin_detail() {        
        $query = $this->db->get_where('ai_admin', array('admin_id' => 1));
        return $query->row();
    }
    /* 	public function get_all_categories()
      {
      $query=$this->db->get_where('event_categories');
      return $query->result();
      }
     */
    public function get_all_country() {
        $this->db->order_by('country.name', 'asc');
        $query = $this->db->get('country');
        return $query->result();
    }
    public function get_all_states($countryID = '') {
        //$query=$this->db->get_where('hvs_states');
        $this->db->select('states.*');
        $this->db->where('countryID', $countryID);
        $query = $this->db->get('states');
        return $query->result();
    }
    public function add_user_post($data) {
        $random_code = date('his') . random_string('alnum', 6);
        $my_random_number = rand(1000, 9999);
        $email_code = md5(uniqid(rand()));
        $check = $this->db->get_where('hvs_supplier', array('email' => $this->input->post('email')));
        //$event_category = implode(",", $_POST['event_category']);  
        if ($check->num_rows() == 0) {
            /* if($data)
              $image_url = $data['upload_data']['file_name'];
              else
              $image_url = "default.png"; */
            $data_array = array(
                //'user_uid'=>$random_code,
                'first_name' => $this->input->post('f_name'),
                'last_name' => $this->input->post('l_name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'password_without_md5' => $this->input->post('password'),
                'address' => $this->input->post('address'),
                //'profile_image'=>$image_url,
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zipcode' => $this->input->post('zipcode'),
                'user_type' => $this->input->post('user_type'),
                //'event_category_uid'=>$event_category,
                //'join_through'=>'website',
                'createdat' => date('Y-m-d H:i:s'),
                    //'contact_no'=>$this->input->post('contact'),
                    //'email_code'=>$email_code
            );
            $this->db->insert('hvs_supplier', $data_array);
            //-------Sending Email--------------------- 
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $config['priority'] = '1';
            //$this->email->initialize($config);	
            $this->email->from('SITE_EMAIL', "Admin Team");
            $this->email->to($this->input->post('email'));
            $this->email->subject('Welcome To HV Square');
            //$msg = '';
            $msg = 'Hello ' . $this->input->post('f_name');
            $msg.= '<br/>';
            $msg.= 'Welcome to HV Square';
            $msg.= '<br/>';
            $msg.= 'You should verify your email by clicking the link below';
            $msg.= '<br/>';
            $msg.= base_url() . 'VerifyUserEmail/' . $email;
            $data_email['user_name'] = $this->input->post('name');
            //$data_email['email_code'] = $email_code;
            $msg = $this->load->view('email/verify_email', $data_email, TRUE);
            $this->email->message($msg);
            $this->email->send();
            return $this->db->affected_rows();
        } else {
            return 2;
        }
    }
    /*
     * Manish
     */
    function get($table_name, $all = true, $condition = array(), $colom = array()) {
        if (!empty($colom)) {
            $this->db->select(implode(',', $colom));
        }
        $this->db->from($table_name);
        foreach ($condition as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = array();
        if ($all) {
            $result = $query->result();
        } else {
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
            }
        }
        //echo '<pre>';
        //print_r($result);die;
        return $result;
    }
    public function get_where($table, $orderby_field = '', $orderby_val = '', $where_field, $select_column = '') {
        if (!empty($select_column)) {
            $this->db->select($select_column);
        }
        if ($orderby_field)
            $this->db->order_by($orderby_field, $orderby_val);
        if ($where_field) {
            $this->db->where($where_field);
        }
        $query = $this->db->get($table);
        //  echo $this->db->last_query();die;
        if ($query->num_rows > 0) {
            return $query->result_array();
        }
    }
    public function getAllAtribOfChild($catid) {
        $this->db->select('cat_attribute');
        $this->db->from('category');
        $this->db->where_in('cat_id', $catid);
        $query = $this->db->get();
        $results = $query->result();
        $main_array = array();
        $temp = array();
        foreach ($results as $result):
            if (!empty($result->cat_attribute))
                $temp = array_merge($temp, json_decode($result->cat_attribute, true));
        endforeach;
        //print_r($main_array); exit;
        return $temp;
    }
/////////////////////// 
    public function get_data_by_join($table, $table2, $where, $table1_column, $table2_column, $limit = '', $order_column = '', $order_by = 'DESC', $select_columns = '', $is_single_record = false, $group_by = '', $join_by = '') {
        if (!empty($select_columns)) {
            $this->db->select($select_columns);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        $this->db->join($table2, $table . '.' . $table1_column . '=' . $table2 . '.' . $table2_column, $join_by);
        $this->db->where($where);
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (!empty($order_column)) {
            $this->db->order_by($order_column, $order_by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            if ($is_single_record) {
                $rs = $query->result_array();
                return $rs[0];
            } else {
                return $query->result_array();
            }
        } else {
            return false;
        }
    }
    
    public function add_page_post()
	{
		$check = $this->db->get_where('pages',array('page_title'=>$this->input->post('title')));
		if($check->num_rows() == 0)
		{
                    $data_array = array(
                    'page_title'=>$this->input->post('title'),
                    'page_content'=>$this->input->post('description'),
                    'meta_title'=>$this->input->post('m_title'),
                    'meta_description'=>$this->input->post('m_desc'),
                    'meta_keyword'=>$this->input->post('m_keyword'),
                    'is_active' => $this->input->post('status')
                    );
                    $data_array['create_date'] = date('Y-m-d h:i:s');
                    $this->db->insert('pages',$data_array);
                    return $this->db->affected_rows();
		}
		else
		{ return 2; }
	}
    function getsingle($table, $where = '', $fld = NULL, $order_by = '', $order = '') {
        if ($fld != NULL) {
            $this->db->select($fld);
        }
        $this->db->limit(1);
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        if ($where != '') {
            $this->db->where($where);
        }
        $q = $this->db->get($table);
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        } else {
            return 'no record found';
        }
    }
     function getsinglewith_like($table, $where = '', $fld = NULL, $order_by = '', $order = '', $LIKE = '') {
        if ($fld != NULL) {
            $this->db->select($fld);
        }
        $this->db->limit(1);
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        if ($where != '') {
            $this->db->where($where);
        }
         if ($LIKE != '') {
            $this->db->where($LIKE);
        }
        $q = $this->db->get($table);
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        } else {
            return 'no record found';
        }
    }
    
    function getsingle_new($table, $where = '', $fld = NULL, $order_by = '', $order = '') {
        if ($fld != NULL) {
            $this->db->select($fld);
        }
        //$this->db->limit(1);
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        if ($where != '') {
            $this->db->where($where);
        }
        $q = $this->db->get($table);
        //echo $this->db->last_query();
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        } else {
            return 'no record found';
        }
    }
    /* <!--Join tables get single record with using where condition--> */
    function GetJoinRecord($table, $field_first, $tablejointo, $field_second, $field, $value, $field1, $value1, $field_val) {
        $this->db->select("$field_val");
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        $this->db->where("$table.$field", "$value");
        $this->db->where("$table.$field1", "$value1");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    /* ---GET MULTIPLE RECORD--- */
    function getAllwhere($table, $where = '', $order_fld = '', $order_type = '', $select = 'all', $limit = '', $offset = '') {
        if ($order_fld != '' && $order_type != '') {
            $this->db->order_by($order_fld, $order_type);
        }
        if ($select == 'all') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        if ($where != '') {
            $this->db->where($where);
        }
        if ($limit != '' && $offset != '') {
            $this->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->db->limit($limit);
        }
        $q = $this->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            return 'no';
        }
    }
    function getAllwherenew($table, $where, $select = '') {
        if ($select == '') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        $this->db->where($where);
        $q = $this->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            return 'no';
        }
    } 
        function getAllwherenew_try($table, $where, $select = '',$order_fld = '', $order_type = '') {
            if ($order_fld != '' && $order_type != '') {
            $this->db->order_by($order_fld, $order_type);
        }
        if ($select == '') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        $this->db->where($where, NULL, FALSE);
        $q = $this->db->get($table);
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        } else {
            return 'no record found';
        }
        
    } 
    function getAllwherenewwith_order($table, $where, $select = '',$order_field = '',$order_by = '') {
        if ($select == '') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        if ($order_field != '' && $order_by != '') {
            $this->db->order_by($order_field, $order_by);
        }
        $this->db->where($where, NULL, FALSE);
        $q = $this->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            return 'no';
        }
    }  
    function getAllwherenewRecord($table, $where, $select = '') {
        if ($select == '') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        $this->db->where($where, NULL, FALSE);
        $q = $this->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            return 'no';
        }
    }
    function getAllwherenewgroup($table, $where, $select = '') {
        if ($select == '') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        $this->db->where($where, NULL, FALSE);
        $this->db->group_by("$table.benefit_name");
        $q = $this->db->get($table);
        
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            return 'no';
        }
    }
    // for searching
   function getCat($search){
  $this->db->select("cat_name");
  $whereCondition = array('cat_name' =>$search);
  $this->db->where($whereCondition);
  $this->db->from($table);
  $query = $this->db->get($table);
  return $query->result();
 }
    public function get_per_pages($id)
	{
		$query=$this->db->get_where('pages',array('page_id'=>$id));
		return $query->result();
	}
    
    
    public function get_page_status($id)
	{
		$query=$this->db->get_where('pages',array('page_id'=>$id));
		$r = $query->row();
        return $r->is_active;
	}
        
    public function edit_page_post($id)
	{
            $data_array = array(
                            'page_title'=>$this->input->post('title'),
                            'page_content'=>$this->input->post('description'),
                            'meta_title'=>$this->input->post('m_title'),
                            'meta_description'=>$this->input->post('m_desc'),
                            'meta_keyword'=>$this->input->post('m_keyword'),
                            'is_active' => $this->input->post('status')
                            );
            $data_array['update_date'] = date('Y-m-d h:i:s');
            $this->db->where('page_id',$id);
            $this->db->update('pages',$data_array);
            return $this->db->affected_rows();
	}
        
        public function active_pages($id)
	{
		$this->db->where('page_id',$id);
		$query= $this->db->update('pages',array('status'=>1));
		return $query;
	}
        
        public function get_all_sub_cat($select='',$where='',$orderby,$order_field){
            if($select) 
                {
                    $this->db->select($select);
                } 
                else 
                {
                    $this->db->select('ai_category.*');
                    $this->db->select('b.cat_name as parent_level');
                }                
                if($where)
		$this->db->where($where);
                //join members table 
                $this->db->join('ai_category as b', 'ai_category.cat_parent_id = b.cat_id','left');
                 $this->db->order_by($order_field,$orderby);         
		$query = $this->db->get("ai_category");
		if($query->num_rows>0)
		{
			return $query->result_array();
		}else
		{
			return false;
		}
   }
    
}
// class close here
?>