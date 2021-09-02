<?php 
/**
 * 
 */
class General extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('general_model');	
		$this->load->model('dashboard_model');	
	}
	
	function index(){
		$data['products'] = $this->dashboard_model->get_all_products();
		$data['food_items']=$this->general_model->get_all_food_items();
		// debug($data);exit;
		$this->load->view('general/index',$data);
	}
}
 ?>