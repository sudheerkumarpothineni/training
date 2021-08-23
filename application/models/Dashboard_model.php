<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Dashboard_model extends CI_Model
{
	
	function get_user_details()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		// debug($query);exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function add_product($data){
		$this->db->insert('products',$data);
		return $this->db->insert_id();
	}

	function get_all_products(){
		$where = "quantity > 0 AND status = 1";
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where($where);
		$query = $this->db->get();
		// debug($query);exit;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
	}

	function user_delete($origin){
		// debug($origin);exit;
		$this->db->where('origin',$origin);
		$this->db->delete('users');
		if ($this->db->affected_rows() > 0) {
			redirect('dashboard');
		}
	}

	function get_user_details_by_id($data){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('origin',$data['origin']);
		$query = $this->db->get();
		// debug($query);exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function update_user_data($data){
		// debug($data);exit('sudheer');
		$update_data = array('username' => $data['username'],'mobile' => $data['mobile'],'email' => $data['email']);
		$this->db->set($update_data);
		$this->db->where('origin',$data['origin']);
		$this->db->update('users');
		return $this->db->affected_rows();
	}

	function change_user_status($data){
		if ($data['status'] == ACTIVE) {
			$data['status'] = IN_ACTIVE;
		}
		else{
			$data['status'] = ACTIVE;
		}
		$this->db->set('status',$data['status']);
		$this->db->where('origin',$data['origin']);
		$this->db->update('users');
		return $this->db->affected_rows();

	}

	function razorpay_insert($data){
		$this->db->insert('razorpay_payment',$data);
		return $this->db->insert_id();
	}
}
?>