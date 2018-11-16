<?php

class Page_model extends CI_Model {
	
	
	public function get_all_pages()
	{
		$query=$this->db->get_where('pages');
  		return $query->result();
	}
	
	public function get_parent_pages()
	{
		$query=$this->db->get_where('pages',array('parent_page_id'=>'0'));
		return $query->result();
	}
	
	public function add_page_post()
	{
		$random_code = date('his').random_string('alnum',6);
		
		$check = $this->db->get_where('page_details',array('title'=>$this->input->post('title')));
		
		if($check->num_rows() == 0)
		{
			
						$data_array = array(

						'page_uid'=>$random_code,
						
						'title'=>$this->input->post('title'),
						
						'parent_page_id'=>$this->input->post('parent_page_id'),

						'page_content'=>$this->input->post('description'),
						
						'meta_title'=>$this->input->post('m_title'),

						'meta_description'=>$this->input->post('m_desc'),

						'meta_keyword'=>$this->input->post('m_keyword') 

						);
                            $data_array['page_add_date'] = date('Y-m-d h:i:s');
                            $this->db->insert('page_details',$data_array);
			
			return $this->db->affected_rows();
		}

		else
		{
			return 2;
		}
	}
	
	public function get_per_pages($id)
	{
		$query=$this->db->get_where('page_details',array('page_uid'=>$id));
		return $query->result();
	}
	
	public function edit_page_post($id)
	{
		
		
		$data_array = array(

			'title'=>$this->input->post('title'),
					
			'parent_page_id'=>$this->input->post('parent_page_id'),

			'page_content'=>$this->input->post('description'),
			
			'meta_title'=>$this->input->post('m_title'),

			'meta_description'=>$this->input->post('m_desc'),

			'meta_keyword'=>$this->input->post('m_keyword') 
		);
                        $data_array['page_update_date'] = date('Y-m-d h:i:s');

		$this->db->where('page_uid',$id);

		$this->db->update('page_details',$data_array);

		return $this->db->affected_rows();
	
		//echo $this->db->last_query();
		//die;
	}
	
	public function active_pages($id)
	{
		$this->db->where('page_id',$id);

		$query= $this->db->update('pages',array('status'=>1));

		return $query;
	}
	
	public function block_pages($id)
	{
		$this->db->where('page_uid',$id);

		$query= $this->db->update('page_details',array('status'=>0));

		return $query;
	}
	
	
	
	}
?>