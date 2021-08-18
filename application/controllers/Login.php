<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$this->load->view('user_login');
	}

	function validation(){
		$post_data=$this->input->post();
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		if ($this->form_validation->run()) {
			unset($post_data['submit']);
			$user_data = $this->login_model->get_user_details($post_data);
			if ($user_data) {
				$session_data=array(
				'username' => $user_data[0]->username,
				'email' => $user_data[0]->email,
				'mobile' => $user_data[0]->mobile
			);
			// debug($session_data);exit;
			$this->session->set_userdata($session_data);
			redirect(base_url().'dashboard');
			}
			else{
				$this->session->set_flashdata('message','Invalid Credentials');
				redirect(base_url().'login');
			}
				
		}
		else{
			$this->index();
		}
	}
}
?>