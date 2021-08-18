<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Register_model extends CI_Model
{
	
	function insert_users($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	function get_user_details_by_id($data){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('origin',$data);
		$query = $this->db->get();
		// debug($query);exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}
	function update_user_data($data){
		$this->db->set('password',$data['password']);
		$this->db->where('origin',$data['id']);
		$this->db->update('users');
		return $this->db->affected_rows();
	}
}
?>