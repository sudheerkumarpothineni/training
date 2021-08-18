<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Register extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$this->load->view('user_register');
	}

	function validation(){
		$post_data=$this->input->post();
			debug($post_data);exit;
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('mobile','Mobile Number','required|trim|is_unique[users.mobile]');
		if ($this->form_validation->run()) {
			$post_data['password']=rand(1000,100000).date('Y').time();
			$result=$this->register_model->insert_users($post_data);
			if ($result) {
				//Custom library
				$this->load->library('common_email');
				$subject = ucfirst($post_data['username']).' Registation';
				$message = 'Your Credentials are <br>';
				$message.= '<h3><strong>Username</strong> is - '. $post_data['email'] . '/'. $post_data['mobile'] .'</h3>';
				$message.= '<h3><strong>Password </strong> is - '. $post_data['password'] .'</h3>';
				$mail_status = $this->common_email->sending_email($post_data['email'],$subject,$message);
				if ($mail_status == 'success') {
					$this->session->set_flashdata('message', 'Registration Success');
					redirect(base_url().'register');
				}
				else{
					$this->index();
				}
			}
		}
		else{
			$this->index();
		}
	}
}
?>