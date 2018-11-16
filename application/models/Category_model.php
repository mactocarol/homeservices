<?php
class Category_model extends CI_Model {
    
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
   
   function run_query($query,$always_result='no') { //if $always_result == 'yes' then we will use result() function for tacking results either we have only one row.
        $query_res = $this->db->query($query);
        $num = $query_res->num_rows();
        if($always_result == 'no' ){
            if ($num == 1) {
                $res = $query_res->row();
            } else if ($num == 0) {
                $res = 'no';
            } else {
                $res = $query_res->result();
            }
        }else{
            $res = $query_res->result();
        }
        return $res;
    }

    function run_query_arr($query) {
        $query_res = $this->db->query($query);
        $num = $query_res->num_rows();
        if ($num > 0) {
            $res = $query_res->result();
        } else {
            $res = 'no';
        }
        return $res;
    }
    
    function getcount($table, $where) {
        $this->db->where($where);
        $q = $this->db->count_all_results($table);
        return $q;
    }

    /* <!--GET SUM FROM SINGLE TABLE--> */

    function getSum($table, $where, $data) {
        $this->db->where($where);
        $this->db->select_sum($data);
        $q = $this->db->get($table);
        return $q->result();
    }

    function getTotalsum($table, $where, $data) {
        $this->db->where($where);
        $this->db->select_sum($data);
        $q = $this->db->get($table);
        return $q->row();
    }
   
}
?>