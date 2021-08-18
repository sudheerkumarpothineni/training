<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model
{
	
	function get_user_details($data)
	{
		$where = "email = '".$data["username"]."' or mobile = '".$data["username"]."'";
		$this->db->where($where);
		$this->db->where('password',$data['password']);
		$this->db->where('status',1);
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		// debug($query);exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}
}
?>