<?php
/**
 * 
 */
class General_model extends CI_Model
{
	function get_all_food_items(){
		$result=$this->db->query("call get_all_food_items()")->result_array();
		return $result;
	}
}
?>